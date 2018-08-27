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
      
        <form action="{{url('/on-duty/store')}}" method="post" autocomplete="off" id="od_form">

            {{ csrf_field() }}
      <div id="official_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5  style="color: #009688; text-align: center;"><p class="fa fa-calendar"> Employee 'On-Duty' Application Form</p></h5>
            <div class="row">
             
             <div class="col-md-4"> 
              <div class="form-group">
                  <strong><label for="">OD Date</label></strong>  
                    <input class="form-control" id="od_date" name="od_date" type="text" aria-describedby="emailHelp" placeholder="Start Date" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for="">Visit IN Time</label></strong>
                    <input class="form-control input-a"  id="intime" name="intime" type="text" aria-describedby="emailHelp" placeholder="Visit IN Time" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                <strong><label for="">Visit OUT Time</label></strong>    
                    <input class="form-control input-a" id="outtime" data-default="" name="outtime" type="text" aria-describedby="emailHelp" placeholder="Visit OUT Time" required="">
                </div>
             </div>
             <div class="col-md-5"> 
              <div class="form-group">
                  <strong>  <label for="">OD Type</label></strong><br>
                   <select class="form-control" name="od_type" id="od_type" required="">
                    <option value="">Please Select OD-Type</option>
                     <option value="Session at School">Session at School</option>
                      <option value="School Visit">School Visit</option>
                       <option value="Feeders Tie up"> Feeders Tie up</option>
                        <option value="Counseling">Counseling</option>
                         <option value="Enrollment">Enrollment </option>
                          <option value="Meeting with Client">Meeting with Client </option>
                   </select>

                </div>
             </div>
             <div class="col-md-7"> 
              <div class="form-group">
                    <strong><label for="">Reason</label></strong>
                    <textarea class="form-control capitalize char-only" name="reason" id="reason" rows="5" placeholder="Explain your reason for OD" required=""></textarea>
                </div>
             </div>

            
             <br>
            <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
              <h3 style="margin-bottom:0; color:#135cb0; font-weight:bold;">Select Reporting Manager <font style="font-size:14px; color:#FF0000;">(Select Maximum 2)</font></h3>
                         </div>
              <div class="col-lg-12" style="margin-bottom:10px;z-index: 999;">
                 @foreach($managers as $manager)          
               <p style="margin-right:20px; min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="leaveoff2[]" id="leaveoff2" value="{{$manager->email}}">{{$manager->name}}</p>
                @endforeach    
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
    $( "#od_date" ).datepicker({minDate:0,
                                dateFormat:'yy-mm-dd'});
  } );
  </script>
    <script type="text/javascript">
   $(document).ready(function(){
    $("#od_form").submit(function(){
      // alert("jhg");
    if ($('.approvalMsg').filter(':checked').length < 1){
        alert("Select Atleast Two ApprovalFrom");
    return false;
    }
    
    });
});
 </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

