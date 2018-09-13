<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\NewsUpload;
use App\UploadCategory;
use Session;
use Auth;

class PolicyController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
     
     $policydata=UploadCategory::where('id',$id)->get();
      $policyContent=NewsUpload::where('category',$id)
                                ->join('upload_categories','upload_categories.id','=','news_uploads.category')
                                ->select('upload_categories.name as policyType','news_uploads.*')
                                ->get();
                                
              //dd($policyContent);
       return view('policy.viewPolicy',compact(['policyContent','id','policydata']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       // dd($id);

         $policydata=UploadCategory::where('id',$id)->get();
         //dd($policydata);

         $content=NewsUpload::where('category',$id)->get();
        //s dd($content);

        return view('policy.policyCreate',compact(['policydata','id','content']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function policyUpdate(Request $request,$id)
    {
       // dd($id);
      $user_id=Auth::user()->id;
      $description=$request->description;
       $data=NewsUpload::where('category',$id)->update(['description'=>$description,'updatedby'=>$user_id]);
       //dd($data);
       Session::flash('message','Policy Updated Successfully!!');
        return redirect()->route('policy.index',['id'=>$id]);
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
