<!DOCTYPE html>
<html lang="en">

    <head>
        <title>IIFM MIS - User Management</title>

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
                    <h1 class="heading_title"><i class="fa fa-users"></i> User Management </h1>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <div class="tile-body">
                            <div id="table" class="">

                                <div class="row"><div>
                                        <div id="successMsg" class="alert alert-success" style="display: none;">

                                        </div>
                                        <?php $i = 1; ?>
                                        <?php if (Session::has('message')) { ?>
                                            <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                                            </div><?php } ?>
                                        <table id="sampleTable"  width="100%">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th style="text-align: left;">Name</th>       
                                                    <th style="text-align: left;">Department</th>
                                                    <th style="text-align: left;">Designation</th>
                                                    <th style="text-align: left;">Location/Center</th>
                                                    <th style="text-align: left;">Active/Deactive</th>
                                                    <th style="text-align: left;">Details Editable</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($users as $user)
                                                <tr role="row" class="odd">
                                                    <td><?= $i++; ?></td>
                                                    <td style="text-align: left;">{{ucwords(strtolower($user->name))}}</td>
                                                    <td style="text-align: left;">{{$user->dept_name}}</td>
                                                    <td style="text-align: left;">{{$user->designation}}</td>
                                                    <td style="text-align: left;">{{$user->locationcentre}}</td>
                                                    <td style="text-align: left;">
                                                        @if($user->status=='Active')
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox" name="status" class="status" checked="true" id="{{$user->user_id}}" value="{{$user->user_id}},{{$user->status}}"><span class="flip-indecator" data-toggle-off="Deactive" data-toggle-on="Active" ></span>
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox" name="status" class="status" id="{{$user->user_id}}" value="{{$user->user_id}},{{$user->status}}"><span class="flip-indecator" data-toggle-off="Deactive" data-toggle-on="Active" ></span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($user->edit_option=='True')
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox" name="status" class="edit_option" checked="true" id="{{$user->user_id}}" value="{{$user->user_id}},{{$user->edit_option}}"><span class="flip-indecator" data-toggle-off="Disable" data-toggle-on="Enable" ></span>
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="toggle-flip">
                                                            <label>
                                                                <input type="checkbox" name="status" class="edit_option" id="{{$user->user_id}}" value="{{$user->user_id}},{{$user->edit_option}}"><span class="flip-indecator" data-toggle-off="Disable" data-toggle-on="Enable" ></span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td >
                                                        <a href="{{url('/user-details')}}/{{$user->user_id}}" class="btn btn-info fa fa-eye" title="View User"></a>

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
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('change', '.status', function () {
                    var value = $(this).val();
                    $.get("{{url('/update-user-status')}}/" + value, function (data) {
                        // console.log(data);
                        if (data) {
                            $('#successMsg').show();
                            $('#successMsg').html(data);
                        }
                    });
                });


                // $('.edit_option').change(function(){
                $(document).on('change', '.edit_option', function () {
                    var value = $(this).val();
                    $.get("{{url('/edit-user-details/option')}}/" + value, function (data) {

                        if (data) {
                            $('#successMsg').show();
                            $('#successMsg').html(data);
                        }
                    });
                });

            });
        </script>

    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>