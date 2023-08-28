<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Modules\Repositories\ChampionRepository;

class MyProvidersController extends Controller
{
    public function __construct(ChampionRepository $championRepository)
    {
    }

    public function __invoke()
    {
        return view('champion.my-providers');
    }
}
