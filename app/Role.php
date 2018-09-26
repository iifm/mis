<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['name','access_zone','addedby','updatedby','upload_category_option'];
}
