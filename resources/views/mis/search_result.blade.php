<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>SEARCH</title>

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
          <h1><i class="fa fa-search"></i> Search Result  </h1>

        </div>
      </div>

      <div class="row">
         @foreach($datas as $data)
    <div class="col-md-12">
    <div class="col-md-3">
   <div class="card tile" style="height: 320px;">
    @if($data->user_profile!="")
    <img class="" width="100%" height="200" src="{{URL::To('storage/app/profile/'.$data->user_profile)}}" alt="Profile image">
    @else
    <img class="" width="100%" height="200" src="{{URL::To('public/images/usser.png')}}" alt="Profile image">
    @endif
    <div class="card-body">
      <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$data->user_name}}</h4>
       <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$data->user_designation}}</h4>

      <p class="card-text" style="text-align: center">
    </div>
  </div> 
    </div>
     <div class="col-md-9 tile">
       <h3 class="tile-title" style="font-family: Times New Roman">OFFICIAL INFORMATION </h3>

            <table class="table">
            <tr>
              <th>Email ID</th>
              <td>{{$data->user_email}}</td>
            </tr>
             <tr>
              <th>Mobile</th>
              <td> {{$data->user_mobile}}</td>
            </tr>
             <tr>
              <th>Employee ID</th>
              <td>IIFM{{ str_pad($data->user_id,4,"0",STR_PAD_LEFT) }}</td>
            </tr>
             <tr>
              <th>Department</th>
              <td> {{$data->user_department}}</td>
            </tr>
             <tr>
              <th>Location/Centre</th>
              <td> {{$data->user_locationcentre}}</td>
            </tr>
             <tr>
              <th>Date Of Joining</th>
              <td> {{$data->user_doj}}</td>
            </tr>

            </table>
       
    </div>  
  </div>
   @endforeach
  
      </div>
    </main>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
    
     <!--  <script src="{{ asset('js/main.js') }}" ></script> -->

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>