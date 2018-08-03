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
  
  
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    
    {!!View('partials.header')!!}


    <!-- Sidebar menu-->
    {!!View('partials.sidebar')!!}


    
    <!-- Main Content-->
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> User Personal Information </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
          <form action="{{url('/user-personal/add')}}" method="post" autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                      <option>Select Gender</option>
                      <option>Male</option>
                      <option>Female</option>
                      <option>Other</option>
                    </select>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input class="form-control demoDate" id="dob" name="dob" type="text" aria-describedby="emailHelp" placeholder="Date Of Birth">
                </div>
             </div>

             <strong><h4>Current Address</h4></strong>
             <hr>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Street Address</label>
                    <textarea class="form-control" name="cstreet" id="cstreet" rows="4" placeholder="Street Address"></textarea>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input class="form-control" id="ccity" name="ccity" type="text" aria-describedby="emailHelp" placeholder="City">
                </div>
             </div>
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input class="form-control" id="cstate" name="cstate" type="text" aria-describedby="emailHelp" placeholder="State">
             </div>
            </div>
          <strong> Check If Current and Permanent Adress Same</strong> 
            <input type="checkbox" id="copyaddress" style="height: 15px; width: 15px; margin-left: 10px;">
             <strong><h4>Permanent Address</h4></strong>
             <hr>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Street Address</label>
                    <textarea class="form-control" name="pstreet" id="pstreet" rows="4" placeholder="Street Address"></textarea>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input class="form-control" id="pcity" name="pcity" type="text" aria-describedby="emailHelp" placeholder="City">
                </div>
             </div>
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input class="form-control" id="pstate" name="pstate" type="text" aria-describedby="emailHelp" placeholder="State">
             </div>
          </div>
           <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Alternate Contact Number  </label>
                    <input class="form-control" id="altno" name="altno" type="text" aria-describedby="emailHelp" placeholder="Alternate Contact Number">
             </div>
          </div>
          </li>
        </ul>
       
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


  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

