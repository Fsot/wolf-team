<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 13/04/2017
 * Time: 13:28
 */

namespace wolfteam\Http\Controllers\Pages;


use Auth;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use League\HTMLToMarkdown\HtmlConverter;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\AnswerRequest;
use wolfteam\Http\Requests\UpdateForumChannelRequest;
use wolfteam\Http\Requests\UpdateMessageRequest;
use wolfteam\Http\Requests\UpdateThreadRequest;
use wolfteam\Models\BlackWord;
use wolfteam\Models\Categorie;
use wolfteam\Models\Channel;
use wolfteam\Models\LoginAttempt;
use wolfteam\Models\Message;
use wolfteam\Models\Setting;
use wolfteam\Models\Thread;
use wolfteam\Models\User;
use wolfteam\Notifications\AlertedMessageAdmin;

class ForumsController extends Controller
{

    use Notifiable;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $settings = Setting::where('name', 'like', 'forum%')->get();
            $s = $settings->where('name', 'forum_on')->first()->value;
            if($s == 0){
                return redirect('/')->with('info', 'Le forum est actuellement fermer. Rassurez-vous ce n\'est pas définitif.');
            }
            return $next($request);
        });

        $this->middleware('auth')->except(['index', 'channel','thread']);
    }

    public function index()
    {
        $channels = [];
        $c = Channel::all();
        $categories = Categorie::where('type', 'forum')->get();
        foreach ($categories as $category) {
            $channels[$category->title] = $c->where('categorie_id', $category->id);
        }
        foreach ($c as $chan){
            $loginAttempts = LoginAttempt::where('user_id', Auth::id())->where('success', true)->orderBy('login_time', 'desc')->select('login_time')->get();
            if(isset($loginAttempts[1])) {
                $last_login = Carbon::createFromFormat('Y-m-d H:i:s', $loginAttempts[1]->login_time);
                foreach ($chan->threads as $thread) {
                    foreach ($thread->messages as $message) {
                        if ($message->updated_at->timestamp > $last_login->timestamp) {
                            $chan->new_msg = true;
                        } else {
                            $chan->new_msg = false;
                        }
                    }
                }
            }
        }
        return view('forums.index', compact('channels'));
    }

    public function channel($channel)
    {
        $channel = Channel::where('slug', $channel)->first();
        $threads = Thread::where('channel_id', $channel->id)->orderByDesc('created_at')->get();
        if($channel){
            $loginAttempts = LoginAttempt::where('user_id', Auth::id())->where('success', true)->orderBy('login_time', 'desc')->select('login_time')->get();
            foreach ($threads as $thread){
                foreach ($thread->messages as $msg){
                    if(isset($loginAttempts[1])) {
                        $last_login = Carbon::createFromFormat('Y-m-d H:i:s', $loginAttempts[1]->login_time);
                        if ($msg->updated_at->timestamp > $last_login->timestamp) {
                            $thread->new_msg = true;
                        } else {
                            $thread->new_msg = false;
                        }
                    }
                    if($thread->answer_id == $msg->id){
                        if($msg->destroy == 1){
                            $thread->destroy = 1;
                        }
                    }
                }
            }
            return view('forums.channel', compact('channel', 'threads'));
        }
    }

    public function create_thread($channel_id)
    {
        $thread = new Thread();
        $c = Channel::all();
        $channel = $c->where('id', $channel_id)->first();
        $channels = $c->pluck('title', 'id');
        return view('forums.create_channel', compact('channels', 'thread', 'channel'));
    }

    public function store_thread(UpdateForumChannelRequest $request)
    {
        $thread = new Thread();
        $message = new Message();

        $thread->title = $request->title;
        $thread->slug = $request->slug;
        $thread->channel_id = $request->channel;
        $thread->user_id = Auth::id();

        $save_thread = $thread->save();

        if($save_thread){
            $content = $this->black_words($request->input('content'));

            $message->text = Markdown::convertToHtml($content);
            $message->user_id = Auth::id();
            $message->thread_id = $thread->id;
            $message->alert = 0;
            $message->moderate = 0;
            $message->doModerate = 0;
            $message->destroy = 0;

            $save_message = $message->save();

            if($save_message){
                $thread->update([
                    'answer_id' =>  $message->id
                ]);
                return redirect()->action('Pages\ForumsController@thread', $thread->slug)->with('success', 'Votre sujet a été crée.');
            }
        }
        return redirect()->action('Pages\ForumsController@index')->with('erreur', 'Erreur sur l\'enregistrement de votre sujet.');
    }

    public function edit_thread($thread_id)
    {
        if($thread_id && is_numeric($thread_id)){
            $thread = Thread::findOrFail($thread_id);
            if($thread->user_id == Auth::id() OR Auth::user()->can('edit_other_message')){
                $thread->content = $thread->messages->where('id', $thread->answer_id)->first()->text;
                $converter = new HtmlConverter(['header_style' => 'atx']);
                $thread->content = $converter->convert($thread->content);

                if($thread){
                    $c = Channel::all();
                    if($c){
                        $channel = $c->where('id', $thread->channel_id)->first();
                        $channels = $c->pluck('title', 'id');
                        return view('forums.edit_thread', compact('thread', 'channel', 'channels'));
                    }
                }
            }else{
                return redirect()->back()->with('info', 'Vous ne pouvez pas modifier le message des autres');
            };
        }
    }

    public function update_thread($thread_id, UpdateThreadRequest $request)
    {
        if($thread_id){
            if(is_numeric($thread_id)){
                $thread = Thread::findOrFail($thread_id);
                if($thread){
                    $message = Message::findOrFail($thread->answer_id);
                    if($message){
                        $persist_thread = $thread->update([
                           'title' => $request->title,
                            'channel_id' => $request->channel
                        ]);
                        $persist_msg = $message->update([
                           'text' => Markdown::convertToHtml($request->input('content'))
                        ]);
                        if($persist_msg == true && $persist_thread == true){
                            return redirect()->action('Pages\ForumsController@thread', $thread->slug)->with('success', 'Votre sujet a bien été modifié.');
                        }
                    }
                }
            }
        }
        return redirect()->action('Pages\ForumsController@thread', $thread->slug)->with('error', 'Erreur sur la modification de votre sujet.');
    }

    public function thread($thread_slug){
        $thread = Thread::where('slug', $thread_slug)->first();
        $content = Message::where('thread_id', $thread->id)->orderBy('created_at', 'desc')->get();
        $subject = $content->where('id', $thread->answer_id)->first();
        if($subject->destroy == true && !Auth::user()->hasRole('sup_admin')) {
            return redirect()->back()->with('info', 'Ce message a été bloqu" par notre équipe.');
        }
        $messages = $content->whereNotIn('id', $thread->answer_id);
        $count_answers = $messages->count();
        $answers = $this->paginate($messages->all(), 15);
        $paginate = $this->view_paginate($answers);
        return view('forums.thread', compact('thread', 'subject', 'answers', 'count_answers','paginate'));
    }

    public function answer($thread, AnswerRequest $request)
    {
       if($thread){
            if(is_numeric($thread)){
                $answer = $this->black_words($request->input('content'));
                $message = Message::create([
                    'text' =>  Markdown::convertToHtml($answer),
                    'user_id'   => Auth::id(),
                    'thread_id' => $thread,
                    'alert' => false,
                    'moderate' => false,
                    'destroy' => false
                ]);
                if($message){
                    return redirect()->back()->with('success', 'Votre message a été publié.');
                }
            }
       }



    }

    public function edit_message($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    if($msg->user_id == Auth::user()->id){
                        $converter = new HtmlConverter(['header_style' => 'atx']);
                        $msg->text = $converter->convert($msg->text);
                        return view('forums.edit_message', compact('msg'));
                    }
                }
            }
        }
    }

    public function update_message($msg_id, UpdateMessageRequest $request)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg->user_id == Auth::user()->id){
                    $msg->update([
                       'text' => Markdown::convertToHtml($request->input('content'))
                    ]);
                    return redirect()->action('Pages\ForumsController@thread', $msg->thread->slug)->with('success', 'Votre message a bien été modifié.');
                }
            }
        }
        return redirect()->action('Pages\ForumsController@thread', $msg->thread->slug)->with('error', 'Erreur sur la modification de votre message.');
    }

    public function advertissement($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    $updated = $msg->update([
                       'alert' => true
                    ]);
                    if($updated == true){
                        $users = User::all();
                        foreach ($users as $user){
                            if($user->hasRole('sup_admin')){
                                if($user){
                                    $user->notify(new AlertedMessageAdmin($msg));
                                }
                            }
                        }
                        return redirect()->back()->with('success', 'Le message a bien été signalé à notre equipe. Nous allons effectuer des verifications sur son contenu.');
                    }
                }
            }
        }
        return redirect()->back()->with('error', 'Erreur sur le signalement du message.');
    }


    private function paginate($items, $perPage)
    {
        $pageStart           = \Request::get('page', 1);
        $offSet              = ($pageStart * $perPage) - $perPage;
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, TRUE);

        return new LengthAwarePaginator(
            $itemsForCurrentPage, count($items), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    private function black_words($str){
        $blackwords = BlackWord::all();
        $patterns = [];
        foreach ($blackwords as $bw){
           array_push($patterns, '/\b'.$bw->word.'\b/i');
        }
        return preg_replace($patterns, '****',$str);
    }
}