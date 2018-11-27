<!DOCTYPE html>
<html lang="en">

    <head>

        <title>IIFM MIS - Leave Management</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    <h4><i class="fa fa-th-list"></i> Leave Management </h4>
                </div>
                <!--   <a href="{{url('/leave-view')}}/{{Auth::id()}}" class="btn btn-primary fa fa-eye">View Your Leaves</a> -->
            </div>
            <div class="row">

                <form action="{{url('/leave-store')}}" method="post" autocomplete="off" id="leave_form">

                    {{ csrf_field() }}
                    <div id="official_info" class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <h5  style="color: #009688; text-align: center;"><p class="fa fa-calendar"> Leave/Comp-off Application Form</p></h5>
                                <div class="row">

                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Leave Start Date</label></strong>  
                                            <input class="form-control" id="leavefrom" name="leavefrom" type="text" aria-describedby="emailHelp" placeholder="Start Date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong> <label for="">Leave End Date</label></strong>
                                            <input class="form-control" id="leaveto" name="leaveto" type="text" aria-describedby="emailHelp" placeholder="End Date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                        <div class="form-group">
                                            <strong><label for="">Total Leaves (In Days)</label></strong>    
                                            <input class="form-control" id="totdays" name="totdays" type="text" aria-describedby="emailHelp" placeholder="Auto Calculated" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group ">
                                            <strong>  <label for="">Leave Type</label></strong><br>
                                            <input class="leaveSelect"  type="radio" value="Comp Off" name="leaveoff[]" id="leave_compoff"> Compensatory Off<br><br>
                                            <input class="leaveSelect radio_hc" type="radio" value="Casual Leave" name="leaveoff[]"> Casual Leave <br><br>
                                            <input class="leaveSelect radio_hc" type="radio" value="Half day Leave" id="halfday" name="leaveoff[]"> Half day Leave

                                        </div>
                                    </div>
                                    <div class="col-md-9"> 
                                        <div class="form-group">
                                            <strong><label for="">Reason</label></strong>
                                            <textarea class="form-control " name="reason" id="reason" rows="5" placeholder="Explain your reason for leave" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 compoff"> 
                                        <h5 style="font-weight:bold;color: red!important; margin-bottom: 10px;  font-family: Times New Roman">Select Sunday Date against Comp off (In case of comp off only)</h5>
                                        <input type="text" class="form-control" name="agdcompoff" id="agdcompoff" placeholder="Pic a date" required="">
                                    </div>
                                    <div class="col-md-6"> 
                                    </div>
                                    <br>
                                    <div class="col-lg-12" style="padding-bottom:0; margin-bottom:10px;">
                                        <h3 style="color:#135cb0; margin-top: 20px; font-family: Times New Roman">Select Reporting Manager(s) <font style="font-size:14px; color:#FF0000;">(Select Maximum 3)</font></h3>
                                    </div>
                                    <table>
                                        <tbody><tr><td>

                                                    @foreach($managers as $manager)

                                                    <p style="margin-right:20px; min-width:180px; float:left;"><input class="messageCheckbox"   type="checkbox" name="approvalfrom[]" id="approvalfrom" value="{{$manager->id}}"> {{$manager->name}}</p>
                                                    @endforeach


                                                </td></tr>
                                        </tbody></table>

                                </div>
                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit" id="leave_submit">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

        </main>
        <!--   {!!View('partials.include_js')!!} -->

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('js/main.js') }}" ></script>


        <script>
$(document).ready(function () {

    var $datepicker1 = $("#leavefrom");
    var $datepicker2 = $("#leaveto");
    var $datepicker3 = $("#agdcompoff");

    $datepicker1.datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onClose: function () {
            var fromDate = $datepicker1.datepicker('getDate');
            var currentDate = new Date();
            var curdatecheck = new Date(currentDate - fromDate);
            var firstdate = curdatecheck / 1000 / 60 / 60 / 24;
            if (firstdate > 1) {

            }
            $(this).prop("readOnly", true);
        },
    });

    $datepicker2.datepicker({
        dateFormat: 'yy-mm-dd',

        onClose: function () {

            var fromDate = $datepicker1.datepicker('getDate');
            var toDate = $datepicker2.datepicker('getDate');

            // date difference in millisec
            var diff = new Date(toDate - fromDate);
            // date difference in days
            var days = diff / 1000 / 60 / 60 / 24;

            // alert(days);
            if (fromDate == null) {
                alert('Please Select Start Date First');
                document.getElementById('leaveto').value = null;
                document.getElementById('totdays').value = null;
            } else if (days < 0 || days > 100 && fromDate != '') {
                alert('To date should be onward date');
                document.getElementById('leaveto').value = null;
                document.getElementById('totdays').value = null;
            } else {

                if ($('#halfday').prop('checked')) {
                    document.getElementById('totdays').value = days + 0.5;
                } else {
                    document.getElementById('totdays').value = days + 1;
                }

            }
            $(this).prop("readOnly", true);
        }
    });

    $('#halfday').on('click', function () {
        if ($(this).prop("checked") == true) {
            var leavedays = $('#totdays').val();
            //alert("Checkbox is checked.");
            if (leavedays == '') {
                alert('Please Select Leave-Start and Leave-End Dates');
            } else {
                $('#totdays').val(leavedays - 0.5);
            }
        } else if ($(this).prop("checked") == false) {
            var leavedays = $('#totdays').val();
            var hday = 0.5;
            var leaveday_new = +leavedays + +hday;
            $('#totdays').val(leaveday_new);
        }

    });

    // Enable Sunday only
    $datepicker3.datepicker({
        minDate: -14,
        maxDate: 0,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: enableSUNDAYS
    });

    // Custom function to enable SUNDAY only in jquery calender
    function enableSUNDAYS(date) {
        var day = date.getDay();
        return [(day == 0), ''];
    }

});
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#leave_form").submit(function () {


                    if ($('.messageCheckbox').filter(':checked').length < 1) {
                        alert("Select Atleast Two ApprovalFrom");
                        return false;
                    }
                    if ($('.leaveSelect').filter(':checked').length < 1) {
                        alert("Select Atleast One Leave Type");
                        return false;
                    }
                });

            });
        </script>


        <script type="text/javascript">
            $(document).ready(function () {
                $('.compoff').hide();

                $('#leave_compoff').click(function () {
                    $('#agdcompoff').prop('required', true);
                    $('.compoff').show();
                });

                $('.radio_hc').click(function () {
                    $('#agdcompoff').prop('required', false);
                    $('.compoff').hide();
                });

            });
        </script>
    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT
    </html>
    
