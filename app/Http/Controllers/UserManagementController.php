<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserEducation;
use App\UserWorkExperience;
use App\UserDetails;
use DB;
use Auth;

class UserManagementController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users=User::join('user_details','user_details.user_id','=','users.id')
                       // ->where('user_details.status','Active')
                        ->join('departments','departments.id','=','user_details.department')
                         ->join('locations','locations.id','=','user_details.locationcentre')
                        ->select('users.*','user_details.*','users.id as user_id','departments.name as dept_name','locations.name as locationcentre')
                        ->get();

        return view('user_management.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusEdit($id)
    {
       $data=explode(",", $id);
       $id=$data[0];
        $status=$data[1];
        if($status=='Active'){
             $changeStatus=UserDetails::where('user_id',$id)->update(['status'=>'unactive']);
              $response="Employee Status De-Activated Successfully";
        }
        else{
             $changeStatus=UserDetails::where('user_id',$id)->update(['status'=>'Active']);
              $response="Employee Status Activated Successfully";
        }
        return $response;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        if($id){
            $id;
            $role=Auth::user()->role;
            if($role==3 || $role==2){
                $view_details='SHOW';
            }else{
                $view_details='HIDE';
            }
         }else{
            $id=Auth::user()->id; 
            $view_details='SHOW';
         }
       $user_detail=User::where('users.id',$id)
                    ->where('user_details.status','Active')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->select('users.*','user_details.*','users.id as user_id')
                    ->get();
                  // dd($official_datas);
         $useredu=  DB::table('user_educations')
                ->where('user_id',$id)
                ->join('education_options','user_educations.edu_option','=','education_options.id')
                ->select('user_educations.*', 'education_options.name as course_type', 'education_options.id as education_id')->get();
        $user_work = UserWorkExperience::where('user_id',$id)->get();

        $personal_datas=UserDetails::where('user_id',$id)->get();
         $family_datas=UserDetails::where('user_id',$id)->get();


       return view('mis.user_detail.index',compact(['user_detail','useredu','user_work','personal_datas','family_datas','view_details']));
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
