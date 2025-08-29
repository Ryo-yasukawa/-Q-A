<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuestionController extends Controller
{
    // 一覧画面
    public function index()
    {
        $questions = Question::select('questions.*', DB::raw('COUNT(question_reports.id) as reports_count'))
            ->leftJoin('question_reports', 'questions.id', '=', 'question_reports.question_id')
            ->groupBy('questions.id')
            ->orderByDesc('reports_count')
            ->paginate(20);

        return view('admin.questions.index', compact('questions'));
    }

    // 詳細画面
    public function show($id)
    {
        $question = Question::findOrFail($id);
        $reports = QuestionReport::where('question_id', $id)->orderByDesc('created_at')->get();

        return view('admin.questions.show', compact('question', 'reports'));
    }

    // 編集画面
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->is_visible = $request->input('is_visible', 1);  // デフォルト表示
        $question->save();

        return redirect()->route('admin.questions.show', $id)->with('status', '質問を更新しました');
    }
}
