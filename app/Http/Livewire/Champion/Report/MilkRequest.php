<?php

namespace App\Http\Livewire\Champion\Report;

use App\Models\Requester\MilkRequest as MilkRequestModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Rap2hpoutre\FastExcel\FastExcel;

class MilkRequest extends Component
{
    public $status = 'all';

    public $from = null;

    public $to = null;

    public $dataIncluded = [
        'ref_number',
        'mother_name',
        'baby_name',
        'quantity',
        'address',
        'phone_number',
        'baby_name',
        'provided_by',
    ];

    protected $messages = [
        'from.date' => 'The starting field from must be a valid date.',
        'to.date' => 'The up until field must be a valid date.',
    ];

    public function export()
    {
        $this->validate([
            'status' => ['required', 'in:all,accepted,assigned,delivered,confirmed'],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        if (empty($this->dataIncluded)) {
            $this->addError('dataIncluded', 'Select at least one of the following.');

            return;
        }

        $this->dataIncluded[] = 'id';
        $this->dataIncluded[] = 'created_at';

        $milkRequests = MilkRequestModel::query()
            ->select($this->dataIncluded)
            ->with(
                'provider:id,first_name,middle_name,last_name',
                'statuses'
            )
            ->when(
                $this->status !== 'all', fn ($q) => $q->where('status', $this->status)
            )
            ->when(! is_null($this->from), function ($q) {
                $q->whereDate('created_at', '>=', $this->from);
            })
            ->when(! is_null($this->to), function ($q) {
                $q->whereDate('created_at', '<=', $this->to);
            })
            ->where('accepted_by', Auth::id())
            ->get();

        if (in_array('provided_by', $this->dataIncluded)) {
            $milkRequests->map(function (MilkRequestModel $request) {
                $request->provider_name = $request->provider
                    ? $request->provider->first_name.' '.$request->provider->first_name
                    : 'No Provider';

                return $request;
            });
        }

        $data = collect($milkRequests->toArray())
            ->transform(function ($el) {
                $el = array_merge($el, $el['statuses']);

                unset(
                    $el['id'],
                    $el['created_at'],
                    $el['provider'],
                    $el['provided_by'],
                    $el['statuses'],
                    $el['milk_request_id'],
                );

                return $el;
            });

        return response()->streamDownload(function () use ($data) {
            return (new FastExcel($data->all()))
                ->export('php://output');
        }, sprintf('milk-requests-%s.xlsx', date('Y-m-d')));
    }

    public function render(): View
    {
        return view('livewire.champion.report.milk-request');
    }
}
