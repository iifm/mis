<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use URL;
use App\UserDetails;
use App\Department;
use App\UserWorkExperience;

class SearchController extends Controller
{
    public function index()
    {
    	$departments=Department::all();
        return view('mis.search',compact('departments'));
    }
    public function Search(Request $request,$search)
    {
    	$array_user[]='';
        $search=User::where('users.name','like',"%".$search."%")
                        ->join('user_details','user_details.user_id','=','users.id')
                        ->join('departments','departments.id','=','user_details.department')
                        ->where('user_details.status','Active')	
                        ->select('users.id as user_id','user_details.*','users.*','departments.name as department')
    					->orderBy('name')
    					->get();
                       // dd($search);
      
		foreach ($search as  $value) {
			$link=URL::route('search_user',['id'=>$value->user_id]);
			$array_user[] = "<a href='$link' style='color:black;'>".strtoupper($value->name)." - ".strtoupper($value->department)."</a> <br>";
			
		}
    		 
		return $array_user;
    }

    public function searchResult($id)
    {
    	//return $id;
         $useredu=  DB::table('user_educations')
                ->where('user_id',$id)
                ->join('education_options','user_educations.edu_option','=','education_options.id')
                ->select('user_educations.*', 'education_options.name as course_type', 'education_options.id as education_id')->get();

        $user_detail=User::where('users.id',$id)
                    ->where('user_details.status','Active')
                    ->join('user_details','user_details.user_id','=','users.id')
                    ->select('users.*','user_details.*','users.id as user_id')
                    ->get();
                  //  dd($user_detail);
         $user_work = UserWorkExperience::where('user_id',$id)->get();
        return view('mis.user_detail.index',compact(['user_detail','useredu','user_work']));
    }

    public function searchByDepartment($id)
    {
        $data=UserDetails::where('department',$id)
                            ->join('users','users.id','=','user_details.user_id')
                            ->where('user_details.status','Active')
                            ->select('users.id as user_id','users.*','user_details.*')
                            ->orderBy('users.name')
                            ->get();

                    return response()->json($data);
    }

    
}
