<!DOCTYPE html>
<html lang="en">

    <head>
        <title>View Conveyance</title>
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
                    <h4 class="heading_title">
                        <i class="fa fa-th-list"></i> Conveyance Management     
                    </h4>
                </div>
                <a href="{{url('/conveyance')}}" class="btn btn-primary fa fa-plus pull-right"> ADD Conveyance</a>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <?php $i = 1; ?>
                                        <?php if (Session::has('message')) { ?>
                                            <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                                            </div><?php } ?>
                                        <div id="success_msg" class="alert alert-success" style="display: none;">

                                        </div>
                                        <h3 style="margin-bottom: 20px">This month total Conveyance : <span  class="fa fa-rupee">  {{$monthConveyance}} </span></h3>
                                        <table class="table table-hover table-stripped" id="sampleTable" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Conveyance Date</th>
                                                    <th>Travel From</th>
                                                    <th >Travel To</th>
                                                    <th>Travel Mode</th>
                                                    <th>Image</th>
                                                    <th>Distance</th>
                                                    <th>Amount</th>

                                                    <th>Action</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($conveyance as $con)
                                                <tr role="row" class="odd">
                                                    <td><?= $i++; ?></td>
                                                    <td>{{date('j F Y',strtotime($con->con_date))}}</td>
                                                    <td>{{$con->disfrom}}</td>
                                                    <td>{{$con->disto}}</td>
                                                    @if($con->mode=="3.5")
                                                    <td>CAR</td>
                                                    @elseif($con->mode=="2.5")
                                                    <td>BIKE</td>
                                                    @else
                                                    <td>{{$con->mode}}</td>
                                                    @endif

                                                    <td> 
                                                        @if($con->uploadcimg)
                                                        <a href="{{URL::To('storage/app/conveyance')}}/{{$con->uploadcimg}}" target="_blank">
                                                            <img src="{{URL::To('storage/app/conveyance')}}/{{$con->uploadcimg}}" height="50px" width="50px">
                                                        </a> @endif
                                                    </td>

                                                    <td>{{$con->distance}}</td>
                                                    <td>{{$con->amount}}</td>
                                                    <td align="right"> <a onclick="return confirm('Are you sure you want to delete this item?')" href="{{url('/conveyance/delete')}}/{{$con->id}}" class="btn btn-danger btn-sm fa fa-trash"></a> </td>
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
        <script type="text/javascript">
            $(document).ready(function () {
                $('.approve').on('click', function () {
                    var id_action = $(this).val();
                    var con_id = $(this).attr('id');
                    var approver = $('#approver').val();
                    var appr_amount = $('#approved_amount_' + con_id).val();
                    $.get("{{url('/conveyance-approve')}}/" + id_action + "/" + appr_amount + "/" + approver, function (data) {
                        alert(data);
                        location.reload();

                    });
                });
                $('.disapprove').on('click', function () {
                    var id_action = $(this).val();
                    var con_id = $(this).attr('id');
                    var approver = $('#approver').val();
                    var appr_amount = $('#approved_amount_' + con_id).val();
                    $.get("{{url('/conveyance-approve')}}/" + id_action + "/" + appr_amount + "/" + approver, function (data) {
                        alert(data);
                        location.reload();
                    });
                });
                $('.action_again').on('click', function () {
                    var action_again = $(this).val();
                    $.get("{{url('/conveyance/re-action')}}/" + action_again, function (data) {
                        alert(data);
                        location.reload();
                    });
                })
            });
        </script>
    </body>

</html>