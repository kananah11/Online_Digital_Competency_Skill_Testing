<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userexam extends Model
{
    protected $fillable = ['userexamset_id', 'exam_id', 'numexam', 'ch1', 'ch2', 'ch3', 'ch4', 'answer', 'score'];
}
