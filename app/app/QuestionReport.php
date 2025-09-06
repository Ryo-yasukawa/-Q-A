<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class QuestionReport extends Model
{
    protected $fillable = ['user_id', 'question_id', 'reason', 'comment'];
    public function user()
{
    return $this->belongsTo(User::class);  
}
     // 通報された質問
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
