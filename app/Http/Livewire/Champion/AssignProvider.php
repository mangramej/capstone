<?php

namespace App\Http\Livewire\Champion;

use App\Models\Requester\MilkRequest;
use App\Models\User;
use App\Modules\Enums\MilkRequestStatus;
use App\Modules\Enums\UserEnum;
use App\Modules\Exceptions\InsufficientBagException;
use App\Modules\Repositories\ChampionRepository;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignProvider extends Component
{
    use WithAlert, AuthorizesRequests;

    public $providers;
    public MilkRequest $milkRequest;

    public $selectedProvider;

    protected $rules = [
        'selectedProvider' => ['required', 'exists:users,id'],
    ];

    protected $messages = [
        'selectedProvider.required' => 'You must select a provider.',
        'selectedProvider.exists' => 'The provider must be a valid user.',
    ];

    public function mount(MilkRequest $milkRequest): void
    {
        $this->milkRequest = $milkRequest;
    }

    public function save()
    {
        $this->authorize('update', $this->milkRequest);

        try {
            DB::beginTransaction();

            ChampionRepository::for(Auth::user())
                ->deductMilkBag($this->milkRequest, User::find($this->selectedProvider));

            $this->milkRequest->status = MilkRequestStatus::Assigned;
            $this->milkRequest->save();

            $this->milkRequest->statuses()->update([
                'assigned_at' => now(),
            ]);

            DB::commit();

            $this->alert(
                type: 'info',
                title: 'Milk Request Update',
                description: 'A provider has been assigned to this request.',
                event: 'UpdateMilkRequestEvent'
            );

            $this->dispatchBrowserEvent('close');
        }

        catch (InsufficientBagException) {
            $this->addError('selectedProvider', 'Insufficient milk bag, try another provider.');

            DB::rollBack();
            return;
        }
    }

    public function render(): View
    {
        $this->providers = User::select([
                'id', 'email', DB::raw("CONCAT(first_name, ' ', last_name) AS name"),
            ])
            ->where('type', UserEnum::Provider)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('champion_providers')
                    ->where('champion_providers.status', true)
                    ->where('champion_providers.champion_id', Auth::id())
                    ->whereColumn('champion_providers.provider_id', 'users.id');
            })->get();

        return view('livewire.champion.assign-provider');
    }
}
