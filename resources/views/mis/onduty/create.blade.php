<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>IIFM MIS</title>
    
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

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
           <h4><i class="fa fa-th-list"></i>On-Duty Management  <a href="{{url('/on-duty/index')}}" class="btn btn-primary fa fa-eye">View Your OD</a></h4>
 
        </div>
      
      </div>
      <div class="row">
        <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-primary btn-lg"> Back</a>
        <form action="{{url('/on-duty/store')}}" method="post" autocomplete="off">

            {{ csrf_field() }}
      <div id="official_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-calendar"> Employee 'On-Duty' Application Form</p></h5>
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
                  <strong><label for="">OD Date</label></strong>  
                    <input class="form-control" id="od_date" name="od_date" type="text" aria-describedby="emailHelp" placeholder="Start Date">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for="">Visit IN Time</label></strong>
                    <input class="form-control input-a"  id="intime" name="intime" type="text" aria-describedby="emailHelp" placeholder="Visit IN Time">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                <strong><label for="">Visit OUT Time</label></strong>    
                    <input class="form-control input-a" id="outtime" data-default="" name="outtime" type="text" aria-describedby="emailHelp" placeholder="Visit OUT Time" >
                </div>
             </div>
             <div class="col-md-5"> 
              <div class="form-group">
                  <strong>  <label for="">OD Type</label></strong><br>
                   <select class="form-control" name="od_type" id="od_type">
                    <option>Please Select OD-Type</option>
                     <option>Session at School</option>
                      <option>School Visit</option>
                       <option> Feeders Tie up</option>
                        <option>Counseling</option>
                         <option>Enrollment </option>
                          <option>Meeting with Client </option>
                   </select>

                </div>
             </div>
             <div class="col-md-7"> 
              <div class="form-group">
                    <strong><label for="">Reason</label></strong>
                    <textarea class="form-control" name="reason" id="reason" rows="5" placeholder="Explain your reason for OD"></textarea>
                </div>
             </div>

            
             <br>
            <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
              <h3 style="margin-bottom:0; color:#135cb0; font-weight:bold;">Select Reporting Manager <font style="font-size:14px; color:#FF0000;">(Select Maximum 2)</font></h3>
                         </div>
              <div class="col-lg-12" style="margin-bottom:10px;z-index: 999;">
                           
               <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="hb@iifm.co.in_51"> Hemant Bisht</p>
                    
                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="pc@iifm.co.in_206"> Pranav Chaturvedi</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="jibani.singh@iifm.co.in_68"> Jibani Singh</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="gaurav@prathamonline.com_39"> Gaurav Singh</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="nira.sinha@iifm.co.in_29"> Nira Sinha</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="sunil.verma@iifm.co.in_105"> Sunil Verma</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="ranjan.vakil@iifm.co.in_122"> Vakil Ranjan</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="amit.jain@iifm.co.in_66"> Amit Jain</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="manish.ram@iifm.co.in_1"> Manish Ram</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="rohit.kapoor@prathamonline.com_325"> Rohit Kapoor</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="amit.vig@prathamonline.com_125"> Amit Vig</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="vidhi@prathamonline.com_34"> Vidhi Mangla</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="dharmandra.kandari@iifm.co.in_52"> Dharmendra Kandari</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="asif.mufti@prathamonline.com_225"> Asif Mufti</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="vikrant.bahl@iifm.co.in_272"> Vikrant Bahl</p>

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="puneet.khurana@iifm.co.in_271"> Puneet Khurana</p> 

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="reeturaj.goswami@prathamonline.com_264"> Reeturaj Goswami</p>  

                <p style="margin-right:20px; min-width:180px; float:left;"><input type="checkbox" name="leaveoff2[]" id="leaveoff2" value="amandeep@prathamonline.com_378"> Amandeep Rajgotra</p>
                        
                        
                         </div>
           
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
  <!--   {!!View('partials.include_js')!!} -->
  <script src="{{ asset('js/main.js') }}" ></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#od_date" ).datepicker({minDate:0});
  } );
  </script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

