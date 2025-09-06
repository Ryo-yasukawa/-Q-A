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
    public function show(Question $question)
    {
        // $question = Question::findOrFail($id);
        $reports = QuestionReport::where('question_id', $question->id)
        ->with('user')
        ->orderByDesc('created_at')
        ->get();

        return view('admin.questions.show', compact('question', 'reports'));
    }
 
    // 更新処理（質問の表示/非表示切り替え専用）
public function update(Request $request, Question $question)
{
    // hidden フィールドから送られてくる値 (0 or 1) をそのまま反映
    $question->is_visible = $request->input('is_visible', $question->is_visible);
    $question->save();

    return redirect()
        ->route('admin.questions.show', $question->id)
        ->with('status', '質問の表示状態を更新しました');
}
    
}
