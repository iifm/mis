<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title>IIFM MIS - Employee of Month</title>


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
                    <h1 class="heading_title"><i class="fa fa-trophy"></i> Employees Of the Month</h1>

                </div>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif
            <div class="row tile">
                <div class="col-md-12">
                    @foreach($eom as $e)
                    <div class="col-md-4"  >
                        <div class="card" style="height: 400px; margin-top: 30px;">
                            <center> <img class="" width="250px;" height="300" src="{{ URL::To('storage/app/public/images/'.$e->image) }}" alt="Card image"></center>
                            <div class="card-body">
                                <center><strong>Employee of the Month</strong></center> 
                                <center><strong> <p class="card-text">{{$e->month}}</p></strong></center> 
                                <center> <strong><p class="card-text">{{$e->empname}}</p></strong></center> 

                                <center> <p class="card-text">Department {{$e->department}}</p></center> 


                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </main>




        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}


    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>