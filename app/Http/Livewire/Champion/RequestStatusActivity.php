<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Models\RequestStatus;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class RequestStatusActivity extends Component
{
    public RequestStatus $status;

    protected $listeners = [
        'UpdateMilkRequestEvent' => '$refresh',
    ];

    public bool $isDeclined;

    public MilkRequest $milkRequest;

    public function mount(MilkRequest $milkRequest): void
    {
        $this->status = $milkRequest->statuses;
        $this->milkRequest = $milkRequest;
    }

    public function render(): View
    {
        $this->milkRequest->load('declines');

        return view('livewire.champion.request-status-activity');
    }
}
