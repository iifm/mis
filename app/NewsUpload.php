<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsUpload extends Model
{
   protected $fillable=['subject','category','description','uploadfile','filetype','addedby','updatedby'];
}
