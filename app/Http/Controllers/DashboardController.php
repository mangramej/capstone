<?php

namespace App\Http\Controllers;

use App\Models\Champion\ChampionProvider;
use App\Models\Champion\MilkBagTransaction;
use App\Models\DeclinedRequest;
use App\Models\Location;
use App\Models\ProviderApplication;
use App\Models\Requester\MilkRequest;
use App\Models\User;
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
            UserEnum::Admin => $this->admin($request),
        };
    }

    private function champion(): View
    {
        $total_milk_bags = ChampionProvider::query()
//            ->where('champion_id', Auth::id())
            ->sum('total_milk_bags');

        $total_milk_requests = MilkRequest::count();

        $total_accepted_milk_request = MilkRequest::query()
            ->whereNotNull('accepted_by')
            ->count();

        $total_assigned_milk_request = MilkRequest::query()
            ->where('status', MilkRequestStatus::Assigned)
            ->count();

        $total_delivered_milk_request = MilkRequest::query()
            ->where('status', MilkRequestStatus::Delivered)
            ->count();

        $total_confirmed_milk_request = MilkRequest::query()
            ->where('status', MilkRequestStatus::Confirmed)
            ->count();

        $total_pending_milk_request = MilkRequest::query()
            ->where('status', MilkRequestStatus::Pending)
            ->count();

        $total_declined_milk_request = DeclinedRequest::count();

        $total_provider = ChampionProvider::count();

        $total_pending_donor_application = ProviderApplication::where('status', 'pending')
            ->count();

        return view('champion.dashboard', compact([
            'total_milk_bags',
            'total_milk_requests',
            'total_accepted_milk_request',
            'total_assigned_milk_request',
            'total_delivered_milk_request',
            'total_confirmed_milk_request',
            'total_provider',
            'total_declined_milk_request',
            'total_pending_milk_request',
            'total_pending_donor_application',
        ]));
    }

    private function requester(): View
    {
        auth()->user()->hasPendingMilkRequest();

        return view('requester.dashboard');
    }

    private function provider(): View
    {
        //        $milk_bags = ChampionProvider::with(['transactions' => function ($query) {
        //            $query->where('type', 'added');
        //        }])
        //            ->where('provider_id', Auth::id())
        //            ->first();

        $milk_bags = ChampionProvider::where('provider_id', Auth::id())
            ->first();

        $transactions = collect();

        if ($milk_bags) {
            $transactions = MilkBagTransaction::where('owner_id', $milk_bags->id)
                ->where('type', 'added')
                ->paginate(9)
                ->withQueryString();
        }

        $user = Auth::user()->load('donorApplication');

        $locations = null;

        if ($user->donorApplication) {
            $locations = Location::all();
        }

        return view('provider.dashboard', compact('milk_bags', 'transactions', 'locations'));
    }

    private function admin(Request $request): View
    {
        $data = collect([
            'user' => [
                'count' => User::count(),
                //                'growth' => User::count()
            ],
            //            'request' => [
            //                'count' => MilkRequest::count(),
            //            ],
        ])->dot()->all();

        return view('admin.dashboard', compact('data'));
    }
}
