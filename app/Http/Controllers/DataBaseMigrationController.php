<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataBaseMigrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //user table migration
/*       $users = DB::connection('mysql2')->select("select * from iifm_employees");
        //dd($users);
       foreach ($users as  $user) {
            $member_id=$user->member_id;
            $firstname=$user->firstname;
            $lastname=$user->lastname;
            $password=$user->password;
        $role=$user->role;
        $alt_lastname=$member_id.$firstname;

        if ($lastname=='' || $lastname=='xxxxx' || $lastname == 'vcvvv' || $lastname=='cccx') {
           $data=DB::connection('mysql3')->insert('insert into users (id, name,email,password,role) values (?, ?, ?, ?,?)', [$member_id, $firstname,$alt_lastname,$password,$role]);

        }
        else{
      $data=DB::connection('mysql3')->insert('insert into users (id, name,email,password,role) values (?, ?, ?, ?,?)', [$member_id, $firstname,$lastname,$password,$role]);
        }

        echo $member_id; echo "<br>";
     }
*/

    /* //user detail table migrtion

      $users = DB::connection('mysql2')->select("select * from iifm_employees");
    // dd($users);
          foreach ($users as  $user) {
      $member_id=$user->member_id;
     // dd($member_id);
        $doj=$user->doj;
     //   dd($doj);
       $doj1= date("Y-m-d", strtotime($doj));

        $designation=$user->designation;
        $department=$user->department;
        $gender=$user->gender;
        $dob=$user->dob;
         $dob1= date("Y-m-d", strtotime($dob));

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
          $anniversary1= date("Y-m-d", strtotime($anniversary));
        $status=$user->status;
        $time=$user->time;


      $data=DB::connection('mysql3')->insert('insert into user_details (user_id, doj,designation,department,gender,dob,cstreet,ccity,cstate,pstreet,pcity,pstate,mobile,altno,fname,  foccup,fcontact,mname,moccup,mcontact,maritalstatus,spname,spoccup,sip,locationcentre,anniversary,status,created_at) values (?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?, ?, ?, ?,?,?,?,?)', [$member_id, $doj1,$designation,$department,$gender,$dob1,$cstreet,$ccity,$cstate,$pstreet,$pcity,$pstate,$mobile,$altno,$fname,$foccup,$fcontact,$mname,$moccup,$mcontact,$maritalstatus,$spname,$spoccup,$sip,$locationcentre,$anniversary1,$status,$time]);
     }
*/

      //leave table migration
       
/*        $users = DB::connection('mysql2')->select("select member_id from iifm_employees ");

 $leaves = DB::connection('mysql2')->select('select * FROM `leave`');

//dd($leaves);
        foreach ($leaves as  $leave) {
          $approval_ids=[];
          $idss=[];
          
            $leaveid=$leave->leaveid;
            $empname=$leave->empname;
            $empemail=$leave->empemail;
           // dd($empemail);
            $empmobile=$leave->empmobile;
            $leavefrom=$leave->leavefrom;
           // dd($leavefrom);
            $leavefrom1= date("Y-m-d", strtotime($leavefrom));

            $leaveto=$leave->leaveto;
           // dd($leaveto);
             $leaveto1= date("Y-m-d", strtotime($leaveto));

            $totalleave=$leave->totalleave;
            $leavetype=$leave->leavetype;
            $agcompoffdate=$leave->agcompoffdate;

            $reason=$leave->reason;

            $approvedby=$leave->approvedby;
            //dd($approvedby);
            $disapprovedby=$leave->disapprovedby;
            $pendingby=$leave->pendingby;
            $status=$leave->status;
            $date1=$leave->date1;
            $sip=$leave->sip;

            //$approval_ids[]='';
          $approvalfrom=$leave->approvalfrom;
          $app_ids= explode(',', $approvalfrom);
         $appp_ids= array_filter($app_ids);
          //dd($appp_ids);
          foreach ($appp_ids as  $app_id) {
            //dd($app_id);
           $app_id=trim($app_id);
          // dd($id);
             $approval_ids[] = DB::connection('mysql2')->select("select `member_id` FROM `iifm_employees` where `lastname`='$app_id'");
          }
    
          $approval_ids= array_filter($approval_ids);
         
         foreach ($approval_ids as $values) {
          foreach ($values as  $value) {
            $idss[]=$value->member_id;
          }
          
         }
         //dd($ids);
       $final_app_ids =  implode(',', $idss);
      $final_app_ids= trim($final_app_ids,',');
      //dd($final_app_ids);
     
              $member_id = DB::connection('mysql2')->select("select `member_id` FROM `iifm_employees` where `lastname`='$empemail'");
              foreach ($member_id as  $value) {
                 $empid=$value->member_id;
                // dd($empid);
              }
           
              $data=DB::connection('mysql3')->insert('insert into `leaves` (leaveid, empid,leavefrom,leaveto,totalleave,leavetype,agcompoffdate,reason,approvalfrom,approvedby,disapprovedby,pendingby,status,sip,created_at) values (?,?, ?, ?, ?,?, ?, ?, ?,?, ?, ?, ?,?,?)', [$leaveid, $empid,$leavefrom1,$leaveto1,$totalleave,$leavetype,$agcompoffdate,$reason,$final_app_ids,$approvedby,$disapprovedby,$pendingby,$status,$sip,`$date1`]);

              $final_app_ids='';
             // dd($final_app_ids);
              $idss=[];
             // dd($idss);
              $approval_ids=[];
       // dd($data);
             
          }*/

       /*    //on-duty data migration
        $ods = DB::connection('mysql2')->select("select * FROM `onduty_data` where empid != ''");
dd($ods);
        
        foreach ($ods as  $od) {
          $app_ids=[];
          $ids=[];
            $empid=$od->empid;
            $od_date=$od->od_date;
            $od_date1= date("Y-m-d", strtotime($od_date));
            $intime=$od->intime;
            $outtime=$od->outtime;
            $odtype=$od->odtype;
            $reason=$od->reason;
            $approvalfrom=$od->approvalfrom;
           
            $approvalfroms=explode(',', $approvalfrom);
            
          //  dd($approvalfrom);
            foreach ($approvalfroms as  $approvalfrom) {
              $approvalfrom=trim($approvalfrom);
                $app_ids[] = DB::connection('mysql2')->select("select `member_id` FROM `iifm_employees` where `lastname`='$approvalfrom'");
            }
            foreach ($app_ids as  $app_id) {
             foreach ($app_id as  $value) {
              $ids[]=$value->member_id;
             }
            }
           $final_app_ids=implode(',', $ids);
           $final_app_ids=trim($final_app_ids,',');
          
            $status=$od->status;
            $created_at=$od->time;
            $sip=$od->sip;
           
              $data=DB::connection('mysql3')->insert('insert into `on_duties` (empid, od_date,intime,outtime,odtype,reason,approvalfrom,status,sip,created_at) values (?, ?, ?, ?,?, ?, ?, ?,?, ?)', [$empid, $od_date1,$intime,$outtime,$odtype,$reason,$final_app_ids,$status,$sip,$created_at]);
       // dd($data);
                
         }   
*/
/*
          //conveyance table migration
      $conveyances = DB::connection('mysql2')->select("select * FROM `convyance_iifm_2016` ");
//dd(count($conveyances));
      foreach ($conveyances as  $value) {
        $reason=$value->reason;
           $user_id=$value->user_id;
          
        $disfrom=$value->disfrom;
        $disto=$value->disto;
        $mode=$value->mode;
        $distance=$value->distance;
        $amount=$value->amount;
        $con_date=$value->con_date;
         $con_date1= date("Y-m-d", strtotime($con_date));
        // dd($con_date1);
        $status=$value->status;
        $paid=$value->paid;
        $uploadcimg=$value->uploadcimg;
        $comments=$value->comments;
        $conpid=$value->conpid;
        $edit_time=$value->edit_time;
        $sip=$value->sip;
       
        $data=DB::connection('mysql3')->insert('insert into `conveyances` (reason, user_id,disfrom,disto,mode,distance,amount,con_date,status,paid,uploadcimg,comments,conpid,sip,created_at) values (?, ?, ?, ?,?, ?, ?, ?,?, ?,?, ?, ?,?, ?)', [$reason,$user_id,$disfrom,$disto,$mode,$distance,$amount,$con_date1,$status,$paid,$uploadcimg,$comments,$conpid,$sip,$edit_time]);

      }
*/
      //attendance table migration

          $attendance = DB::connection('mysql2')->select("select * FROM `attendance` ");
//dd($attendance);
          $i=0;
      foreach ($attendance as  $value) {
        $member_id=$value->member_id;

         $date=$value->date;
         $date1= date("Y-m-d", strtotime($date));
        $time=$value->time;
        $type=$value->type;
        $location=$value->location;
        $longitude=$value->longitude;
        $latitude=$value->latitude;
        $sip=$value->sip;  
        $session_id=$value->session_id;
        $remark=$value->remark;

         if ($member_id!=0) {
           $data=DB::connection('mysql3')->insert('insert into `attendances` (member_id, date,time,type,location,longitude,latitude,sip,session_id,remark) values (?, ?, ?, ?,?, ?, ?, ?,?, ?)', [$member_id,$date1,$time,$type,$location,$longitude,$latitude,$sip,$session_id,$remark]);
        }
       
       $i++;

      }


      //user work-experience migration
/*
        $users = DB::connection('mysql2')->select("select * from iifm_employees
ORDER BY allinfo desc");
      //  dd($users);

            foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
             $json = json_decode($info,true);
             $sip=$user->sip;
          

            for ($i=1; $i<3; $i++) { 

            $company= $json['company'.$i];
           // return $company;
            $designation= $json['designation'.$i];
            $fromdate= $json['fromdate'.$i];
            $fromdate= date("Y-m-d", strtotime($fromdate));
            $todate= $json['todate'.$i];
            $todate= date("Y-m-d", strtotime($todate));

            if ($company!='' && $designation!='' && $fromdate!='' && $todate!='') {
               $data=DB::connection('mysql3')->insert("insert into `user-work-experience`(user_id,    company,designation1,fromdate,todate,sip) values (?,?,?,?,?,?)", [$user_id,$company,$designation,$fromdate,$todate,$sip]);
            }
               
            }
    }*/


    //user education migration
   /* $users = DB::connection('mysql2')->select("select * from iifm_employees
ORDER BY allinfo desc");
        //dd($users);
        foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
            // return $info;
             $json = json_decode($info,true);
             $sip=$user->sip;

            $schoolname= $json['10thschname'];
            $year= $json['10thschyear'];
            $percentage= $json['10thschpercent'];
           //$gracoll= $json['gracoll'];

            if ($schoolname!='' && $year!='' && $percentage!='') {
               $data=DB::connection('mysql3')->insert("insert into user_educations (user_id,    edu_option,schoolname,endyear,sip,percentage) values (?,?,?,?,?,?)", [$user_id,1,$schoolname,$year,$sip,$percentage]);
            } 
          
        }

        foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
            // return $info;
             $json = json_decode($info,true);
             $sip=$user->sip;

            $schoolname= $json['12thschname'];
            $year= $json['12thschyear'];
            $percentage= $json['12thschpercent'];
           //$gracoll= $json['gracoll'];

            if ($schoolname!='' && $year!='' && $percentage!='') {
               $data=DB::connection('mysql3')->insert("insert into user_educations (user_id,    edu_option,schoolname,endyear,sip,percentage) values (?,?,?,?,?,?)", [$user_id,2,$schoolname,$year,$sip,$percentage]);
            } 
          
        }

          foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
            // return $info;
             $json = json_decode($info,true);
             $sip=$user->sip;

            $gradegree= $json['gradegree'];
            $grayear= $json['grayear'];
            $grapercentage= $json['grapercentage'];
           $gracoll= $json['gracoll'];

            if ($gradegree!='' && $grayear!='' && $grapercentage!='' && $gracoll!='') {
               $data=DB::connection('mysql3')->insert("insert into user_educations (user_id,    edu_option,schoolname,endyear,sip,percentage,specialization) values (?,?,?,?,?,?,?)", [$user_id,3,$gracoll,$grayear,$sip,$grapercentage,$gradegree]);
            } 
          
        }

          foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
            // return $info;
             $json = json_decode($info,true);
             $sip=$user->sip;

            $gradegree= $json['postgradegree'];
            $grayear= $json['postgrayear'];
            $grapercentage= $json['postgrapercentage'];
           $gracoll= $json['postgracoll'];

            if ($gradegree!='' && $grayear!='' && $grapercentage!='' && $gracoll!='') {
               $data=DB::connection('mysql3')->insert("insert into user_educations (user_id,    edu_option,schoolname,endyear,sip,percentage,specialization) values (?,?,?,?,?,?,?)", [$user_id,4,$gracoll,$grayear,$sip,$grapercentage,$gradegree]);
            } 
          
        }
*/

       /*  //user education migration
    $users = DB::connection('mysql2')->select("select * from iifm_employees
ORDER BY allinfo desc");
        //dd($users);
        foreach ($users as  $user) {
            $user_id=$user->member_id;
            $info=$user->allinfo;
            // return $info;
             $json = json_decode($info,true);
             $sip=$user->sip;

            $gradegree= $json['gradegree'];
            $grayear= $json['grayear'];
            $grapercentage= $json['grapercentage'];
           $gracoll= $json['gracoll'];

            if ($gradegree!='' && $grayear!='' && $grapercentage!='' && $gracoll!='') {
               $data=DB::connection('mysql3')->insert("insert into user_educations (user_id,    edu_option,schoolname,endyear,sip,percentage,specialization) values (?,?,?,?,?,?,?)", [$user_id,3,$gracoll,$grayear,$sip,$grapercentage,$gradegree]);
            } 
          
        }*/

           

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
