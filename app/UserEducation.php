<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEducation extends Model
{
    protected $fillable=['edu_option','user_id','board','course','strtyear','endyear','schoolname','specialization','percentage','addedby','certificate','sip'];
}
