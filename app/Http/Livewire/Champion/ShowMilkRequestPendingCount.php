<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowMilkRequestPendingCount extends Component
{
    public function render(): View
    {
        $count = MilkRequest::where('status', MilkRequestStatus::Pending)
            ->count();

        return view('livewire.champion.show-milk-request-pending-count', compact('count'));
    }
}
