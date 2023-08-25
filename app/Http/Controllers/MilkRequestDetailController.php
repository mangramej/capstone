<?php

namespace App\Http\Controllers;

use App\Models\Requester\MilkRequest;
use Illuminate\Http\Request;

class MilkRequestDetailController extends Controller
{
    public function __invoke(Request $request, MilkRequest $milkRequest)
    {
        $this->authorize('view', $milkRequest);

        return view('requester.milk-request-detail', compact('milkRequest'));
    }
}