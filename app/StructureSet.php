<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StructureSet extends Model
{
    protected $table = 'structure_sets';

    protected $fillable = ['id', 'easy', 'medium', 'hard', 'cate_id', 'set_id'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }
}
