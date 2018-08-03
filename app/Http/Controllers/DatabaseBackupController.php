<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DatabaseBackupController extends Controller
{
    public function backup()
    {
    	/*$users = DB::connection('mysql2')->select("select member_id,firstname,lastname,password from iifm_employees where lastname !=' ' and lastname !='xxxxx' and lastname !='vcvvv' AND lastname!='cccx' ");
    	dd($users);
    	
    	foreach ($users as  $user) {
    		$member_id=$user->member_id;
    		$firstname=$user->firstname;
    		$lastname=$user->lastname;
    		$password=$user->password;

    	$data=DB::connection('mysql')->insert('insert into users (id, name,email,password) values (?, ?, ?, ?)', [$member_id, $firstname,$lastname,$password]);

*/
    	$users = DB::connection('mysql2')->select("select * from iifm_employees
ORDER BY allinfo desc");
    	//dd($users);
    	foreach ($users as  $user) {
    		$user_id=$user->member_id;
    		$info=$user->allinfo;
    		$sip=$user->sip;
    		
            $json = json_decode($info,true);

            $postgradegree= $json['postgradegree'];
            $postgrayear= $json['postgrayear'];
            $postgrapercentage= $json['postgrapercentage'];
            $postgracoll= $json['postgracoll'];
            // $edu_option='12th';

    	$data=DB::connection('mysql')->insert("insert into user_educations (user_id, 	edu_option,specialization,percentage,endyear,sip,schoolname) values (?,?,?,?,?,?,?)", [$user_id,4,$postgradegree,$postgrapercentage,$postgrayear,$sip,$postgracoll]);

           

    		/*$member_id=$user->member_id;
    		$doj=$user->doj;
    		$designation=$user->designation;
    		$department=$user->department;
    		$gender=$user->gender;
    		$dob=$user->dob;
			$cstreet=$user->cstreet;
    		$ccity=$user->ccity;
    		$cstate=$user->cstate;
    		$pstreet=$user->pstreet;
    		$pcity=$user->pcity;
    		$pstate=$user->pstate;
    		$mobile=$user->mobile;
    		$altno=$user->altno;
    		$fname=$user->fname;
    		$foccup=$user->foccup;
    		$fcontact=$user->fcontact;
    		$mname=$user->mname;
    		$moccup=$user->moccup;
    		$mcontact=$user->mcontact;
    		$maritalstatus=$user->maritalstatus;
    		$spname=$user->spname;
    		$spoccup=$user->spoccup;
    		$sip=$user->sip;
    		$locationcentre=$user->locationcentre;
    		$anniversary=$user->anniversary;
    		$status=$user->status;
    		$time=$user->time;


    	$data=DB::connection('mysql')->insert('insert into user_details (user_id, doj,designation,department,gender,dob,cstreet,ccity,cstate,pstreet,pcity,pstate,mobile,altno,fname,					foccup,fcontact,mname,moccup,mcontact,maritalstatus,spname,spoccup,sip,locationcentre,anniversary,status,created_at) values (?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?,?,?)', [$member_id, $doj,$designation,$department,$gender,$dob,$cstreet,$ccity,$cstate,$pstreet,$pcity,$pstate,$mobile,$altno,$fname,$foccup,$fcontact,$mname,$moccup,$mcontact,$maritalstatus,$spname,$spoccup,$sip,$locationcentre,$anniversary,$status,$time]);*/
    	}
    	
    }

}