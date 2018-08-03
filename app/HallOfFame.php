<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
    protected $fillable= ['user_id','empname','month','image','department','addedby','sip','description'];
}
