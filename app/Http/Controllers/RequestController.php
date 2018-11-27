<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Session;
use App\Requirement;
use DB;

class RequestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $departments = Department::all();
        $locations = DB::table('locations')
                ->where('parent_id', '!=', '0')
                ->where('parent_id', '!=', '')
                ->get();
        $users = DB::table('users')->join('user_details', 'user_details.user_id', '=', 'users.id')
                ->where('user_details.status', '=', 'Active')
                ->select('users.id as user_id', 'users.*')
                ->get();
        return view('manager.request.create', compact(['departments', 'locations', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //  dd($request->all());
        $data = Requirement::create($request->all());
        Session::flash('message', 'Request Sent Successfully !!');
        return back();
    }

    public function show() {
        $requirements = Requirement::join('users', 'users.id', '=', 'requirements.user_id')
                ->join('departments', 'departments.id', '=', 'requirements.department')
                ->join('locations', 'locations.id', '=', 'requirements.location')
                ->select('users.name as username', 'requirements.*', 'requirements.id as req_id', 'departments.name as dept_name', 'locations.name as loc_name', 'requirements.id as req_id')
                ->get();

        // dd($requirements);
        return view('manager.request.index', compact('requirements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewDetail($id) {
        $requirements = Requirement::join('users', 'users.id', '=', 'requirements.user_id')
                ->join('departments', 'departments.id', '=', 'requirements.department')
                ->join('locations', 'locations.id', '=', 'requirements.location')
                ->where('requirements.id', $id)
                ->select('users.name as username', 'requirements.*', 'requirements.id as req_id', 'departments.name as dept_name', 'locations.name as loc_name', 'requirements.id as req_id')
                ->get();
        return view('manager.request.view', compact('requirements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
