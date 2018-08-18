<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>IIFM MIS</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   

   </head>
    

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
          <h1><i class="fa fa-calendar "></i> Attendance Update </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
        <div class="col-md-12">
          @if($type=='IN')
          <form action="{{url('/updated-user-attendance')}}" method="post" id="attendance_update"  autocomplete="off">
          @else
           <form action="{{url('/updated-userout-attendance')}}" method="post" id="attendance_update"  autocomplete="off">
          @endif
            {{ csrf_field() }}
         
              <div class="row">
            <div class="col-md-12">
              
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Employee Name</label>
                    <input class="form-control capitalize char-only" id="name" name="name" type="text" aria-describedby="emailHelp" value="{{$name}}" readonly="" required="">
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                     <input class="form-control" id="date" name="date" type="text" value="{{$date}}" placeholder="YYYY/MM/DD" readonly="" required="">
                </div>
             </div>
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Attendance Type</label>
                     <input class="form-control" id="type" name="type" type="text" value="{{$type}}" placeholder="YYYY/MM/DD" readonly="" required="">
                </div>
             </div>
               <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Attendance Time</label>
                     <input class="form-control input-a" id="time" name="time" type="text"  placeholder="Attendance Time" required="">
                </div>
             </div>
             <div class="col-md-8"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Reason</label>
                    <textarea class="form-control capitalize char-only" rows="4" name="reason" id="reason" placeholder="Reason For Attendance Updation" required=""></textarea>
                </div>
             </div>
                   <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
              <h3 style="margin-bottom:0; color:#135cb0; font-weight:bold;">Select Reporting Manager <font style="font-size:14px; color:#FF0000;">(Select Maximum 2)</font></h3>
                         </div>
              <div class="col-lg-12" style="margin-bottom:10px;z-index: 999;">
                           
               <p style=" min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="hb@iifm.co.in_51"> Hemant Bisht</p>
                    
                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="pc@iifm.co.in_206"> Pranav Chaturvedi</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="jibani.singh@iifm.co.in_68"> Jibani Singh</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="gaurav@prathamonline.com_39"> Gaurav Singh</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="nira.sinha@iifm.co.in_29"> Nira Sinha</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="sunil.verma@iifm.co.in_105"> Sunil Verma</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="ranjan.vakil@iifm.co.in_122"> Vakil Ranjan</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amit.jain@iifm.co.in_66"> Amit Jain</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="manish.ram@iifm.co.in_1"> Manish Ram</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="rohit.kapoor@prathamonline.com_325"> Rohit Kapoor</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amit.vig@prathamonline.com_125"> Amit Vig</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="vidhi@prathamonline.com_34"> Vidhi Mangla</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="dharmandra.kandari@iifm.co.in_52"> Dharmendra Kandari</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="asif.mufti@prathamonline.com_225"> Asif Mufti</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="vikrant.bahl@iifm.co.in_272"> Vikrant Bahl</p>

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="puneet.khurana@iifm.co.in_271"> Puneet Khurana</p> 

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="reeturaj.goswami@prathamonline.com_264"> Reeturaj Goswami</p>  

                <p style="min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="amandeep@prathamonline.com_378"> Amandeep Rajgotra</p>
                        
                        
              </div>

          </div>
         
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
 <script type="text/javascript">
   $(document).ready(function(){
    $("#attendance_update").submit(function(){
      // alert("jhg");
    if ($('.approvalMsg').filter(':checked').length < 2){
        alert("Select Atleast Two ApprovalFrom");
    return false;
    }
    
    });
});
 </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

