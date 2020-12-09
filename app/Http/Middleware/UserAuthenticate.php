<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userdata = array(
            'email'     => $request->header('auth_email'),
            'password'  => $request->header('password')
        );

        if (Auth::attempt($userdata)) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Invalid user', 'status' => true], 401);
        }
    }
}
