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
    public function show($id)
    {
        $answer = Answer::findOrFail($id);
        $reports = Answer_report::where('answer_id', $id)->orderByDesc('created_at')->get();

        return view('admin.answers.show', compact('answer', 'reports'));
    }

    // 編集画面
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        return view('admin.answers.edit', compact('answer'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->is_visible = $request->input('is_visible', 1);
        $answer->save();

        return redirect()->route('admin.answers.show', $id)->with('status', '回答を更新しました');
    }
}
