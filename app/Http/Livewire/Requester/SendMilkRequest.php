<?php

namespace App\Http\Livewire\Requester;

use App\Models\User;
use App\Modules\Repositories\RequesterRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class SendMilkRequest extends Component
{
    use Actions;

    public $mother_name;
    public $quantity;
    public $baby_name;
    public $phone_number;

    public $comment;
    public $agreed;

    protected $rules = [
        'mother_name' => ['required', 'string', 'max:255'],
        'quantity' => ['required', 'numeric'],
        'baby_name' => ['required', 'string', 'max:255'],
        'phone_number' => ['required', 'max:255'],
        'comment' => ['nullable', 'string', 'max:255'],
    ];

    public function mount(): void
    {
        $requester = Auth::user();

        $this->mother_name = $requester->fullname();
        $this->quantity = 1;
        $this->baby_name = '';
        $this->phone_number = $requester->phone_number;
        $this->comment = '';
        $this->agreed = false;
    }

    public function save(): void
    {
        if (! $this->agreed) {
            $this->addError('agreed', "You must read and 'Accept the terms and conditions'");

            return;
        }
        $this->validate();

        (new RequesterRepository)
            ->newMilkRequest(
                motherName: $this->mother_name,
                babyName: $this->baby_name,
                quantity: $this->quantity,
                address:  Auth::user()->address(),
                phoneNumber:  $this->phone_number,
                comment: $this->comment
            );

        $this->notification()->success(
            title: __('requester.sent.title'),
            description: __('requester.sent.description')
        );

        $this->dispatchBrowserEvent('close');

        $this->emit('NewMilkRequestEvent');
    }

    public function render(): View
    {
        return view('livewire.requester.send-milk-request');
    }
}
