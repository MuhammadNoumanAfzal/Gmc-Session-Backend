<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Grant access if user possesses the required permission
        if ($user->hasPermission($permission)) {
            return $next($request);
        }

        // If user is a restricted employee with proofs access, redirect them back to payment proofs
        if ($user->role !== 'owner' && $user->hasPermission('proofs')) {
            return redirect()->route('payment-proofs.index')->with('error', 'Access Denied: You do not have permission to access that section.');
        }

        // General unauthorized abort page
        abort(403, 'Access Denied: You do not have permission to access this module.');
    }
}
