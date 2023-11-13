<?php

namespace App\Http\Controllers\Chat;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat\Thread;
use App\Models\User;
use App\Notifications\NewMessageNotification;
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

        $other = $thread->participants()
            ->where('thread_id', $thread->id)
            ->whereNot('user_id', auth()->id())
            ->first();

        $user = User::find($other->user_id);

        if (! $user->unreadNotifications()->where('data->type', 'new-message')->exists()) {
            $user->notify(
                new NewMessageNotification($thread, 'You got a new message from '.auth()->user()->fullname())
            );
        }

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
