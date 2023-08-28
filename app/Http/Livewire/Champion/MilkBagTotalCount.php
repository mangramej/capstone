<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\ChampionProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MilkBagTotalCount extends Component
{
    public $readyToLoad = false;

    protected $listeners = [
        'UpdateMilkBagEvent' => '$refresh',
    ];

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    public function render(): View
    {
        return view('livewire.champion.milk-bag-total-count', [
            'count' => $this->readyToLoad
                ? ChampionProvider::query()
                    ->where('champion_id', Auth::id())
                    ->sum('total_milk_bags')
                : 0
        ]);
    }
}
