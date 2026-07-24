<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            return redirect()->route("dashboard.{$user->role}");
        }

        return $next($request);
    }
}
