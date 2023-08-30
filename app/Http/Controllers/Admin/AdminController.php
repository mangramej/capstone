<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest as AdminStoreRequest;
use App\Models\User;
use App\Modules\Enums\UserEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('type', UserEnum::Admin)
            ->paginate();

        return view('admin.index', compact('admins'));
    }

    public function store(AdminStoreRequest $request)
    {
        $admin = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
            'email_verified_at' => $request->validated('is_verified') == '1' ? now() : null,
            'type' => UserEnum::Admin,
        ]);

        $admin->assignRole($request->validated('role'));

        return back();
    }

    public function show(User $user)
    {
        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions();

        return view('admin.show', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'is_verified' => 'boolean',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:super-admin,admin'],
        ]);

        if (! $validated['password']) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $validated['email_verified_at'] = $validated['is_verified'] == '1' ? now() : null;
        unset($validated['is_verified']);

        if (($oldRole = $user->getRoleNames()[0]) !== $validated['role']) {

            if ($oldRole === 'super-admin') {
                $super_admin_role = Role::withCount('users')
                    ->where('name', 'super-admin')
                    ->first();

                if ($super_admin_role->users_count === 1) {
                    //                    Alert::warning('Failed', 'There must be one super admin left.');

                    return back();
                }
            }

            $user->removeRole($oldRole);
            $user->assignRole($validated['role']);
        }

        $user->update($validated);

        //        Alert::success('Great', 'Admin has been updated.');

        return back();
    }
}
