<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

     protected function authenticated($request, $user)
    {
        if ($user->role == 1) {
            // 管理者はダッシュボードへ
            return redirect()->route('admin.dashboard');
        }

        // 一般ユーザーはホーム画面へ
        return redirect()->route('home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
