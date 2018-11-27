<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Session;
use App\Department;
use App\UploadCategory;

class RoleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $roleDetails = [];
        $access_zone_names = '';
        $roles = Role::join('users', 'users.id', '=', 'roles.addedby')
                ->select('users.name as username', 'roles.*')
                ->get();

        foreach ($roles as $value) {
            $access_zone = $value->access_zone;
            $upload_categories_option = $value->upload_category_option;

            $upload_categories_array = explode(",", $upload_categories_option);

            $upload_categories_name = UploadCategory::whereIn('id', $upload_categories_array)->pluck('name')->toArray();
            $upload_categories_names = implode(",", $upload_categories_name);
            // $role_id=$value->id;
            if ($access_zone != 'All') {
                $access_zone_arry = explode(",", $access_zone);
                $access_zone_name = Role::whereIn('id', $access_zone_arry)->pluck('name')->toArray();

                $access_zone_names = implode(",", $access_zone_name);
                $roleDetails[] = ['role_name' => $value->name, 'access_users' => $access_zone_names, 'upload_category' => $upload_categories_names, 'role_id' => $value->id];
            } else {
                $roleDetails[] = ['role_name' => $value->name, 'access_users' => 'All', 'upload_category' => $upload_categories_names, 'role_id' => $value->id];
            }
        }
//dd($roleDetails);
        // dd($roles);
        return view('admin.role.index', compact(['roleDetails']));
    }

    public function create() {
        $roles = Role::all();
        $categories = UploadCategory::where('type', '!=', 'text')->get();
        //dd($categories);
        return view('admin.role.create', compact(['roles', 'categories']));
    }

    public function store(Request $request) {

        $access_zones = implode(",", $request->access_zone);

        $upload_category_options = implode(",", $request->upload_category_option);

        Role::create(['name' => $request->name, 'access_zone' => $access_zones, 'addedby' => $request->addedby, 'updatedby' => $request->updatedby, 'upload_category_option' => $upload_category_options]);

        Session::flash('message', 'Role Added Successfully!!');
        return redirect()->route('role.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $role_edit = Role::where('roles.id', $id)->get();
        $access_zones = '';
        $access_zone_details = [];
        foreach ($role_edit as $value) {
            $access_zones = $value->access_zone;
        }
        $access_zones = explode(",", $access_zones);

        foreach ($access_zones as $zone) {
            $access_zone_details[] = Role::where('roles.id', $zone)->get()->toArray();
        }


        $upload_categories_details = [];
        foreach ($role_edit as $edit) {
            $upload_categories = $edit->upload_category_option;
        }

        $upload_categories = explode(",", $upload_categories);

        foreach ($upload_categories as $categories) {
            $upload_categories_details[] = Role::where('roles.id', $categories)->get()->toArray();
        }
        //dd($upload_categories_details);

        $roles = Role::all();
        $categories = UploadCategory::where('type', '!=', 'text')->get();

        return view('admin.role.edit', compact(['roles', 'id', 'categories', 'role_edit', 'access_zone_details', 'upload_categories_details']));
    }

    public function update(Request $request, $id) {

        $access_zone = $request->access_zone;
        $upload_category_option = $request->upload_category_option;
        $access_zones = implode(",", $access_zone);

        if ($upload_category_option != '') {

            $upload_category_options = implode(",", $upload_category_option);

            Role::where('id', $id)->update(['name' => $request->name, 'updatedby' => $request->updatedby, 'access_zone' => $access_zones, 'upload_category_option' => $upload_category_options]);
        } else {
            Role::where('id', $id)->update(['name' => $request->name, 'updatedby' => $request->updatedby, 'access_zone' => $access_zones]);
        }

        Session::flash('message', 'Role Updated Successfully!!');
        return redirect()->route('role.index');
    }

    public function destroy($id) {
        Role::where('id', $id)->delete();
        Session::flash('message', 'Role Deleted Successfully!!');
        return redirect()->route('role.index');
    }

}
