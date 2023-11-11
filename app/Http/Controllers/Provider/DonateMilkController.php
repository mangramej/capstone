<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\PreScreening;
use App\Models\ProviderApplication;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonateMilkController extends Controller
{
    public function index(): View
    {
        $hasAnsweredAlready = Auth::user()->preScreening;

        $locations = Location::all();

        return view('provider.donate-milk', compact('hasAnsweredAlready', 'locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question_1' => 'required',
            'question_2' => 'required',
            'question_3' => 'required',
            'question_4' => 'required',
            'question_5' => 'required',
            'question_6' => 'required',
            'question_7' => 'required',
        ]);

        $content = [
            [
                'question' => 'Why are you interested in donating milk?',
                'answer' => $data['question_1'],
            ],
            [
                'question' => 'Have you ever had brain surgery that included receiving a human cadveric (allogenic) dura mater (brain covering) graft?',
                'answer' => $data['question_2'],
            ],
            [
                'question' => 'Do you use any nicotine/tobacco or cannabis/marijuana products on an ongoing basis?',
                'answer' => $data['question_3'],
            ],
            [
                'question' => 'In the past 12 months, have you used any recreational/illegal drugs such as, cocaine, ecstasy, LSD, Dexedrine, or injectables?',
                'answer' => $data['question_4'],
            ],
            [
                'question' => 'Do you have a history of cancer, leukemia, lymphoma (including Hodgkin’s disease), or Kaposi sarcoma?',
                'answer' => $data['question_5'],
            ],
            [
                'question' => 'Have you ever had HIV, Hepatitis B or C, or HTLV?',
                'answer' => $data['question_6'],
            ],
            [
                'question' => 'Please list any ongoing medications you took or plan to take for the majority of the time you were/will be pumping for donation:',
                'answer' => $data['question_7'],
            ],
        ];

        $preScreening = PreScreening::updateOrCreate([
            'provider_id' => Auth::id(),
        ], [
            'content' => serialize($content),
        ]);

        ProviderApplication::create([
            'provider_id' => Auth::id(),
            'pre_screening_id' => $preScreening->id,
        ]);

        return to_route('provider.donate-milk');
    }
}
