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
          <h1><i class="fa fa-building"></i> User Official Information </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
          <form action="{{url('/user-official/add')}}" method="post" autocomplete="off" enctype="multipart/form-data">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Employee ID</label>
                    <input class="form-control" value="IIFM00{{Auth::user()->id}}"  name="" type="text" aria-describedby="emailHelp" readonly>
                </div>
             </div>
            <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input class="form-control" id="name" name="name" type="text" aria-describedby="emailHelp" placeholder="Full Name" value="{{Auth::user()->name}}" required="">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Email ID</label>
                    <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" value="{{Auth::user()->email}}" placeholder="Email ID(Only Official Email-ID)" required="">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input class="form-control" id="mobile" name="mobile" type="text" aria-describedby="emailHelp" placeholder="Mobile Number" required="" maxlength="10">
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input class="form-control" id="designation" name="designation" type="text" aria-describedby="emailHelp" placeholder="Designation" required="">
                </div>
             </div>
               <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <select class="form-control" name="department" id="department" required="">
                      <option value="">Select Department</option>
                      <option value="Information Technology(IT)">Information Technology(IT)</option>
                      <option value="SALES">SALES</option>
                      <option value="ACADEMIC">ACADEMIC</option>
                      <option value="FINANCE">FINANCE</option>
                      <option value="ADMIN">ADMIN</option>
                      <option value="MARKETTING">MARKETTING</option>
                      <option value="TELE COUNSELLING">TELE COUNSELLING</option>
                      <option value="OTHERS">OTHERS</option>
                    </select>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Location/Centre</label>
                   <input class="form-control" id="locationcentre" name="locationcentre" type="text" aria-describedby="emailHelp" placeholder="Location/Centre" required="">
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Date of Joining</label>
                   <input class="form-control demoDate" id="doj" name="doj" type="text" aria-describedby="emailHelp" placeholder="Date of Joining" required="">
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Profile Photo</label>
                   <input class="form-control" id="profile" name="profile" type="file" aria-describedby="emailHelp" placeholder="Profile Photo" required="">
                </div>
            </div>

          </div>
          </li>
        </ul>
       
       <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit"> Submit</button>     
      </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}



  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

