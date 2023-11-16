<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Champion\ChampionProvider;
use App\Models\ProviderApplication;
use Illuminate\Contracts\View\View;

class DonorApplicationController extends Controller
{
    public function show(ProviderApplication $providerApplication): View
    {
        $providerApplication->load(['user', 'preScreening']);

        return view('champion.show-donor-application', compact('providerApplication'));
    }

    public function approve(ProviderApplication $providerApplication)
    {
        $exist = ChampionProvider::where('provider_id', $providerApplication->provider_id)
            ->exists();

        if (! $exist) {
            ChampionProvider::create([
                'provider_id' => $providerApplication->provider_id,
                'status' => true,
            ]);
        }

        $providerApplication->status = 'approved';
        $providerApplication->save();

        return to_route('champion.my-providers');
    }

    public function decline(ProviderApplication $providerApplication)
    {
        $providerApplication->status = 'declined';
        $providerApplication->save();

        return to_route('champion.my-providers');
    }
}
