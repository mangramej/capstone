<?php

namespace App\Http\Livewire\Auth\Passwords;

use App\Modules\Enums\UserEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Confirm extends Component
{
    /** @var string */
    public $password = '';

    public function confirm()
    {
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        if (! Auth::check()) {
            return redirect()->intended(route('home'));
        }

        if (Auth::user()->type === UserEnum::Admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm')->extends('layouts.auth');
    }
}
