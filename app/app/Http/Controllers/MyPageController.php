<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
     public function index()
    {
        $user = Auth::user();
        return view('mypage.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'introduction' => 'nullable|string|max:1000',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('mypage')->with('status', 'プロフィールを更新しました');
    }

    // 投稿履歴
    public function myQuestions()
    {
        $questions = Auth::user()->questions()->latest()->paginate(10);
        return view('mypage.questions', compact('questions'));
    }

    public function myAnswers()
    {
        $answers = Auth::user()->answers()->latest()->paginate(10);
        return view('mypage.answers', compact('answers'));
    }

    public function myBookmarks()
    {
        $bookmarks = Auth::user()->bookmarks()->with('question')->paginate(10);
        return view('mypage.bookmarks', compact('bookmarks'));
    }

    public function withdrawConfirm()
{
    return view('mypage.withdraw_confirm');
}

// 実際の退会処理
public function withdraw(Request $request)
{
    $user = Auth::user();
    Auth::logout();           // ログアウト
    $user->is_active = 0;     // 利用停止フラグ
    $user->save();

    // セッションをクリア
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('mypage.withdraw.complete');
}

// 退会完了画面
public function withdrawComplete()
{
    return view('mypage.withdraw_complete');
}
    
}
