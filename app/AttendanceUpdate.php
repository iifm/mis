<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceUpdate extends Model
{
    protected $fillable=['user_id','date','type','time','reason','approvalfrom','status','sip'];
}
