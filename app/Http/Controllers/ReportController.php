<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conveyance;
use DB;
use App\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct()
    {
        $this->middleware('auth');
    }

    public function conveyanceReport()
    {
      $users=User::all();
       $cyear=date('Y');
        $conveyance=DB::table('conveyances')
            ->whereYear('con_date',$cyear)
            ->join('users', 'users.id', '=', 'conveyances.user_id')
            ->select('conveyances.*', 'users.name')
            ->get();
        return view('mis.report.conveyance',compact(['conveyance','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conveyanceDate(Request $request)
    {
     
        $users=User::all();
               $cyear=date('Y');

      $start= \Carbon\Carbon::parse($request->strtDate)->format('Y-m-d');
      $end =\Carbon\Carbon::parse($request->endDate)->format('Y-m-d');
      $user_id=$request->employee;

      if ($request->has('strtDate') && $request->has('endDate') && $request->has('employee')) {
           $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->whereBetween('conveyances.con_date', [$start, $end])
       ->where('user_id',$user_id)
       ->get();
      }
      elseif ($request->has('strtDate') && $request->has('endDate')) {
           $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->whereBetween('conveyances.con_date', [$start, $end])
      
       ->get();
      }

      elseif ($request->has('employee')) {
          $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->where('user_id',$user_id)
       ->whereYear('con_date',$cyear)
       ->get();
      }

     
       return view('mis.report.conveyance',compact(['conveyance','users']));
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
