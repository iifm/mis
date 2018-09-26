<!DOCTYPE html>
<html lang="en">
  

<head>
  
    <title>IIFM MIS - Attendance</title>
    
    

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
                @foreach($managers as $manager)
               <p style=" min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="{{$manager->id}}"> {{$manager->name}}</p>
                 @endforeach    
              </div>

          </div>
         
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background-color:  #009688; border: none;">  Submit</button>
           
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
    if ($('.approvalMsg').filter(':checked').length < 1){
        alert("Select Atleast One ApprovalFrom");
    return false;
    }
    
    });
});
 </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

