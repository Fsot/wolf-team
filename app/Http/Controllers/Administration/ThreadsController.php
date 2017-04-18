<?php

namespace wolfteam\Http\Controllers\Administration;

use wolfteam\Http\Controllers\Controller;
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
            $thread = Thread::findOrFail($thread_id)->first();

            return view('threads.thread', compact('thread'));
        }
    }
}