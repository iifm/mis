<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:13 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>IIFM MIS</title>
    
    

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
          <h1 class="heading_title"><i class="fa fa-tasks"></i> User Professional Information </h1>
        </div>
           <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
        <div class="col-md-12">
          <form action="{{url('/user/professional/update/')}}/{{$id}}/{{$user_id}}" method="post" autocomplete="off" enctype="multipart/form-data">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              @foreach($user_work_datas as $data)
              <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Company Name</label>
                    <input class="form-control char-only capitalize" value="{{$data->company}}" id="company" name="company" type="text" aria-describedby="emailHelp" placeholder="Company Name" required="">
                </div>
             </div>
              <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">From</label>
                    <input class="form-control datepicker" id="fromdate" value="{{$data->fromdate}}" name="fromdate" type="text" aria-describedby="emailHelp" placeholder="From" required="">
                </div>
             </div>
              <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">To</label>
                    <input class="form-control datepicker" id="todate" name="todate" value="{{$data->todate}}" type="text" aria-describedby="emailHelp" placeholder="To" required="">
                </div>
             </div>

              <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input class="form-control char-only capitalize" id="designation1" value="{{$data->designation1}}" name="designation1" type="text" aria-describedby="emailHelp" placeholder="Designation" required="">
                </div>
             </div>
              <div class="col-md-6 "> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Address</label>
                    <textarea class="form-control capitalize" name="address" value="{{$data->address}}" id="address" placeholder="Company Address" rows="4" required="">{{$data->address}}</textarea>
             </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Offer/Appointment Letter</label>
                    <input class="form-control" id="offerletter" name="offerletter" onchange="return fileValidation2();" type="file" aria-describedby="emailHelp" placeholder="">
                </div>
             </div>
             <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Relieving/Experience Letter</label>
                    <input class="form-control" id="relievingletter" onchange="return fileValidation();" name="relievingletter" type="file" aria-describedby="emailHelp" placeholder="">
                </div>
             </div>
          </div>
          @endforeach
          </li>
        </ul>
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none"> Submit</button>
           
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
  
<script>
 function fileValidation(){
    var fileInput = document.getElementById('relievingletter');
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
<script>
 function fileValidation2(){
    var fileInput = document.getElementById('offerletter');
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


  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

