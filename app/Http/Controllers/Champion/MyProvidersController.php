<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\ProviderApplication;
use App\Modules\Repositories\ChampionRepository;

class MyProvidersController extends Controller
{
    public function __construct(ChampionRepository $championRepository)
    {
    }

    public function __invoke()
    {
        $applications = ProviderApplication::with('user', 'preScreening')
            ->where('status', 'pending')
            ->paginate()->withQueryString();

        return view('champion.my-providers', compact('applications'));
    }
}
