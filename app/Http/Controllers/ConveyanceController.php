<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Conveyance;

class ConveyanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id=Auth::user()->id;
       $conveyance=Conveyance::where('user_id',$id)->get();
        return view('mis.conveyance.index',compact('conveyance'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mis.conveyance.save');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $count = $request->input('tcount');
      $filename='';

      for ($i=1; $i <= $count ; $i++) { 
         $file = $request->file('uploadfile'.$i);
         if ($request->hasFile('uploadfile'.$i)) {
             $filename =$i.$file->getClientOriginalName();
               $file->storeAs('/public/conveyance', $filename);
         }               
      }

      for ($i=1; $i <= $count ; $i++) { 
        
          $conveyance= new Conveyance;        
          $conveyance->user_id = Auth::user()->id;
          $conveyance->con_date= $request->input('date'.$i);
          $conveyance->reason= $request->input('reason'.$i);
          $conveyance->disfrom= $request->input('travelfrom'.$i);
          $conveyance->disto= $request->input('travelto'.$i);
          $conveyance->distance=$request->input('distance'.$i);
          $conveyance->amount=$request->input('Rate'.$i);
          $conveyance->mode= $request->input('mode'.$i);

          if ($filename!='') {
               $conveyance->uploadcimg=$filename;

          }
           
            $conveyance->sip=\Request::ip();

             $conveyance->save();  


      }
        
        Session::flash('message','Your Conveyance Added Successfully !!');
        return redirect()->route('conveyance.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
         return view('mis.conveyance.policy');
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

      public function policy()
    {
       

    }

}
