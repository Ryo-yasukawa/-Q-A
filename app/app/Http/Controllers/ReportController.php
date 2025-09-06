<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionReport;
use App\Answer;
use App\AnswerReport;
use App\Question;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
      public function showQuestionReportForm(Question $question)
    {
        // $question = \App\Question::findOrFail($questionId);
        return view('reports.question', compact('question'));
    }

    // 通報保存
    public function storeQuestionReport(Request $request, Question $question)
    {
        // バリデーション
        $request->validate([
            'reason' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        // 保存
          QuestionReport::create([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
            'reason' => $request->reason,
            'comment' => $request->comment,
        ]);

        return redirect()->route('questions.show', $question->id)
                         ->with('success', '通報が送信されました');
    }

    public function showAnswerReportForm(Answer $answer)
{

    // $answer = Answer::with('question')->findOrFail($answerId);
    $answer->load('question');
    return view('reports.answer', compact('answer'));
}

public function submitAnswerReport(Request $request, Answer $answer)
{
    $request->validate([
        'reason' => 'required|string|max:255',
        'comment' => 'nullable|string|max:1000',
    ]);

    //    $answer = Answer::with('question')->findOrFail($answerId);
            $answer->load('question');

    AnswerReport::create([
        'answer_id' => $answer->id,
        'user_id'   => auth()->id(),
        'reason'    => $request->reason,
        'comment'   => $request->comment,
    ]);

    return redirect()->route('questions.show', $answer->question->id)
                     ->with('success', '回答を通報しました。');
}
}
