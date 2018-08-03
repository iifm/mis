<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leave;
use Session;
use Auth;
use DateTime;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave=Leave::all();
        return view('mis.leave.index',compact('leave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mis.leave.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
        $approvalfrom = $request->Input('approvalfrom');
           $approvalfrom_array=implode(",", $approvalfrom);
         $ip= \Request::ip();
         $id=Auth::user()->id;


        $name = $request->Input('name');
        $email = $request->Input('email');
        $mobile = $request->Input('name');
       $leavefrom = $request->Input('leavefrom');
       $leaveto = $request->Input('leaveto');
       $totdays = $request->Input('totdays');
        $leaveoff = $request->Input('leaveoff');
        $leavetype=implode(',', $leaveoff);
        $reason = $request->Input('reason');
        $agdcompoff = $request->Input('agdcompoff');
        $approvalfrom = $request->Input('approvalfrom');
        $approvalfrom_array=implode(",", $approvalfrom);

        $data=Leave::create(['empid'=> $id,'empname'=>$name,'empemail'=>$email,'empmobile'=>$mobile,'leavefrom'=>$leavefrom,'leaveto'=>$leaveto,'totalleave'=>$totdays,'leavetype'=>$leavetype,'agcompoffdate'=>$agdcompoff,'reason'=>$reason,'approvalfrom'=>$approvalfrom_array,'status'=>'Pending','sip'=>$ip]);
           Session::flash('message','Leave Request Sent Successfully !!');

        return redirect()->route('leave.index');

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
         return view('mis.leave.edit');
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
        Leave::where('id',$id)->delete();
          Session::flash('message','Leave Request Deleted Successfully !!');

        return redirect()->route('leave.index');
    }
}
