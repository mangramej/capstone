<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;

class ShowMilkRequestController extends Controller
{
    public function pending()
    {
        return view('champion.milk-requests.pending');
    }

    public function recent()
    {
        return view('champion.milk-requests.recent');
    }
}
