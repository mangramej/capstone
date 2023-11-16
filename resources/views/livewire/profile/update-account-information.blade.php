<section id="account--info" class="bg-white p-6 rounded-md shadow-md w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Account Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's information and email address.") }}
        </p>
    </header>

    <form wire:submit.prevent="save" class="mt-6 space-y-6">
        <x-input wire:model.defer="email" label="Email" placeholder="Email Address" />

        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail)
            <div>
                @if(auth()->user()->hasVerifiedEmail())
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is verified at
                        <b>{{ auth()->user()->email_verified_at->format('F j, Y g:i A') }}</b>.
                    </p>
                    <p class="text-sm mt-2 text-gray-800">
                        Changing your email address will result of re-verification.
                    </p>
                @endif
            </div>
        @endif

        <x-inputs.password wire:model.defer="currentPassword" label="Current Password" />
        <x-inputs.password wire:model.defer="newPassword" label="New Password" />
        <x-inputs.password wire:model.defer="newPasswordConfirmation" label="Confirm New Password" />
        <x-button type="submit" primary label="Update" />
    </form>
</section>
