<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
   public function store(Request $request, $answerId)
    {
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $answer = Answer::findOrFail($answerId);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->answer_id = $answer->id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('questions.show', $answer->question_id)
                         ->with('status', 'コメントを投稿しました');
    }
}
