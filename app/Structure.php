<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    public $primaryKey = 'id';

    protected $casts = ['id' => 'string'];
    protected $fillable = ['id', 'count', 'time', 'status', 'struc_name'];

    public function examset()
    {
        return $this->hasMany(ExamSet::class);
    }
}
