<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    // 投稿処理
    public function store(QuestionRequest $request)
    {
        $validated = $request->validated();

        

        $question = new Question();
        $question->user_id = Auth::id(); // 投稿者ID
        $question->title = $validated['title'];
        $question->body  = $validated['body'];
     // 画像保存
         if ($request->hasFile('image')) {
        $path = $request->file('image')->store('questions', 'public');
        $question->image_path = $path;  // ← ここを追加
    }

        $question->save();

        return redirect()->route('home')->with('status', '質問を投稿しました');
    } 

    public function show(Question $question)
{
    
    // 回答も取得（コメント付き）
   
    $answers = $question->answers()
                        ->where('is_visible', 1)
                        ->with('comments')
                        ->get();

    return view('questions.show', compact('question', 'answers'));
}

    public function myQuestions()
{
    $questions = Question::where('user_id', auth()->id())
                         ->orderBy('created_at', 'desc')
                         ->paginate(10); // 1ページ10件
    return view('mypage.questions', compact('questions'));
}


public function myQuestionShow(Question $question)
{
//   $question = Question::where('id', $id)
//                         ->where('user_id', auth()->id())
//                         ->firstOrFail();
    $this->authorize('update', $question);
    $answers = $question->answers; // リレーション前提
    return view('questions.my_show', compact('question', 'answers'));
}
// 編集画面
public function edit(Question $question)
{
    
     $this->authorize('update', $question);
    return view('questions.edit', compact('question'));
}

// 質問削除
public function destroy(Question $question)
{
    // ポリシーで自分の質問か確認
    $this->authorize('delete', $question);

    $question->delete();

    return redirect()->route('mypage.questions')
                     ->with('status', '質問を削除しました');
}

// 更新処理
public function update(QuestionRequest $request, Question $question)
{
    $validated = $request->validated();

    // $question = Question::where('id', $id)
    //                     ->where('user_id', auth()->id())
    //                     ->firstOrFail();

    $question->title = $validated['title'];
    $question->body  = $validated['body'];
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