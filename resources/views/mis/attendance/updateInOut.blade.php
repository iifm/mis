<!DOCTYPE html>
<html lang="en">
  

<head>
  
    <title>IIFM MIS - Attendance</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   
<style type="text/css">
  #inTimeEnable {
  position:absolute;
  right:25px;
  top:30px;
}

 #outTimeEnable {
  position:absolute;
  right:25px;
  top:30px;
}
</style>
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
       @if(Session::has('message'))
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div>
        @endif
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
        <div class="col-md-12">
        
          <form action="{{url('/update-attendance/store')}}/{{$user_id}}/{{$date}}" method="post" id="attendance_update"  autocomplete="off">
         
          
         
            {{ csrf_field() }}
         
              <div class="row">
            <div class="col-md-12">
              
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Employee Name</label>
                    <input class="form-control capitalize char-only" id="name" name="name" type="text" aria-describedby="emailHelp" value="{{$user->name}}" readonly="" required="">
                </div>
                 <div class="col-md-12" >
                   <label for="exampleInputEmail1">In Time</label>
                   @if($inTime!='')
                    <input type="text" id="inTime" name="inTime"  class="form-control" placeholder="IN-TIME" value="{{$inTime}}"  readonly="readonly" required />
                     <input type="checkbox" name="inTimeCheck"  id="inTimeEnable" value="inTimeEdited" />
                    @else
                     <input type="text" id="inTime" name="inTime"  class="form-control input-a" placeholder="IN-TIME" value="{{$inTime}}" required  />

                     @endif
                   

                    </div>
             </div>
              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                     <input class="form-control" id="date" name="date" type="text" value="{{date('j F Y',strtotime($date))}}" placeholder="YYYY/MM/DD" readonly="" required>
                </div>
                <div class="col-md-12" >
                   <label for="exampleInputEmail1">Out Time</label>
                    @if($outTime!='')
                    <input type="text" id="outTime" name="outTime"  class="form-control " placeholder="OUT-TIME" value="{{$outTime}}"  readonly="readonly" required />
                    <input type="checkbox" id="outTimeEnable" name="outTimeCkeck"   />
                    @else
                     <input type="text" id="outTime" name="outTime"  class="form-control input-a" placeholder="OUT-TIME" value="{{$outTime}}"  required />
                    @endif
                    
                    </div>

                
             </div>

         
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Reason</label>
                    <textarea class="form-control" rows="5"  name="reason" id="reason" placeholder="Reason For Attendance Updation" required=""></textarea>
                </div>
             </div>

               
                   <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
              <h3 style="margin-bottom:0; color:#135cb0; font-weight:bold;">Select Reporting Manager <font style="font-size:14px; color:#FF0000;">(Select Maximum 2)</font></h3>
                         </div>
              <div class="col-lg-12" style="margin-bottom:10px;z-index: 999;">
               @foreach($managers as $manager)
               <p style=" min-width:180px; float:left;"><input class="approvalMsg" type="checkbox" name="approvalfrom[]" id="approvalfrom" value="{{$manager->id}}">{{$manager->name}} </p>
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
   <!--  {!!View('partials.include_js')!!} -->
   <script type="text/javascript" src="{{URL::To('public/js/jquery-clockpicker.min.js')}}"></script>
   <script src="{{ asset('js/main.js') }}" ></script>

<script type="text/javascript">
      var input = $('.input-a');
input.clockpicker({
    autoclose: true
});

 </script>

 <script type="text/javascript">
   $(document).ready(function(){

      $(document).on('click','.input-a2',function(){
          $(this).clockpicker({
              autoclose: true
          });
        });

   $(document).on('change','#inTimeEnable',function(){
        

        if($(this).is(":checked")) {
           $("#inTime").removeAttr('readonly');
            $("#inTime").addClass('input-a2');   
            $(this).val('inTimeEdited');   
        }
        else{
          
          $('#inTime').attr('readonly','readonly');
           $("#inTime").removeClass('input-a2');
            $(this).val('inTimeNotEdited');   
        }
                
    });

     $('#outTimeEnable').change(function() {
        if($(this).is(":checked")) {
           $("#outTime").removeAttr('readonly');
             $("#outTime").addClass('input-a2');
              $(this).val('outTimeEdited');  
        }
        else{
          
          $('#outTime').attr('readonly','readonly');
            $("#outTime").removeClass('input-a2');
             $(this).val('outTimeNotEdited');  
        }
                
    });



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

