<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use App\Modules\Services\MilkRequestService;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AcceptDeclineMilkRequest extends Component
{
    use WithAlert;

    public MilkRequest $milkRequest;

    public function mount(MilkRequest $milkRequest): void
    {
        $this->milkRequest = $milkRequest;
    }

    public function accept()
    {
        if (
            $this->milkRequest->status !== MilkRequestStatus::Pending ||
            ! is_null($this->milkRequest->accepted_by)
        ) {
            $this->alert(
                type: 'warning',
                title: 'Milk Request Accept',
                description: 'The request has already been accepted by other champion.',
            );

            return;
        }

        MilkRequestService::for($this->milkRequest)
            ->accept(Auth::user())
            ->notifyRequester(
                message: 'Your milk request has been accepted.'
            );

        $this->alert(
            type: 'success',
            title: 'Milk Request Accept',
            description: 'The request has been set to accepted.',
            event: 'UpdateMilkRequestEvent'
        );
    }

    public function decline()
    {
        $isDeclineAlready = $this->milkRequest->whereHas('declines', function ($query) {
            $query->where('milk_request_id', $this->milkRequest->id);
        })->exists();

        $isAcceptedByOther = ! is_null($this->milkRequest->accepted_by);

        if ($isDeclineAlready || $isAcceptedByOther) {
            $this->alert(
                type: 'warning',
                title: 'Milk Request Decline',
                description: 'The request is already been accepted or declined by other champion.',
            );

            return;
        }

        $this->milkRequest->declines()->create([
            'declined_by' => Auth::id(),
        ]);

        $this->milkRequest->status = MilkRequestStatus::Declined;
        $this->milkRequest->save();

        $this->alert(
            type: 'success',
            title: 'Milk Request Decline',
            description: 'The request has been set to decline.',
            event: 'UpdateMilkRequestEvent'
        );
    }

    public function render(): View
    {
        return view('livewire.champion.accept-decline-milk-request');
    }
}
