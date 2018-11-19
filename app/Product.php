<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['pcode','category','pname','pcompany','pmodel','pserial','pcondition','pdate','pdescription','pinvoice','sip','addedby'];
}
