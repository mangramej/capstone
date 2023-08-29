<?php

namespace App\Http\Controllers\Chat;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat\Thread;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message = $thread->messages()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        MessageSent::dispatch($message);

        return response()->json([
            'message' => $message->only(['thread_id', 'user_id', 'content', 'created_at']),
        ]);
    }

    public function show(Thread $thread)
    {
        abort_unless($thread->isParticipant(auth()->id()), 403);

        $thread->load(['participants' => function ($query) {
            $query->whereNot('user_id', auth()->id());
        }, 'participants.user:id,first_name,middle_name,last_name', 'messages']);

        return view('chat.messages', compact('thread'));
    }
}
