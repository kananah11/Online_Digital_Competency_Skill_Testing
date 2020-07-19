<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExamSet extends Model
{
    protected $fillable = ['user_id', 'exam_id', 'startdatetime', 'enddatetime', 'status', 'score'];

    public function ExamSet()
    {
        return $this->belongsTo(ExamSet::class, 'exam_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
