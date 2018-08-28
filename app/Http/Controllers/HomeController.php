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
          $profile='';
          $department='';
       //dd($strtYear);
        $endYear=date('Y',strtotime('+1 year')).'-03-31';
        $cyear= date("Y");
        $cdate= date("d");
       // dd($cdate);
        $cmonth= date("m");

       //  dd($cmonth);
        $id=Auth::id();

        $user_detail=User::where('users.id',$id)
                    ->where('user_details.status','Active')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->select('users.*','user_details.*','users.id as user_id')
                    ->get();
        foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
            //dd($profile);
            $department=$value->department;
        }

        Session::put('profile', $profile);
        Session::put('department',$department);

        

        $strtYear=date('Y').'-04-01';
        $endYear=date('Y',strtotime('+1 year')).'-03-31';
  
        $totod=OnDuty::where('empid',$id)
                    ->whereBetween('od_date',[$strtYear,$endYear])
                    ->orderBy('id','DESC')->count();
                    //dd($onduty);

        $eoms=HallOfFame::orderBy('id','desc')->get();
       
         $totleaves=Leave::where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->whereBetween('leavefrom',[$strtYear,$endYear])
                        ->count();

        /* $totod=OnDuty::where('empid',$id)
                        ->whereYear('od_date',$cyear)
                        ->count();
        $totod=OnDuty::where('empid',$id)->count();
*/
        $todays_event = [];

        $totconveyance=Conveyance::where('user_id',$id)
                        ->whereYear('con_date',$cyear)
                          ->whereMonth('con_date',$cmonth)
                        ->sum('amount');

        $birthdays=UserDetails::whereDay('dob',$cdate)
                    ->whereMonth('dob',$cmonth)
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
                    ->whereMonth('anniversary',$cmonth)
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
                      ->whereMonth('doj',$cmonth)
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

    public function sendWish($id,$subject)
    {
        $user_data=User::where('id',$id)->get();
        

        //dd($user_data);
       return view('mis.wish',compact(['user_data','subject']));
    }
    public function wishEmail(Request $request){
       // dd($request);
        $sender_id=Auth::user()->id;
        $sender_name=Auth::user()->name;
        $sender_dept=UserDetails::where('user_id',$sender_id)->get();
        foreach ($sender_dept as $dept) {
           $department=$dept->department;
        }
        //dd($sender_dept);
        $message=$request->message;
        $receiver_email=$request->email;
        $receiver_name=$request->name;
        $sub=$request->subject;
        $receiver_id=$request->receiver_id;
        $sip=\Request::ip();
       $sender_mail=Auth::user()->email;
      // $image_path="https://thumbs.dreamstime.com/b/best-wishes-lettering-text-card-44167686.jpg";
       $birthday_img="https://asset.holidaycardsapp.com/assets/card/b_day229-6ae37171a98c1ce89a30eb6454e1fe60.png";
       $anni_img="https://www.ienglishstatus.com/wp-content/uploads/2016/12/50th-Anniversary-Images-Free.png";
       $work_image="https://quotespics.net/wp-content/uploads/2017/01/CmCx1QjWkAAxlhk.jpg";
        $to=['sarita.sharma@iifm.co.in'];

        if($sub=="Birthday"){
           $image_path=$birthday_img; 
        }
        elseif ($sub=="Work Anniversary") {
            $image_path=$work_image; 
        }
        else{
            $image_path=$anni_img;
        }

           $query=Wishes::create(['sender_id'=> $sender_id,'message'=>$message,'receiver_id'=>$receiver_id,'sip'=>$sip]);
       // $to_email[]='';
           
          $subject =$sub." Greeting from ". $sender_name. "  - " .$department;
           //$data = [];
          $data= array('message' => $message,'name'=>$receiver_name,'image'=>$image_path);

           Mail::send('mail.wish_mail',  ['data' => $data], function ($message)use($receiver_email,$subject,$sender_mail,$to) {
             $message->from($sender_mail, 'PRATHAM Education');
                 $message->to($to);
                $message->subject($subject);
            });

           Session::flash('message','Your Message sent Successfully!!');
           return redirect()->route('dashboard');
    }

    
}
