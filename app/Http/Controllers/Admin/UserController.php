<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->latest()
            ->paginate();

        return view('admin.user.index', compact('users'));
    }

    //    public function create()
    //    {
    //    }
    //
    //    public function store(Request $request)
    //    {
    //    }

    public function show(User $user)
    {
        //        $activities = UserActivity::where('user_id', $user->id)
        //            ->latest()
        //            ->paginate();

        return view('admin.user.show', compact('user'));
    }

    //    public function edit($id)
    //    {
    //    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'is_verified' => 'boolean',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        if (! $validated['password']) {
            unset($validated['password']);
        } else {
            $user->password = Hash::make($validated['password']);
        }

        $user->email = $validated['email'];

        $user->email_verified_at = $validated['is_verified'] == '1' ? now() : null;

        $user->save();

        //        Alert::success('Great', 'User has been updated.');

        return back();
    }
    //
    //    public function destroy($id)
    //    {
    //    }

    //    public function ban(BanUserRequest $request, User $user)
    //    {
    //        if ($user->isBanned()) {
    //            Alert::info('Ops', 'User has already been banned.');
    //
    //            return back();
    //        }
    //
    //        $user->ban($request->validated());
    //
    //        $description = ($request->expired_at)
    //            ? 'Administrator has banned this account until '.
    //            Carbon::parse($request->expired_at)->format('F j, Y').'.'
    //            : 'Administrator has banned this account permanently.';
    //
    //        $user->activities()->create([
    //            'subject' => 'Banned',
    //            'description' => $description,
    //        ]);
    //
    //        $user->update(['is_ban' => true]);
    //
    //        Alert::info('Great', 'User has been banned.');
    //
    //        return back();
    //    }

    //    public function unban(User $user)
    //    {
    //        if (! $user->isBanned()) {
    //            Alert::info('Ops', 'User is already unbanned.');
    //
    //            return back();
    //        }
    //
    //        $user->unban();
    //        $user->update(['is_ban' => false]);
    //
    //        Alert::info('Great', 'User is now unbanned.');
    //
    //        $user->activities()->create([
    //            'subject' => 'Unban',
    //            'description' => 'Administrator has unbanned this account.',
    //        ]);
    //
    //        return back();
    //    }
}
