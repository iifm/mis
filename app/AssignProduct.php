<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignProduct extends Model
{
    protected $fillable=['user_id','product_cat','product_id','date','remark','assignedby','sip'];
}
