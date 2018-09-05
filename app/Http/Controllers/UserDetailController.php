<<<<<<< HEAD
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
use App\Department;


class UserDetailController extends Controller
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

    public function index($id=null)
    {
        if($id){
           $user_id = $id;
            $role=Auth::user()->role;
            if($role==1 || $role==2){
                $view_details='SHOW';
            }else{
                $view_details='HIDE';
            }
         }else{
            $user_id=Auth::user()->id; 
            $view_details='SHOW';
         }
        
         $user_detail=User::where('users.id',$user_id)
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('departments','departments.id','=','user_details.department')
                    ->select('users.*','user_details.*','users.id as user_id','departments.name as department')
                    ->get();

           // dd($user_detail);
        foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
            $department=$value->department;
        }

        //Session::put('profile', $profile);
        //Session::put('department',$department);
       
        $useredu=  DB::table('user_educations')
                ->where('user_id',$user_id)
                ->join('education_options','user_educations.edu_option','=','education_options.id')
                ->select('user_educations.*', 'education_options.name as course_type', 'education_options.id as education_id')->get();
               

        $user_work = UserWorkExperience::where('user_id',$user_id)->get();
        // dd($user_work);

        
          
        return view('mis.user_detail.index',compact(['user_detail','user_work','user_education','designation','mobile','locationcentre','department','doj','useredu','view_details','user_id']));
       
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

  
    public function education($id)
    {
       $education_options=DB::table('education_options')->get();
       return view('mis.user_detail.education',compact(['education_options','id']));
    }

     public function educationAdd(Request $request,$id)
     {
       // return $id;
        $user_id=$id;
         $edu_option=$request->input('edu_option');
         $schoolname=$request->input('schoolname');
         $board=$request->input('board');
         $specialization=$request->input('specialization');
         $strtyear=$request->input('strtyear');
         $endyear=$request->input('endyear');
         $percentage=$request->input('percentage');
         $sip=\Request::ip();
         $filename='';
         $addedby=Auth::user()->name;
         $certificate=$request->file('certificate');

          if ($request->hasFile('certificate')) {
              $filename=$user_id.'_'.$certificate->getClientOriginalName();
              $certificate->storeAs('/education', $filename);
         }     
       
        UserEducation::create(['user_id'=>$user_id,'edu_option'=>$edu_option,'schoolname'=>$schoolname,'board'=>$board,'certificate'=>$filename,'specialization'=>$specialization,'strtyear'=>$strtyear,'endyear'=>$endyear,'percentage'=>$percentage,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');

         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }

    }

    public function userEducationUpdate($id,Request $request,$user_id)
    {
         $edu_option=$request->input('edu_option');
         $schoolname=$request->input('schoolname');
         $board=$request->input('board');
         $specialization=$request->input('specialization');
         $strtyear=$request->input('strtyear');
         $endyear=$request->input('endyear');
         $percentage=$request->input('percentage');
         $sip=\Request::ip();
         $filename='';
         $addedby=Auth::user()->name;
         $certificate=$request->file('certificate');

          if ($request->hasFile('certificate')) {
              $filename=$user_id.'_'.$addedby.'_'.$certificate->getClientOriginalName();
              $certificate->storeAs('/education', $filename);
         }     
          UserEducation::where('id',$id)
                        ->update(['user_id'=>$user_id,'edu_option'=>$edu_option,'schoolname'=>$schoolname,'board'=>$board,'certificate'=>$filename,'specialization'=>$specialization,'strtyear'=>$strtyear,'endyear'=>$endyear,'percentage'=>$percentage,'sip'=>$sip,'addedby'=>$addedby]);
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }

    public function educationDelete($id,$user_id){
        UserEducation::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
        if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }
    public function educationEdit($id,$user_id)
    {
       $education_options=DB::table('education_options')->get();
       $edu_datas = UserEducation::where('user_educations.id',$id)
                                ->join('education_options','education_options.id','=','user_educations.edu_option')
                                ->select('education_options.name as education_name','education_options.id as education_id','user_educations.*')
                                ->get();
                               // dd($edu_datas);
       return view('mis.user_detail.educationEdit',compact(['id','edu_datas','education_options','user_id']));
    }

    public function professionalDelete($id,$user_id){
        UserWorkExperience::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
           if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
       
    }

     public function professional($id)
    {
      // return $id;
       return view('mis.user_detail.professional',compact('id'));
    }

     public function professionalAdd(Request $request,$id){
        $user_id=$id;
        $sip=\Request::ip();
        $company=$request->input('company');
        $fromdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $designation1=$request->input('designation1');
        $address=$request->input('address');
        $addedby=Auth::user()->name;

        $offerletter=$request->file('offerletter');
        $relievingletter=$request->file('relievingletter');

        $offer='';
        $relieving='';

        if ($request->hasFile('offerletter')) {
           $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);
        }

        if ($request->hasFile('relievingletter')) {
            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);
        }
        
        

        UserWorkExperience::create(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
       

    }
    public function professionalEdit($id,$user_id)
    {
        $user_work_datas=UserWorkExperience::where('id',$id)->get();
        return view('mis.user_detail.professionalEdit',compact(['id','user_work_datas','user_id']));
    }

    public function professionalUpdate($id,$user_id,Request $request)
    {
       $sip=\Request::ip();
        $company=$request->input('company');
        $fromdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $designation1=$request->input('designation1');
        $address=$request->input('address');
        $addedby=Auth::user()->name;

        $offerletter=$request->file('offerletter');
        $relievingletter=$request->file('relievingletter');

        $offer='';
        $relieving='';

        if ($request->hasFile('offerletter')) {
           $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);


             UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        }

        elseif ($request->hasFile('relievingletter')) {
            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);

             UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'sip'=>$sip,'addedby'=>$addedby]);
        }
        elseif ($request->hasFile('offerletter') && $request->hasFile('relievingletter')) {
          $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);

            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);


              UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        }
        else{
              UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'address'=>$address,'sip'=>$sip,'addedby'=>$addedby]);
        }
      
        Session::flash('message','Your Details Updated Successfully !!');
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }

     public function official($id)
    {
       //$id=Auth::user()->id;
        $departments=Department::all();
        $user_detail =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid')
                                ->get();
       return view('mis.user_detail.official',compact(['user_detail','id','departments']));
    }

     public function officialAdd(Request $request,$id)
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
       

         $profile=$request->file('profile');

         $filename='';

        if ($request->hasFile('profile')) {
            $filename =$name.'_'.$id.'_'.$profile->getClientOriginalName();
        $request->file('profile')->storeAs('/profile', $filename);


        $official=UserDetails::where('user_id',$id)->update(['profile'=>$filename,'doj'=>$doj,'designation'=>$designation,'department'=>$department,'locationcentre'=>$locationcentre,'sip'=>$sip,'mobile'=>$mobile]);
        }
        else{
            $official=UserDetails::where('user_id',$id)->update(['doj'=>$doj,'designation'=>$designation,'department'=>$department,'locationcentre'=>$locationcentre,'sip'=>$sip,'mobile'=>$mobile]);
        }

        $user=User::where('id',$id)->update(['name'=>$name,'email'=>$email]);
          Session::flash('message','Your Details Updated Successfully !!');
          if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }

    }

   
      public function personal($id)
    {
         $user_detail =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid')
                                ->get();

       return view('mis.user_detail.personal',compact(['user_detail','id']));
    }

 public function personalAdd(Request $request,$id)
    {
     //return $id;
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
      
        $official=UserDetails::where('user_id',$id)->update(['gender'=>$gender,'dob'=>$dob,'cstreet'=>$cstreet,'ccity'=>$ccity,'cstate'=>$cstate,'pstreet'=>$pstreet,'pcity'=>$pcity,'pstate'=>$pstate,'altno'=>$altno]);
       // return $official;
          Session::flash('message','Your Details Updated Successfully !!');
         // return back();
         if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }

    }

     public function family($id)
    {
       $user_details =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid')
                                ->get();
       return view('mis.user_detail.family',compact(['user_details','id']));
    }

     public function familyAdd(Request $request,$id)
    {
       // return $id;
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
      
        $official=UserDetails::where('user_id',$id)->update(['fname'=>$fname,'foccup'=>$foccup,'fcontact'=>$fcontact,'mname'=>$mname,'moccup'=>$moccup,'mcontact'=>$mcontact,'maritalstatus'=>$maritalstatus,'spname'=>$spname,'spoccup'=>$spoccup,'anniversary'=>$anniversary]);

                 Session::flash('message','Your Details Updated Successfully !!');


           if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }
           Session::flash('message','Your Details Updated Successfully !!');
       
    }
    
}
=======
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
use App\Department;


class UserDetailController extends Controller
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

    public function index($id=null)
    {
        if($id){
           $user_id = $id;
            $role=Auth::user()->role;
            if($role==1 || $role==2){
                $view_details='SHOW';
            }else{
                $view_details='HIDE';
            }
         }else{
            $user_id=Auth::user()->id; 
            $view_details='SHOW';
         }
        
         $user_detail=User::where('users.id',$user_id)
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->join('departments','departments.id','=','user_details.department')
                    ->select('users.*','user_details.*','users.id as user_id','departments.name as department')
                    ->get();

           //dd($user_detail);
        foreach ($user_detail as  $value) {    
            $profile=$value->profile; 
            $department=$value->department;
        }

        //Session::put('profile', $profile);
        //Session::put('department',$department);
       
        $useredu=  DB::table('user_educations')
                ->where('user_id',$user_id)
                ->join('education_options','user_educations.edu_option','=','education_options.id')
                ->select('user_educations.*', 'education_options.name as course_type', 'education_options.id as education_id')->get();
               

        $user_work = UserWorkExperience::where('user_id',$user_id)->get();
        // dd($user_work);

        
          
        return view('mis.user_detail.index',compact(['user_detail','user_work','user_education','designation','mobile','locationcentre','department','doj','useredu','view_details','user_id']));
       
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

  
    public function education($id)
    {
       $education_options=DB::table('education_options')->get();
       return view('mis.user_detail.education',compact(['education_options','id']));
    }

     public function educationAdd(Request $request,$id)
     {
       // return $id;
        $user_id=$id;
         $edu_option=$request->input('edu_option');
         $schoolname=$request->input('schoolname');
         $board=$request->input('board');
         $specialization=$request->input('specialization');
         $strtyear=$request->input('strtyear');
         $endyear=$request->input('endyear');
         $percentage=$request->input('percentage');
         $sip=\Request::ip();
         $filename='';
         $addedby=Auth::user()->name;
         $certificate=$request->file('certificate');

          if ($request->hasFile('certificate')) {
              $filename=$user_id.'_'.$certificate->getClientOriginalName();
              $certificate->storeAs('/education', $filename);
         }     
       
        UserEducation::create(['user_id'=>$user_id,'edu_option'=>$edu_option,'schoolname'=>$schoolname,'board'=>$board,'certificate'=>$filename,'specialization'=>$specialization,'strtyear'=>$strtyear,'endyear'=>$endyear,'percentage'=>$percentage,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');

         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }

    }

    public function userEducationUpdate($id,Request $request,$user_id)
    {
         $edu_option=$request->input('edu_option');
         $schoolname=$request->input('schoolname');
         $board=$request->input('board');
         $specialization=$request->input('specialization');
         $strtyear=$request->input('strtyear');
         $endyear=$request->input('endyear');
         $percentage=$request->input('percentage');
         $sip=\Request::ip();
         $filename='';
         $addedby=Auth::user()->name;
         $certificate=$request->file('certificate');

          if ($request->hasFile('certificate')) {
              $filename=$user_id.'_'.$addedby.'_'.$certificate->getClientOriginalName();
              $certificate->storeAs('/education', $filename);
         }     
          UserEducation::where('id',$id)
                        ->update(['user_id'=>$user_id,'edu_option'=>$edu_option,'schoolname'=>$schoolname,'board'=>$board,'certificate'=>$filename,'specialization'=>$specialization,'strtyear'=>$strtyear,'endyear'=>$endyear,'percentage'=>$percentage,'sip'=>$sip,'addedby'=>$addedby]);
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }

    public function educationDelete($id,$user_id){
        UserEducation::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
        if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }
    public function educationEdit($id,$user_id)
    {
       $education_options=DB::table('education_options')->get();
       $edu_datas = UserEducation::where('user_educations.id',$id)
                                ->join('education_options','education_options.id','=','user_educations.edu_option')
                                ->select('education_options.name as education_name','education_options.id as education_id','user_educations.*')
                                ->get();
                               // dd($edu_datas);
       return view('mis.user_detail.educationEdit',compact(['id','edu_datas','education_options','user_id']));
    }

    public function professionalDelete($id,$user_id){
        UserWorkExperience::where('id',$id)->delete();
         Session::flash('message','Your Details Updated Successfully !!');
           if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
       
    }

     public function professional($id)
    {
      // return $id;
       return view('mis.user_detail.professional',compact('id'));
    }

     public function professionalAdd(Request $request,$id){
        $user_id=$id;
        $sip=\Request::ip();
        $company=$request->input('company');
        $fromdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $designation1=$request->input('designation1');
        $address=$request->input('address');
        $addedby=Auth::user()->name;

        $offerletter=$request->file('offerletter');
        $relievingletter=$request->file('relievingletter');

        $offer='';
        $relieving='';

        if ($request->hasFile('offerletter')) {
           $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);
        }

        if ($request->hasFile('relievingletter')) {
            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);
        }
        
        

        UserWorkExperience::create(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        Session::flash('message','Your Details Updated Successfully !!');
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
       

    }
    public function professionalEdit($id,$user_id)
    {
        $user_work_datas=UserWorkExperience::where('id',$id)->get();
        return view('mis.user_detail.professionalEdit',compact(['id','user_work_datas','user_id']));
    }

    public function professionalUpdate($id,$user_id,Request $request)
    {
       $sip=\Request::ip();
        $company=$request->input('company');
        $fromdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $designation1=$request->input('designation1');
        $address=$request->input('address');
        $addedby=Auth::user()->name;

        $offerletter=$request->file('offerletter');
        $relievingletter=$request->file('relievingletter');

        $offer='';
        $relieving='';

        if ($request->hasFile('offerletter')) {
           $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);


             UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        }

        elseif ($request->hasFile('relievingletter')) {
            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);

             UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'sip'=>$sip,'addedby'=>$addedby]);
        }
        elseif ($request->hasFile('offerletter') && $request->hasFile('relievingletter')) {
          $offer=$user_id.$offerletter->getClientOriginalName();
            $offerletter->storeAs('/professional',$offer);

            $relieving=$user_id.$relievingletter->getClientOriginalName();
             $relievingletter->storeAs('/professional',$relieving);


              UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'relievingletter'=>$relieving,'address'=>$address,'offerletter'=>$offer,'sip'=>$sip,'addedby'=>$addedby]);
        }
        else{
              UserWorkExperience::where('id',$id)->update(['user_id'=>$user_id,'company'=>$company,'fromdate'=>$fromdate,'todate'=>$todate,'designation1'=>$designation1,'address'=>$address,'sip'=>$sip,'addedby'=>$addedby]);
        }
      
        Session::flash('message','Your Details Updated Successfully !!');
         if(Auth::user()->id==$user_id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$user_id]);
        }
    }

     public function official($id)
    {
       //$id=Auth::user()->id;
        $departments=Department::all();
        $user_detail =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->join('departments','departments.id','=','user_details.department')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid','departments.id as department_id','departments.name as department_name')
                                ->get();
       return view('mis.user_detail.official',compact(['user_detail','id','departments']));
    }

     public function officialAdd(Request $request,$id)
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
       

         $profile=$request->file('profile');

         $filename='';

        if ($request->hasFile('profile')) {
            $filename =$name.'_'.$id.'_'.$profile->getClientOriginalName();
        $request->file('profile')->storeAs('/profile', $filename);


        $official=UserDetails::where('user_id',$id)->update(['profile'=>$filename,'doj'=>$doj,'designation'=>$designation,'department'=>$department,'locationcentre'=>$locationcentre,'sip'=>$sip,'mobile'=>$mobile]);
        }
        else{
            $official=UserDetails::where('user_id',$id)->update(['doj'=>$doj,'designation'=>$designation,'department'=>$department,'locationcentre'=>$locationcentre,'sip'=>$sip,'mobile'=>$mobile]);
        }

        $user=User::where('id',$id)->update(['name'=>$name,'email'=>$email]);
          Session::flash('message','Your Details Updated Successfully !!');
          if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }

    }

   
      public function personal($id)
    {
         $user_detail =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid')
                                ->get();

       return view('mis.user_detail.personal',compact(['user_detail','id']));
    }

 public function personalAdd(Request $request,$id)
    {
     //return $id;
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
      
        $official=UserDetails::where('user_id',$id)->update(['gender'=>$gender,'dob'=>$dob,'cstreet'=>$cstreet,'ccity'=>$ccity,'cstate'=>$cstate,'pstreet'=>$pstreet,'pcity'=>$pcity,'pstate'=>$pstate,'altno'=>$altno]);
       // return $official;
          Session::flash('message','Your Details Updated Successfully !!');
         // return back();
         if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }

    }

     public function family($id)
    {
       $user_details =UserDetails::join('users','users.id','=','user_details.user_id')
                                ->where('users.id',$id)
                                ->select('users.*','user_details.*','users.id as userid')
                                ->get();
       return view('mis.user_detail.family',compact(['user_details','id']));
    }

     public function familyAdd(Request $request,$id)
    {
       // return $id;
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
      
        $official=UserDetails::where('user_id',$id)->update(['fname'=>$fname,'foccup'=>$foccup,'fcontact'=>$fcontact,'mname'=>$mname,'moccup'=>$moccup,'mcontact'=>$mcontact,'maritalstatus'=>$maritalstatus,'spname'=>$spname,'spoccup'=>$spoccup,'anniversary'=>$anniversary]);

                 Session::flash('message','Your Details Updated Successfully !!');


           if(Auth::user()->id==$id){
        return redirect()->route('user.index');
        }
        else{
             return redirect()->route('search_user',['id'=>$id]);
        }
           Session::flash('message','Your Details Updated Successfully !!');
       
    }
    
}
>>>>>>> refs/remotes/origin/master
