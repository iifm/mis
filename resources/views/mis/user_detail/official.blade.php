<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>IIFM MIS - Official Information</title>
    
    

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
          <h1 class="heading_title"><i class="fa fa-building"></i> User Official Information </h1>
        </div>
          <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
      </div>
      <div class="row  tile">
     
        <div class="col-md-12">
          <form action="{{url('/user-official/add')}}/{{$id}}" method="post" autocomplete="off" enctype="multipart/form-data">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              @foreach($user_detail as $value)
           
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Employee ID</label>
                    <input class="form-control" value="IIFM00{{$value->userid}}"  name="" type="text" aria-describedby="emailHelp" readonly>
                </div>
             </div>
            <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input class="form-control capitalize char-only" id="name" name="name" type="text" aria-describedby="emailHelp" placeholder="Full Name" value="{{$value->name}}" required="">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Email ID</label>
                    <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" value="{{$value->email}}" placeholder="Email ID(Only Official Email-ID)" required="">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input class="form-control numbers-only" id="mobile" value="{{$value->mobile}}" name="mobile" type="text" aria-describedby="emailHelp" placeholder="Mobile Number" required="" maxlength="10">
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input class="form-control capitalize char-only" id="designation" value="{{$value->designation}}" name="designation" type="text" aria-describedby="emailHelp" placeholder="Designation" required="">
                </div>
             </div>
               <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <select class="form-control" name="department" id="department" required="">
                      <option value="{{$value->department_id}}">{{$value->department_name}}</option>
                      @foreach($departments as $department)
                      <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Location/Centre</label>
                   <select name="locationcentre" id="locationcentre" class="form-control" required="">
                     <option value="">Select Location</option>
                     @foreach($locations as $location)
                     <option value="{{$location->id}}">{{$location->name}}</option>
                     @endforeach
                   </select>
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Date of Joining</label>
                   <input class="form-control" value="{{$value->doj}}" id="doj" name="doj" type="text" aria-describedby="emailHelp" placeholder="Date of Joining" required="">
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Profile Photo</label>
                   <input class="form-control" id="profile-img" onchange="return fileValidation()" name="profile" type="file" aria-describedby="emailHelp" placeholder="Profile Photo" >
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                 
                  <img src="" id="profile-img-tag" width="200px" />

                </div>
            </div>
          </div>
          </li>
        </ul>
       @endforeach
       <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none"> Submit</button>     
      </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
 
<script>
 function fileValidation(){
    var fileInput = document.getElementById('profile-img');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" height="150px" width="150px"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>

 <script src="{{ asset('js/main.js') }}" ></script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#doj" ).datepicker({ dateFormat:'yy-mm-dd'});
  } );
  </script>

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

