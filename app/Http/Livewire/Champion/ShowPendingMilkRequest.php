<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowPendingMilkRequest extends Component
{
    protected $listeners = [
        'MilkRequestConfirmedEvent' => '$refresh',
        'AlreadyAcceptedEvent' => '$refresh',
        'RefreshComponentEvent' => '$refresh',
    ];

    public $readToLoad = false;

    public function load(): void
    {
        $this->readToLoad = true;
    }

    public function render(): View
    {
        $milkRequest = MilkRequest::where('accepted_by', Auth::id())
            ->whereNot('status', MilkRequestStatus::Confirmed)
            ->orderBy('created_at')
            ->first();

        if (is_null($milkRequest)) {
            $milkRequest = MilkRequest::where('status', MilkRequestStatus::Pending)
                ->orderBy('created_at')
                ->first();
        }

        if (! is_null($milkRequest)) {
            $milkRequest->load('requester', 'requester.requesterVerification');
        }

        return view('livewire.champion.show-pending-milk-request', [
            'milkRequest' => $this->readToLoad ? $milkRequest : null,
        ]);
    }
}
