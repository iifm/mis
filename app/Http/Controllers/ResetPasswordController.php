<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use URL;
use App\User;

class ResetPasswordController extends Controller
{
    
    public function index()
    {
        return view('reset_password.resetPassword');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        //dd($request->all());
       $email=$request->email;
       $user_profile='';
       $user_data=User::where('email','like','%'.$email.'%')
                        ->join('user_details','user_details.user_id','=','users.id')
                        ->select('users.*','user_details.*','users.id as user_id')
                        ->get();
                        //dd($user_data);
        foreach ($user_data as  $value) {
            $user_id=$value->user_id;
           // dd($user_id);
           $user_id = base64_encode($user_id);
            $user_name=$value->name;
           

        }
// dd($user_profile);
       if(count($user_data)==0){
          Session::flash('message',"This Email doesn't exists to IIFM MIS system. Please Enter Correct Email-Id");
        return redirect()->back();
       }
       else{
            //return "success";
             $email=$request->email;
            $to_email = ['sarita.sharma@iifm.co.in',$email];
            $subject = "Reset Password  ". date('d-m-Y h:m:s');
            $data=['link'=>URL::route('reset-password-form',['id'=>$user_id]),'name'=>$user_name];

           Mail::send('mail.reset_password',  ['data' => $data], function ($message)use($to_email,$subject) {
                $message->from('info@prathamonline.in', 'MIS Alert');
                 $message->to($to_email);
                 $message->subject($subject);
            });
           Session::flash('message',"Mail have been sent to your Email-Id. Please check your email");
       }

       return redirect()->route('root');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetPasswordForm($id)
    {
      
        $user_id=base64_decode($id);
   // dd($user_id);
         $user_data=User::where('users.id',$user_id)
                        ->join('user_details','user_details.user_id','=','users.id')
                        ->select('users.*','user_details.*')
                        ->get();
                       // dd($user_data);
       return view('reset_password.resetPasswordForm',compact('user_data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordChanged($id,Request $request)
    {
      // dd($request->all());
       $password=$request->password;
       $password_confirmation=$request->password_confirmation;
       if ($password==$password_confirmation) {
          $change_password=User::where('id',$id)->update(['password'=>md5($password)]);
          Session::flash('message','Password changed successfully !!');
          return redirect()->route('root');
       }
       else{
            Session::flash('message',"Password and Confirmed-Password doesn't match.");
          return redirect()->back();
       }
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
        //
    }
}
