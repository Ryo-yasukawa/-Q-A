<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{

    // 回答作成画面
    public function create(Question $question)
    {
        // $question = Question::findOrFail($questionId);
        return view('answers.create', compact('question'));
    }

    // 回答保存
    public function store(AnswerRequest $request, Question $question)
    {
    
        // $question = Question::findOrFail($questionId);

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

public function myAnswerShow(Answer $answer)
{
    // $answer = Answer::where('id', $id)
    //                 ->where('user_id', auth()->id())
    //                 ->firstOrFail();
     $this->authorize('update', $answer);
    $question = $answer->question; // リレーション前提
    return view('answers.my_show', compact('answer', 'question'));
}

   // 編集画面
public function edit(Answer $answer)
{
    // $answer = Answer::where('id', $id)
    //                 ->where('user_id', auth()->id())
    //                 ->firstOrFail();
     $this->authorize('update', $answer);
    return view('answers.edit', compact('answer'));
}

// 更新処理
public function update(AnswerRequest $request, Answer $answer)
{
    
    // $answer = Answer::where('id', $id)
    //                 ->where('user_id', auth()->id())
    //                 ->firstOrFail();

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
public function destroy(Answer $answer)
{
    // $answer = Answer::where('id', $id)
    //                 ->where('user_id', auth()->id())
    //                 ->firstOrFail();
    $this->authorize('delete', $answer);
    $answer->delete();

    return redirect()->route('mypage.answers')->with('status', '回答を削除しました');
}


}