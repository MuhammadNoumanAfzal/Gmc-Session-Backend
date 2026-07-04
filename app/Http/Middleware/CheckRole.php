<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if the user's role is within the allowed roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // If unauthorized, redirect user to their dashboard or index based on their role
        if ($user->role === 'revenueOfficer') {
            return redirect()->route('payment-proofs.index')->with('error', 'Access Denied: Revenue Officers are only permitted to access Payment Proofs.');
        }

        // General unauthorized response
        abort(403, 'Access Denied: You do not have permissions to access this page.');
    }
}
