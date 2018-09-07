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

class AttendanceController extends Controller
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

    public function index()
    {   
       $date=date("Y-m-d");
       $id=Auth::user()->id;
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
       Session::flash('message','Your Attendance Recorded successfully!!');

       return redirect()->route('attendance.index');
    }

  
    public function viewAttendance(Request $request)
    {
          
       if ($request->has('strtDate') && $request->has('endDate') && $request->has('employee')) {
            $users=User::all();
             $start= $request->strtDate;
             $end =$request->endDate;
             $employee=$request->employee;
             // dd($start,$end);
            $datas = [];
            while (strtotime($start) <= strtotime($end)) {
             
             /* foreach($attendance_dates as $attendance_date){*/
                $attendances = DB::table('attendances')
                               ->where('date',$start)
                               ->where('member_id',$employee)
                               ->where('type','IN')
                               ->whereBetween('date',[$start,$end])
                               ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
                               //dd($attendances);
                $user_ids = DB::table('attendances')
                              ->where('member_id',$employee)
                               ->where('date',$start)
                               ->where('type','IN')
                                ->whereBetween('date',[$start,$end])
                               ->orderBy('id', 'ASC')->pluck('member_id'); 
                              // dd($user_ids);              

               // dd($user_ids);


                  if ($attendances==null) {
                    $user_name=User::find($employee); //where('id',$employee)->pluck('name');
                     // dd($employee);
                    $datas[] = array(
                        'date'=>$start,
                        'inTime'=>'NA',
                        'outTime'=>'NA',
                        'username'=>$user_name->name,
                        'user_id'=>$employee

                    );   
                   // dd($datas);    
                  }
                  else{

                    foreach ($user_ids as $user_id) {

                        $count = DB::table('attendances')
                                    ->where('member_id',$employee)
                                   ->where('date',$start)
                                   ->where('type','OUT')
                                   ->where('member_id',$user_id)
                                   ->orderBy('id', 'ASC')->count();              
                    
                        if($count==1){
                            $attendance_out = DB::table('attendances')
                                       ->where('date',$start)
                                       ->where('member_id',$employee)
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
                            'user_id'=>$employee
                        );       
                    }
                  }
                
                     $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                
            /*  }*/
          }
            //return $datas;
            return view('mis.attendance.view',compact(['datas','users']));
          } 

           if ($request->has('strtDate') && $request->has('endDate') && $request->has('employee') && Auth::user()->role==3) {
            $users=User::all();
            $id=Auth::id();
            //dd($id);
             $start= $request->strtDate;
             $end =$request->endDate;
             $employee=$request->employee;
             //dd($start,$end);
            $datas = [];
            while (strtotime($start) <= strtotime($end)) {
             
             /* foreach($attendance_dates as $attendance_date){*/
                $attendances = DB::table('attendances')
                               ->where('date',$start)
                               ->where('member_id',$employee)
                               ->where('type','IN')
                               ->whereBetween('date',[$start,$end])
                               ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();
                               //dd($attendances);
                $user_ids = DB::table('attendances')
                              ->where('member_id',$employee)
                               ->where('date',$start)
                               ->where('type','IN')
                                ->whereBetween('date',[$start,$end])
                               ->orderBy('id', 'ASC')->pluck('member_id'); 
                              // dd($user_ids);              

               // dd($user_ids);


                  if ($attendances==null) {
                    $user_name=User::find($employee); //where('id',$employee)->pluck('name');

                    $datas[] = array(
                        'date'=>$start,
                        'inTime'=>'NA',
                        'outTime'=>'NA',
                        'username'=>$user_name->name,
                        'user_id'=>$employee

                    );   
                   // dd($datas);    
                  }
                  else{

                    foreach ($user_ids as $user_id) {

                        $count = DB::table('attendances')
                                    ->where('member_id',$employee)
                                   ->where('date',$start)
                                   ->where('type','OUT')
                                   ->where('member_id',$user_id)
                                   ->orderBy('id', 'ASC')->count();              
                    
                        if($count==1){
                            $attendance_out = DB::table('attendances')
                                       ->where('date',$start)
                                       ->where('member_id',$employee)
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
                            'user_id'=>$employee
                        );       
                    }
                  }
                
                     $start = date ("Y-m-d", strtotime("+1 days", strtotime($start)));
                
            /*  }*/
          }
            //return $datas;
            return view('mis.attendance.view',compact(['datas','users']));
          } 

        else  if ($request->has('strtDate') && $request->has('endDate') && Auth::user()->role==1) {
             
            $users=User::all();
             $start= $request->strtDate;
             $end =$request->endDate;
              $attendance_dates = DB::table('attendances')
                               ->whereBetween('date',[$start,$end])
                               ->distinct()
                               ->pluck('date');
                    
                       // dd($attendance_dates);     
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
            //dd($user_ids);
           // return $datas;
            return view('mis.attendance.view',compact(['datas','users']));
              
          }

          
          else if ($request->has('strtDate') && $request->has('endDate')) {

              $users=User::all();
              // $id=Auth::user()->id;
         
           $id=Auth::user()->id;
             $start= $request->strtDate;
             $end =$request->endDate;
         
                             
            $datas = [];

            while (strtotime($start) <= strtotime($end)) {
              # code...
            }

            foreach($attendance_dates as $attendance_date){
                $attendances = DB::table('attendances')
                               ->where('attendances.member_id',$id)
                               ->where('attendances.date',$attendance_date)
                               ->where('attendances.type','IN')
                                ->join('users','users.id','=','attendances.member_id')
                               ->select('attendances.*','users.name as username','users.id as uid')
                               ->orderBy('id', 'ASC')->first();

               //dd($attendances);

                $count = DB::table('attendances')
                               ->where('member_id',$id)
                               ->where('date',$attendance_date)
                               ->where('type','OUT')
                               ->orderBy('id', 'ASC')->count();              
                


                if($count==1){
                    $attendance_out = DB::table('attendances')
                               ->where('member_id',$id)
                               ->where('date',$attendance_date)
                               ->where('type','OUT')
                               ->orderBy('id', 'ASC')->first();

                    $outtime = $attendance_out->time;
                }else $outtime = 'NA';

                $datas[] = array(
                    'date'=>$attendances->date,
                    'inTime'=>$attendances->time,
                    'outTime'=>$outtime,
                    'username'=>$attendances->username
                );           
                
            }
            // return $datas;
            return view('mis.attendance.view',compact(['datas','users']));
          } 
          
          else{
            $start='';
            $end='';
            $datas=[];
             
            $users=User::all();
             return view('mis.attendance.view',compact(['datas','users']));
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
      $managers=User::where('role',1)->get();
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

     // $to_email = ['sarita.sharma@iifm.co.in'];
        //  $subject = "Test Mail". date('d-m-Y h:m:s');
           $data = ['name'=>$username,'date'=>$date,'time'=>$time,'type'=>$type,'reason'=>$reason];
      $to_email=User::whereIn('id',$approvalfrom)->pluck('email')->toArray();
      $approval_ids=User::whereIn('id',$approvalfrom)->pluck('id')->toArray();

     // dd($to_email);

        $subject = "Attendance Approval Request From ".$username. "  on ". date("l jS \of F Y h:i:s A");

          foreach ($to_email as  $to) {
           foreach ($approval_ids as  $approval_id) {
             # code...
          
           Mail::send('mail.attendance_approve',  ['data' => $data,'link'=>URL::route('attendanceApprove',['id'=>$att_in->id,'from'=>$approval_id,'user_id'=>$user_id])], function ($message)use($to,$subject) {
             $message->from('info@prathamonline.in', 'MIS Alert');
                 $message->to($to);
                 $message->subject($subject);
            });
          }
         }
      Session::flash('message','Your Attendance Recorded successfully!!');

       return redirect()->route('attendance.index');

    }

     public function updateOutAttendance($id,$date,$type)
    {
      $username=User::find($id);
       $managers=User::where('role',1)->get();

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
      $approval_ids=User::whereIn('id',$approvalfrom)->pluck('id')->toArray();



     // dd($to_email);

        $subject = "Attendance Approval Request From ".$username. "  on ". date("l jS \of F Y h:i:s A");

          foreach ($to_email as  $to) {
           foreach ($approval_ids as  $approval_id) {
             # code...
          
           Mail::send('mail.attendance_approve',  ['data' => $data,'link'=>URL::route('attendanceApprove',['id'=>$att_in->id,'from'=>$approval_id,'user_id'=>$user_id])], function ($message)use($to,$subject) {
             $message->from('sharmasarita505@gmail.com', 'PRATHAM Education');
                 $message->to($to);
                 $message->subject($subject);
            });
          }
         }

      Session::flash('message','Your Attendance Recorded successfully!!');

       return redirect()->route('attendance.index');

    }

    public function attendanceApprove($id,$from,$user_id)
    {
     //dd($user_id);
      $datas=User::where('users.id',$user_id)
                    ->where('attendance_updates.id',$id)
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('attendance_updates','attendance_updates.user_id','=','users.id')
                    ->select('users.name as user_name','users.email as user_email','user_details.mobile as user_mobile','attendance_updates.date as att_date','attendance_updates.time as att_time', 'attendance_updates.type as att_type','attendance_updates.reason as att_reason')
                    ->get();
      return view('attendanceApprove',compact(['datas','id','from','user_id']));
    }
    public function attendanceApproved(Request $request,$from,$id,$user_id)
    {
    // dd($user_id);
       $actionstatus= $request->actionstatus;
        $comment= $request->comment;
        $date=$request->date;
        //dd($comment);
        $time=$request->time;
        $type=$request->type;

        $sip=\Request::ip();
        $data=AttendanceUpdate::where('id',$from)->update(['status'=>$actionstatus,'approvalfrom'=>$id,'comment'=>$comment]);

        $match=Attendance::where('member_id',$user_id)
                            ->where('date',$date)
                            ->where('time',$time)
                            ->where('type',$type)
                            ->get();
          //dd($match);                
        //dd($actionstatus);
        if ($actionstatus=='approved' && count($match)==0) {
           $attendance_update=Attendance::insert(['member_id'=>$user_id,'date'=>$date,'time'=>$time,'type'=>$type,'sip'=>$sip]);
        }
      
       Session::flash('message','Attendance Status Updated Successfully!!');
       return redirect()->route('dashboard');
        //dd($actionstatus);
    }
}
