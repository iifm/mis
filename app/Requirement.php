<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $fillable=['user_id','department','subject','description','sip'];
}
