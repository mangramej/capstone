<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\ChampionProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MilkBagTransactionList extends Component
{
    use WithPagination;

    public $readyToLoad = false;

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    protected $listeners = [
        'UpdateMilkBagEvent' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.champion.milk-bag-transaction-list', [
            'transactions' => $this->readyToLoad
                ? ChampionProvider::with(['provider:id,first_name,middle_name,last_name'])
//                    ->where('champion_id', Auth::id())
                    ->paginate()
                    ->withQueryString()
                : collect()->paginate(),
        ]);
    }
}
