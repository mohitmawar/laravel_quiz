<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id', 'question', 'counter', 'options', 'answers',];

    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }

    /** 
     * convert option json string to array
     */
    public function getOptionsAttribute($option)
    {
        if ($option) {
            return json_decode($option);
        }
        return $option;
    }

    /** 
     * convert answers json string to array
     */
    public function getAnswersAttribute($answers)
    {
        if ($answers) {
            return json_decode($answers);
        }
        return $answers;
    }
}
