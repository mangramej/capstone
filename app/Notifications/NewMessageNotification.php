<?php

namespace App\Notifications;

use App\Models\Chat\Thread;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Thread $thread,
        public readonly string $message,
        public readonly string $type = 'new-message'
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];

    }

    public function toArray(object $notifiable): array
    {
        return [
            'thread_id' => $this->thread->id,
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
