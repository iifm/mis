<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use Auth;
use Session;
use DB;
use App\User;
use App\AttendanceUpdate;
use Mail;
use URL;
use DateTime;
use App\OnDuty;
use App\Leave;

class AttendanceController extends Controller
{     
  public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
       
        $id=Auth::user()->id;
       $date=date("Y-m-d");
      
       $typecheck='';

       $inTime=Attendance::where('member_id','=',$id)
        ->where('date',$date)
        ->where('type','IN')
        ->get();

        foreach ($inTime as  $value) {
            $inTime=$value->time;
            Session::put('inTime',$inTime);
        }

        $outTime=Attendance::where('member_id','=',$id)
        ->where('date',$date)
        ->where('type','OUT')
        ->get();
         foreach ($outTime as  $value) {
            $inTime=$value->time;
            Session::put('outTime',$inTime);
        }
        
        $attendanceIn=Attendance::where('member_id','=',$id)
        ->where('date',$date)->get();

        if (count($attendanceIn)==0) {
            $typecheck="IN";
            Session::put('attendType',$typecheck);
        }
        else if(count($attendanceIn)==1)
        {
            $typecheck="OUT";
            Session::put('attendType',$typecheck);
        }
        else 
        {
            $typecheck="ATTENDANCE FOR TODAY HAVE BEEN MARKED!!";
            Session::put('attendType',$typecheck);
        }

      /*  Session::flash('errorMsg','Trun ON your Mobile GPS/Location & RELOAD the page');
        Session::flash('successMsg','Your Attendance Recorded successfully');*/
        
        return view('mis.attendance.index',compact(['inTime','outTime']));
    }
  

    public function store(Request $request)
    {
       
     // dd($request->all());
       Attendance::create($request->all());
       Session::flash('message','Your Attendance has been Recorded Successfully!!');

       return redirect()->route('dashboard');
    }

  
    public function viewAttendance(Request $request,$id=null)
    {
       
    

      if ($id) {
        $user_id=$id;
      }
      else{
        $user_id=Auth::user()->id;
      }
       if ($request->has('strtDate') && $request->has('endDate')) {
            

             $start= $request->strtDate;
             $end =$request->endDate;

               $startDate = new DateTime($start);
        $endDate = new DateTime($end);

      $sundays = array();

    while ($startDate <= $endDate) {
        if ($startDate->format('w') == 0) {
            $sundays[] = $startDate->format('Y-m-d');
        }

        $startDate->modify('+1 day');
    }

//dd($sundays);
           
           $flag=0;
            $datas = [];
            $remark_all='Absent';
            while(strtotime($start) <= strtotime($end)) {
             
            $flag=0;
            $remark_all='Absent';
                
                $attendances = DB::table('attendances')
                               ->where('date',$start)
                               ->where('member_id',$user_id)
                               ->where('type','IN')
                               ->whereBetween('date',[$start,$end])
                               ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
                               //dd($attendances);
                $user_ids = DB::table('attendances')
                              ->where('member_id',$user_id)
                               ->where('date',$start)
                               ->where('type','IN')
                                ->whereBetween('date',[$start,$end])
                               ->orderBy('id', 'ASC')->pluck('member_id'); 
                              // dd($user_ids);              

               // dd($user_ids);


                  if($attendances==null) {
                    $user_name=User::find($user_id); //where('id',$user_id)->pluck('name');

                     // find OD/Leave/Sunday or Present/Absent
                        $userOnduty=OnDuty::where('od_date',$start)
                                  ->where('empid',$user_id)->get();

                         if (count($userOnduty)>0){
                            $remark_all = 'On Duty';
                            $flag=1;
                         }
                         else{
                              $userLeave=Leave::where('leavefrom',$start)
                                ->where('empid',$user_id)->first();                  
                                if($userLeave!= '') {
                                  $remark_all = $userLeave->leavetype;
                                  $flag = 1;
                                }
                                else{
                                  $flag =0;
                                }
                          }

                          $sunday_day = array_intersect([$start], $sundays);

                         //dd($sunday_day);

                          if($flag===0) {
                            //$remark_all = is_null(array_search($start, $sundays))? $remark_all : 'Sunday';
                            if(!$sunday_day){
                              $remark_all = 'Absent';
                            }
                            else{
                              $remark_all = 'Sunday';
                            }
                          }
                          
                          $flag=0;

                    $datas[] = array(
                        'date'=>$start,
                        'inTime'=>'NA',
                        'outTime'=>'NA',
                        'username'=>$user_name->name,
                        'user_id'=>$user_id,
                        'remark_all'=>$remark_all
                    );  
                    
                  }
                  else{

                    foreach ($user_ids as $user_id) {

                        $count = DB::table('attendances')
                                    ->where('member_id',$user_id)
                                   ->where('date',$start)
                                   ->where('type','OUT')
                                   ->orderBy('id', 'ASC')->count();              
                    
                        if($count==1){
                            $attendance_out = DB::table('attendances')
                                       ->where('date',$start)
                                       ->where('member_id',$user_id)
                                       ->where('type','OUT')
                                        ->where('member_id',$attendances->uid)
                                        ->orderBy('id', 'ASC')->first();

                            $outtime = $attendance_out->time;
                        }else $outtime = 'NA';

                        $datas[] = array(
                            'date'=>$attendances->date,
                            'inTime'=>$attendances->time,
                            'outTime'=>$outtime,
                            'username'=>$attendances->username,
                            'user_id'=>$user_id,
                            'remark_all'=>'Present'
                        );       
                    }
                  }
                
                  $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                  $remark_all='Absent';
                
            /*  }*/
          }
          $message='';
         /// $edit_option='false';
           // return $remarks;
            $edit_option=null;
            return view('mis.attendance.view',compact(['datas','users','message','edit_option','user_id','remarks']));
          } 

          
          else{
            $message="Your Last Seven Days Attendance";

            $last_seven_day=date('Y-m-d', strtotime('-6 days'));
            $now=date('Y-m-d');


            $startDate = new DateTime($last_seven_day);
        $endDate = new DateTime($now);

      $sundays = array();

    while ($startDate <= $endDate) {
    if ($startDate->format('w') == 0) {
        $sundays[] = $startDate->format('Y-m-d');
    }

    $startDate->modify('+1 day');
}


          $datas = [];
           $remark_all='Absent';
            while (strtotime($last_seven_day) <= strtotime($now)) {
            
           
             /* foreach($attendance_dates as $attendance_date){*/
                $attendances = DB::table('attendances')
                               ->where('date',$last_seven_day)
                               ->where('member_id',$user_id)
                               ->where('type','IN')
                               ->whereBetween('date',[$last_seven_day,$now])
                               ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
                               //dd($attendances);
                $user_ids = DB::table('attendances')
                              ->where('member_id',$user_id)
                               ->where('date',$last_seven_day)
                               ->where('type','IN')
                                ->whereBetween('date',[$last_seven_day,$now])
                               ->orderBy('id', 'ASC')->pluck('member_id'); 
                              // dd($user_ids);              

               // dd($user_ids);


                  if ($attendances==null) {
                    $user_name=User::find($user_id); 
                    
                      // find OD/Leave/Sunday or Present/Absent
                        $userOnduty=OnDuty::where('od_date',$last_seven_day)
                                  ->where('empid',$user_id)
                                    ->get();

                         if (count($userOnduty)>0){
                            $remark_all = 'On Duty';
                           
                         }
                         else{
                              $userLeave=Leave::where('leavefrom',$last_seven_day)
                                ->where('empid',$user_id)->first();                  
                                if($userLeave!= '') {
                                  $remark_all = $userLeave->leavetype;
                                }
                                else{
                                  $remark_all='Absent';
                                }
                          }

                          foreach ($sundays as  $sunday) {
                             if ($remark_all=='Absent' && $sunday==$last_seven_day) {
                                  $remark_all='Sunday';
                             }
                             else{
                                $remark_all=$remark_all;
                             }
                          }



                         


                    $datas[] = array(
                        'date'=>$last_seven_day,
                        'inTime'=>'NA',
                        'outTime'=>'NA',
                        'username'=>$user_name->name,
                        'user_id'=>$user_id,
                        'remark_all'=>$remark_all

                    );   
                   // dd($datas);    
                  }
                  else{

                    foreach ($user_ids as $user_id) {

                        $count = DB::table('attendances')
                                    ->where('member_id',$user_id)
                                   ->where('date',$last_seven_day)
                                   ->where('type','OUT')
                                   ->where('member_id',$user_id)
                                   ->orderBy('id', 'ASC')->count();              
                    
                        if($count==1){
                            $attendance_out = DB::table('attendances')
                                       ->where('date',$last_seven_day)
                                       ->where('member_id',$user_id)
                                       ->where('type','OUT')
                                        ->where('member_id',$attendances->uid)
                                        ->orderBy('id', 'ASC')->first();

                            $outtime = $attendance_out->time;
                        }else $outtime = 'NA';

                        $datas[] = array(
                            'date'=>$attendances->date,
                            'inTime'=>$attendances->time,
                            'outTime'=>$outtime,
                            'username'=>$attendances->username,
                            'user_id'=>$user_id,
                            'remark_all'=>'Present'
                        );       
                    }
                  }
                
                     $last_seven_day = date ("Y-m-d", strtotime("+1 days", strtotime($last_seven_day)));
                
            /*  }*/
          }
         
           $edit_option='true';
           //dd($edit_option);
           //return $remarks;
         
             return view('mis.attendance.view',compact(['datas','users','message','edit_option','user_id','remarks']));
          }
         
        
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

    public function updateInAttendance($id,$date,$type)
    {
      $username=User::find($id);
      $name=$username->name;
      $managers=User::whereIn('id',[1,272,271,125,122,105,39,68,66,29,225,51,52,201,264,71]) 
                        ->where('id','!=',Auth::id())
                        ->get();

      return view('mis.attendance.update_attendance',compact(['date','name','type','managers']));
    }
    public function updateIn(Request $request)
    {
      //$att_in=AttendanceUpdate::create($request->all());
      $name=$request->name;
       $date=$request->date;
      $type=$request->type;
      $reason=$request->reason;
       $time=$request->time;
      $approvalfrom=$request->approvalfrom;
     // dd($approvalfrom);
      $approvalfroms=implode(",", $approvalfrom);

      $user_id=Auth::id();
      $username=Auth::user()->name;
      $sip=\Request::ip();
      $att_in=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'name'=>$name,'type'=>$type,'time'=>$time,'reason'=>$reason,'approvalfrom'=>$approvalfroms,'sip'=>$sip]);

        
           $data = ['name'=>$username,'date'=>$date,'time'=>$time,'type'=>$type,'reason'=>$reason];

      $to_email=User::whereIn('id',$approvalfrom)->pluck('email')->toArray();

      array_push($to_email, Auth::user()->email);


      $approval_ids=User::whereIn('id',$approvalfrom)->pluck('id')->toArray();

     // dd($to_email);

        $subject = "Attendance Approval Request From ".$username. "  on ". date("l jS \of F Y ");
      
           Mail::send('mail.attendanceRequestMailer',  ['data' => $data,'link'=>URL::route('attendanceApprove',['id'=>$att_in->id,'user_id'=>$user_id])], function ($message)use($to_email,$subject) {
                  $message->from('info@prathamonline.in', 'MIS Alert');
                 $message->to($to_email);
                 $message->subject($subject);
            });
        
      Session::flash('message','Your Attendance Recorded successfully!!');

       return back();

    }

     public function updateOutAttendance($id,$date,$type)
    {
      $username=User::find($id);
       $managers=User::whereIn('id',[1,272,271,125,122,105,39,68,66,29,225,51,52,201,264,71]) 
                        ->where('id','!=',Auth::id())
                        ->get();

      $name=$username->name;
      return view('mis.attendance.update_attendance',compact(['date','name','type','managers']));
    }


     public function updateOut(Request $request)
    {
      $name=$request->name;
       $date=$request->date;
      $type=$request->type;
      $reason=$request->reason;
       $time=$request->time;
      $approvalfrom=$request->approvalfrom;
      $approvalfroms=implode(",", $approvalfrom);
      $user_id=Auth::id();
      $sip=\Request::ip();
       $username=Auth::user()->name;
      $att_in=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'name'=>$name,'type'=>$type,'time'=>$time,'reason'=>$reason,'approvalfrom'=>$approvalfroms,'sip'=>$sip]);

     $data = ['name'=>$username,'date'=>$date,'time'=>$time,'type'=>$type,'reason'=>$reason];
      $to_email=User::whereIn('id',$approvalfrom)->pluck('email')->toArray();
      //$approval_ids=User::whereIn('id',$approvalfrom)->pluck('id')->toArray();


 array_push($to_email, Auth::user()->email);

     // dd($to_email);

        $subject = "Attendance Approval Request From ".$username. "  on ". date("l jS \of F Y ");
      
           Mail::send('mail.attendanceRequestMailer',  ['data' => $data,'link'=>URL::route('attendanceApprove',['id'=>$att_in->id,'user_id'=>$user_id])], function ($message)use($to_email,$subject) {
                 $message->from('info@prathamonline.in', 'MIS Alert');
                 $message->to($to_email);
                 //$message->cc([]);
                 $message->subject($subject);
            });
        

      Session::flash('message','Your Attendance has been Recorded successfully!!');

       return back();

    }

    public function attendanceApprove($id,$user_id)
    {
     //dd($user_id);
      $from=Auth::user()->id;
      $att_detail=AttendanceUpdate::where('id',$id)->first();
      $applier_id=$att_detail->user_id;
     // dd($applier_id);
      if ($applier_id==$from) {
       return redirect()->route('attendance.index');
      }
      else{
          $datas=User::where('users.id',$user_id)
                    ->where('attendance_updates.id',$id)
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('attendance_updates','attendance_updates.user_id','=','users.id')
                    ->select('users.name as user_name','users.email as user_email','user_details.mobile as user_mobile','attendance_updates.date as att_date','attendance_updates.time as att_time', 'attendance_updates.type as att_type','attendance_updates.reason as att_reason')
                    ->get();
      return view('attendanceApprove',compact(['datas','id','from','user_id']));
      }
    
    }
    public function attendanceApproved(Request $request,$from,$id,$user_id)
    {
//dd($user_id);
       $actionstatus= $request->actionstatus;
        $comment= $request->comment;
        $date=$request->date;
        //dd($comment);
        $time=$request->time;
        $type=$request->type;

        $sip=\Request::ip();
        $data=AttendanceUpdate::where('id',$from)->update(['status'=>$actionstatus,'approvedby'=>$id,'comment'=>$comment]);

        $match=Attendance::where('member_id',$user_id)
                            ->where('date',$date)
                            ->where('time',$time)
                            ->where('type',$type)
                            ->get();
         //dd($match);

        if ($actionstatus=='approved' && count($match)==0) {
           $attendance_update=Attendance::insert(['member_id'=>$user_id,'date'=>$date,'time'=>$time,'type'=>$type,'sip'=>$sip]);
        }
       $attendanceDetails=AttendanceUpdate::where('attendance_updates.id',$from)
                        ->join('users','users.id','=','attendance_updates.user_id')
                        ->select('attendance_updates.*','users.name as username')->first();
                       // dd($attendanceDetails);
     $subject ="Re: "." Attendance Approval Request From ".$attendanceDetails->username. "  on ". date("l jS \of F Y ",strtotime($attendanceDetails->created_at));

      $approvedby=User::where('id',$attendanceDetails->approvedby)->first();

            $email=User::where('id',$attendanceDetails->user_id)->first();

            $to_email=['sarita.sharma@iifm.co.in',$email->email];

       $data=['username'=>$attendanceDetails->username,'type'=>$attendanceDetails->type,'date'=>$attendanceDetails->date,'time'=>$attendanceDetails->time,'reason'=>$attendanceDetails->reason,'status'=>$attendanceDetails->status,'approvedby'=>$approvedby->name];


         Mail::send('mail.attendanceRequestApproved',  ['data' => $data], function ($message)use($to_email,$subject) {
             $message->from('info@prathamonline.in', 'PRATHAM Education');
                 $message->to($to_email);
                 $message->subject($subject);
            });
      
       Session::flash('message','Attendance Status Updated Successfully!!');
       return redirect()->route('dashboard');
        //dd($actionstatus);
    }

    public function updateBothAttendance($user_id,$date)
    {
     $managers=User::whereIn('id',[1,272,271,125,122,105,39,68,66,29,225,52,264,201,51,71])
                           ->where('id','!=',Auth::id())
                           ->get(); 
          $user=User::find($user_id);

          $inTime='';
          $outTime='';

          $userInAttendance=Attendance::where('date',$date)
                                      ->where('member_id',$user_id)
                                      ->where('type','IN')
                                      ->first();
                        if ($userInAttendance!='') {
                          $inTime=$userInAttendance->time;
                        }
                        else{
                          $inTime='';
                        }

          $userOutAttendance=Attendance::where('date',$date)
                                      ->where('member_id',$user_id)
                                      ->where('type','OUT')
                                      ->first();
                       if ($userOutAttendance!='') {
                          $outTime=$userOutAttendance->time;
                        }
                        else{
                          $outTime='';
                        }                  


       return view('mis.attendance.updateInOut',compact(['managers','user_id','date','user','date','inTime','outTime']));
    }

    public function storeUpdatedAttendance(Request $request,$user_id,$date)
    {

    // dd($request->all());

      $att_detail=AttendanceUpdate::where('user_id',$user_id)
                                    ->where('date',$date)
                                    ->get();

                                 //   dd($att_detail);
  
      if (count($att_detail)==0) {
         $approvalfrom=implode(",", $request->approvalfrom);

        // dd($request->inTime);

   if ($request->inTimeCheck=='inTimeEdited' && $request->outTimeCkeck=='outTimeEdited') {
     $updatedAttendance=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'update_type'=>'Both','in_time'=>$request->inTime,'out_time'=>$request->outTime,'reason'=>$request->reason,'approvalfrom'=>$approvalfrom,'status'=>'Pending','sip'=>\Request::ip()]);
     Session::flash('message','Attendance Update Request Sent Successfully !!.');
   }
   elseif ($request->inTimeCheck=='inTimeEdited') {
      $updatedAttendance=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'update_type'=>'IN','in_time'=>$request->inTime,'out_time'=>$request->outTime,'reason'=>$request->reason,'approvalfrom'=>$approvalfrom,'status'=>'Pending','sip'=>\Request::ip()]);
      Session::flash('message','Attendance Update Request Sent Successfully !!.');
   }
   elseif($request->outTimeCkeck=='outTimeEdited'){
   // return "hi";
     $updatedAttendance=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'update_type'=>'OUT','in_time'=>$request->inTime,'out_time'=>$request->outTime,'reason'=>$request->reason,'approvalfrom'=>$approvalfrom,'status'=>'Pending','sip'=>\Request::ip()]);
     Session::flash('message','Attendance Update Request Sent Successfully !!.');
   }
   else{
     $updatedAttendance=AttendanceUpdate::create(['user_id'=>$user_id,'date'=>$date,'in_time'=>$request->inTime,'out_time'=>$request->outTime,'reason'=>$request->reason,'approvalfrom'=>$approvalfrom,'status'=>'Pending','sip'=>\Request::ip()]);
     Session::flash('message','Attendance Update Request Sent Successfully !!.');
   }
    

      $user_details=User::find($user_id);

        $subject ="Re: "." Attendance Approval Request From ".$user_details->name. "  on ". date("l jS \of F Y ",strtotime($updatedAttendance->created_at));

      $approvedby=Auth::id();

         
          $approvalfrom_emails=User::whereIn('id',$request->approvalfrom)->pluck('email')->toArray();

          //dd($approvalfrom_emails);

            $to_email=['sarita.sharma@iifm.co.in'/*,$user_details->email*/];

          /*  $to_emails=array_merge($to_email,$approvalfrom_emails);

          $to_emails = array_unique($to_emails);*/
          // dd($to_emails);



       $data=['username'=>$user_details->name,'date'=>$date,'in_time'=>$request->inTime,'out_time'=>$request->outTime,'reason'=>$request->reason];


         Mail::send('mail.updateInOutMailer', ['data' => $data,'link'=>URL::route('updateBothAttendance',['id'=>$updatedAttendance->id])], function ($message)use($to_email,$subject) {
             $message->from('info@prathamonline.in', 'PRATHAM Education');
                 $message->to($to_email);
                 $message->subject($subject);
            });

      }
      else{

          Session::flash('message','Your attendance update request already exists. Please wait for approval.');
      
      }
   

     return back();

    }

    public function UpdateBothAttendanceApprove($id,Request $request)
    {
      
        $attendance_details=AttendanceUpdate::join('users','users.id','=','attendance_updates.user_id')
                                            ->join('user_details','user_details.user_id','=','attendance_updates.user_id')
                                            ->where('attendance_updates.id',$id)
                                            ->select('attendance_updates.*','users.name as username','user_details.mobile as mobile','users.*')
                                            ->first();

                                            //dd($attendance_details);

          return view('updateBothAttendanceApprove',compact('attendance_details'));
    }

    public function StoreUpdateBothAttendanceApprove($id)
    {
      # code...
    }
}
