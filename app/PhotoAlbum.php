<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    protected $fillable=['user_id','addedby','category','photo','sip'];
}
