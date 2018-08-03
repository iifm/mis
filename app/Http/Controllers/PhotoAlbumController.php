<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PhotoCategory;
use App\PhotoAlbum;
use Auth;
use Session;


class PhotoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $photos=PhotoAlbum::all();
        return view('mis.photoAlbum.index',compact('photos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $category=PhotoCategory::all();
        return view('mis.photoAlbum.create',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addedby=$request->input('addedby');
        $user_id=Auth::user()->id;
        $category=$request->input('category');
        $photo=$request->file('photo');
        $sip=\Request::ip();
    
        $photo=$request->file('photo');
        $filename =$user_id.$photo->getClientOriginalName();
        $request->file('photo')->storeAs('/public/photos', $filename);
        PhotoAlbum::create(['user_id'=>$user_id,'category'=>$category,'photo'=>$filename,'addedby'=>$addedby,'sip'=>$sip]);
        Session::flash('message','Your Photo Added Successfully !!');
        return redirect()->route('photo.index');
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

    public function addCategory(Request $request){

        PhotoCategory::create($request->all());
        return redirect()->route('photo.create');
    }
}
