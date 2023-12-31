<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UpdateRequestStatus extends Component
{
    use WithAlert;

    public MilkRequest $milkRequest;

    protected $listeners = [
        'UpdateMilkRequestEvent' => '$refresh',
    ];

    public function mount(MilkRequest $milkRequest): void
    {
        $this->milkRequest = $milkRequest;
    }

    public function render(): View
    {
        return view('livewire.champion.update-request-status');
    }
}
