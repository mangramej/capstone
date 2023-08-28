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

class AddMilkBag extends Component
{
    use WithAlert;

    public $quantity = 1;
    public $selectedProvider;

    protected $rules = [
        'selectedProvider' => ['required', 'exists:users,id'],
        'quantity' => ['required', 'numeric', 'min:1'],
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
                ->addMilkBagTransaction(User::find($this->selectedProvider), $this->quantity);

        } catch (InvalidArgumentException) {
            $this->addError('provider', 'Missing/Invalid provider.');

            return;
        }

        $this->alert(
            type: 'success',
            title: 'Milk Bag Updated',
            description: 'Milk bags has been added successfully',
            event: 'UpdateMilkBagEvent',
        );
        $this->reset();
        $this->dispatchBrowserEvent('close');
    }

    public function render(): View
    {
        $providers = User::query()
            ->select([
                'id', 'email', DB::raw("CONCAT(first_name, ' ', last_name) AS name"),
            ])
            ->where('type', UserEnum::Provider)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('champion_providers')
                    ->where('champion_providers.champion_id', Auth::id())
                    ->where('champion_providers.status', true)
                    ->whereColumn('champion_providers.provider_id', 'users.id');
            })
            ->get();

        return view('livewire.champion.add-milk-bag', compact('providers'));
    }
}
