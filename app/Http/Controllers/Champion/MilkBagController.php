<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Champion\ChampionProvider;
use App\Models\Champion\MilkBagTransaction;
use Illuminate\Http\Request;

class MilkBagController extends Controller
{
    public function index()
    {
        $total_deducted_milk_bags = MilkBagTransaction::where('type', 'deduct')
            ->sum('quantity');

        return view('champion.milk-bag', compact('total_deducted_milk_bags'));
    }

    public function show(Request $request, ChampionProvider $championProvider)
    {
        //        abort_if($request->user()->id !== $championProvider->champion_id, 403);

        $championProvider->load(['transactions', 'provider:id,first_name,middle_name,last_name,email']);

        return view('champion.transaction-detail', [
            'milk_bag' => $championProvider,
        ]);
    }
}
