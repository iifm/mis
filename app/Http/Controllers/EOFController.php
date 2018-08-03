<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\HallOfFame;
use Storage;
use Session;

class EOFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $eom=  HallOfFame::all();
      return view('mis.eof.index',compact('eom'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mis.eof.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
          
           $sip=\Request::ip();
        $id=Auth::user()->id;
        $filename=$request->file('image');
        $empname=$request->input('empname');
        $month=$request->input('month');
        $department=$request->input('department');
        $description=$request->input('description');
        $addedby=Auth::user()->name;

         $image = $request->file('image');
        $filename=$id.$image->getClientOriginalName();
      $request->file('image')->storeAs('/public/images', $filename);

        $data=HallOfFame::create(['user_id'=>$id,'empname'=>$empname,'month'=>$month,'department'=>$department,'addedby'=>$addedby,'image'=>$filename,'sip'=>$sip,'description'=>$description]);

          Session::flash('message','Employee of Month Added Successfully !!');

        return redirect()->route('eof.index');
     

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
