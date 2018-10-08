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
    public function managerLeaveIndex()
    {
         $strtYear=date('Y').'-04-01';
       $endYear=date('Y',strtotime('+1 year')).'-03-31';
        $user_role=Auth::user()->role;
        $loginId=Auth::user()->id;
        //dd($user_role);
        $role_detail=Role::where('id',$user_role)->first();
       
       $member_ids=[];
       if ($role_detail->access_zone=='All') {
          $team_members=User::all();
       }
       else{
          $team_members=User::where('role',$role_detail->access_zone)->get();
       }
     
       foreach ($team_members as  $team_member) {
          $member_ids[]=$team_member->id;
       }

       $leave_details=[];
       foreach ($member_ids as  $member_id) {
           $leaves=Leave::where('empid',$member_id)
                            ->join('users','users.id','=','leaves.empid')
                            ->whereBetween('leavefrom',[$strtYear,$endYear])
                            ->where('leaves.status','!=','approved')
                            ->where('leaves.empid','!=',$loginId)
                            ->select('leaves.*','users.id as user_id','users.name as user_name','leaves.id as leave_id')
                            ->orderBy('leaves.id','DESC')
                            ->get();

                    foreach ($leaves as  $leave) {
                        $leave_details[]=['user_name'=> $leave->user_name,
                                          'start_date'=>$leave->leavefrom,
                                            'end_date'=>$leave->leaveto,
                                            'leave_type'=>$leave->leavetype,
                                            'total_leaves'=>$leave->totalleave,
                                            'reason'=>$leave->reason,
                                            'user_id'=>$leave->user_id,
                                            'status'=>$leave->status,
                                            'leave_id'=>$leave->leave_id
                                        ];
                    }
               
       }

        return view('manager.leave.index',compact('leave_details'));
    }

  
}
