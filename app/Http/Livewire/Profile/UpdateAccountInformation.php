<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Modules\Traits\WithAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateAccountInformation extends Component
{
    use WithAlert;

    public $email;

    public $currentPassword;

    public $newPassword;

    public $newPasswordConfirmation;

    public $user;

    public function mount($user = null)
    {
        $this->user = $user ?? Auth::user();
        $this->email = $this->user->email;
    }

    public function save(): void
    {
        $this->validate([
            'email' => ['nullable', 'email', Rule::unique(User::class)->ignore(Auth::id())],
        ]);

        if (! is_null($this->email)) {
            $this->user->email = $this->email;
        }

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        if (! is_null($this->currentPassword)) {
            $validator = Validator::make([
                'currentPassword' => $this->currentPassword,
                'newPassword' => $this->newPassword,
                'newPasswordConfirmation' => $this->newPasswordConfirmation,
            ], [
                'currentPassword' => 'current_password',
                'newPassword' => ['required', 'min:8', 'same:newPasswordConfirmation'],
            ]);

            $validator->validate();

            $this->user->password = Hash::make($this->newPassword);
        }

        $this->user->save();

        if ($this->user->wasChanged()) {
            $this->alert(
                type: 'success',
                title: 'Profile Update',
                description: 'Account information has been updated.'
            );
        }
    }

    public function render(): View
    {
        return view('livewire.profile.update-account-information');
    }
}
