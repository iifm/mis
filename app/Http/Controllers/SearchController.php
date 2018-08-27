<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use URL;

class SearchController extends Controller
{
    public function index()
    {
    	return view('mis.search');
    }
    public function Search(Request $request,$search)
    {
    	$search=DB::table('users')
    					->where('name','like',"%".$search."%")
    					->orderBy('name')
    					->get();

      
    		foreach ($search as  $value) {
    			  $link=URL::route('search_result',['id'=>$value->id]);
    			$array_user[] = "<a href='$link'>".$value->name."</a> <br>";
    			
    		}
    		 
    		return $array_user;
    }

    public function searchResult($id)
    {
    	//return $id;
        $datas=User::where('users.id',$id)
                ->join('user_details','user_details.user_id','=','users.id')
                ->select('users.name as user_name','users.email as user_email','user_details.mobile as user_mobile','user_details.designation as user_designation','user_details.department as user_department','user_details.locationcentre as user_locationcentre')
                ->get();
        return view('mis.search_result',compact('datas'));
    }

    
}
