<?php

namespace App\Http\Controllers;

use App\Models\Champion\ChampionProvider;
use App\Models\Requester\MilkRequest;
use App\Modules\Enums\MilkRequestStatus;
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

    private function champion(): View
    {
        $total_milk_bags = ChampionProvider::query()
            ->where('champion_id', Auth::id())
            ->sum('total_milk_bags');

        $total_milk_requests = MilkRequest::query()
            ->where('accepted_by', Auth::id())
            ->count();

        $total_accepted_milk_request = MilkRequest::query()
            ->where('accepted_by', Auth::id())
            ->where('status', MilkRequestStatus::Accepted)
            ->count();

        $total_assigned_milk_request = MilkRequest::query()
            ->where('accepted_by', Auth::id())
            ->where('status', MilkRequestStatus::Assigned)
            ->count();

        $total_delivered_milk_request = MilkRequest::query()
            ->where('accepted_by', Auth::id())
            ->where('status', MilkRequestStatus::Delivered)
            ->count();

        $total_confirmed_milk_request = MilkRequest::query()
            ->where('accepted_by', Auth::id())
            ->where('status', MilkRequestStatus::Confirmed)
            ->count();

        $total_provider = ChampionProvider::where('champion_id', Auth::id())
            ->count();

        return view('champion.dashboard', compact([
            'total_milk_bags',
            'total_milk_requests',
            'total_accepted_milk_request',
            'total_assigned_milk_request',
            'total_delivered_milk_request',
            'total_confirmed_milk_request',
            'total_provider'
        ]));
    }

    private function requester(): View
    {
        return view('requester.dashboard');
    }

    private function provider(): View
    {
        return view('provider.dashboard');
    }
}
