<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWorkExperience extends Model
{
    protected $table='user-work-experience';

    protected $fillable= ['user_id','company','designation1','fromdate','todate','address','sip','offerletter','relievingletter','addedby'];
}
