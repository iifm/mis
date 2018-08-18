<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnDuty extends Model
{
     protected $fillable = [ 'empid','od_date','intime','outtime','odtype','reason','approvalfrom','status','sip'];

}
	
