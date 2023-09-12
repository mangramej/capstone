<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use App\Modules\Services\MilkRequestService;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

        $this->milkRequest->statuses()->update([
            'delivered_at' => now(),
        ]);

        MilkRequestService::for($this->milkRequest)
            ->notifyRequester(
                message: 'Your milk request has been delivered.'
            );

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
