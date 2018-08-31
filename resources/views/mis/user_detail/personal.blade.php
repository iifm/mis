<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title> User Personal Information</title>
    
    

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
          <h1 class="heading_title"><i class="fa fa-user"></i> User Personal Information </h1>
        </div>
          <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
      </div>
      @foreach($user_detail as $data)
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
      
        <div class="col-md-12">
          <form action="{{url('/user-personal/add')}}/{{$id}}" method="post" autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <select class="form-control" name="gender" id="gender" required="">
                      <option value="{{$data->gender}}">{{$data->gender}}</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input class="form-control" id="dob" value="{{$data->dob}}" name="dob" type="text" aria-describedby="emailHelp" placeholder="Date Of Birth" required="">
                </div>
             </div>

             <strong><h4 class="heading_title">Current Address</h4></strong>
             <hr>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Street Address</label>
                    <textarea class="form-control capitalize char-only" name="cstreet" id="cstreet" rows="4" placeholder="Street Address" required="">{{$data->cstreet}}</textarea>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input class="form-control capitalize char-only" value="{{$data->ccity}}" id="ccity" name="ccity" type="text" aria-describedby="emailHelp" placeholder="City" required="">
                </div>
             </div>
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input class="form-control capitalize char-only" id="cstate" value="{{$data->cstate}}" name="cstate" type="text" aria-describedby="emailHelp" placeholder="State" required="">
             </div>
            </div>
          <strong> Check If Current and Permanent Adress Same</strong> 
            <input type="checkbox" id="copyaddress" style="height: 15px; width: 15px; margin-left: 10px;">
             <strong><h4 class="heading_title">Permanent Address</h4></strong>
             <hr>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Street Address</label>
                    <textarea class="form-control capitalize char-only" name="pstreet" id="pstreet" rows="4" placeholder="Street Address" required="">{{$data->pstreet}}</textarea>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input class="form-control capitalize char-only" value="{{$data->pcity}}" id="pcity" name="pcity" type="text" aria-describedby="emailHelp" placeholder="City" required="">
                </div>
             </div>
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input class="form-control capitalize char-only" id="pstate" value="{{$data->pstate}}" name="pstate" type="text" aria-describedby="emailHelp" placeholder="State" required="">
             </div>
          </div>
           <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Alternate Contact Number  </label>
                    <input class="form-control numbers-only" id="altno" value="{{$data->altno}}" name="altno" maxlength="10" type="text" aria-describedby="emailHelp" placeholder="Alternate Contact Number" required="">
             </div>
          </div>
          </li>
        </ul>
       @endforeach
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

 
<script type="text/javascript">
  $(document).ready(function(){
    $("#copyaddress").on("click", function(){
         if (this.checked) { 
               $('#pcity').val($('#ccity').val());
                $("#pstreet").val($("#cstreet").val());
                $("#pstate").val($("#cstate").val());                  
    }
    else {
         $("#pcity").val('');
        $("#pstreet").val('');
        $("#pstate").val('');        
    }
    });
});

</script>

<script src="{{ asset('js/main.js') }}" ></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dob" ).datepicker({ dateFormat:'yy-mm-dd'});
  } );
  </script>

  </body>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

