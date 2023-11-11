<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\ChampionProvider;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProviderListCount extends Component
{
    public $readyToLoad = false;

    protected $listeners = [
        'UpdateProviderListEvent' => '$refresh',
    ];

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    public function render(): View
    {
        $stats = [];

        if ($this->readyToLoad) {
            $stats['total_provider_count'] = ChampionProvider::count();

            $stats['total_active_provider_count'] = ChampionProvider::where('status', true)
                ->count();

            $stats['total_inactive_provider_count'] = ChampionProvider::where('status', false)
                ->count();
        }

        return view('livewire.champion.provider-list-count', compact('stats'));
    }
}
