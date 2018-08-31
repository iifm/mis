<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadCategory extends Model
{
   protected $fillable=['name','addedby','updatedby','sip','status','type'];
}
