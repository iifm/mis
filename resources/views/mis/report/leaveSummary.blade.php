<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Leave Summary Report</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js
        "></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js "></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css
              ">

    </script>
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
                <h1 class="heading_title"><i class="fa fa-file-excel-o"></i> Leave Report Summary</h1>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form action="{{url('/leave-report/summary/data')}}" method="get" autocomplete="off">
                            {{csrf_field()}}
                            <table width="50%" style="min-width:600px; ">
                                <thead>
                                    <tr>
                                        <th width="20%"><label class="form-group">TO</label></th>
                                        <th width="20%"><label class="form-group">FROM</label></th>

                                        <th width="20%"><label class="form-group"></label></th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control " placeholder="{{date('j F Y',strtotime(date('Y-04-01')))}}" name="strtDate" readonly></td>
                                        <td><input type="text" class="form-control datepicker" placeholder="End Date" name="endDate"></td>

                                        <td align=""><input type="submit" name="" class="btn btn-primary" style="margin-left: 25px; width: 100px;"> </td>
                                    </tr>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <div class="row" style="margin-top: 50px;">
                        <div class="col-sm-12 ">
                            <?php $i = 1; ?>
                            <?php if (Session::has('message')) { ?>
                                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                                </div><?php } ?>

                            <table class="table table-hover table-stripped" id="table" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Leave Generated</th>
                                        <th>Leave Taken</th>
                                        <th>Leave Balance</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($leaveSummaryDetails as $leaveSummaryDetail)
                                    <tr role="row" class="odd">
                                        <td>{{$i++}}</td>
                                        <td>{{ucwords(strtolower($leaveSummaryDetail['username']))}}</td>
                                        <td>{{$leaveSummaryDetail['leave_generated']}}</td>
                                        @if($leaveSummaryDetail['leave_taken']!='')
                                        <td>{{$leaveSummaryDetail['leave_taken']}}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                        <td>{{$leaveSummaryDetail['leave_balance']}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>




    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('js/main.js') }}" ></script>

    <script>
$(function () {
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
    </script>

    <script type="text/javascript">
        $('#table').DataTable({
            dom: 'lBfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o">  Export To Excel</i>',
                    titleAttr: 'Excel'
                },

                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa fa-copy">  Copy</i>',
                    titleAttr: 'Copy'

                },
            ]
        });
    </script>

</body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>