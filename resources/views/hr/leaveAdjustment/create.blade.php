<!DOCTYPE html>
<html lang="en">

<head>
  
    <title> HR - Leave Management</title>
 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
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
        <h1 class="heading_title"><i class="fa fa-building-o "></i> HR - Leave Management</h1>
        </div>
         <a href="{{url('/hr/leave-adjustment/index')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Leaves</a>   
      </div>
      <div class="row  tile">
        <div class="col-md-12">
          <form action="{{url('hr/leave-adjustment/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <div class="col-md-4"> 
              <div class="form-group">
                  <label >Select Employee</label>
                  <select class="form-control" name="empid">
                    <option value="">Select Employee</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{ucwords(strtolower($user->name))}}</option>
                    @endforeach
                  </select>
                   
                </div>
             </div>
             
              <div class="col-md-4"> 
              <div class="form-group">
                  <label >Leave Start Date</label>
                  <input type="text" name="leavefrom" class="form-control datepicker" placeholder="Leave Start Date">
              </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                  <label>Leave End Date</label>
                  <input type="text" name="leaveto" class="form-control datepicker" placeholder="Leave End Date">
              </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                  <label>Total Leave(s)</label>
                  <input type="text" name="totalleave" class="form-control" placeholder="Total Leave">
              </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group ">
                 <label for="">Leave Type</label>
                    <select class="form-control" name="leavetype">
                      <option value="">Select Leave Type</option>
                      <option value="Comp Off">Comp Off</option>
                      <option value="Casual Leave">Casual Leave</option>
                      <option value="Half day Leave">Half day Leave</option>     
                    </select>
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                  <label>Reason</label>
                  <textarea class="form-control" name="reason" rows="4"></textarea>
              </div>
             </div>
             </div>
           </div>      
          </li>
        </ul>
       
    <div class="tile-footer">
              <button  class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none;">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

 <script src="{{ asset('js/main.js') }}" ></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat:'yy-mm-dd',
                              changeMonth: true,
                              changeYear: true});
  } );
  </script>
   
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

