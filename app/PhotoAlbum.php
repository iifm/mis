<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    protected $fillable=['title','addedby','category','photo','sip'];
}
