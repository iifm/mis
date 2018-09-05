<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conveyance;
use DB;
use App\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $conveyance=DB::table('conveyances')
            ->whereYear('con_date',$cyear)
            ->join('users', 'users.id', '=', 'conveyances.user_id')
            ->select('conveyances.*', 'users.name')
            ->get();
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

      elseif ($request->has('employee')) {
          $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->where('user_id',$user_id)
       ->whereYear('con_date',$cyear)
       ->get();
      }

     
       return view('mis.report.conveyance',compact(['conveyance','users']));
    }

    public function attendanceReport(Request $request)
    {
         $cyear=date('Y');
        
       $users=User::join('user_details','user_details.user_id','=','users.id')
                      ->where('user_details.status','Active')
                      ->select('user_details.status','users.*')
                      ->orderBy('users.name')
                      ->get();
          $attendances=DB::table('attendances')
            ->whereYear('date',$cyear)
            ->join('users', 'users.id', '=', 'attendances.member_id')
            ->select('attendances.*', 'users.name')
            ->get();

            if($request->has('strtDate') && $request->has('endDate') && $request->has('employee')){
             // return "hello";
   $start= $request->strtDate;
             $end =$request->endDate;
             $employee=$request->employee;
              $attendance_dates = DB::table('attendances')
                               ->whereBetween('date',[$start,$end])
                               ->where('member_id',$employee)
                               ->distinct()
                               ->pluck('date');
                    
                      //  dd($attendance_dates);     
            $datas = [];

            foreach($attendance_dates as $attendance_date){
               
                        //dd($attendances);
                $user_ids = DB::table('attendances')
                               ->where('date',$attendance_date)
                                ->where('member_id',$employee)
                               ->where('type','IN')
                               ->orderBy('id', 'ASC')->pluck('member_id');               

               // dd($user_ids);
                foreach ($user_ids as $user_id) {

                   $attendances = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','IN')
                                ->where('member_id',$employee)
                               ->join('users','users.id','=','attendances.member_id')->where('users.id',$user_id)
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
//dd($attendances);
                    $count = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','OUT')
                                ->where('member_id',$employee)
                               ->where('member_id',$user_id)
                               ->orderBy('id', 'ASC')->count();              
                //dd($count);


                    if($count==1){
                        $attendance_out = DB::table('attendances')
                                   ->where('date',$attendance_date)
                                   ->where('type','OUT')
                                    ->where('member_id',$employee)
                                    ->where('member_id',$user_id)
                                    ->first();

                        $outtime = $attendance_out->time;

                        //dd($outtime);
                    }else $outtime = 'NA';

                    $datas[] = array(
                        'date'=>$attendances->date,
                        'inTime'=>$attendances->time,
                        'outTime'=>$outtime,
                        'username'=>$attendances->username
                    );       
                }
                    
                
            }
             // return $datas;
            return view('mis.report.attendance',compact(['datas','users']));

            }
            elseif ($request->has('strtDate') && $request->has('endDate')) {
                $start= $request->strtDate;
             $end =$request->endDate;
            
              $attendance_dates = DB::table('attendances')
                               ->whereBetween('date',[$start,$end])
                               ->distinct()
                               ->pluck('date');
                    
                      //  dd($attendance_dates);     
            $datas = [];

            foreach($attendance_dates as $attendance_date){
               
                        //dd($attendances);
                $user_ids = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','IN')
                               ->orderBy('id', 'ASC')->pluck('member_id');               

               // dd($user_ids);
                foreach ($user_ids as $user_id) {

                   $attendances = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','IN')
                               ->join('users','users.id','=','attendances.member_id')->where('users.id',$user_id)
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
//dd($attendances);
                    $count = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','OUT')
                               ->where('member_id',$user_id)
                               ->orderBy('id', 'ASC')->count();              
                //dd($count);


                    if($count==1){
                        $attendance_out = DB::table('attendances')
                                   ->where('date',$attendance_date)
                                   ->where('type','OUT')
                                    ->where('member_id',$user_id)
                                    ->first();

                        $outtime = $attendance_out->time;

                        //dd($outtime);
                    }else $outtime = 'NA';

                    $datas[] = array(
                        'date'=>$attendances->date,
                        'inTime'=>$attendances->time,
                        'outTime'=>$outtime,
                        'username'=>$attendances->username
                    );       
                }
                    
                
            }
             // return $datas;
            return view('mis.report.attendance',compact(['datas','users']));
            }
            elseif ($request->has('employee')) {

              $cyear=date('Y');
              $cmonth=date('m');
            
             $employee=$request->employee;
              $attendance_dates = DB::table('attendances')
                               ->where('member_id',$employee)
                               ->whereYear('date',$cyear)
                               ->whereMonth('date',$cmonth)
                               ->distinct()
                               ->pluck('date');
                    
                      //  dd($attendance_dates);     
            $datas = [];

            foreach($attendance_dates as $attendance_date){
               
                        //dd($attendances);
                $user_ids = DB::table('attendances')
                               ->where('date',$attendance_date)
                                ->where('member_id',$employee)
                               ->where('type','IN')
                               ->orderBy('id', 'ASC')->pluck('member_id');               

               // dd($user_ids);
                foreach ($user_ids as $user_id) {

                   $attendances = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','IN')
                                ->where('member_id',$employee)
                               ->join('users','users.id','=','attendances.member_id')->where('users.id',$user_id)
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
//dd($attendances);
                    $count = DB::table('attendances')
                               ->where('date',$attendance_date)
                               ->where('type','OUT')
                                ->where('member_id',$employee)
                               ->where('member_id',$user_id)
                               ->orderBy('id', 'ASC')->count();              
                //dd($count);


                    if($count==1){
                        $attendance_out = DB::table('attendances')
                                   ->where('date',$attendance_date)
                                   ->where('type','OUT')
                                    ->where('member_id',$employee)
                                    ->where('member_id',$user_id)
                                    ->first();

                        $outtime = $attendance_out->time;

                        //dd($outtime);
                    }else $outtime = 'NA';

                    $datas[] = array(
                        'date'=>$attendances->date,
                        'inTime'=>$attendances->time,
                        'outTime'=>$outtime,
                        'username'=>$attendances->username
                    );       
                }
                    
                
            }
             // return $datas;
            return view('mis.report.attendance',compact(['datas','users']));
            }
            else{
                $datas = [];
              return view('mis.report.attendance',compact(['attendances','users','datas']));
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
}
