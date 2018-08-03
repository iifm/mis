<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserEducation;
use App\UserWorkExperience;
use App\UserDetails;
use Auth;
use App\User;
use Session;
use DB;


class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         $id=Auth::user()->id;
 
         $user_detail =UserDetails::where('user_id',$id)->get();
          foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
        }
         Session::put('profile', $profile);
         Session::put('userDetail',$user_detail);
       
       $useredu=  DB::table('user_educations')
                ->where('user_id',$id)
                ->join('education_options','user_educations.edu_option','=','education_options.id')
                ->select('user_educations.*', 'education_options.name as course_type', 'education_options.id as education_id')->get();
               

          $user_work = UserWorkExperience::where('user_id',$id)->get();
          
        return view('mis.user_detail.index',compact(['user_detail','user_work','user_education','designation','mobile','locationcentre','department','doj','useredu']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $id=Auth::user()->id;

         $user_detail = UserDetails::where('id',$id)->get();
          $user_work = UserWorkExperience::where('id',$id)->get();
         $user_education = UserEducation::where('id',$id)->get();

       
        return view('mis.user_detail.add',compact(['user_detail','user_work','user_education']));
    }

  
    public function education()
    {
       $education_options=DB::table('education_options')->get();
       return view('mis.user_detail.education',compact('education_options'));
    }

     public function educationAdd(Request $request){
         //$date= $request->except('certificate');
        $user_id=Auth::user()->id;
         $edu_option=$request->input('edu_option');
         $schoolname=$request->input('schoolname');
         $board=$request->input('board');
         $specialization=$request->input('specialization');
         $strtyear=$request->input('strtyear');
         $endyear=$request->input('endyear');
         $percentage=$request->input('percentage');
         $sip=\Request::ip();

         $addedby=Auth::user()->name;
         $certificate=$request->file('certificate');

        $filename=$user_id.'_'.$addedby.'_'.$certificate->getClientOriginalName();
        
        $certificate->storeAs('/public/education', $filename);

        UserEducation::create(['user_id'=>$user_id,'edu_option'=>$edu_option,'schoolname'=>$schoolname,'board'=>$board,'certificate'=>$filename,'specialization'=>$specialization,'strtyear'=>$strtyear,'endyear'=>$endyear,'percentage'=>$percentage,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');

    }

    public function educationDelete($id){
        UserEducation::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');
    }

    public function professionalDelete($id){
        UserWorkExperience::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');
    }

     public function professional()
    {
       return view('mis.user_detail.professional');
    }

     public function professionalAdd(Request $request){
        $user_id=Auth::user()->id;
        $sip=\Request::ip();
        $company=$request->input('company');
        $fromdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $designation1=$request->input('designation1');
        $address=$request->input('address');
        $addedby=Auth::user()->name;

        $offerletter=$request->file('offerletter');
        $relievingletter=$request->file('relievingletter');

        $offer=$user_id.'_'.$addedby.$offerletter->getClientOriginalName();
        $offerletter->storeAs('public/professional',$offer);
        $relieving=$user_id.'_'.$addedby.$relievingletter->getClientOriginalName();
        $relievingletter->storeAs('public/professional',$relieving);

        UserWorkExperience::create(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');

    }

     public function official()
    {
       return view('mis.user_detail.official');
    }

     public function officialAdd(Request $request)
    {
        //dd($request->all());
        $name=$request->input('name');
        $email=$request->input('email');
        $doj=$request->input('doj');
        $mobile=$request->input('mobile');
        $designation=$request->input('designation');
        $department=$request->input('department');
        $locationcentre=$request->input('locationcentre');
        $sip=\Request::ip();
        $id=Auth::user()->id;

         $profile=$request->file('profile');
        $filename =$id.$profile->getClientOriginalName();
        $request->file('profile')->storeAs('/public/profile', $filename);
      
        $official=UserDetails::where('user_id',$id)->update(['profile'=>$filename,'doj'=>$doj,'designation'=>$designation,'department'=>$department,'locationcentre'=>$locationcentre,'sip'=>$sip,'mobile'=>$mobile]);

        $user=User::where('id',$id)->update(['name'=>$name,'email'=>$email]);
          Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');

    }

   
      public function personal()
    {
       return view('mis.user_detail.personal');
    }

 public function personalAdd(Request $request)
    {
      
        $gender=$request->input('gender');
        $dob=$request->input('dob');
        $cstreet=$request->input('cstreet');
        $ccity=$request->input('ccity');
        $cstate=$request->input('cstate');
        $pstreet=$request->input('pstreet');
        $pcity=$request->input('pcity');
        $altno=$request->input('altno');
        $pstate=$request->input('pstate');        
        $sip=\Request::ip();
        $id=Auth::user()->id;

        
        $official=UserDetails::where('user_id',$id)->update(['gender'=>$gender,'dob'=>$dob,'cstreet'=>$cstreet,'ccity'=>$ccity,'cstate'=>$cstate,'pstreet'=>$pstreet,'pcity'=>$pcity,'pstate'=>$pstate,'altno'=>$altno]);

          Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');

    }

     public function family()
    {
       return view('mis.user_detail.family');
    }

     public function familyAdd(Request $request)
    {
     
        $fname=$request->input('fname');
        $foccup=$request->input('foccup');
        $fcontact=$request->input('fcontact');
        $mname=$request->input('mname');
        $moccup=$request->input('moccup');
        $mcontact=$request->input('mcontact');
        $maritalstatus=$request->input('maritalstatus');
        $spname=$request->input('spname');
        $spoccup=$request->input('spoccup');        
         $anniversary=$request->input('anniversary');        

        $sip=\Request::ip();
        $id=Auth::user()->id;

        
        $official=UserDetails::where('user_id',$id)->update(['fname'=>$fname,'foccup'=>$foccup,'fcontact'=>$fcontact,'mname'=>$mname,'moccup'=>$moccup,'mcontact'=>$mcontact,'maritalstatus'=>$maritalstatus,'spname'=>$spname,'spoccup'=>$spoccup,'anniversary'=>$anniversary]);

          Session::flash('message','Your Details Updated Successfully !!');
        return redirect()->route('user.index');

    }
    
}
