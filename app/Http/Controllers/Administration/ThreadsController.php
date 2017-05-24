<?php

namespace wolfteam\Http\Controllers\Administration;

use Auth;
use GrahamCampbell\Markdown\Facades\Markdown;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateThreadRequest;
use wolfteam\Models\Channel;
use wolfteam\Models\Message;
use wolfteam\Models\Thread;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function thread($thread_id)
    {

        if($thread_id){
            $thread = Thread::findOrFail($thread_id);
            return view('threads.thread', compact('thread'));
        }
    }

    public function create($channel_id)
    {
        $thread = new Thread();
        $c = Channel::all();
        $channel = $c->where('id', $channel_id)->first();
        $channels = $c->pluck('title', 'id');
        return view('threads.create_channel', compact('channels', 'thread', 'channel'));
    }

    public function store(UpdateThreadRequest $request)
    {
        $thread = new Thread();
        $message = new Message();

        $thread->title = $request->title;
        $thread->slug = $request->slug;
        $thread->channel_id = $request->channel;
        $thread->user_id = Auth::id();

        $save_thread = $thread->save();

        if($save_thread){
            $message->text = Markdown::convertToHtml($request->input('content'));
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
                return redirect()->action('Administration\ChannelsController@channel', $thread->channel_id)->with('success', 'Votre sujet a été crée.');
            }
        }
        return redirect()->action('Administration\ChannelsController@channel', $thread->channel_id)->with('erreur', 'Erreur sur l\'enregistrement de votre sujet.');
    }

    public function destroy_thread($thread)
    {
        if($thread){
            if(is_numeric($thread)){
                $delete = Thread::where('id', $thread)->delete();
                if($delete){
                    return redirect()->back()->with('success', 'Le sujet a bien été supprimé');
                }
            }
        }
        return redirect()->back()->with('error', 'Le sujet n\'a pas été supprimé');
    }
}