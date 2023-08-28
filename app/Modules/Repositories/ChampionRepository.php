<?php

namespace App\Modules\Repositories;

use App\Models\Champion\ChampionProvider;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ChampionRepository
{
    public function __construct(
        private User $champion
    ) {
    }

    public static function for(User $user): static
    {
        if ($user->type !== UserEnum::Champion) {
            throw new InvalidArgumentException('User must be a type of Champion.');
        }

        return new self($user);
    }

    public function addProvider(User $provider): static
    {
        if ($provider->type !== UserEnum::Provider) {
            throw new InvalidArgumentException('User must be a type of Provider.');
        }

        $exist = ChampionProvider::where('champion_id', $this->champion->id)
            ->where('provider_id', $provider->id)
            ->exists();

        if (! $exist) {
            ChampionProvider::create([
                'champion_id' => $this->champion->id,
                'provider_id' => $provider->id,
                'status' => true,
            ]);
        }

        return $this;
    }

    public function getAllProvider(): array
    {
        return User::select([
            'id', DB::raw("CONCAT(first_name, ' ', last_name) AS name"),
        ])
            ->where('type', UserEnum::Provider)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('champion_providers')
                    ->where('champion_providers.champion_id', $this->champion->id)
                    ->whereColumn('champion_providers.provider_id', 'users.id');
            })->get();
    }
}
