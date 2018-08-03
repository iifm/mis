<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:13 GMT -->
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
          <h1><i class="fa fa-tasks"></i> User Professional Information </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
          <form action="{{url('/user-professional/update')}}" method="post" autocomplete="off" enctype="multipart/form-data">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Company Name</label>
                    <input class="form-control" id="company" name="company" type="text" aria-describedby="emailHelp" placeholder="Company Name" required="">
                </div>
             </div>
              <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">From</label>
                    <input class="form-control demoDate" id="fromdate" name="fromdate" type="text" aria-describedby="emailHelp" placeholder="From" required="">
                </div>
             </div>
              <div class="col-md-3"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">To</label>
                    <input class="form-control demoDate" id="todate" name="todate" type="text" aria-describedby="emailHelp" placeholder="To" required="">
                </div>
             </div>

              <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input class="form-control" id="designation1" name="designation1" type="text" aria-describedby="emailHelp" placeholder="Designation" required="">
                </div>
             </div>
              <div class="col-md-6 "> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Address</label>
                    <textarea class="form-control" name="address" id="address" placeholder="Company Address" rows="4" required=""></textarea>
             </div>
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Offer/Appointment Letter</label>
                    <input class="form-control" id="offerletter" name="offerletter" type="file" aria-describedby="emailHelp" placeholder="">
                </div>
             </div>
             <div class="col-md-3"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Relieving/Experience Letter</label>
                    <input class="form-control" id="relievingletter" name="relievingletter" type="file" aria-describedby="emailHelp" placeholder="">
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

<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('.example1').datepicker({
                    minViewMode: 'years',
                    autoclose: true,
                     format: 'yyyy'
                });  
            
            });
        </script>
    
     <script type="text/javascript">
      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
  </script>

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

