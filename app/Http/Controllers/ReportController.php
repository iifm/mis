<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conveyance;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conveyanceReport()
    {
       
        $conveyance=DB::table('conveyances')
            ->join('users', 'users.id', '=', 'conveyances.user_id')
            ->select('conveyances.*', 'users.name')
            ->get();
        return view('mis.report.conveyance',compact('conveyance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function conveyanceDate(Request $request)
    {
     
       
      $start= \Carbon\Carbon::parse($request->strtDate)->format('Y-m-d');
      $end =\Carbon\Carbon::parse($request->endDate)->format('Y-m-d');

       $conveyance = DB::table('conveyances')
       ->join('users', 'users.id', '=', 'conveyances.user_id')
       ->select('conveyances.*', 'users.name')
       ->whereBetween('conveyances.created_at', [$start, $end])->get();
       return view('mis.report.conveyance',compact('conveyance'));
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
