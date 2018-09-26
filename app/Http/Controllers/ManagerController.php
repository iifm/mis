<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Role;
use App\User;
use App\Leave;
use DB;
use App\OnDuty;
use App\Conveyance;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $strtYear=date('Y').'-04-01';
       $endYear=date('Y',strtotime('+1 year')).'-03-31';

      $userRole=Auth::user()->role;
      $accessZone=Role::where('id',$userRole)->pluck('access_zone');

      foreach ($accessZone as $key => $accessZone) {
         $accessZone=$accessZone;
      }
    $accessZones= explode(",", $accessZone);
    $teamMembersUserIds=User::whereIn('role',$accessZones)
                            ->join('user_details','user_details.user_id','=','users.id')
                            ->where('user_details.status','Active')
                            ->pluck('users.id')
                            ->toArray();
                            
                          $totalTeamMemberDetails=[];
   foreach ($teamMembersUserIds as $teamMembersUserId) {
      $teamMembersDetails=[];
        $username=User::find($teamMembersUserId);

        $total_leaves=Leave::whereBetween('leavefrom',[$strtYear,$endYear])
                        ->where('empid',$teamMembersUserId)
                        ->where('leavetype','!=','Comp Off')
                        ->sum('totalleave');

        $total_ods=OnDuty::where('empid',$teamMembersUserId)
                    ->whereBetween('od_date',[$strtYear,$endYear])
                    ->orderBy('id','DESC')->count();

       $total_conveyance=Conveyance::where('user_id',$teamMembersUserId)
                                    ->whereBetween('con_date',[$strtYear,$endYear])
                                    ->sum('amount');

        $teamMembersDetails=['total_leaves'=>$total_leaves,
                                'total_ods'=>$total_ods,
                                'total_conveyance'=>$total_conveyance,
                                'username'=>$username->name,
                                'user_id'=>$teamMembersUserId]; 
                                //dd($teamMembersDetails);
        $totalTeamMemberDetails[]= $teamMembersDetails;                               
                       
   }
  
       return view('manager.manager_zone.index',compact(['totalTeamMemberDetails']));
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
