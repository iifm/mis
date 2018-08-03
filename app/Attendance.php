<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   protected $fillable = ['member_id','date','time','type','location','longitude','latitude','sip','session_id','datesort','remark'];
}
