<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionReport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
     // 質問通報
    public function reportQuestion(Request $request, $questionId)
    {
        // バリデーション
        $request->validate([
            'reason' => 'required|string|max:255',
            'comment' => 'nullable|string|max:1000',
        ]);

        // 作成
        QuestionReport::create([
            'user_id' => Auth::id(),
            'question_id' => $questionId,
            'reason' => $request->reason,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', '通報が送信されました');
    }
}
