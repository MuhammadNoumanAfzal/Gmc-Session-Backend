<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Support\SystemUserProvisioner;
use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSystemUsersExist
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (User::query()->count() === 0) {
                SystemUserProvisioner::ensureDefaultUsersExist();
            }
        } catch (QueryException $exception) {
            // Ignore bootstrapping queries before migrations are available.
        }

        return $next($request);
    }
}
