<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAnswerController extends Controller
{
    // 一覧
    public function index()
    {
        $answers = Answer::select('answers.*', DB::raw('COUNT(answer_reports.id) as reports_count'))
            ->leftJoin('answer_reports', 'answers.id', '=', 'answer_reports.answer_id')
            ->groupBy('answers.id')
            ->orderByDesc('reports_count')
            ->paginate(20);

        return view('admin.answers.index', compact('answers'));
    }

    // 詳細
    public function show(Answer $answer)
    {
        // $answer = Answer::findOrFail($id);
        $reports = AnswerReport::where('answer_id', $answer->id)
         ->with('user')
        ->orderByDesc('created_at')
        ->get();

        return view('admin.answers.show', compact('answer', 'reports'));
    }

    
    // 更新処理（表示/非表示の切り替え専用）
    public function update(Request $request, Answer $answer)
    {
        // hidden フィールドから送られてくる値 (0 or 1) をそのまま反映
        $answer->is_visible = $request->input('is_visible', $answer->is_visible);
        $answer->save();

        return redirect()
            ->route('admin.answers.show', $answer->id)
            ->with('status', '回答の表示状態を更新しました');
    }
}
