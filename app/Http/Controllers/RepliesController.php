<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread, Request $request)
    {
        $request->validate([
            'body' => 'required|min:5',
        ]);

        $thread->addReply([
            'user_id' => auth()->user()->id,
            'body' => $request->get('body'),
        ]);

        return response()->redirectTo(route('threads.show', ['id' => $thread]));
    }
}
