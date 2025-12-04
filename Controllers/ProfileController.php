<?php

namespace Vendor\UltimateStarterKit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        return view('ultimate::profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the password change form.
     */
    public function editPassword()
    {
        return view('ultimate::profile.password');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.profile.password.edit')
            ->with('success', 'Password updated successfully.');
    }
}

