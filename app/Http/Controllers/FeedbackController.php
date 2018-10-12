<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Feedback;
use Mail;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('feedback.feedback');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $storeFeedback=Feedback::create($request->all());
        $to_email=['sarita.sharma@iifm.co.in','hr@iifm.co.in'];
        $subject="New Anonymous Feedback Received  on ". date("l jS \of F Y",strtotime($storeFeedback->created_at));
       $data=['title'=>$request->subject,'message'=>$request->description];

         Mail::send('mail.feedbackMailer',['data'=>$data], function ($message)use($to_email,$subject) {
                     $message->from('info@prathamonline.in', 'MIS Alert');
                        $message->to($to_email);
                        $message->subject($subject);
                        
                    });
       
        Session::flash('message','Your Feedback Sent Successfully!!');
        return redirect()->route('feedback.index');
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
        //
    }
}
