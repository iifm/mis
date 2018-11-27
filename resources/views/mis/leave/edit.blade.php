<!DOCTYPE html>
<html lang="en">

    <head>

        <title>IIFM MIS</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}


    </head>

    <body class="app sidebar-mini rtl">
        <!-- Navbar-->

        {!!View('partials.header')!!}


        <!-- Sidebar menu-->
        {!!View('partials.sidebar')!!}



        <!-- Main Content-->

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1><i class="fa fa-th-list"></i> Leave Management</h1>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                    <li class="breadcrumb-item">User Profile</li>
                    <li class="breadcrumb-item"><a href="#">User Profile Edit</a></li>
                </ul>
            </div>
            <div class="row">
                <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-primary btn-lg"> Back</a>
                <form action="{{url('/leave-store')}}" method="post">

                    {{ csrf_field() }}
                    <div id="official_info" class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-calendar"> Leave/Comp-off Application Form</p></h5>
                                <div class="row">

                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Name</label></strong>  
                                            <input class="form-control" id="name" name="name" type="text" value="{{Auth::user()->name}}" aria-describedby="emailHelp" placeholder="Enter Full Name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Email ID</label></strong>  
                                            <input class="form-control" id="email" name="email" value="{{Auth::user()->email}}" type="email" aria-describedby="emailHelp" placeholder="Email Id (Enter Only Official-ID)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Mobile</label></strong> 
                                            <input class="form-control" id="mobile" name="mobile" type="text" aria-describedby="emailHelp" placeholder="Mobile">
                                        </div>
                                    </div>


                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Leave Start Date</label></strong>  
                                            <input class="form-control demoDate" id="leavefrom" name="leavefrom" type="text" aria-describedby="emailHelp" placeholder="Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong> <label for="">Leave End Date</label></strong>
                                            <input class="form-control demoDate" id="leaveto" name="leaveto" type="text" aria-describedby="emailHelp" placeholder="End Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Total Leaves (In Days)</label></strong>    
                                            <input class="form-control" id="totdays" name="totdays" type="text" aria-describedby="emailHelp" placeholder="Auto Calculated" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <strong>  <label for="">Leave Type</label></strong><br>
                                            <input type="checkbox" value="Compensatory Off" name="leaveoff[]" id="leaveoff"> Compensatory Off<br><br>
                                            <input type="checkbox" value="Casual Leave" name="leaveoff[]"> Casual Leave <br><br>
                                            <input type="checkbox" value="Half day Leave" name="leaveoff[]"> Half day Leave

                                        </div>
                                    </div>
                                    <div class="col-md-9"> 
                                        <div class="form-group">
                                            <strong><label for="">Reason</label></strong>
                                            <textarea class="form-control" name="reason" id="reason" rows="5" placeholder="Explain your reason for leave"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6"> 
                                        <h5 style="font-weight:bold;color: red!important; margin-bottom: 10px;  font-family: Times New Roman">Select Sunday Date against Comp off (In case of comp off only)</h5>
                                        <input type="text" class="form-control demoDate" name="agdcompoff" id="agdcompoff" placeholder="Pic a date">
                                    </div>
                                    <div class="col-md-6"> 

                                    </div>
                                    <br>
                                    <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
                                        <h3 style="color:#135cb0; margin-top: 20px; font-family: Times New Roman">Approval From <font style="font-size:14px; color:#FF0000;">(Select Maximum 3)</font></h3>
                                    </div>
                                    <table>
                                        <tbody><tr><td>
                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="hb@iifm.co.in_51"> Hemant Bisht</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="pc@iifm.co.in_206"> Pranav Chaturvedi</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="jibani.singh@iifm.co.in_68"> Jibani Singh</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="gaurav@prathamonline.com_39"> Gaurav Singh</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="nira.sinha@iifm.co.in_29"> Nira Sinha</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="sunil.verma@iifm.co.in_105"> Sunil Verma</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="ranjan.vakil@iifm.co.in_122"> Vakil Ranjan</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amit.jain@iifm.co.in_66"> Amit Jain</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="manish.ram@iifm.co.in_1"> Manish Ram</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="rohit.kapoor@prathamonline.com_325"> Rohit Kapoor</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amit.vig@prathamonline.com_125"> Amit Vig</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="vidhi@prathamonline.com_34"> Vidhi Mangla</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="dharmandra.kandari@iifm.co.in_52"> Dharmendra Kandari</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="asif.mufti@prathamonline.com_225"> Asif Mufti</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="vikrant.bahl@iifm.co.in_272"> Vikrant Bahl</p>

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="puneet.khurana@iifm.co.in_271"> Puneet Khurana</p> 

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="reeturaj.goswami@prathamonline.com_264"> Reeturaj Goswami</p>  

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amandeep@prathamonline.com_378"> Amandeep Rajgotra</p>

                                                </td></tr>
                                        </tbody></table>

                                </div>
                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>  
                </form>
            </div>

        </main>


        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}


    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

