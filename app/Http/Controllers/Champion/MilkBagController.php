<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Champion\ChampionProvider;
use Illuminate\Http\Request;

class MilkBagController extends Controller
{
    public function index()
    {
        return view('champion.milk-bag');
    }

    public function show(Request $request, ChampionProvider $championProvider)
    {
        abort_if($request->user()->id !== $championProvider->champion_id, 403);

        $championProvider->load(['transactions', 'provider:id,first_name,middle_name,last_name,email']);

        return view('champion.transaction-detail', [
            'milk_bag' => $championProvider
        ]);
    }
}
