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

    public $status;

    protected $listeners = [
        'NewMilkRequestEvent' => '$refresh',
    ];

    public function loadMilkRequests(): void
    {
        $this->readyToLoad = true;
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.requester.recent-requests', [
            'milk_requests' => $this->readyToLoad
                ? MilkRequest::query()
                    ->where('requester_id', Auth::id())
                    ->when(true, function ($query) {
                        if (
                            ! in_array($this->status, ['all', 'pending', 'accepted', 'assigned', 'delivered', 'confirmed', 'declined'])
                            || $this->status === 'all'
                        ) {
                            return;
                        }

                        $query->where('status', $this->status);
                    })
                    ->latest()
                    ->paginate(8)
                : collect()->paginate(),
        ]);
    }
}
