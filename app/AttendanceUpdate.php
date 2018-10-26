<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceUpdate extends Model
{
    protected $fillable=['user_id','date','update_type','in_time','out_time','reason','approvalfrom','status','sip'];
}
