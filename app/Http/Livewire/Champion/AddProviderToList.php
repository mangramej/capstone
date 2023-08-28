<?php

namespace App\Http\Livewire\Champion;

use App\Models\User;
use App\Modules\Enums\UserEnum;
use App\Modules\Repositories\ChampionRepository;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Livewire\Component;

class AddProviderToList extends Component
{
    use WithAlert;

    public $selectedProvider;

    protected $rules = [
        'selectedProvider' => ['required', 'exists:users,id'],
    ];

    protected $messages = [
        'selectedProvider.required' => 'You must select a provider.',
        'selectedProvider.exists' => 'The provider must be a valid user.',
    ];

    public function save(): void
    {
        $this->validate();

        try {
            ChampionRepository::for(Auth::user())
                ->addProvider(provider: User::find($this->selectedProvider));

        } catch (InvalidArgumentException) {
            $this->addError('provider', 'Missing/Invalid provider.');

            return;
        }

        $this->alert(
            type: 'success',
            title: 'Update saved',
            description: 'A new provider has been added.',
            event: 'UpdateProviderListEvent',
        );

        $this->dispatchBrowserEvent('close');
    }

    public function render(): View
    {
        $providers = User::select([
            'id', 'email', DB::raw("CONCAT(first_name, ' ', last_name) AS name"),
        ])
            ->where('type', UserEnum::Provider)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('champion_providers')
                    // Provider is not constrained
                    // to a single champion
                    ->where('champion_providers.champion_id', Auth::id()) // comment this to constrain
                    ->whereColumn('champion_providers.provider_id', 'users.id');
            })
            ->get();

        return view('livewire.champion.add-provider-to-list', compact('providers'));
    }
}
