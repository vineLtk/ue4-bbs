<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
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
        $user = $request->user();

        if($user &&
            ! $user->hasVerifiedEmail() &&
            ! $request->is('email/*', 'logout')){
                return $request->expectsJson() ? abort(403, '您还没有验证邮箱，请先验证') : redirect()->route('verification.notice');
            }
        return $next($request);
    }
}
