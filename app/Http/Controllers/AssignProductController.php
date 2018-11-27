<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssignProduct;
use App\User;
use App\Product;
use DB;
use Session;

class AssignProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        // $assign=AssignProduct::all();
        $assign = DB::table('assign_products')
                ->join('users', 'users.id', '=', 'assign_products.assigned_to')
                ->join('products', 'products.id', '=', 'assign_products.product_code')
                ->join('locations', 'locations.id', '=', 'assign_products.location')
                ->select('assign_products.*', 'users.name as username','locations.name as loc_name','products.pcode as pcode')
                ->get();
        //dd($assign);
        return view('inventory_management.product_allocated.index', compact('assign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

       $products=DB::table('products')->where('status','not_assigned')->get();

        $users = User::join('user_details', 'user_details.user_id', '=', 'users.id')
                ->where('user_details.status', 'Active')
                ->select('users.id as user_id', 'users.name as username')
                ->orderBy('users.name')
                ->get();
        $locations=DB::table('locations')->where('parent_id','!=','0')->get();

       // $product = DB::table('products')->get();


        $category = DB::table('product_categories')->get();
        return view('inventory_management.product_allocated.create', compact(['users', 'category', 'products','locations']));
    }

    public function getProduct($category) {

        $product = DB::table('products')->where('category', $category)->get(['pdescription', 'id']);
        return response()->json($product);
    }

    public function store(Request $request) {
       // dd($request->all());
        AssignProduct::create(['product_code'=>$request->pcode,'assigned_to'=>$request->assign_to,'date'=>$request->date,'remark'=>$request->remark,'location'=>$request->location,'assignedby'=>$request->assignedby,'sip'=>\Request::ip()]);

        $update=DB::table('products')->where('id',$request->pcode)->update(['status'=>'assigned']);
       
        Session::flash('message', 'Product Assigned successfully!!');

        return redirect()->route('assign.index');
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
        //$assign_product= AssignProduct::where('id',$id)->get();
         $products=DB::table('products')->where('status','not_assigned')->get();

        $users = User::join('user_details', 'user_details.user_id', '=', 'users.id')
                ->where('user_details.status', 'Active')
                ->select('users.id as user_id', 'users.name as username')
                ->orderBy('users.name')
                ->get();

        $locations=DB::table('locations')->where('parent_id','!=','0')->get();

        $assigned_product = DB::table('assign_products')
                ->where('assign_products.id',$id)
                ->join('users', 'users.id', '=', 'assign_products.assigned_to')
                ->join('products', 'products.id', '=', 'assign_products.product_code')
                ->join('locations', 'locations.id', '=', 'assign_products.location')
                ->select('assign_products.*', 'users.name as username','users.id as user_id','locations.name as loc_name','products.pdescription as pro_desc','products.pname as pro_name','locations.id as loc_id','products.pcode as pcode')
                ->get();

     
        return view('inventory_management.product_allocated.edit', compact(['products', 'users', 'locations','assigned_product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //dd($request->all());
       $product_detail=AssignProduct::where('assign_products.id',$id)->first();

       $update_status=DB::table('products')->where('id',$product_detail->product_code)->update(['status'=>'not_assigned']);
     
      $assign_products=  AssignProduct::where('id',$id)
                            ->update(['product_code'=>$request->pcode,'assigned_to'=>$request->assign_to,'date'=>$request->date,'remark'=>$request->remark,'location'=>$request->location,'assignedby'=>$request->assignedby,'sip'=>\Request::ip()]);

        $update=DB::table('products')->where('id',$request->pcode)->update(['status'=>'assigned']);

        Session::flash('message', 'Product Assignment Updated Successfully !!');
        return redirect()->route('assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        AssignProduct::where('id', $id)->delete();
        Session::flash('message', 'Product Assigned Deleted successfully!!');

        return redirect()->route('assign.index');
    }

}
