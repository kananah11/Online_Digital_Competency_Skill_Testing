<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class signature extends Model
{
    protected $fillable = ['id', 'name', 'position', 'image', 'status'];
}
