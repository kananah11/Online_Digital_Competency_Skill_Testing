<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamSet extends Model
{
    public $primaryKey = 'id';

    protected $casts = ['id' => 'string'];
    protected $fillable = ['id', 'description', 'str_id', 'status','pass'];

    public function Structure()
    {
        return $this->belongsTo(Structure::class, 'str_id');
    }
    
     public function UserExamSet()
    {
        return $this->hasMany(UserExamSet::class);
    }
}
