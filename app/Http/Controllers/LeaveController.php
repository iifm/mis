<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use Session;
use Auth;
use DateTime;
use DB;
use App\User;
use Mail;
use URL;

class LeaveController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cyear=date('Y');
        $id=Auth::user()->id;
       $strtYear=date('Y').'-04-01';
       //dd($strtYear);
       $endYear=date('Y',strtotime('+1 year')).'-03-31';
        $currenDate = date('Y-m-d');

         $datetime1 = date_create($strtYear);
         $datetime2 = date_create($currenDate);

         $interval = date_diff($datetime1, $datetime2);
         $diff=$interval->format('%m');

         $total_leaves=$diff*1.75;

        $leave_applied=Leave::whereBetween('leavefrom',[$strtYear,$currenDate])
                        ->where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->select(DB::raw('sum(totalleave) as total_leaves'))
                        ->get();
         $leave_approved=Leave::whereBetween('leavefrom',[$strtYear,$currenDate])
                        ->where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->where('status','!=','rejected')
                        ->select(DB::raw('sum(totalleave) as total_leaves'))
                        ->get();

                
            foreach ($leave_applied as  $value) {
               $leave_applied=$value->total_leaves;
            }
            foreach ($leave_approved as $value) {
               $leave_approved=$value->total_leaves;
            }
       // $leave=Leave::where('empid',$id)->orderBy('id','DESC')->get();
        $leave=Leave::whereBetween('leavefrom',[$strtYear,$currenDate])
                        ->where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->orderBy('id','DESC')
                        ->get();
                     //   dd($leave);
                //$managersname[]="";
              $leave_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($leave as  $value) {
                

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
                                    'type'=> $value->leavetype,
                                    'from'=> $value->leavefrom,
                                    'to'=> $value->leaveto,
                                    'approval'=> $usernames,
                                    'status'=> $value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($leave_datas); 
               //return $leave_datas;


         
        return view('mis.leave.index',compact(['finaldatas','total_leaves','leave_applied','leave_approved']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers=User::where('role',1)->get();
      //  dd($managers);
        return view('mis.leave.add',compact('managers'));
    }

    public function store(Request $request)
    {

      
        $approvalfrom = $request->Input('approvalfrom');
           $approvalfrom_array=implode(",", $approvalfrom);
         $ip= \Request::ip();
         $id=Auth::user()->id;
          $name=Auth::user()->name;

       
       $leavefrom = $request->Input('leavefrom');
       $leaveto = $request->Input('leaveto');
       $totdays = $request->Input('totdays');

      // dd($totdays);
        $leaveoff = $request->Input('leaveoff');
     // dd($leaveoff);
   /*    $half_day = array_search('Half day Leave',[$leaveoff]);

           //dd($half_day);
           if ($half_day!='false') {
            $totdays=$totdays - 0.5;
           }
*/
           //dd($totdays);
        $leavetype=implode(',', $leaveoff);

        $reason = $request->Input('reason');  
        $agdcompoff = $request->Input('agdcompoff'); 
        $approvalfrom = $request->Input('approvalfrom');
      // dd($approvalfrom);

        $approvalfrom_array=implode(",", $approvalfrom);
       // dd($approvalfrom_array);

        $query=Leave::create(['empid'=> $id,'leavefrom'=>$leavefrom,'leaveto'=>$leaveto,'totalleave'=>$totdays,'leavetype'=>$leavetype,'agcompoffdate'=>$agdcompoff,'reason'=>$reason,'approvalfrom'=>$approvalfrom_array,'status'=>'Pending','sip'=>$ip]);
       // $to_email[]='';
            $leavefromname=User::find($query->empid);
           
            $to_email=User::whereIn('id',$approvalfrom)->pluck('email')->toArray();
             $uids=User::whereIn('id',$approvalfrom)->pluck('id')->toArray();
           
          
             $default_to=['manish.ram@iifm.co.in'];

             $email_array=array_merge($to_email,$default_to);
          //dd($email_array);
              
          $subject = "Leave Request From " .$leavefromname->name ."  on ". date("l jS \of F Y h:i:s A");
          $replyto=['manish.ram@iifm.co.in','sarita.sharma@iifm.co.in','hr@iifm.co.in','ankit.kapoor@iifm.co.in'];
          $data= array('name' => $name, 'leavefrom' => $leavefrom,'reason'=>$reason,'leavetype'=>$leavetype, 'leaveto'=>$leaveto,'totdays'=>$totdays);
    
       
             foreach ($email_array as $to) {
                foreach ($uids as  $uid) {
                
                  Mail::send('mail.leaveapprove',  ['data' => $data,'link'=>URL::route('leave-approval',['id'=>$query->id,'uid'=>$uid])], function ($message)use($replyto,$to,$subject,$approvalfrom) {
                     $message->from('info@prathamonline.in', 'PRATHAM Education');
                        $message->to($to);
                        $message->subject($subject);
                        $message->replyTo($replyto);
                    });
            
                 }
               }
      

           Session::flash('message','Your Leave Request Sent Successfully !!');


            
        return redirect()->route('leave.index');

    }

 
    public function edit($id)
    {
         return view('mis.leave.edit');
    }

   
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        Leave::where('id',$id)->delete();
          Session::flash('message','Leave Request Deleted Successfully !!');

        return redirect()->route('leave.index');
    }

    public function leaveApproval(Request $request,$id,$uid)
    {
       //dd($uid);
        $leave_id=Leave::where('id',$id)->get();
        foreach ($leave_id as  $value) {
           $userDetail=User::where('users.id',$value->empid)
                          ->join('user_details','users.id','=','user_details.user_id')
                          ->select('users.id as user_id','users.email as user_email','user_details.mobile as user_mobile','users.name as user_name','user_details.department as user_deptt')
                          ->get();
        }
       
       // dd($userDetail);
        return view('leaveApproval',compact(['leave_id','userDetail','from','uid']));
    }

    public function leaveApproved(Request $request,$id,$uid){
        //dd($uid);
        $actionstatus= $request->actionstatus;
        $comment= $request->comment;
       
       $data=Leave::where('id',$id)->update(['status'=>$actionstatus,'comment'=>$comment,'approvedby'=>$uid]);
       Session::flash('message','Leave Status Updated Successfully!!');
       return redirect()->route('dashboard');
    }


    public function sendMail(){
         $to_email = ['manish.ram@iifm.co.in','sarita.sharma@iifm.co.in'];
          $subject = "Test Mail". date('d-m-Y h:m:s');
           $data = [];


           Mail::send('mail.leaveapprove',  ['data' => $data], function ($message)use($to_email,$subject) {
             $message->from('hr@iifm.co.in', 'PRATHAM Education');
                 $message->to($to_email);
            });

            echo "Mail Sent.... Check Your Email Please... :)";

        }
}
