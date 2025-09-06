<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerReport extends Model
{
    protected $fillable = ['answer_id', 'user_id', 'reason', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 通報された回答とのリレーション（必要なら）
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
