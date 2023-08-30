<?php

namespace App\Http\Requests\Admin;

use App\Modules\Enums\UserEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    protected $errorBag = 'createAdmin';

    public function authorize(): bool
    {
        $user = auth()->user();

        return $user->hasRole('super-admin') && $user->type === UserEnum::Admin;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:super-admin,admin'],
            'is_verified' => ['required', 'boolean'],
        ];
    }
}
