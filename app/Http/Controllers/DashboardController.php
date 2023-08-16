<?php

namespace App\Http\Controllers;

use App\Modules\Enums\UserEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return match (Auth::user()->type) {
            UserEnum::Champion => $this->champion(),
            UserEnum::Requester => $this->requester(),
            UserEnum::Provider => $this->provider(),
        };
    }

    private function requester(): View
    {
        return view('requester.dashboard');
    }

    private function champion(): View
    {
        return view('champion.dashboard');
    }

    private function provider(): View
    {
        return view('provider.dashboard');
    }
}
