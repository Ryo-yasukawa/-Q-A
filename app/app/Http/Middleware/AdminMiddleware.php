<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
    // ログインしていなければログイン画面へ
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // 管理者以外はアクセス拒否
    if (auth()->user()->role != 1) {
        abort(403, '管理者専用です');
    }

    return $next($request);
}

}
