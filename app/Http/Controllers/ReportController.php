<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conveyance;
use App\Attendance;
use DB;
use DateTime;
use App\User;
use App\OnDuty;
use App\Leave;
use App\UserDetails;

class ReportController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function conveyanceReport()
    {

      $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();
       $cyear=date('Y');
        $conveyance='';
        return view('mis.report.conveyance',compact(['conveyance','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conveyanceDate(Request $request)
    {
     
        $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();
               $cyear=date('Y');

      $pre_month = Date("Y-m-d", strtotime(date('Y-m-01') . " last month"));
      $c_month=date('Y-m-10');

     // dd($pre_month,$c_month);

      $start= \Carbon\Carbon::parse($request->strtDate)->format('Y-m-d');
      $end =\Carbon\Carbon::parse($request->endDate)->format('Y-m-d');
      $user_id=$request->employee;

      if ($request->has('strtDate') && $request->has('endDate') && $request->has('employee')) {
           $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->whereBetween('conveyances.con_date', [$start, $end])
       ->where('user_id',$user_id)
       ->get();
      }
      elseif ($request->has('strtDate') && $request->has('endDate')) {
           $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->whereBetween('conveyances.con_date', [$start, $end])
      
       ->get();
      }
       elseif($request->has('employee') && $request->has('month')){
      
         $conveyance = DB::table('conveyances')
              ->join('users', 'users.id', '=', 'conveyances.user_id')
              ->where('user_id',$request->employee)
              ->whereYear('con_date',$cyear)
               ->whereMonth('con_date',$request->month)
                ->select('conveyances.*', 'users.name')
              ->get();
          //dd($conveyance);
      }

      elseif ($request->has('employee')) {
          $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->where('user_id',$user_id)
       ->whereYear('con_date',$cyear)
       ->get();
      }
     
      else{
          $conveyance = DB::table('conveyances')
              ->join('users', 'users.id', '=', 'conveyances.user_id')
              ->whereYear('con_date',$cyear)
               ->whereMonth('con_date',$request->month)
                ->select('conveyances.*', 'users.name')
              ->get();
      }
//dd($pre_month,$c_month);
    /* $conveyance_datas=[];
      foreach ($conveyance as  $value) {
        $conveyance_date=$value->con_date;
       while (strtotime($pre_month) <= strtotime($c_month)) {
          if ($conveyance_date>=$pre_month) {
           $admin_action='true';
          }
          else{
            $admin_action='false';
          }
     $conveyance_datas[]=['username'=>$value->name,
                                'con_date'=>$value->con_date,
                                'from'=>$value->disfrom,
                                'to'=>$value->disto,
                                'mode'=>$value->mode,
                                'distance'=>$value->distance,
                                'amount'=>$value->amount,
                                'status'=>$value->status,
                                'action'=>$admin_action
                              ];
       $pre_month = date ("Y-m-d", strtotime("+1 days", strtotime($pre_month)));

        }


      }

      dd($conveyance_datas);*/
     
       return view('mis.report.conveyance',compact(['conveyance','users','pre_month','c_month']));
    }

   
    public function attendanceReport(Request $request)
    {
         $cyear=date('Y');
        
      $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();

      $start= $request->strtDate;
      $end =$request->endDate;

      $prathamHolidays=[date('Y-01-01'),date('Y-01-26'),date('Y-08-15'),date('Y-10-02'),date('2018-11-07'),date('2018-11-08')];

      if ($request->employee=='') {
        $member_ids= Attendance::whereBetween('date',[$start,$end])
                                ->distinct('member_id')
                                ->pluck('member_id')
                                ->toArray();
      }

      else{

        $member_ids=explode(",",$request->employee);


      }
     

    if ($request->has('strtDate') && $request->has('endDate')) {
            
           $flag=0;
            $datas = [];
            $remark_all='Absent';
          while(strtotime($start) <= strtotime($end)) {
             foreach ($member_ids as $member_id) {
                   
                $flag=0;
                $remark_all='Absent';

            $attendances = DB::table('attendances')
                               ->where('date',$start)
                               ->where('member_id',$member_id)
                               ->where('type','IN')
                               ->whereBetween('date',[$start,$end])
                               ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
                      // dd($attendances);        
              $user_ids = DB::table('attendances')
                              ->where('member_id',$member_id)
                               ->where('date',$start)
                               ->where('type','IN')
                                ->whereBetween('date',[$start,$end])
                               ->orderBy('id', 'ASC')->pluck('member_id'); 
                             

                  if($attendances==null) {

                    $user_name=User::find($member_id); 

                     $userOnduty=OnDuty::where('od_date',$start)
                                  ->where('empid',$member_id)->get();

                         if (count($userOnduty)>0){
                            $remark_all = 'On Duty';
                            $flag=1;
                         }
                         else{
                              $userLeave=Leave::where('leavefrom',$start)
                                                 ->where('empid',$member_id)->first();      

                                //dd($user_id);            
                                if($userLeave != '') {
                                  $remark_all = $userLeave->leavetype;
                                           if ($userLeave->leavetype=='Casual Leave' && $userLeave->totalleave > 1) {
                                    $total_days=$userLeave->totalleave;
                                   
                                        for($i=1; $i <$total_days; $i++){ 
                                                $username=User::find($user_id);
                                                $emp_name=$username->name;
                                                
                                            $datas[] = array(
                                                            'date'=>$start,
                                                            'inTime'=>'NA',
                                                            'outTime'=>'NA',
                                                            'username'=>$emp_name,
                                                            'user_id'=>$user_id,
                                                            'remark_all'=>$userLeave->leavetype
                                                );  

                                           $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));   
                                         }
                                  }
                                  $flag = 1;
                                }
                                else{
                                  $flag =0;
                                }
                          }


                          foreach ($prathamHolidays as  $prathamHoliday) {
                            if ($remark_all=='Absent' && $prathamHoliday==$start) {
                                  $remark_all='Official Holiday';
                             }
                             else{
                                $remark_all=$remark_all;
                             }
                          }

                       
                    $datas[] = array(
                        'date'=>$start,
                        'inTime'=>'NA',
                        'outTime'=>'NA',
                        'username'=>$user_name->name,
                        'user_id'=>$member_id,
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
                
           }

            $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
             $remark_all='Absent';

          }

            return view('mis.report.attendance',compact(['datas','users','message','edit_option','user_id']));
          } 

          else{
            $users='';
            $datas=[];
            return view('mis.report.attendance',compact(['users','datas']));
          }


           
        

    }

    public function leaveReport()
    {
       $cyear=date('Y');
         $strtYear=date('Y').'-04-01';
       //dd($strtYear);
       $endYear=date('Y',strtotime('+1 year')).'-03-31';
      $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();
     $leaves=DB::table('leaves')
            ->whereBetween('leavefrom',[$strtYear,$endYear])
            ->join('users', 'users.id', '=', 'leaves.empid')
            ->select('leaves.*', 'users.name')
            ->orderBy('leaves.id','DESC')
            ->get();
              $leave_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($leaves as  $value) {
                

                $appfrom = $value->approvalfrom;
                
                //dd($appfrom);

                $name[]='';

                $appfromnamesarr = explode(',', $appfrom);
               // dd($appfromnamesarr);
                $appfrom=array_filter($appfromnamesarr);
                //dd($appfrom);
                $appfromname=User::whereIn('id',[$appfrom])->pluck('name')->toArray();   
              //  dd($appfromname);
                $names = implode(',',$appfromname); 

                $usernames = trim($names,",");
               // dd($appfromname);
                    
                  $leave_datas[] =  array(
                                    'name'=>$value->name,
                                    'type'=> $value->leavetype,
                                    'from'=> $value->leavefrom,
                                    'to'=> $value->leaveto,
                                    'days'=>$value->totalleave,
                                    'approval'=> $usernames,
                                    'status'=> $value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($leave_datas); 
           //return $finaldatas;
      return view('mis.report.leave',compact(['users','finaldatas']));
    }

    public function leaveDate(Request $request)
    {
      $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();
               $cyear=date('Y');

      $start= \Carbon\Carbon::parse($request->strtDate)->format('Y-m-d');
      $end =\Carbon\Carbon::parse($request->endDate)->format('Y-m-d');
      $user_id=$request->employee;
      if ($request->has('strtDate') && $request->has('endDate') && $request->has('employee')) {
       // return "hii";
           $leaves = DB::table('leaves')
       ->join('users', 'users.id', '=', 'leaves.empid')
       ->select('leaves.*', 'users.name')
       ->whereBetween('leaves.leavefrom', [$start, $end])
       ->where('empid',$user_id)
       ->get();
         $leave_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($leaves as  $value) {
                

                $appfrom = $value->approvalfrom;
                
                //dd($appfrom);

                $name[]='';

                $appfromnamesarr = explode(',', $appfrom);
               // dd($appfromnamesarr);
                $appfrom=array_filter($appfromnamesarr);
                //dd($appfrom);
                $appfromname=User::whereIn('id',[$appfrom])->pluck('name')->toArray();   
              //  dd($appfromname);
                $names = implode(',',$appfromname); 

                $usernames = trim($names,",");
               // dd($appfromname);
                    
                  $leave_datas[] =  array(
                                    'name'=>$value->name,
                                    'type'=> $value->leavetype,
                                    'from'=> $value->leavefrom,
                                    'to'=> $value->leaveto,
                                    'days'=>$value->totalleave,
                                    'approval'=> $usernames,
                                    'status'=> $value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($leave_datas); 
           //return $finaldatas;
          return view('mis.report.leave',compact(['users','finaldatas']));

      
      }
      elseif ($request->has('strtDate') && $request->has('endDate')) {
           $leaves = DB::table('leaves')
       ->join('users', 'users.id', '=', 'leaves.empid')
       ->select('leaves.*', 'users.name')
       ->whereBetween('leaves.leavefrom', [$start, $end])
       ->get();

         $leave_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($leaves as  $value) {
                

                $appfrom = $value->approvalfrom;
                
                //dd($appfrom);

                $name[]='';

                $appfromnamesarr = explode(',', $appfrom);
               // dd($appfromnamesarr);
                $appfrom=array_filter($appfromnamesarr);
                //dd($appfrom);
                $appfromname=User::whereIn('id',[$appfrom])->pluck('name')->toArray();   
              //  dd($appfromname);
                $names = implode(',',$appfromname); 

                $usernames = trim($names,",");
               // dd($appfromname);
                    
                  $leave_datas[] =  array(
                                    'name'=>$value->name,
                                    'type'=> $value->leavetype,
                                    'from'=> $value->leavefrom,
                                    'to'=> $value->leaveto,
                                    'days'=>$value->totalleave,
                                    'approval'=> $usernames,
                                    'status'=> $value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($leave_datas); 
          // return $finaldatas;
          return view('mis.report.leave',compact(['users','finaldatas']));

      }

      elseif ($request->has('employee')) {
          $leaves = DB::table('leaves')
       ->join('users', 'users.id', '=', 'leaves.empid')
       ->select('leaves.*', 'users.name')
       ->where('empid',$user_id)
       ->whereYear('leavefrom',$cyear)
       ->get();


         $leave_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($leaves as  $value) {
                

                $appfrom = $value->approvalfrom;
                
                //dd($appfrom);

                $name[]='';

                $appfromnamesarr = explode(',', $appfrom);
               // dd($appfromnamesarr);
                $appfrom=array_filter($appfromnamesarr);
                //dd($appfrom);
                $appfromname=User::whereIn('id',[$appfrom])->pluck('name')->toArray();   
              //  dd($appfromname);
                $names = implode(',',$appfromname); 

                $usernames = trim($names,",");
               // dd($appfromname);
                    
                  $leave_datas[] =  array(
                                    'name'=>$value->name,
                                    'type'=> $value->leavetype,
                                    'from'=> $value->leavefrom,
                                    'to'=> $value->leaveto,
                                    'days'=>$value->totalleave,
                                    'approval'=> $usernames,
                                    'status'=> $value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($leave_datas); 
          // return $finaldatas;
          return view('mis.report.leave',compact(['users','finaldatas']));


      }

     
       return view('mis.report.conveyance',compact(['conveyance','users']));
    }

    public function approval()
    {
      return view('approval');
    }

    public function leaveSummaryReport(Request $request)
    {
       
      $strtYear=date('Y').'-04-01';  
      $endYear=date('Y',strtotime('+1 year')).'-03-31';
      $currenDate = date('Y-m-d');
      $leaveSummaryDetails=[];

        $user_ids=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->pluck('users.id')
                      ->toArray();
          $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->orderBy('users.name')
                      ->get();

        if ($request->has('endDate')) {
            foreach ($user_ids as  $user_id) {
              $endDate=$request->endDate;
              $user_details=UserDetails::where('user_id',$user_id)->first();
               $username=User::find($user_id);
                   if (strtotime($user_details->doj)> strtotime($strtYear)) {
             
                  $datetime1 = date_create($user_details->doj);
                  $datetime2 = date_create($endDate);

                  $interval = date_diff($datetime1, $datetime2);
                  $diff=$interval->format('%m'); 
                  $total_leaves=$diff*1.75;

           }
        else{

                $datetime1 = date_create($strtYear);
                $datetime2 = date_create($endDate);
                $interval = date_diff($datetime1, $datetime2);
                $diff=$interval->format('%m'); 
                $total_leaves=$diff*1.75;
             }
             $leave_approved=Leave::whereBetween('leavefrom',[$strtYear,$endDate])
                        ->where('empid',$user_id)
                        ->where('leavetype','!=','Comp Off')
                        ->where('status','!=','rejected')
                        ->select(DB::raw('sum(totalleave) as total_leaves'))
                        ->get();
          foreach ($leave_approved as $value) {
               $leave_approved=$value->total_leaves;
            }

             $leaveSummaryDetails[]=['leave_generated'=>$total_leaves,
                               'leave_taken'=> $leave_approved,
                                'leave_balance'=>$total_leaves-$leave_approved,
                                'username'=>$username->name
                              ];
          }
        }
        else{
           foreach ($user_ids as  $user_id) {
             $user_details=UserDetails::where('user_id',$user_id)->first();
             $username=User::find($user_id);

             if (strtotime($user_details->doj)> strtotime($strtYear)) {
             
                  $datetime1 = date_create($user_details->doj);
                  $datetime2 = date_create(date('Y-m-d'));

                  $interval = date_diff($datetime1, $datetime2);
                  $diff=$interval->format('%m'); 
                  $total_leaves=$diff*1.75;

           }
        else{

                $datetime1 = date_create($strtYear);
                $datetime2 = date_create($currenDate);
                $interval = date_diff($datetime1, $datetime2);
                $diff=$interval->format('%m'); 
                $total_leaves=$diff*1.75;
         }

           $leave_approved=Leave::whereBetween('leavefrom',[$strtYear,$currenDate])
                        ->where('empid',$user_id)
                        ->where('leavetype','!=','Comp Off')
                        ->where('status','!=','rejected')
                        ->select(DB::raw('sum(totalleave) as total_leaves'))
                        ->get();
          foreach ($leave_approved as $value) {
               $leave_approved=$value->total_leaves;
            }


         $leaveSummaryDetails[]=['leave_generated'=>$total_leaves,
                               'leave_taken'=> $leave_approved,
                                'leave_balance'=>$total_leaves-$leave_approved,
                                'username'=>$username->name
                              ];
       }
      }
                      
      
     
      return view('mis.report.leaveSummary',compact(['leaveSummaryDetails','users']));
    }
}
