<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class MilkRequestList extends Component
{
    use WithPagination;

    public $readyToLoad = false;

    public $status = 'all';

    public $search = '';

    protected $queryString = [
        'status', 'search',
    ];

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.champion.milk-request-list', [
            'milk_requests' => $this->readyToLoad
                ? MilkRequest::query()
                    ->where('ref_number', 'LIKE', '%'.$this->search.'%')
                    ->when(true, function ($query) {
                        switch ($this->status) {
                            //                            case MilkRequestStatus::Pending->value:
                            //                                $query->where('status', $this->status);
                            //                                $query->whereNull('accepted_by');
                            //                                break;

                            case 'all':
                                $query->where(function ($query) {
                                    $query->orWhereNotNull('accepted_by');
                                    $query->orWhereHas('declines');
                                });

                                return;

                            case MilkRequestStatus::Declined->value:
                                $query->whereHas('declines');
                                break;

                            default:
                                $query->where('status', $this->status);
                        }
                    })
                    ->latest()
                    ->paginate()
                    ->withQueryString()
                : collect()->paginate(),
        ]);
    }
}
