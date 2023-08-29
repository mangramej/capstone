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

    public function save(): void
    {
        $this->validate([
            'email' => ['nullable', 'email', Rule::unique(User::class)->ignore(Auth::id())],
        ]);

        $user = Auth::user();

        if (! is_null($this->email)) {
            $user->email = $this->email;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
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

            $user->password = Hash::make($this->newPassword);
        }

        $user->save();

        $this->alert(
            type: 'success',
            title: 'Profile Update',
            description: 'Account information has been updated.'
        );

        $this->reset();
    }

    public function render(): View
    {
        $this->email = Auth::user()->email;

        return view('livewire.profile.update-account-information');
    }
}
