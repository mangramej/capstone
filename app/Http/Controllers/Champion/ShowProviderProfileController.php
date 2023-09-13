<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Champion\ChampionProvider;
use App\Models\Champion\MilkBagTransaction;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Http\Request;

class ShowProviderProfileController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        abort_unless($user->type === UserEnum::Provider, 404);

        $milk_bag = ChampionProvider::query()
            ->where('provider_id', $user->id)
            ->first(['id', 'created_at']);

        $total_bag_provided = null;
        if ($milk_bag) {
            $total_bag_provided = MilkBagTransaction::query()
                ->where('owner_id', $milk_bag->id)
                ->where('type', 'added')
                ->sum('quantity');
        }

        return view('champion.show-provider-profile', compact(
            'user',
            'milk_bag',
            'total_bag_provided'
        ));
    }
}
