<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Conveyance</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <style type="text/css">
            .formdiv{border: 2px solid #e1e1e1;}
            .input_fields_wrap div{float: left !important; margin-bottom:10px;  }
            .input_fields_wrap input{ height: 30px; }
        </style>

        <script>
            $(document).ready(function () {
                var max_fields = 10; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID
                var x = 1; //initlal text box count
                $(add_button).click(function (e) {
                    //on add input button click

                    e.preventDefault();
                    $("#tcount").val(x);

                    if (x < max_fields) { //max input box allowed
                        $(wrapper).append(
                                '<div class="row formdiv" id="formdiv' + x + '"><div class="col-md-12" style="padding:0"><div class="col-md-3 datepic' + x + '"><h5>Date</h5><input class="form-control datepick" type="text" id="datepicker_' + x + '" name="date' + x + '" value="" placeholder="Click Here" required></div><div class="col-md-3"><h5>Reason</h5><input class="form-control" type="text" name="reason' + x + '" id="reason_' + x + '" placeholder="Reason/remarks" required></div><div class="col-md-3"> <h5>Travel From</h5><input class="form-control" type="text" placeholder="Travel from (Eg. Kailash Colony)" name="travelfrom' + x + '" id="travelfrom_' + x + '" required></div><div class="col-md-3"><h5>Travel To</h5> <input class="form-control" type="text" placeholder="Travel to (Eg. Vasant Kunj)" name="travelto' + x + '" id="travelto_' + x + '" required></div></div><div class="col-md-12" style="padding:0"><div class="col-md-3"><h5>Distance</h5><input class="form-control disclass ratefind" type="text"  placeholder="(Eg. 20)" name="distance' + x + '" id="distance_' + x + '" required></div><div class="col-md-3"> <h5>Mode</h5><select class="form-control smode ratefind" name="mode' + x + '" id="mode_' + x + '" required><option value="">Select Mode</option><option name="mode' + x + '" id="mode_' + x + '" value="3.5">CAR</option><option name="mode' + x + '" id="mode_' + x + '" value="2.5">BIKE</option><option name="mode' + x + '" id="mode_' + x + '" value="CAB">CAB</option><option name="mode' + x + '" id="mode_' + x + '" value="RIKSHA">RIKSHA</option><option name="mode' + x + '" id="mode_' + x + '" value="BUS">BUS</option><option name="mode' + x + '" id="mode_' + x + '" value="METRO">METRO</option><option name="mode' + x + '" id="mode_' + x + '" value="AUTO">AUTO</option><option name="mode' + x + '" id="mode_' + x + '" value="Others">OTHERS</option></select></div><div class="col-md-3" class="amtf' + x + '" id="#amtcal_' + x + '"><h5>Amount</h5><input type="text" class="form-control amtc" name="amt' + x + '" id="amt_' + x + '" value="" placeholder="Amount"></div><div class="col-md-3" class="ratec' + x + '" id="#ratecal_' + x + '"><h5>Calculated(Amt.)</h5><input class="form-control" type="text" name="Rate' + x + '" id="Rate_' + x + '" value="" readonly required></div></div><div class="col-md-12" style="padding:0"><div id="billUpload' + x + '"  class="col-md-3"><input class="form-control input-md"  style="height:41px; line-height: 20px;" type="file" name="uploadfile' + x + '" id="fileToUpload' + x + '"  placeholder="Upload your Image"><h5 style="font-weight:bold;font-size: 13px;color:#203748;">Upload Bill(Only gif, png, jpg and pdf)</h5></div><a href="#"  class="remove_field btn btn-danger" id="' + x + '" >Remove Field</a></div></div>'
                                ); //add input box 
                        x++; //text box increment
                    }
                });



                $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                    e.preventDefault();
                    //get id 
                    var id = $(this).attr('id');
                    $('#formdiv' + id).remove();
                    x--;
                    //$("#tcount").val(x-1);
                })
                $('body').on('focus', ".datepick", function () {
<?php
$date = date("d");
if ($date <= '12') {
    $prevmonth = date('01 F Y', strtotime('-1 months'));
    ?>
                        $(this).datepicker({
                            dateFormat: 'dd MM yy',
                            minDate: "<?php echo $prevmonth; ?>",
                            maxDate: new Date(),
                            onSelect: function () {
                                $(this).prop("readOnly", true);
                            },
                        });
    <?php
} else {
    $currmonth = date('01 F Y');
    ?>
                        $(this).datepicker({
                            dateFormat: 'dd MM yy',
                            minDate: "<?php echo $currmonth; ?>",
                            maxDate: new Date(),
                            onSelect: function () {
                                $(this).prop("readOnly", true);
                            },
                        });
    <?php
}
?>
                    //$(this).prop( "disabled", true );
                });
                $(document).on('change', '.ratefind', function () {

                    var e_id = $(this).attr("id");
                    var res = e_id.split("_");
                    var scount = res[1];
                    var tmode = $('#mode_' + scount + ' > option:selected').text();

                    if (tmode == 'CAR' || tmode == 'BIKE') {
                        $('#billUpload' + scount).hide();
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('#amt_' + scount).prop("disabled", true);
                        var dis = $('#distance_' + scount).val();
                        if (tmode == 'CAR') {
                            var rate = 5;
                        } else {
                            var rate = 3;
                        }
                        var disc = dis * rate;
                        $('#Rate_' + scount).val(disc);
                    } else if (tmode == 'CAB' || tmode == 'OTHERS') {
                        $('#billUpload' + scount).show();
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;
                            $('#Rate_' + scount).val(disc);
                            $('#fileToUpload' + scount).prop("required", true);
                        });
                    } else {
                        $('#billUpload' + scount).hide();
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;
                            $('#Rate_' + scount).val(disc);

                        });
                    }
                });

                $(document).on('keyup', '.disclass', function () {

                    var e_id = $(this).attr("id");
                    var res = e_id.split("_");
                    var scount = res[1];
                    var tmode = $('#mode_' + scount + ' > option:selected').text();

                    if (tmode == 'CAR') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('#amt_' + scount).prop("disabled", true);

                        var dis = $('#distance_' + scount).val();
                        var disc = dis * 5;
                        //$('#mode1 > option:selected').val(disc);
                        var datastr = '&Rate' + scount + '=' + disc + '&varid=' + scount;

                        $.ajax({
                            type: "POST",
                            url: "calculate_new.php",
                            data: datastr,
                            cache: false,
                            success: function (data)
                            {
                                //alert(data);

                                $('#Rate_' + scount).val(data);

                            }
                        });
                    }

                    if (tmode == 'BIKE') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", true);
                        $('.amtf' + scount).show();
                        var dis = $('#distance_' + scount).val();
                        var disc = dis * 3;
                        //$('#mode1 > option:selected').val(disc);
                        var datastr = '&Rate' + scount + '=' + disc + '&varid=' + scount;

                        $.ajax({
                            type: "POST",
                            url: "calculate_new.php",
                            data: datastr,
                            cache: false,
                            success: function (data)
                            {
                                //alert(data);

                                $('#Rate_' + scount).val(data);

                            }
                        });
                    }

                    if (tmode == 'CAB') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);
                            $('#fileToUpload' + scount).prop("required", true);
                        });

                    }

                    if (tmode == 'RIKSHA') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);

                        });

                    }

                    if (tmode == 'BUS') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);

                        });

                    }

                    if (tmode == 'METRO') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);

                        });

                    }

                    if (tmode == 'AUTO') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);

                        });

                    }

                    if (tmode == 'OTHERS') {
                        $('#Rate_' + scount).val('');
                        $('#amt_' + scount).val('');
                        $('.amtfshow').show();
                        $('.amtf' + scount).show();
                        $('#amt_' + scount).prop("disabled", false);
                        $('#amt_' + scount).keyup(function () {
                            var amt = $(this).val();
                            var dis = $('#distance_' + scount).val();
                            var disc = amt;
                            //var datastr = '&Rate'+scount+'=' + disc + '&varid='+scount;

                            $('#Rate_' + scount).val(disc);

                        });
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {

                $("#submitbtn").hide();

                $("#addformbtn").click(function () {
                    $("#submitbtn").show();
                });
            });
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
                    <h4 class="heading_title">
                        <i class="fa fa-inr"></i> Conveyance Management

                    </h4> 
                </div>
                <a href="{{url('/conveyance/index')}}/{{Auth::id()}}" class="btn btn-primary fa fa-eye pull-right" >View All Conveyances
                </a>
            </div>
            <form action="{{url('/conveyance/store')}}" method="post" style="width:100%" enctype="multipart/form-data" autocomplete="off">
                {{ csrf_field() }}
                <div class="row tile" style="width:100%">
                    <div class="col-md-12">
                        <button class="add_field_button btn btn-primary" id="addformbtn">Add Fields</button>
                        <input id="tcount" type="hidden" value="" name="tcount" />  
                        <div class="input_fields_wrap" style="margin-top:20px; ">

                        </div>
                        <div class="tile-footer" id="submitbtn">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    <script src="{{ asset('js/main.js') }}" ></script>



</body>
</html>

