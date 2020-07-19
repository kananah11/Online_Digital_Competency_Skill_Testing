<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $fillable = ['topic', 'status'];
    public function examination()
    {
        return $this->hasMany(examination::class);
    }

    public function StructureSet()
    {
        return $this->hasMany(StructureSet::class);
    }

    public function UserExamScoreByCat()
    {
        return $this->hasMany(UserExamScoreByCat::class);
    }

}
