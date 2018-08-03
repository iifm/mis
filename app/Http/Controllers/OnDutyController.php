<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OnDuty;
use Session;
use Auth;

class OnDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $onduty=OnDuty::all();
     return view('mis.onduty.index',compact('onduty'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mis.onduty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 'name','email',   'mobile','od_date','intime','outtime','odtype','reason','approvalfrom','status','sip'
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $status="Pending";
        $ip= \Request::ip();
       $id=Auth::user()->id;
        $empname = $request->Input('name');
        $empemail = $request->Input('email');
        $empmobile = $request->Input('mobile');
        $od_date = $request->Input('od_date');
        $intime = $request->Input('intime');
        $outtime = $request->Input('outtime');
        $odtype = $request->Input('od_type');
        $reason = $request->Input('reason');
         $manager = $request->Input('leaveoff2');
         $manager_array=implode(",",$manager );

        $status = $status;
       

        $data=OnDuty::create(['empid'=> $id,'empname'=>$empname, 'empemail'=>$empemail, 'empmobile' =>$empemail,'od_date' =>$od_date,'intime' =>$intime,'outtime' =>$outtime,'odtype' =>$odtype,'reason' =>$reason,'approvalfrom' =>$manager_array,'status' =>$status,'sip' =>$ip]);

         Session::flash('message','On-Duty Request Sent Successfully !!');

        return redirect()->route('od.index');
       
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
        OnDuty::where('id',$id)->delete();
         Session::flash('message','On-Duty Request Deleted Successfully !!');

        return redirect()->route('od.index');


    }
}
