<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>SEARCH</title>

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
          <h5><i class="fa fa-search"></i> Search Result  <a href="{{URL::previous()}}" class="btn btn-primary fa fa-arrow-circle-left" > BACK</a></h5>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
             <div class="col-lg-12 col-lg-offset-1">
                <div class="input-group">
                   <div class="table" >
                     <table width="100%">
                       <thead>
                        <tr>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Mobile</th>
                         <th>Designation</th>
                         <th>Department</th>
                         <th>Location/Centre</th>
                        </tr>
                       </thead>
                       <tbody>
                        @foreach($datas as $data)
                         <tr>
                          <td>{{$data->user_name}}</td>
                          <td>{{$data->user_email}}</td>
                          <td>{{$data->user_mobile}}</td>
                          <td>{{$data->user_designation}}</td>
                          <td>{{$data->user_department}}</td>
                          <td>{{$data->user_locationcentre}}</td>
                         </tr>
                       @endforeach
                       </tbody>
                     </table>
                   </div>
                   
                </div>
            </div>
             

                
            </div>
          </div>
        </div>
      </div>
    </main>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
    
     <!--  <script src="{{ asset('js/main.js') }}" ></script> -->

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>