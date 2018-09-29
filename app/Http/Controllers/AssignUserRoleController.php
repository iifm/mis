<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Session;

class AssignUserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users_has_role_details=User::join('user_details','user_details.user_id','=','users.id')
                        ->join('roles','roles.id','=','users.role')
                        ->where('user_details.status','Active')
                        ->select('users.*','roles.name as user_role','users.id as user_id','roles.id as role_id')
                        ->orderBy('users.name')
                        ->get();
        $roles=Role::all();

      //dd($users_has_role_details); 
      
     
      
        return view('admin.role.assign_role.index',compact(['users_has_role_details','roles']));
    }

    public function roleUpdate($user_data)
    {
        $data=explode(",", $user_data);
        $user_role=$data[0];
        $user_id=$data[1];
        $update_role=User::where('id',$user_id)->update(['role'=>$user_role]);
        return  "User Role Updated Successfully !!";
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
        $edit_user_roles=User::where('id',$id)->get()->toArray();
            foreach ($edit_user_roles as  $edit_user_role) {
                $name=$edit_user_role['name'];
                $role_ids=$edit_user_role['role'];
            }

            $role_ids=explode(",", $role_ids);
            $role_name=[];

            foreach ($role_ids as  $role_id) {
                $role_name[]=Role::where('id',$role_id)->get()->toArray();
            }
            //dd($role_name);

           $all_roles=Role::all();


        return view('admin.role.assign_role.edit_assigned_role',compact('edit_user_roles','role_name','all_roles','id'));
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
      
      $user_roles=$request->input('assigned-role');
      $user_roles=implode(",", $user_roles);
      $update_role=User::where('id',$id)->update(['role'=>$user_roles]);
      Session::flash('message','User Role Updated Successfully!!');
      return redirect()->route('assign_role.index');
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
