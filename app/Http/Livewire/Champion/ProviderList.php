<?php

namespace App\Http\Livewire\Champion;

use App\Models\Champion\ChampionProvider;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProviderList extends Component
{
    use WithAlert, WithPagination;

    public $readyToLoad = false;

    public $status = null;

    protected $queryString = [
        'status',
    ];

    protected $listeners = [
        'UpdateProviderListEvent' => '$refresh',
    ];

    public function load(): void
    {
        $this->readyToLoad = true;
    }

    public function setInactive(ChampionProvider $provider): void
    {
        $provider->update(['status' => false]);

        $this->alert(
            type: 'info',
            title: 'Update saved',
            description: 'A provider has been set to inactive.',
            event: 'UpdateProviderListEvent'
        );
    }

    public function setActive(ChampionProvider $provider): void
    {
        $provider->update(['status' => true]);

        $this->alert(
            type: 'info',
            title: 'Update saved',
            description: 'A provider has been set to active.',
            event: 'UpdateProviderListEvent'
        );
    }

    public function render(): View
    {
        return view('livewire.champion.provider-list', [
            'providers' => $this->readyToLoad
                ? ChampionProvider::with('provider:id,first_name,middle_name,last_name')
                    ->select('id', 'status', 'provider_id', 'created_at')
//                    ->where('champion_id', Auth::id())
                    ->when(! is_null($this->status), function ($query) {
                        if ($this->status === 'active') {
                            $query->where('status', true);
                        }

                        if ($this->status === 'inactive') {
                            $query->where('status', false);
                        }
                    })
                    ->paginate()
                    ->withQueryString()
                : collect()->paginate(),
        ]);
    }
}
