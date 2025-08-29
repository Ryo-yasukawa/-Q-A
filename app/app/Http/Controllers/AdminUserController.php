<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // 一覧
    public function index()
    {
        $users = User::withCount([
            'questions as stopped_questions_count' => function ($q) {
                $q->where('is_visible', 0);
            },
            'answers as stopped_answers_count' => function ($q) {
                $q->where('is_visible', 0);
            }
        ])
         ->orderByRaw('(stopped_questions_count + stopped_answers_count) desc')
        ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    // 詳細
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // 編集画面
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = $request->input('is_active', 1);
        $user->save();

        return redirect()->route('admin.users.show', $id)->with('status', 'ユーザー情報を更新しました');
    }
}
