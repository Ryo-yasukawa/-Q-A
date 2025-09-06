<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckActiveUser
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
            if (Auth::check() && Auth::user()->is_active == 0) {
            Auth::logout(); // 強制ログアウト
            return redirect()->route('login')->withErrors([
                'email' => 'このアカウントは利用停止されています。',
            ]);
        }

        return $next($request);
    }
}
