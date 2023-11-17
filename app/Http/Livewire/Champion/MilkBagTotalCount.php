<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\ChampionProvider;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MilkBagTotalCount extends Component
{
    protected $listeners = [
        'UpdateMilkBagEvent' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.champion.milk-bag-total-count', [
            'count' => ChampionProvider::query()
                ->sum('total_milk_bags'),
        ]);
    }
}
