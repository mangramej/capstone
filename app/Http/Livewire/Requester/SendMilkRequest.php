<?php

namespace App\Http\Livewire\Requester;

use App\Models\Requester\MilkRequest;
use App\Modules\Services\MilkRequestService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class SendMilkRequest extends Component
{
    use Actions, WithFileUploads;

    public $mother_name;

    public $quantity = 1;

    public $baby_name = '';

    public $phone_number;

    public $comment = '';

    public $agreed = false;

    //    public $image = null;

    protected $rules = [
        'mother_name' => ['required', 'string', 'max:255'],
        'quantity' => ['required', 'numeric'],
        //        'baby_name' => ['required', 'string', 'max:255'],
        'phone_number' => ['required', 'max:255'],
        'comment' => ['nullable', 'string', 'max:255'],
        //        'image' => ['required', 'image', 'max:12000'],
    ];
    //
    //    protected $messages = [
    //        'image.required' => 'You must upload an image of your ID.',
    //    ];

    public function mount(): void
    {
        $this->mother_name = Auth::user()->fullname();
        $this->phone_number = Auth::user()->phone_number;
    }
    //
    //    public function updatedImage(): void
    //    {
    //        $this->validate(['image' => 'required|image|max:12000']);
    //    }

    public function save(): void
    {
        if (! $this->agreed) {
            $this->addError('agreements', 'You must read and "Accept the terms and conditions"');

            return;
        }

        if (Auth::user()->hasPendingMilkRequest()) {
            $this->dispatchBrowserEvent('close');

            $this->notification()->info(
                title: 'Already have pending request',
                description: 'Can only place one request at a time'
            );

            return;
        }

        $user = Auth::user();

        $validated = $this->validate();

        //        $filename = $this->image->store('/user-'.$user->id, 'attachments');

        $milkRequest = MilkRequest::create(array_merge(
            $validated,
            [
                //                'image' => basename($filename),
                'requester_id' => $user->id,
                'address' => $user->address(),
            ]
        ));

        activity('Created Milk Request')
            ->performedOn($milkRequest)
            ->causedBy($user)
            ->event('created')
            ->withProperties([
                'attributes' => $milkRequest->attributesToArray(),
            ])
            ->log('Sent a Milk Request');

        $this->notification()->success(
            title: __('requester.sent.title'),
            description: __('requester.sent.description')
        );

        MilkRequestService::for($milkRequest)
            ->notifyRequester(
                message: 'Great, your request has been sent and might take up days to process, kindly please wait.'
            );

        $this->dispatchBrowserEvent('close');

        $this->emit('NewMilkRequestEvent');
    }

    public function render(): View
    {
        return view('livewire.requester.send-milk-request');
    }
}
