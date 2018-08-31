<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadCategory;
use Session;
use App\NewsUpload;

class UploadCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories=UploadCategory::where('status','Active')
                                ->join('users','users.id','=','upload_categories.addedby')
                                ->select('upload_categories.*','users.name as username')
                                ->get();
                               // dd($categories);
       return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $categories=UploadCategory::create($request->all());
        $newsupdate= new NewsUpload;
         if($request->type=='text') {
          $newsupdate->category=$categories->id;
          $newsupdate->save();
       }
        Session::flash('message','Category added Successfully!!');
       return redirect()->route('uploadCategory.index');
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
        $categories=UploadCategory::where('id',$id)->get();
          return view('admin.category.edit',compact(['categories','id']));

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
       $name=$request->name;
        $type=$request->type;

       $categories=UploadCategory::where('id',$id)->update(['name'=>$name,'type'=>$type]);
         Session::flash('message','Category Updated Successfully!!');
       return redirect()->route('uploadCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UploadCategory::where('id',$id)->delete();
         Session::flash('message','Category Deleted Successfully!!');
       return redirect()->route('uploadCategory.index');
    }
}
