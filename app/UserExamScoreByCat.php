<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExamScoreByCat extends Model
{
    protected $fillable = ['userexamset_id', 'cate_id', 'score'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }
}
