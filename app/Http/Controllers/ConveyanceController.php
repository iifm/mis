<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Conveyance;
use DB;

class ConveyanceController extends Controller
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

    public function index($id)
    {
     
          $strtYear=date('Y').'-04-01';

       $endYear=date('Y-m-d',strtotime("+1 day"));
      
       $conveyance=Conveyance::where('user_id',$id)
                    ->whereBetween('con_date',[$strtYear, $endYear])
                    ->orderBy('id','DESC')
                    ->get();

        $monthConveyance=Conveyance::whereMonth('con_date',date('m'))
                                                    ->whereYear('con_date',date('Y'))
                                                    ->where('user_id',$id)
                                                    ->sum('amount');

           
        return view('mis.conveyance.index',compact(['conveyance','monthConveyance']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('mis.conveyance.save');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $count = $request->input('tcount');
      $filename='';
      $id=Auth::user()->id;
        $name=str_replace(' ', '_', Auth::user()->name);

     // dd($request->all());
      for ($i=1; $i <= $count ; $i++) { 
         $file = $request->file('uploadfile'.$i);
         if ($request->hasFile('uploadfile'.$i)) {
             $filename =$id."_".$name."_".strtotime(date('Y-m-d H:i:s'))."_".$file->getClientOriginalName();
               $file->storeAs('conveyance/', $filename);
         }               
      }

      for ($i=1; $i <= $count ; $i++) { 
        //dd(date('Y-m-d',strtotime($request->input('date'.$i))));
          $conveyance= new Conveyance;        
          $conveyance->user_id = Auth::user()->id;
          $conveyance->con_date= date('Y-m-d',strtotime($request->input('date'.$i)));
          $conveyance->reason= $request->input('reason'.$i);
          $conveyance->disfrom= $request->input('travelfrom'.$i);
          $conveyance->disto= $request->input('travelto'.$i);
          $conveyance->distance=$request->input('distance'.$i);
          $conveyance->amount=$request->input('Rate'.$i);
          $conveyance->mode= $request->input('mode'.$i);

          if ($filename!='') {
               $conveyance->uploadcimg=$filename;

          }
           
            $conveyance->sip=\Request::ip();

             $conveyance->save();  


      }
        
        Session::flash('message','Your Conveyance Added Successfully !!');
        return redirect()->route('conveyance.index',['id'=>Auth::id()]);
       
    }

   
   public function approveConveyance($id,$amount,$approver)
   {
     // $approved_by=Auth::user()->id();
      $data=explode(",", $id);
      $con_id=$data[0];
      $action=$data[1];
      
      if($action=="approve"){
        $approve_con=Conveyance::where('id',$con_id)->update(['approved_amount'=>$amount,'status'=>'Approve','approved_by'=>$approver]);
          return "Conveyance Approved Successfully !!";
      }
     elseif ($action=="disapprove") {
       $approve_con=Conveyance::where('id',$con_id)->update(['status'=>'Rejected','rejected_by'=>$approver]);
          return "Conveyance Rejected Successfully !!";
     }
     
   }
   public function reAction($id)
   {
      Conveyance::where('id',$id)->update(['status'=>"PENDING",'approved_amount'=>'','approved_by'=>'','rejected_by'=>'']);
      return "Conveyance Status Changed Successfully !!";
   }

   public function show()
   {
    return view('mis.conveyance.policy');
   }
   public function destroy($id)
   {
     Conveyance::where('id',$id)->delete();
      Session::flash('message','Your Conveyance Added Successfully !!');
        return redirect()->route('conveyance.index',['id'=>Auth::id()]);
   }

}
