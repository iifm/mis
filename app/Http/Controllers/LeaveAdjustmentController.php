<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use App\User;
use Auth;

class LeaveAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $strtYear=date('Y-m-d', strtotime('-15 days'));
       $endYear=date('Y',strtotime('+1 year')).'-03-31';

       $total_leaves=Leave::whereBetween('leaves.leavefrom',[$strtYear,$endYear])
                                ->join('users','users.id','=','leaves.empid')
                                ->select('leaves.*','users.name as username','leaves.id as leave_id')
                                ->orderBy('leaves.id','DESC')
                                ->get();

                                
        return view('hr.leaveAdjustment.index',compact('total_leaves'));
    }

    public function create()
    {
        $users=User::join('user_details','user_details.user_id','=','users.id')
                        ->where('user_details.status','=','Active')
                        ->select('users.*')
                         ->orderBy('users.name')
                        ->get();
        return view('hr.leaveAdjustment.create',compact('users'));
    }

   
    public function store(Request $request)
    {
      
     
       $store=Leave::create(['empid'=>$request->empid,'leavefrom'=>$request->leavefrom,'leaveto'=>$request->leaveto,'totalleave'=>$request->totalleave,'leavetype'=>$request->leavetype,'reason'=>$request->reason,'status'=>'Approved','approvedby'=>Auth::id()]);
       return redirect()->route('hr.leave.index');
    }

   
    public function edit($id)
    {
         $users=User::join('user_details','user_details.user_id','=','users.id')
                        ->where('user_details.status','=','Active')
                        ->select('users.*')
                        ->orderBy('users.name')
                        ->get();
        $leave_details=Leave::where('leaves.id',$id)
                            ->join('users','users.id','=','leaves.empid')
                            ->select('leaves.*','users.name as username','leaves.id as leave_id','users.id as user_id')
                            ->get();
        return view('hr.leaveAdjustment.edit',compact(['users','id','leave_details']));
    }

   
    public function update(Request $request, $id)
    {
     
       $update=Leave::where('id',$id)->update(['empid'=>$request->empid,'leavefrom'=>date('Y-m-d',strtotime($request->leavefrom)),'leaveto'=>date('Y-m-d',strtotime($request->leaveto)),'totalleave'=>$request->totalleave,'leavetype'=>$request->leavetype,'reason'=>$request->reason,'status'=>'Approved','approvedby'=>Auth::id()]);
      return redirect()->route('hr.leave.index');
    }

  
    public function destroy($id)
    {
       Leave::where('id',$id)->delete();
        return redirect()->route('hr.leave.index');
    }
}
