<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\PhotoAlbum;
use Auth;
use Session;
use App\PhotoCategory;


class PhotoAlbumController extends Controller
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

    public function index()
    {
        $photo_categories=PhotoCategory::distinct('name')->pluck('name')->toArray();
       
        $unique_photo_categories=array_unique($photo_categories);
        //dd($unique_photo_categories);
        $photos=PhotoAlbum::where('category','!=',0)
                            ->join('photo_categories','photo_categories.id','=','photo_albums.category')
                            ->select('photo_albums.id as photo_id','photo_categories.name as photo_category','photo_albums.*')
                            ->get();
                            //dd($photos);
        return view('mis.photoAlbum.index',compact('photos','unique_photo_categories'));

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
       
        $images=[];
         if ($request->hasFile('photo')) {
            $uploadfiles=$request->file('photo');
            foreach ($uploadfiles as  $uploadfile) {
                $image_name=$uploadfile->getClientOriginalName();

                $uploadfile->storeAs('public/photos',$image_name);
                $images[]=$image_name;
            }
        }
       
        $addedby=$request->input('addedby');
        $user_id=Auth::user()->id;
        $category=$request->input('category');
        $photo=$request->file('photo');
        $sip=\Request::ip();
        
        foreach ($images as $image) {
            PhotoAlbum::create(['title'=>$request->title,'category'=>$category,'photo'=>$image,'addedby'=>$addedby,'sip'=>$sip]);
        }
      
       
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
        PhotoAlbum::where('id',$id)->delete();
          Session::flash('message','Your Photo Deleted Successfully !!');
        return redirect()->route('photo.index');
    }

    public function addCategory(Request $request){

        PhotoCategory::create($request->all());
        return redirect()->route('photo.create');
    }
}
