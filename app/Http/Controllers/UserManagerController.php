<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_lists=User::join('user_details','user_details.user_id','=','users.id')
                            ->where('user_details.status','Active')
                            ->pluck('users.id')
                            ->toArray();
            $manager_names=[];
        foreach ($user_lists as  $user_list) 
        {
           $username=User::find($user_list);
           $user_role=Role::find($username->role);

           $managers=Role::where('access_zone','!=','0')
                            ->where('access_zone','!=','All')
                            ->pluck('id')
                            ->toArray();
           foreach ($managers as  $manager) 
           {
              $managerAccessZone=Role::find($manager);
              $access_zone_array=explode(",", $managerAccessZone->access_zone);                        
             
              $search_res = array_search($username->role,$access_zone_array);

              $managerName=$access_zone_array[$search_res];

              
              $user_manager_name=User::where('role',$manager)->first();
           }
          
        }


        return view('admin.userManagers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }
}
