<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class examination extends Model
{
    protected $table = 'examinations';

    protected $fillable = ['questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'degree', 'status', 'answer', 'cate_id', 'exam_id', 'name_cate', 'count', 'correct', 'incorrect','creator'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }
}
