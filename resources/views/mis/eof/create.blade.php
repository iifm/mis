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
          <h1><i class="fa fa-trophy "></i> Hall Of Fame </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
          <form action="{{url('/hall-of-fame/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Employee Name</label>
                    <input class="form-control" id="empname" name="empname" type="text" aria-describedby="emailHelp" placeholder="Employee Name">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Month</label>
                    <select class="form-control" name="month" id="month">
                      <option>Select Month</option>
                      <option>January</option>
                      <option>February</option>
                      <option>March</option>
                      <option>April</option>
                      <option>May</option>
                      <option>June</option>
                      <option>July</option>
                      <option>August</option>
                      <option>September</option>
                      <option>October</option>
                      <option>November</option>
                      <option>December</option>
                  </select>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Upload Image</label>
                    <input class="form-control" id="file" name="image" type="file" aria-describedby="emailHelp" placeholder="Upload Image" >
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <select class="form-control" name="department" id="department">
                      <option>Select Department</option>
                      <option>Information Technology(IT)</option>
                      <option>SALES</option>
                      <option>ACADEMIC</option>
                      <option>FINANCE</option>
                      <option>ADMIN</option>
                      <option>MARKETTING</option>
                      <option>TELE COUNSELLING</option>
                      <option>OTHERS</option>
                    </select>
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" rows="4" name="description" id="description" placeholder="Description"></textarea>
                </div>
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

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

