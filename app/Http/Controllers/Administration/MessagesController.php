<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 26/04/2017
 * Time: 08:55
 */

namespace wolfteam\Http\Controllers\Administration;


use League\HTMLToMarkdown\HtmlConverter;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateMessageRequest;
use wolfteam\Models\Message;
use GrahamCampbell\Markdown\Facades\Markdown;

class MessagesController extends Controller
{

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
                    $converter = new HtmlConverter();
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
                    $msg->update([
                        'text' => Markdown::convertToHtml($request->input('content')),
                        'moderate' => true,
                        'alert' => false
                    ]);
                    return redirect()->action('Administration\ChannelsController@index')->with('success', 'Le message a été modéré.');
                }
            }
        }
        return redirect()->action('Administration\ChannelsController@index')->with('error', 'Le message n\'a pas pus être modéré.');
    }

    public function do_destroy()
    {

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