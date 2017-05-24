<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 26/04/2017
 * Time: 08:55
 */

namespace wolfteam\Http\Controllers\Administration;


use Illuminate\Notifications\Notifiable;
use League\HTMLToMarkdown\HtmlConverter;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateMessageRequest;
use wolfteam\Models\Message;
use GrahamCampbell\Markdown\Facades\Markdown;
use wolfteam\Models\Thread;
use wolfteam\Models\User;
use wolfteam\Notifications\ModeratedForumMessage;

class MessagesController extends Controller
{
    use Notifiable;

    public function __construct()
    {
        parent::__construct();
    }


    public function do_nothing($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg  = Message::findOrFail($msg_id);
                if($msg){
                    $msg->update([
                       'alert' => false
                    ]);
                }
                return redirect()->back()->with('success','Operation validée.');
            }
        }
        return redirect()->back()->with('success','Erreur sur l\'action de cette operation.');
    }

    public function do_moderate($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg  = Message::findOrFail($msg_id);
                if($msg){
                    $converter = new HtmlConverter(['header_style' => 'atx']);
                    $msg->text = $converter->convert($msg->text);
                    return view('messages.do_moderate', compact('msg'));
                }
            }
        }
    }

    public function store_moderate($msg_id, UpdateMessageRequest $request)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    $update = $msg->update([
                        'text' => Markdown::convertToHtml($request->input('content')),
                        'doModerate' => $request->input('doModerate'),
                        'moderate' => true,
                        'alert' => false
                    ]);
                    if($update == true){
                        $user = User::findOrFail($msg->user_id);
                        if($user){
                            $thread = Thread::findOrFail($msg->thread_id);
                            foreach (\Auth::user()->notifications as $notification) {
                                if(isset($notification->data['msg'])){
                                    if($notification->data['msg'] == $msg->id){
                                        $notification->delete();
                                    }
                                }
                            }
                            $user->notify(new ModeratedForumMessage($msg, $thread));
                        }
                        return redirect()->action('Administration\ChannelsController@index')->with('success', 'Le message a été modéré.');
                    }
                }
            }
        }
        return redirect()->action('Administration\ChannelsController@index')->with('error', 'Le message n\'a pas pus être modéré.');
    }

    public function lockMessages($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    $msg->update([
                        'destroy' => true,
                        'alert' => false
                    ]);
                    return redirect()->back()->with('success', 'Le message a été bloqué');
                }
            }
        }
        return redirect()->back()->with('error', 'Erreur sur le bloquage du message');
    }

    public function unlockMessages($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    $msg->update([
                        'destroy' => false,
                        'alert' => false
                    ]);
                    return redirect()->back()->with('success', 'Le message a été débloqué');
                }
            }
        }
        return redirect()->back()->with('error', 'Erreur sur le débloquage du message');
    }

    public function __get_message($msg_id)
    {
        if($msg_id){
            if(is_numeric($msg_id)){
                $msg = Message::findOrFail($msg_id);
                if($msg){
                    $user = $msg->user;
                    $data = [
                        'msg' => $msg,
                        'user' => $user
                    ];
                    return response()->json($data,200);
                }
            }
        }
    }

}