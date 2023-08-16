<?php

namespace App\Http\Livewire\Requester;

use App\Models\Requester\MilkRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RecentRequests extends Component
{
    use WithPagination;

    public $readyToLoad = false;

    protected $listeners = [
        'NewMilkRequestEvent' => '$refresh',
    ];

    public function loadMilkRequests(): void
    {
        $this->readyToLoad = true;
    }

    public function render(): View
    {
        return view('livewire.requester.recent-requests', [
            'milk_requests' => $this->readyToLoad
                ? MilkRequest::query()
                    ->where('requester_id', Auth::id())
                    ->get()
                    ->paginate()
                : collect()->paginate(),
        ]);
    }
}
