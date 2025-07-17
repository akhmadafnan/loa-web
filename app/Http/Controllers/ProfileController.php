<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;




class ProfileController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.profile.index', compact('users'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit($name): View
    {
        $user = User::where('name', str_replace('-', ' ', $name))->firstOrFail();

        return view('admin.profile.edit', compact('user'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $name): RedirectResponse
    {
        $user = User::where('name', str_replace('-', ' ', $name))->firstOrFail();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $filename = $avatarFile->hashName();
            $avatarFile->storeAs('avatars', $filename, 'public');
            $user->avatar = $filename;
        }

        $user->save();

        return Redirect::route('profile.edit', ['name' => str_replace(' ', '-', $user->name)])
            ->with('status', 'profile-updated');
    }




    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
