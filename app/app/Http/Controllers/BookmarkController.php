<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
   // ブックマーク追加
    public function store($questionId)
    {
        $question = Question::findOrFail($questionId);

        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
        ]);

        return back()->with('status', 'ブックマークしました');
    }

    // ブックマーク解除
    public function destroy($questionId)
    {
        Bookmark::where('user_id', Auth::id())
                ->where('question_id', $questionId)
                ->delete();

        return back()->with('status', 'ブックマークを解除しました');
    }
}