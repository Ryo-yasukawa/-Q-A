<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    // 投稿処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $question = new Question();
        $question->user_id = Auth::id(); // 投稿者ID
        $question->title = $request->title;
        $question->body = $request->body;
        $question->save();

        return redirect()->route('home')->with('status', '質問を投稿しました');
    } 

    public function show($id)
{
    $question = \App\Question::with(['answers.comments', 'user'])->findOrFail($id);

    // 回答も取得（コメント付き）
    $answers = $question->answers()->with('comments')->get();

    return view('questions.show', compact('question', 'answers'));
}

    public function myQuestions()
{
    $questions = Question::where('user_id', auth()->id())
                         ->orderBy('created_at', 'desc')
                         ->paginate(10); // 1ページ10件
    return view('mypage.questions', compact('questions'));
}


public function myQuestionShow($id)
{
  $question = Question::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

    $answers = $question->answers; // リレーション前提
    return view('questions.my_show', compact('question', 'answers'));
}
// 編集画面
public function edit($id)
{
    $question = Question::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();
    return view('questions.edit', compact('question'));
}

// 更新処理
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $question = Question::where('id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

    $question->title = $request->title;
    $question->body = $request->body;

    // 画像保存
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('questions', 'public');
        $question->image_path = $path;
    }

    $question->save();

    return redirect()->route('mypage.questions.show', $question->id)
                     ->with('status', '質問を更新しました');
}


}