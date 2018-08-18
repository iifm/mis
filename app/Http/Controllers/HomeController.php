<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Leave;
use App\OnDuty;
use App\Conveyance;
use App\UserDetails;
use App\HallOfFame;
use App\User;
use App\Wishes;
use Mail;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
         $strtYear=date('Y').'-04-01';
       //dd($strtYear);
       $endYear=date('Y',strtotime('+1 year')).'-03-31';
        $cyear= date("Y");
         $cdate= date("d");
          $cmonth= date("m");
       //  dd($cmonth);
        $id=Auth::id();

        $eoms=HallOfFame::orderBy('id','desc')->get();
       
         $totleaves=Leave::where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->whereBetween('leavefrom',[$strtYear,$endYear])
                        ->count();
         $totod=OnDuty::where('empid',$id)
                        ->whereYear('od_date',$cyear)
                        ->count();
        $totod=OnDuty::where('empid',$id)->count();

        $todays_event = [];

        $totconveyance=Conveyance::where('user_id',$id)
                        ->whereYear('con_date',$cyear)
                        ->sum('amount');
        $birthdays=UserDetails::whereDay('dob',$cdate)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username','users.id as user_id')
                     ->get();
                $dobs[]='';
            foreach ($birthdays as  $value) {
              $todays_event[] = array(
                                'name' => $value->username,
                                'event' => 'Birthday',
                                'user_id' => $value->user_id
                            );
                }

          $anniversary=UserDetails::whereDay('anniversary',$cdate)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username','users.id as user_id')
                     ->get();

                    
                    foreach ($anniversary as  $value) {
                        $todays_event[] = array(
                            'name' => $value->username,
                            'event' => 'Wedding Anniversary',
                            'user_id' => $value->user_id
                            );
                    }


         $workanniversary=UserDetails::whereDay('doj',$cdate)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username','users.id as user_id')
                     ->get();

                     foreach ($workanniversary as  $value) {
                        $todays_event[] = array(
                            'name' => $value->username,
                            'event' => 'Work Anniversary',
                            'user_id' => $value->user_id
                            );
                    }

        $monthBirthday=UserDetails::whereMonth('dob',$cmonth)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('user_details.dob','DESC')
                     ->get();

          $monthWorkAniversary=UserDetails::whereMonth('doj',$cmonth)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('user_details.doj','DESC')
                     ->get();
          $monthAniversary=UserDetails::whereMonth('anniversary',$cmonth)

                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('user_details.doj','DESC')
                     ->get();
                    // dd($monthWorkAniversary);
        //dd($totleaves);

                     Session::put('event', $todays_event);

        return view('dashboard',compact(['totleaves','totconveyance','totod','birthdays','anniversary','workanniversary','monthBirthday','monthWorkAniversary','monthAniversary','eoms','todays_event']));
    }

     public function changePasswordView()
    {
        
        return view('mis.changePassword');
    }

     public function changePassword(Request $request){
 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }

    public function sendWish($id)
    {
        $user_data=User::where('id',$id)->get();
        $events= Session::get('event');

        //dd($user_data);
       return view('mis.wish',compact('user_data'));
    }
    public function wishEmail(Request $request){
       // dd($request);
        $sender_id=Auth::user()->id;
        $sender_name=Auth::user()->name;
        $message=$request->message;
        $receiver_email=$request->email;
        $receiver_name=$request->name;
        $receiver_id=$request->receiver_id;
        $sip=\Request::ip();
       $sender_mail=Auth::user()->email;
       
        

           $query=Wishes::create(['sender_id'=> $sender_id,'message'=>$message,'receiver_id'=>$receiver_id,'sip'=>$sip]);
       // $to_email[]='';
           
          $subject = "Best Wishes from ". $sender_name. " on " .date("l jS \of F Y");
           //$data = [];
          $data= array('message' => $message,'name'=>$receiver_name);

           Mail::send('mail.wish_mail',  ['data' => $data], function ($message)use($receiver_email,$subject,$sender_mail) {
             $message->from($sender_mail, 'PRATHAM Education');
                 $message->to($receiver_email);
                $message->subject($subject);
            });

           Session::flash('message','Your Message sent Successfully!!');
           return redirect()->route('dashboard');
    }

    
}
