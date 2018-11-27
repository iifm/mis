<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\HallOfFame;
use Storage;
use Session;
use App\User;
use App\UserDetails;

class EOFController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $eom = HallOfFame::join('users', 'users.id', '=', 'hall_of_fames.empname')
                ->select('hall_of_fames.*', 'users.name as empname')->orderBy('id', 'DESC')
                ->get();
        //dd($eom);
        return view('mis.eof.index', compact('eom'));
    }

    public function getDepartment($id) {
        $department = UserDetails::where('user_id', $id)
                        ->join('departments', 'departments.id', '=', 'user_details.department')
                        ->select('departments.name as department')->pluck('department');
        return $department;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = User::join('user_details', 'user_details.user_id', '=', 'users.id')
                ->where('user_details.status', 'Active')
                ->select('users.id as user_id', 'users.*', 'user_details.*')
                ->orderBy('users.name')
                ->get();
        //$users= strtoupper($users);
        return view('mis.eof.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //  dd($request->all());

        $sip = \Request::ip();
        $id = Auth::user()->id;
        $filename = $request->file('image');
        $empname = $request->input('empname');
        $month = $request->input('month');
        $department = $request->input('department');
        $description = $request->input('description');
        $addedby = Auth::user()->name;

        $image = $request->file('image');
        $filename = $id . $image->getClientOriginalName();
        $request->file('image')->storeAs('/public/images', $filename);

        if ($request->description) {
            $data = HallOfFame::create(['empname' => $empname, 'month' => $month, 'department' => $department, 'addedby' => $addedby, 'image' => $filename, 'sip' => $sip, 'description' => $description]);
        } else {
            $data = HallOfFame::create(['empname' => $empname, 'month' => $month, 'department' => $department, 'addedby' => $addedby, 'image' => $filename, 'sip' => $sip]);
        }



        Session::flash('message', 'Employee of Month Added Successfully !!');

        return redirect()->route('eof.index');
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
        //
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
