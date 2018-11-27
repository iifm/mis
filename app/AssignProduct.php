<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignProduct extends Model
{
    protected $fillable=['product_code','user_id','assigned_to','product_id','date','remark','assignedby','sip'];
}
