<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['quiz_id', 'user_id', 'total_attempt', 'total_right', 'total_wrong', 'is_pass','status'];


    /* relation with user model */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /* relation with Quiz model */
    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }
}
