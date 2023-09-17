<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use App\Modules\Services\MilkRequestService;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetToDeliver extends Component
{
    use WithAlert, AuthorizesRequests;

    public MilkRequest $milkRequest;

    public function mount(MilkRequest $milkRequest): void
    {
        $this->milkRequest = $milkRequest;
    }

    public function deliver(): void
    {
        $this->authorize('update', $this->milkRequest);

        $this->milkRequest->status = MilkRequestStatus::Delivered;
        $this->milkRequest->save();

        $delivered_at = now();

        $this->milkRequest->statuses()->update([
            'delivered_at' => $delivered_at,
        ]);

        MilkRequestService::for($this->milkRequest)
            ->notifyRequester(
                message: 'Your milk request has been delivered.'
            );

        activity('Delivered Milk Request')
            ->performedOn($this->milkRequest)
            ->causedBy(Auth::user())
            ->event('delivered')
            ->withProperties([
                'attributes' => [
                    'status' => $this->milkRequest->status->value,
                    'delivered_at' => $delivered_at->format('m/d/Y, h:iA'),
                ],
                'old' => [
                    'status' => MilkRequestStatus::Assigned->value,
                    'delivered_at' => '',
                ],
            ])
            ->log('Delivered the Milk Request ('.$this->milkRequest->ref_number.')');

        $this->alert(
            type: 'info',
            title: 'Milk Request Update',
            description: 'The request has been set to delivered.',
            event: 'UpdateMilkRequestEvent'
        );

        $this->dispatchBrowserEvent('close');
    }

    public function render(): View
    {
        return view('livewire.champion.set-to-deliver');
    }
}
