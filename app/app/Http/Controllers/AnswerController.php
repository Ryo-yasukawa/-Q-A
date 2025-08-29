<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    // 回答作成画面
    public function create($questionId)
    {
        $question = Question::findOrFail($questionId);
        return view('answers.create', compact('question'));
    }

    // 回答保存
    public function store(Request $request, $questionId)
    {
        $request->validate([
            'body' => 'required|string',       // textarea の name="body" に合わせる
            'image' => 'nullable|image|max:2048', // 任意の画像添付
        ]);

        $question = Question::findOrFail($questionId);

        $answer = new Answer();
        $answer->user_id = Auth::id();
        $answer->question_id = $question->id;
        $answer->body = $request->body;

        // 画像保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('answers', 'public');
            $answer->image_path = $path;
        }

        $answer->save();

        return redirect()->route('questions.show', $question->id)
                         ->with('status', '回答を投稿しました');
    }

    public function myAnswers()
{
    $answers = Answer::where('user_id', auth()->id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(10); // 1ページ10件
    return view('mypage.answers', compact('answers'));
}

public function myAnswerShow($id)
{
    $answer = Answer::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

    $question = $answer->question; // リレーション前提
    return view('answers.my_show', compact('answer', 'question'));
}

   // 編集画面
public function edit($id)
{
    $answer = Answer::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();
    return view('answers.edit', compact('answer'));
}

// 更新処理
public function update(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $answer = Answer::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

    $answer->body = $request->body;

    // 画像保存
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('answers', 'public');
        $answer->image_path = $path;
    }

    $answer->save();

    return redirect()->route('mypage.answers.show', $answer->id)
                     ->with('status', '回答を更新しました');
}

// 削除処理
public function destroy($id)
{
    $answer = Answer::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();
    $answer->delete();

    return redirect()->route('mypage.answers')->with('status', '回答を削除しました');
}


}