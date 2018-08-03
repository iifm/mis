<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
  protected  $fillable= ['empid','empname','empemail','empmobile','leavefrom','leaveto','totalleave','leavetype','agcompoffdate','reason','approvalfrom','sip'];
}
	
