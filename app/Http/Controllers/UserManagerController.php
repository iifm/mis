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
        $managers_ids=Role::where('access_zone','!=',0)
                            ->where('access_zone','!=','All')
                            ->pluck('id')
                            ->toArray();

        $user_name_and_manager=[];

        foreach ($managers_ids as $managers_id) {
            
           $manager_details=User::where('role',$managers_id)->pluck('name')->toArray();

           $manager_name=implode(",", $manager_details);

           $access_zones=Role::find($managers_id);

           $manager_access_zone=explode(",", $access_zones->access_zone);
            
           $team_members=User::join('user_details','user_details.user_id','=','users.id')
                                    ->where('user_details.status','Active')
                                    ->whereIn('users.role',$manager_access_zone)
                                    ->get();

      
           foreach ($team_members as $team_member) {
         
               $user_name_and_manager[]=['username'=>$team_member->name,
                                        'manager_id'=>$managers_id,
                                        'manager_name'=>$manager_name];     

          }       
           
         
        }


        return view('admin.userManagers.index',compact('user_name_and_manager'));
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
