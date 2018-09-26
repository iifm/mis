<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Leave;
use App\UploadCategory;
use App\OnDuty;
use App\UserDetails;
use App\HallOfFame;
use App\User;
use App\Wishes;
use Mail;
use DB;
use Session;
use App\NewsUpload;
use App\Attendance;

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
          $current_date=date('Y-m-d');
            $currenDate = date('Y-m-d');
          $id=Auth::user()->id;
       //dd($strtYear);
        $endYear=date('Y',strtotime('+1 year')).'-03-31';
        $cyear= date("Y");
        $cdate= date("d");
       // dd($cdate);
        $cmonth= date("m");

       //  dd($cmonth);
        $id=Auth::id();


        $pressReases=NewsUpload::join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->where('upload_categories.type','press')
                                ->select('news_uploads.*')->get();
                           // dd($pressReases);

        $announcements=NewsUpload::join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->where('upload_categories.type','announcement')
                                ->select('news_uploads.*')->get();
                               // dd($pressReases);

        $user_detail=User::where('users.id',$id)
                    ->where('user_details.status','Active')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('departments','departments.id','=','user_details.department')
                    ->select('users.*','user_details.*','users.id as user_id','departments.name as department')
                    ->get();
        foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
            //dd($profile);
            $department=$value->department;
        }
      
        Session::put('profile', $profile);
        Session::put('department',$department);    

        $policyEditType=UploadCategory::where('type','text')->get();     
        Session::put('policyType', $policyEditType);
        
        $downloadType=UploadCategory::where('type','file')->get();     
        Session::put('downloadType', $downloadType);
   

        $strtYear=date('Y').'-04-01';
        $endYear=date('Y',strtotime('+1 year')).'-03-31';
  
        $totod=OnDuty::where('empid',$id)
                    ->whereBetween('od_date',[$strtYear,$endYear])
                    ->orderBy('id','DESC')->count();
                    //dd($onduty);

        $eoms= HallOfFame::join('users','users.id','=','hall_of_fames.empname')
                        ->select('hall_of_fames.*','users.name as empname','users.id as user_id')->orderBy('id','DESC')
                        ->get();
       
         $totleaves=Leave::whereBetween('leavefrom',[$strtYear,$currenDate])
                        ->where('empid',$id)
                        ->where('leavetype','!=','Comp Off')
                        ->select(DB::raw('sum(totalleave) as total_leaves'))
                        ->get();
                        //dd($totleaves);

                        foreach ($totleaves as  $value) {
                            $totleaves=$value->total_leaves;
                        }
        $intime='';
        $outtime='';
        $inTime=Attendance::where('date',$current_date)
                                    ->where('member_id',$id)
                                    ->where('type','IN')
                                    ->get();
            foreach ($inTime as  $value) {
               $intime=$value->time;
            }

          $ouTime=Attendance::where('date',$current_date)
                                    ->where('member_id',$id)
                                    ->where('type','OUT')
                                    ->get();
                                   // dd($ouTime);
        foreach ($ouTime as  $value) {
           $outtime=$value->time;
        }
    
        $todays_event = [];

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
               // dd($birthdays);

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
                   // dd($workanniversary);
        $monthBirthday_days_sorted=UserDetails::whereMonth('dob',$cmonth)
                     ->where('status','Active')
                      ->whereday('dob','>=',$cdate)
                       ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('dob','ASC')
                     ->pluck('dob')->toArray();
                     $dob_days=[];

                     foreach ($monthBirthday_days_sorted as  $monthBirthday_day_sorted) {
                         $dob_days[]= date('d',strtotime($monthBirthday_day_sorted));
                     }

                    $dob_days= array_unique($dob_days);
                   
                     sort($dob_days);

                     $monthBirthday=[];

                     foreach ($dob_days as  $dob_day) {
                       $monthBirthday_users= UserDetails::whereMonth('dob',$cmonth)
                     ->where('status','Active')
                      ->whereday('dob','=',$dob_day)
                       ->join('users','users.id','=','user_details.user_id')
                        ->select('user_details.*','users.name as username','users.id as user_id' )
                        ->orderBy('dob','ASC')
                        ->get();

                        foreach ($monthBirthday_users as  $monthBirthday_user) {
                           $monthBirthday[]=[
                                              'username'=>$monthBirthday_user->username,
                                              'dob'=>$monthBirthday_user->dob,
                                              'user_id'=>$monthBirthday_user->user_id
                                                ];

                        }
                     }

                    // dd($monthBirthday);

          $monthWork_day_sorted=UserDetails::whereMonth('doj',$cmonth)
                    ->whereYear('doj','<',$cyear)
                      ->whereday('doj','>=',$cdate)
                     ->where('status','Active')
                      ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('doj','ASC')
                     ->pluck('doj')->toArray();
                    //dd($monthWorkAniversary);
                     $doj_day=[];
                    foreach ($monthWork_day_sorted as  $value) {
                      $doj_day[]= date('d',strtotime($value));
                        //dd($value);
                    }
                    $doj_day=array_unique($doj_day);

                    sort($doj_day);
                    $monthWorkAniversary=[];
            foreach($doj_day as $doj_month_day){
            $monthWorkAniversary_user=UserDetails::whereMonth('doj',$cmonth)
                    ->whereYear('doj','<',$cyear)
                      ->whereday('doj',$doj_month_day)
                     ->where('status','Active')
                      ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username','users.id as user_id')
                     ->orderBy('doj','ASC')
                     ->get();
                     foreach ($monthWorkAniversary_user as  $data) {
                         $monthWorkAniversary[]=[
                             'doj'=>$data->doj,
                             'username'=>$data->username,
                             'user_id'=>$data->user_id,
                       ];
                     }
                
             }   
              //dd($monthWorkAniversary); 
                $monthAniversary =[];
                    $monthAniversary_days=[];
          $monthAniversary_days=UserDetails::whereMonth('anniversary',$cmonth)
                      ->whereday('anniversary','>=',$cdate)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username')
                     ->orderBy('user_details.anniversary','ASC')
                     ->pluck('anniversary')->toArray();

                     $anniversary_days=[];
                      foreach ($monthWork_day_sorted as  $value) {
                      $anniversary_days[]= date('d',strtotime($value));
                       // dd($value);
                    }
                    $anniversary_days=array_unique($anniversary_days);
                     sort($anniversary_days);

                     foreach ($anniversary_days as  $anniversary_day) {
                    $monthAniversaryUser_days  =  UserDetails::whereMonth('anniversary',$cmonth)
                      ->whereday('anniversary','=',$anniversary_day)
                     ->where('status','Active')
                     ->join('users','users.id','=','user_details.user_id')
                     ->select('user_details.*','users.name as username','users.id as user_id')
                     ->orderBy('user_details.anniversary','ASC')
                     ->get();
                           // $monthAniversary=[];
                           // dd($monthAniversary);
                        foreach ($monthAniversaryUser_days as  $monthAniversaryUser_day) {
                            $monthAniversary[]=[
                                                'username'=>$monthAniversaryUser_day->username,
                                                'anniversary'=>$monthAniversaryUser_day->anniversary,
                                                'user_id'=>$monthAniversaryUser_day->user_id

                                            ];
                        }
                     }
                
                     Session::put('event', $todays_event);
                    // dd($outtime);
        return view('dashboard',compact(['totleaves','totod','birthdays','anniversary','workanniversary','monthBirthday','monthWorkAniversary','monthAniversary','eoms','todays_event','intime','outtime','pressReases','announcements']));
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
        $sender_dept=UserDetails::where('user_id',$sender_id)
                                ->join('departments','departments.id','=','user_details.department')
                                ->select('user_details.*','departments.name as dept_name')
                                ->get();
        foreach ($sender_dept as $dept) {
           $department=$dept->dept_name;
        }
        //dd($sender_dept);
        $message=$request->message;
        $receiver_email=$request->email;
        $receiver_name=$request->name;
        $sub=$request->subject;
        $receiver_id=$request->receiver_id;
        $sip=\Request::ip();
       $sender_mail=Auth::user()->email;

       $birthday_images=[];

      // $image_path="https://thumbs.dreamstime.com/b/best-wishes-lettering-text-card-44167686.jpg";
                      
$birthday_images=['http://www.prathamedu.com/Files_Upload/birthday1_file.jpg','http://www.prathamedu.com/Files_Upload/birthday2_file.jpg','http://www.prathamedu.com/Files_Upload/birthday4_file.jpg ','http://www.prathamedu.com/Files_Upload/birthday3_file.jpg','http://www.prathamedu.com/Files_Upload/birthday5_file.jpg'];
   $birthday_image = array_rand($birthday_images);
//dd($birthday_images);
$work_images=['http://www.prathamedu.com/Files_Upload/work1_file.jpg','http://www.prathamedu.com/Files_Upload/work2_file.jpg','http://www.prathamedu.com/Files_Upload/work3_file.jpg','http://www.prathamedu.com/Files_Upload/work4_file.jpg'];
$work_image=array_rand($work_images);

$anniversary_images=['http://www.prathamedu.com/Files_Upload/anniversary1_file.jpg','http://www.prathamedu.com/Files_Upload/anniversary2_file.jpg','http://www.prathamedu.com/Files_Upload/anniversary3_file.jpg','http://www.prathamedu.com/Files_Upload/anniversary4_file.jpg'];
$anniversary_image=array_rand($anniversary_images);
        $to=['sarita.sharma@iifm.co.in'];

        if($sub=="Birthday"){
           $image_path=$birthday_images[$birthday_image];
        }
        elseif ($sub=="Work Anniversary") {
            $image_path=$anniversary_images[$anniversary_image];
            //dd($image_path);
        }
        elseif($sub=="Wedding Anniversary"){
            $image_path=$anniversary_images[$anniversary_image];
        }
        else{
             $image_path="http://www.prathamedu.com/Files_Upload/birthday1_file.jpg";
        }

           $query=Wishes::create(['sender_id'=> $sender_id,'message'=>$message,'receiver_id'=>$receiver_id,'sip'=>$sip]);
       // $to_email[]='';
           
          $subject =$sub." Greeting from ". $sender_name. "  - " .$department;
           //$data = [];
          $data= array('message' => $message,'name'=>$receiver_name,'image'=>$image_path);

           Mail::send('mail.wish_mail',  ['data' => $data], function ($message)use($receiver_email,$subject,$sender_mail,$to) {
                $message->from('info@prathamonline.in', 'MIS Alert');
                 $message->to($to);
                $message->subject($subject);
            });

           Session::flash('message','Your Message sent Successfully!!');
           return redirect()->route('dashboard');
    }



    public function postView($id)
    {
        $post=NewsUpload::where('id',$id)->first();


         
        $otherpostDatas=NewsUpload::join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->where('news_uploads.category',$post->category)
                                ->where('news_uploads.id','!=',$id)
                                ->select('news_uploads.*')->get();
        return view('admin.announcement',compact(['post','otherpostDatas']));
    }

    
}
