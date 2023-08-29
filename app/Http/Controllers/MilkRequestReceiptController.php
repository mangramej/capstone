<?php

namespace App\Http\Controllers;

use App\Models\Requester\MilkRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class MilkRequestReceiptController extends Controller
{
    public function __invoke(MilkRequest $milkRequest)
    {
        $this->authorize('view', $milkRequest);

        $milkRequest->load('requester:id,email');

        $data = $milkRequest->toArray();
        $data['created_at'] = $milkRequest->created_at->format('l, F j, Y g:i A');
        $data['address'] = collect($milkRequest->address)->filter()->toArray();

        $pdf = Pdf::loadView('pdf.milk-request-pdf', $data);

        return $pdf->download('milk-request-receipt.pdf');
    }
}
