<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat\Thread;
use App\Models\User;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::query()
            ->with(['participants' => function ($query) {
                $query->whereNot('user_id', auth()->id());
            }, 'participants.user:id,email,first_name,middle_name,last_name', 'lastMessage.user:id,first_name,middle_name,last_name'])
            ->whereHas('participants', function ($query) {
                $query->where('user_id', auth()->id());
            })->paginate();

        return view('chat.threads', compact('threads'));
    }

    public function create(User $user)
    {
        $thread = Thread::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
            $query->orWhere('user_id', auth()->user()->id);
        }, '=', 2)->first();

        if (! $thread) {
            $thread = Thread::create();

            $thread->participants()->createMany([
                ['user_id' => auth()->user()->id],
                ['user_id' => $user->id],
            ]);
        }

        return redirect()->route('thread.messages', [$thread]);
    }
}
