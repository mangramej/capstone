<?php

namespace App\Http\Livewire\Champion\Report;

use App\Models\Champion\ChampionProvider;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;

class MilkBagTransactionExport extends Component
{
    public $selectedProvider;

    protected $rules = [
        'selectedProvider' => ['required', 'exists:users,id'],
    ];

    protected $messages = [
        'selectedProvider.required' => 'You must select a provider.',
        'selectedProvider.exists' => 'The provider must be a valid user.',
    ];

    public function export()
    {
        $this->validate();

        $milk_bag = ChampionProvider::with([
            'transactions' => function ($query) {
                $query->select(['id', 'owner_id', 'type', 'quantity', 'milk_request_ref_number as ref_number', 'created_at']);
            },
            'provider:id,first_name,middle_name,last_name',
        ])
            ->select(['id', 'champion_id', 'provider_id'])
            ->where('champion_id', Auth::id())
            ->where('provider_id', $this->selectedProvider)
            ->first();

        return response()->streamDownload(function () use ($milk_bag) {
            return (new FastExcel($milk_bag->transactions->all()))
                ->export('php://output', function ($t) {
                    return [
                        'Type' => $t->type,
                        'Quantity' => $t->quantity,
                        'Reference Number' => $t->ref_number,
                        'Date' => $t->created_at->format('M/d/Y, h:i A'),
                    ];
                });

        }, sprintf('milk-bag-%s.xlsx', str_replace(' ', '-', $milk_bag->provider->fullname())));
    }

    public function render(): View
    {
        // Get all providers of this champion
        // regardless of status
        $providers = User::query()
            ->select([
                'id', 'email', DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"),
            ])
            ->where('type', UserEnum::Provider)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('champion_providers')
                    ->where('champion_providers.champion_id', Auth::id())
                    ->whereColumn('champion_providers.provider_id', 'users.id');
            })
            ->get();

        return view('livewire.champion.report.milk-bag-transaction-export', compact('providers'));
    }
}
