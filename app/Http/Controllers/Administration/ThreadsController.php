<?php

namespace wolfteam\Http\Controllers\Administration;

use wolfteam\Http\Controllers\Controller;
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