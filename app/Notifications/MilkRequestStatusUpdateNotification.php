<?php

namespace App\Notifications;

use App\Models\Requester\MilkRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MilkRequestStatusUpdateNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly MilkRequest $milkRequest,
        public readonly string $message,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'milk_request' => $this->milkRequest->only(['ref_number']),
            'message' => $this->message,
        ];
    }
}
