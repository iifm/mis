<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnDuty;
use Session;
use Auth;
use App\User;
use Mail;
use URL;

class OnDutyController extends Controller
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

    public function index($id)
    {
    // $onduty=OnDuty::all()->orderBy('id','');
        $cyear=date('Y');
         $strtYear=date('Y').'-04-01';
       $endYear=date('Y-m-d');
       //dd($endYear);
    
        $onduty=OnDuty::where('empid',$id)
                    ->whereBetween('od_date',[$strtYear,$endYear])
                    ->orderBy('id','DESC')->get();
                    //dd($onduty);


          $od_datas[] = '';  
              
                $names='';
                $usernames='';  
                $appfrom[]='';
             foreach ($onduty as  $value) {
                

                $appfrom = $value->approvalfrom;
               // dd($appfrom);
                //dd($appfrom);

                $name[]='';

                $appfromnamesarr = explode(',', $appfrom);
                $appfrom=array_filter($appfromnamesarr);
                
                $appfromname=User::whereIn('id',$appfrom)->pluck('name')->toArray();   
                $names = implode(',',$appfromname); 

                $usernames = trim($names,",");
                    
                  $od_datas[] =  array(
                                    'od_date'=> $value->od_date,
                                    'intime'=> $value->intime,
                                    'outtime'=> $value->outtime,
                                    'odtype'=> $value->odtype,
                                    'approvalfrom'=> $usernames,
                                    'status'=>$value->status,
                                    'user_id' => $value->empid
                  );            
                  $usernames='';  //dd($value);
                  $names='';

                 //dd($names);
                 
             }
           $finaldatas = array_filter($od_datas); 
           //return $finaldatas;
    return view('mis.onduty.index',compact(['finaldatas']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers=User::whereIn('id',[272,271,125,122,105,39,68,66,29,225,149])->get();
         return view('mis.onduty.create',compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 'name','email',   'mobile','od_date','intime','outtime','odtype','reason','approvalfrom','status','sip'
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       // dd($request->all());
         $status="Pending";
        $ip= \Request::ip();
       $id=Auth::user()->id;
       
        $od_date = $request->Input('od_date');
        $intime = $request->Input('intime');
        $outtime = $request->Input('outtime');
        $odtype = $request->Input('od_type');
        $reason = $request->Input('reason');
         $manager = $request->Input('leaveoff2');
         $manager_array=implode(",",$manager );
           $name=Auth::user()->name;
        $status = $status;
       

        $datas=OnDuty::create(['empid'=> $id,'od_date' =>$od_date,'intime' =>$intime,'outtime' =>$outtime,'odtype' =>$odtype,'reason' =>$reason,'approvalfrom' =>$manager_array,'status' =>$status,'sip' =>$ip]);

//dd($data);
         $odfromname=User::find($datas->empid);
           
            $to_email=User::whereIn('id',$manager)->pluck('email')->toArray();

            array_push($to_email, Auth::user()->email);
             $uids=User::whereIn('id',$manager)->pluck('id')->toArray();
           
             
          $subject = "On-Duty Request From " .$odfromname->name ."  on ". date("l jS \of F Y ");
          $replyto=['manish.ram@iifm.co.in','sarita.sharma@iifm.co.in','hr@iifm.co.in','ankit.kapoor@iifm.co.in'];
          $data= array('name' => $name, 'od_date' => $od_date,'intime'=>$intime,'odtype'=>$odtype, 'outtime'=>$outtime,'reason'=>$reason);
    
         Mail::send('mail.onDutyRequestMailer',  ['data' => $data], function ($message)use($replyto,$subject,$to_email) {
                     $message->from('info@prathamonline.in', 'MIS Alert');
                        $message->to($to_email);
                        $message->subject($subject);
                        $message->cc(['manish.ram@iifm.co.in']);
                        $message->replyTo($replyto);
                    });

         Session::flash('message','On-Duty Request Sent Successfully !!');

        return redirect()->route('od.index',['id'=>Auth::id()]);
       
    }

    public function destroy($id)
    {
        OnDuty::where('id',$id)->delete();
         Session::flash('message','On-Duty Request Deleted Successfully !!');

        return redirect()->route('od.index');


    }
}
