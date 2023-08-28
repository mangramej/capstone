<?php

namespace App\Modules\Repositories;

use App\Models\Champion\ChampionProvider;
use App\Models\Champion\MilkBagTransaction;
use App\Models\User;
use App\Modules\Enums\UserEnum;
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

    public function addMilkBagTransaction(User $provider, int $quantity): static
    {
        if ($provider->type !== UserEnum::Provider) {
            throw new InvalidArgumentException('User must be a type of Provider.');
        }

        $milkBag = ChampionProvider::where('provider_id', $provider->id)
            ->where('champion_id', $this->champion->id)
            ->first();

        if ($milkBag) {
            $transaction = MilkBagTransaction::create([
                'owner_id' => $milkBag->id,
                'type' => 'added',
                'quantity' => $quantity,
            ]);

            $milkBag->total_milk_bags += $transaction->quantity;

            $milkBag->save();
        }

        return $this;
    }
}
