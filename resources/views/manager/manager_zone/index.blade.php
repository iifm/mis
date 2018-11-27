<!DOCTYPE html>
<html lang="en">

    <head>
        <title> Manager Zone</title>

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
                    <h1 class="heading_title"><i class="fa fa-users "></i> Team Members Details </h1>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <div class="tile-body">
                            <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                                <div class="row"><div class="col-sm-12">
                                        <div id="successMsg" class="alert alert-success" style="display: none;">

                                        </div>
                                        <?php $i = 1; ?>
                                        <?php if (Session::has('message')) { ?>
                                            <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                                            </div><?php } ?>
                                        <table id="sampleTable"  width="100%" class="table">
                                            <thead>

                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>User Name</th>
                                                    <th> Leave(s)</th>
                                                    <th> On-Duty(s)</th>
                                                    <th> Conveyance(s)</th>
                                                    <th> Attendance(s)</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($totalTeamMemberDetails as $totalTeamMemberDetail)
                                                <tr style="max-height: 100px;">
                                                    <td><?= $i++; ?></td>
                                                    <td>
                                                        <h6>{{$totalTeamMemberDetail['username']}} 
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/leave-view')}}/{{$totalTeamMemberDetail['user_id']}}" class="fa fa-eye btn btn-primary form-control"> View
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/on-duty/index')}}/{{$totalTeamMemberDetail['user_id']}}" class="fa fa-eye btn btn-sm btn-info form-control"> View
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/conveyance/index')}}/{{$totalTeamMemberDetail['user_id']}}" class="fa fa-eye btn btn-sm btn-warning form-control" style="color: white"> View
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/attendance-view')}}/{{$totalTeamMemberDetail['user_id']}}" class="fa fa-eye btn btn-sm btn-danger form-control"> View
                                                        </a>
                                                    </td>


                                                </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">

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


    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>