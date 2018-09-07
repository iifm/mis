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

    public function index()
    {
    // $onduty=OnDuty::all()->orderBy('id','');
        $cyear=date('Y');
         $strtYear=date('Y').'-04-01';
       $endYear=date('Y-m-d');
       //dd($endYear);
      $id=Auth::user()->id;
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
        $managers=User::where('role',1)->get();
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
             $uids=User::whereIn('id',$manager)->pluck('id')->toArray();
           
          
             $default_to=['manish.ram@iifm.co.in'];

             $email_array=array_merge($to_email,$default_to);
          //dd($email_array);
              
          $subject = "On-Duty Request From " .$odfromname->name ."  on ". date("l jS \of F Y h:i:s A");
          $replyto=['manish.ram@iifm.co.in','sarita.sharma@iifm.co.in','hr@iifm.co.in','ankit.kapoor@iifm.co.in'];
          $data= array('name' => $name, 'od_date' => $od_date,'intime'=>$intime,'odtype'=>$odtype, 'outtime'=>$outtime,'reason'=>$reason);
    
         Mail::send('mail.od_mail',  ['data' => $data], function ($message)use($replyto,$email_array,$subject) {
                     $message->from('info@prathamonline.in', 'MIS Alert');
                        $message->to($email_array);
                        $message->subject($subject);
                        $message->replyTo($replyto);
                    });



            /* foreach ($email_array as $to) {
                foreach ($uids as  $uid) {
                
                  Mail::send('mail.od_mail',  ['data' => $data,'link'=>URL::route('leave-approval',['id'=>$datas->id,'uid'=>$uid])], function ($message)use($replyto,$to,$subject) {
                     $message->from('sharmasarita505@gmail.com', 'PRATHAM Education');
                        $message->to($to);
                        $message->subject($subject);
                        $message->replyTo($replyto);
                    });
            
                 }
               }*/

         Session::flash('message','On-Duty Request Sent Successfully !!');

        return redirect()->route('od.index');
       
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
        OnDuty::where('id',$id)->delete();
         Session::flash('message','On-Duty Request Deleted Successfully !!');

        return redirect()->route('od.index');


    }
}
