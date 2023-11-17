<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\MilkBagTransaction;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddedMilkBagCount extends Component
{
    protected $listeners = [
        'UpdateMilkBagEvent' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.champion.added-milk-bag-count', [
            'count' => MilkBagTransaction::where('type', 'added')
                ->whereDay('created_at', now()->day)
                ->sum('quantity'),
        ]);
    }
}
