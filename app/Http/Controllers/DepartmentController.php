<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Session;

class DepartmentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $departments=Department::join('users','users.id','=','departments.addedby')
                                ->select('users.name as username','departments.*')
                                ->get();
        return view('admin.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data=Department::create($request->all());
       Session::flash('message','Department added Successfully!!');
       return redirect()->route('department.index');
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
        $departments=Department::where('id',$id)->get();
         return view('admin.department.edit',compact(['departments','id']));

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
       $updatedby=$request->updatedby; 

       $data=Department::where('id',$id)->update(['name'=>$name,'updatedby'=>$updatedby]);
        Session::flash('message','Department updated Successfully!!');
       return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Department::where('id',$id)->delete();
        Session::flash('message','Department Deleted Successfully!!');
       return redirect()->route('department.index');
    }
}
