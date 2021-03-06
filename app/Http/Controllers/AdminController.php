<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\NewsUpload;
use Session;
use App\UploadCategory;
use App\Role;
use DB;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {


        $policyEditType = UploadCategory::where('type', 'text')->get();
        Session::put('policyType', $policyEditType);


        $newsUploads = NewsUpload::join('upload_categories', 'upload_categories.id', '=', 'news_uploads.category')
                ->select('news_uploads.*', 'upload_categories.name as cat_name')
                ->get();
        return view('admin.index', compact('newsUploads'));
    }

    public function uploadNews() {
        $user_roles = [];
        $userRole = Role::where('roles.id', Auth::user()->role)->pluck('upload_category_option');

        foreach ($userRole as $role) {
            $user_roles = explode(",", $role);
        }

        $categories = UploadCategory::whereIn('id', $user_roles)->get();

        return view('admin.upload', compact('categories'));
    }

    public function uploadstore(Request $request) {

        $images = [];
        if ($request->hasFile('uploadimage')) {
            $uploadfiles = $request->file('uploadimage');
            foreach ($uploadfiles as $uploadfile) {
                $image_name = $uploadfile->getClientOriginalName();

                $uploadfile->storeAs('public/diwali', $image_name);
                $images[] = $image_name;
            }
        }


        $subject = $request->subject;
        $category = $request->category;
        $description = $request->description;
        /* $uploadimage=$request->file('uploadimage'); */
        $addedby = Auth::user()->name;
        $id = Auth::id();
        $sip = \Request::ip();
        $filename = '';
        $extension = '';

        /* if ($request->hasFile('uploadimage')) {
          $filename=$id."_".$addedby."_".strtotime(date('Y-m-d H:i:s')).$uploadimage->getClientOriginalName();
          $extension=$uploadimage->getClientOriginalExtension();
          $uploadimage->storeAs('/newUploads',$filename);
          } */

        foreach ($images as $image) {
            //dd($image);
            $store = NewsUpload::create(['subject' => $subject, 'category' => $category, 'description' => $description, 'uploadfile' => $image, 'addedby' => $id, 'sip' => $sip, 'filetype' => $extension]);
        }


        Session::flash('message', 'News Uploaded Successfully !!');
        return redirect()->route('news.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $newUploads = NewsUpload::where('news_uploads.id', $id)
                ->join('upload_categories', 'upload_categories.id', '=', 'news_uploads.category')
                ->select('news_uploads.*', 'upload_categories.name as cat_name')
                ->get();

        $categories = UploadCategory::where('type', 'file')
                ->orWhere('type', 'press')
                ->orWhere('type', 'announcement')
                ->get();
        ;
        return view('admin.newsEdit', compact(['newUploads', 'id', 'categories']));
    }

   
    public function update(Request $request, $id) {
        //dd($id);
        $subject = $request->subject;
        $category = $request->category;
        $description = $request->description;
        $uploadimage = $request->file('uploadimage');
        $addedby = Auth::user()->id;

        $sip = \Request::ip();
        $filename = '';
        $extension = '';
        if ($request->hasFile('uploadimage')) {
            $filename = $id . "_" . $addedby . "_" . strtotime(date('Y-m-d H:i:s')) . $uploadimage->getClientOriginalName();
            $extension = $uploadimage->getClientOriginalExtension();
            $uploadimage->storeAs('/newUploads', $filename);
        }


        $store = NewsUpload::where('id', $id)->update(['subject' => $subject, 'category' => $category, 'description' => $description, 'uploadfile' => $filename, 'updatedby' => $addedby, 'sip' => $sip, 'filetype' => $extension]);
        Session::flash('message', 'News Updated Successfully !!');
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        NewsUpload::where('id', $id)->delete();
        Session::flash('message', 'News Deleted Successfully !!');
        return redirect()->route('news.index');
    }

}
