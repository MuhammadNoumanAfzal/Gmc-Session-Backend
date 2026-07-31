<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));

            $user = Auth::user();
            return $this->redirectBasedOnRole($user);
        }

        RateLimiter::hit($this->throttleKey($request), 60);

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect. Please try again.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Helper to redirect users based on their active role.
     */
    private function redirectBasedOnRole($user)
    {
        if ($user->role === 'owner') {
            return redirect()->intended('admin/dashboard');
        }
        return redirect()->intended('admin/payment-proofs/index');
    }

    private function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));
        $minutes = (int) ceil($seconds / 60);

        throw ValidationException::withMessages([
            'email' => "Too many login attempts. Please wait {$minutes} minute(s) and try again.",
        ]);
    }

    private function throttleKey(Request $request): string
    {
        return Str::lower($request->string('email')).'|'.$request->ip();
    }
}
