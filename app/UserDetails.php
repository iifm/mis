<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = ['user_id','profile','doj','designation','department','did','gender','dob','bank','accountno','pan','cstreet','ccity', 'cstate','pstreet','pcity' ,'pstate' ,'mobile','altno','fname','foccup','fcontact', 'mname', 'moccup', 'mcontact','maritalstatus','spname','spoccup','sip','time','locationcentre','anniversary','allinfo','status'
];

}
