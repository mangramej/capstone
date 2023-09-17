<?php

namespace App\Modules\Services;

use App\Models\Requester\MilkRequest;
use App\Models\User;
use App\Modules\Enums\MilkRequestStatus;
use App\Notifications\MilkRequestStatusUpdateNotification;

class MilkRequestService
{
    public function __construct(
        private MilkRequest $milkRequest
    ) {
    }

    public static function for(MilkRequest $milkRequest): static
    {
        return new self($milkRequest);
    }

    public function accept(User $champion): static
    {
        $this->milkRequest->status = MilkRequestStatus::Accepted;
        $this->milkRequest->accepted_by = $champion->id;

        $this->milkRequest->save();

        $accepted_at = now();

        $this->milkRequest->statuses()->update([
            'accepted_at' => $accepted_at,
        ]);

        activity('Accepted Milk Request')
            ->performedOn($this->milkRequest)
            ->causedBy($champion)
            ->event('accepted')
            ->withProperties([
                'attributes' => [
                    'status' => $this->milkRequest->status->value,
                    'accepted_at' => $accepted_at->format('m/d/Y, h:iA'),
                ],
                'old' => [
                    'status' => MilkRequestStatus::Pending->value,
                    'accepted_at' => '',
                ],
            ])
            ->log('Accepted the Milk Request ('.$this->milkRequest->ref_number.')');

        return $this;
    }

    public function notifyRequester(?string $message = ''): void
    {
        $this->milkRequest->requester->notify(
            new MilkRequestStatusUpdateNotification($this->milkRequest, $message)
        );
    }
}
