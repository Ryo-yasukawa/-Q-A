<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Question;

class BookmarkController extends Controller
{
   // ブックマーク追加
    public function store(Question $question)
    {
        // $question = Question::findOrFail($questionId);

        Bookmark::firstOrCreate([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
        ]);

       return response()->json(['message' => 'ブックマークしました']);

    }

    // ブックマーク解除
    public function destroy(Question $question)
    {
        Bookmark::where('user_id', Auth::id())
                ->where('question_id', $question->id)
                ->delete();

        return response()->json(['message' => 'ブックマークを解除しました']);
    }
}