<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MilkRequestList extends Component
{
    use WithPagination;

    public $readyToLoad = false;

    public $status = 'pending';

    protected $queryString = [
        'status',
    ];

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    public function render(): View
    {
        return view('livewire.champion.milk-request-list', [
            'milk_requests' => $this->readyToLoad
                ? MilkRequest::query()
                    ->when(true, function ($query) {
                        switch ($this->status) {
                            case MilkRequestStatus::Pending->value:
                                $query->where('status', $this->status);
                                $query->whereNull('accepted_by');
                                $query->whereDoesntHave('declines', function ($q) {
                                    $q->where('declined_by', Auth::id());
                                });
                                break;

                            case 'declined':
                                $query->whereHas('declines', function ($q) {
                                    $q->where('declined_by', Auth::id());
                                });
                                break;

                            default:
                                $query->where('status', $this->status);
                                $query->where('accepted_by', Auth::id());
                        }
                    })
                    ->get()
                    ->paginate()
                    ->withQueryString()
                : collect()->paginate(),
        ]);
    }
}
