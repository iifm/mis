<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conveyance extends Model
{
   protected $fillable=['user_id','date','reason','disfrom','disto','mode','distance','paid','amount','sip'];
}
	