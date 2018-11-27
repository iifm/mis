<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ProductCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $datas = DB::table('product_categories')
                        ->join('users', 'users.id', '=', 'product_categories.addedby')
                        ->select('users.name as username', 'product_categories.*')->get();
        //dd($datas);
        return view('inventory_management.product_category.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('inventory_management.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
        $name = $request->name;
        $addedby = $request->addedby;
        $parent_id = 0;
        $product_cat = DB::table('product_categories')->insert(['name' => $name, 'addedby' => $addedby, 'parent_id' => $parent_id]);
        Session::flash('message', 'Product Category added Successfully!!');
        return redirect()->route('product.category');
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
        $datas = DB::table('product_categories')
                        ->where('id', $id)->get();
        //dd($datas);
        return view('inventory_management.product_category.edit', compact(['datas', 'id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // dd($id);
        $name = $request->name;
        $addedby = $request->addedby;
        $parent_id = 0;
        $product_cat = DB::table('product_categories')->where('id', $id)->update(['name' => $name, 'addedby' => $addedby, 'parent_id' => $parent_id]);
        Session::flash('message', 'Product Category Updated Successfully!!');
        return redirect()->route('product.category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('product_categories')->where('id', $id)->delete();
        Session::flash('message', 'Product Category Deleted Successfully!!');
        return redirect()->route('product.category');
    }

    public function mailer() {
        return view('mail.leaveRequestApproved');
    }

}
