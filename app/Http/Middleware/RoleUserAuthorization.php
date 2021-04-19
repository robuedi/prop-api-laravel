<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleUserAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //check if user has the role user
        if ($request->route('role_user')->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'],401);
        }

        return $next($request);
    }
}
