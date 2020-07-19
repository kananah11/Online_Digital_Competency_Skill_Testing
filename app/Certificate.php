<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
     protected $table = 'certificates';

    protected $fillable = ['id', 'name', 'signa_name', 'signa_pic', 'signa_pos', 'date','qrcode'];

}
