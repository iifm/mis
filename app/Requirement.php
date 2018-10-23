<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $fillable=['user_id','department','subject','description','sip','no_of_opening','location','type_of_appoint','existing_staff','qualification','skills','jd','reason','date','experience','internal_transfers_promotion','benefits'];
}
