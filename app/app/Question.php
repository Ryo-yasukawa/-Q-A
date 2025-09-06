<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id', 'title', 'body','image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Question.php
     public function bookmarks()
     {
        return $this->hasMany(Bookmark::class);
     }

     public function isBookmarkedBy($userId)
     {
         return $this->bookmarks()->where('user_id', $userId)->exists();
     }

     public function reports()
     {
        return $this->hasMany(QuestionReport::class);
     }

}
