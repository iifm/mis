<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> Manager Zone - Request Management</title>

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}

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
        <h1 class="heading_title"><i class="fa fa-user-plus "></i> Request Management </h1>
        </div>   
     
      </div>
     
      <div class="row">
        <div class="col-md-12">
          
          <div class="tile">
            <div class="tile-body">
             @foreach($requirements as $requirement)
              <table  class="table"  width="100%">
                <tr>
                  <th>Request From</th>
                  <td>{{$requirement->username}}</td>
                </tr>
                <tr>
                  <th>Department</th>
                  <td>{{$requirement->dept_name}}</td>
                </tr>
                <tr>
                  <th>Job Title</th>
                  <td>{{$requirement->subject}}</td>
                </tr>
                <tr>
                  <th>Number of Opening(s)</th>
                  <td>{{$requirement->no_of_opening}}</td>
                </tr>
                <tr>
                  <th>Location</th>
                  <td>{{$requirement->loc_name}}</td>
                </tr>
                <tr>
                  <th>Type of Appointment</th>
                  <td>{{ucwords($requirement->type_of_appoint)}}</td>
                </tr>

                <tr>
                  <th>Existing Staff at present in this category</th>
                  <td>{{$requirement->username}}</td>
                </tr>
                <tr>
                  <th>Job Description</th>
                  <td>{{$requirement->jd}}</td>
                </tr>
                 <tr>
                  <th>Experience Required</th>
                  <td>{{$requirement->experience}}</td>
                </tr>
                <tr>
                  <th>Reason for Requirement</th>
                  <td>{{$requirement->reason}}</td>
                </tr>
                <tr>
                  <th>Date by which Resource is Required</th>
                  <td>{{$requirement->date}}</td>
                </tr>
                  <tr>
                  <th>Can vacancy be filled through internal transfers/promotion</th>
                  <td>{{$requirement->internal_transfers_promotion}}</td>
                </tr>
                  <tr>
                  <th>Benefits/Purpose for Additional Appointment</th>
                  <td>{{$requirement->benefits}}</td>
                </tr>
          </table>
          @endforeach
        </div>
      </div>
      </div>
     </div>
        
    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>