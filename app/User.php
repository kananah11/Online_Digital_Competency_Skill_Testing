<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $casts = ['id' => 'string'];
    protected $fillable = ['id', 'name', 'admin', 'create_question', 'screener', 'prepare', 'password','eng_name','structure'];

    public function UserExamSet()
    {
        return $this->hasMany(UserExamSet::class);
    }
}
