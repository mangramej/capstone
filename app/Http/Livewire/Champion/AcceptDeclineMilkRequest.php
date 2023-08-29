<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
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
            $this->milkRequest->status === MilkRequestStatus::Accepted
            || $this->milkRequest->accepted_by === Auth::id()
        ) {
            $this->alert(
                type: 'info',
                title: 'Milk Request',
                description: 'The request has already been set to accepted.'
            );

            return;
        }

        $this->milkRequest->status = MilkRequestStatus::Accepted;
        $this->milkRequest->accepted_by = Auth::id();
        $this->milkRequest->save();

        $this->milkRequest->statuses()->update([
            'accepted_at' => now(),
        ]);

        return redirect()->route('champion.milk-request-detail', [$this->milkRequest]);
    }

    public function decline()
    {
        $isDecline = $this->milkRequest->whereHas('declines', function ($query) {
            $query->where('milk_request_id', $this->milkRequest->id);
            $query->where('declined_by', Auth::id());
        })->exists();

        if (! $isDecline) {
            $this->milkRequest->declines()->create([
                'declined_by' => Auth::id(),
            ]);

            $this->alert(
                type: 'info',
                title: 'Milk Request Updated',
                description: 'The request has been set to decline.'
            );

        } else {
            $this->alert(
                type: 'info',
                title: 'Milk Request',
                description: 'The request has already been set to decline.'
            );
        }

        return redirect()->route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.champion.accept-decline-milk-request');
    }
}
