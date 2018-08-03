<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssignProduct;
use App\User;
use App\Product;
use DB;
use Session;

class AssignProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $assign=AssignProduct::all();
        $assign=DB::table('assign_products')
        ->join('users','users.id','=','assign_products.user_id')
        ->join('product_categories','product_categories.id','=','assign_products.product_cat')
         ->join('products','products.id','=','assign_products.product_id')
        ->select('assign_products.*','users.name as username','product_categories.name as product_category','products.pdescription as productname')
        ->get();
        //dd($assign);
        return view('inventory_management.product_allocated.index',compact('assign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $users=User::orderBy('name')->get();

        $product=DB::table('products')->get();
      
        $category=DB::table('product_categories')->get();
        return view('inventory_management.product_allocated.create',compact(['users','category','products']));
    }

    public function getProduct($category)
    {
      
       $product=DB::table('products')->where('category',$category)->get(['pdescription','id']);
       return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        AssignProduct::create($request->all());
        Session::flash('message','Product Assigned successfully!!');

       return redirect()->route('assign.index');
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
       //$assign_product= AssignProduct::where('id',$id)->get();
        $users=User::orderBy('name')->get();
         $assign_product=DB::table('assign_products')
         ->where('assign_products.id',$id)
        ->join('users','users.id','=','assign_products.user_id')
        ->join('products','products.id','=','assign_products.product_id')
        ->join('product_categories','product_categories.id','=','assign_products.product_cat')
        ->select('assign_products.*','users.name as username','product_categories.name as product_category','products.pdescription as product_descption')
        ->get();

        $category=DB::table('product_categories')->get();
       return view('inventory_management.product_allocated.edit',compact(['assign_product','users','category']));
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
      //dd($request->all());
        
       $assigned_user= $request->input('user_id');
        $product_cat= $request->input('product_cat');
        $product_desc= $request->input('product_id');
        $date= $request->input('date');
        $remark= $request->input('remark');
       // $assigned_user= $request->input('assigned_user');

          $data=AssignProduct::where('id',$id)->update(['user_id'=>$assigned_user,'product_cat'=>$product_cat,'product_id'=>$product_desc,'date'=>$date,'remark'=>$remark]);

         Session::flash('message','Product Assignment Updated Successfully !!');
        return redirect()->route('assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssignProduct::where('id',$id)->delete();
         Session::flash('message','Product Assigned Deleted successfully!!');

       return redirect()->route('assign.index');
    }
}
