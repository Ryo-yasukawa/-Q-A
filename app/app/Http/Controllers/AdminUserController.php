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
    public function show(User $user)
    {
        // $user = User::findOrFail($id);
      $reportedQuestions = $user->questions()->whereHas('reports')->with('reports')->get();
      $reportedAnswers   = $user->answers()->whereHas('reports')->with('reports')->get();

    return view('admin.users.show', compact('user', 'reportedQuestions', 'reportedAnswers'));
    }

    
    // 更新処理
    public function update(Request $request, User $user)
    {
        $user->is_active = $request->input('is_active', $user->is_active);
    $user->save();

    return redirect()
        ->route('admin.users.show', $user->id)
        ->with('status', 'ユーザーの利用状態を更新しました');
    } 
        

    
}
