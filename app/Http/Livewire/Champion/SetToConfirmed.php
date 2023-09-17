<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SetToConfirmed extends Component
{
    use WithAlert, AuthorizesRequests;

    public MilkRequest $milkRequest;

    public function mount(MilkRequest $milkRequest): void
    {
        $this->milkRequest = $milkRequest;
    }

    public function confirm(): void
    {
        $this->authorize('update', $this->milkRequest);

        $this->milkRequest->status = MilkRequestStatus::Confirmed;
        $this->milkRequest->save();

        $confirmed_at = now();

        $this->milkRequest->statuses()->update([
            'confirmed_at' => $confirmed_at,
        ]);

        activity('Confirmed Milk Request')
            ->performedOn($this->milkRequest)
            ->causedBy(Auth::user())
            ->event('confirmed')
            ->withProperties([
                'attributes' => [
                    'status' => $this->milkRequest->status->value,
                    'confirmed_at' => $confirmed_at->format('m/d/Y, h:iA'),
                ],
                'old' => [
                    'status' => MilkRequestStatus::Delivered->value,
                    'confirmed_at' => '',
                ],
            ])
            ->log('Confirmed the Milk Request ('.$this->milkRequest->ref_number.')');

        $this->alert(
            type: 'info',
            title: 'Milk Request Update',
            description: 'The request has been set to confirmed.',
            event: 'UpdateMilkRequestEvent'
        );

        $this->dispatchBrowserEvent('close');
    }

    public function render(): View
    {
        return view('livewire.champion.set-to-confirmed');
    }
}
