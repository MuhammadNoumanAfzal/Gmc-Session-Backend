<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountSettingsController extends Controller
{
    /**
     * Display the account settings form.
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.settings.index', [
            'user' => $user,
            'active' => 'settings',
            'heading' => 'Account Settings',
            'title' => 'Update your profile information and change passwords.'
        ]);
    }

    /**
     * Update the account details.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $isChangingEmail = $request->email !== $user->email;
        $isChangingPassword = $request->filled('password');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => [($isChangingEmail || $isChangingPassword) ? 'required' : 'nullable', 'current_password'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('settings.index')->with('success', 'Profile settings updated successfully. Your session stayed active.');
    }
}
