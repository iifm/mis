<!DOCTYPE html>
<html lang="en">

    <head>
        <title>IIFM MIS - Attendance</title>
        <!-- Main CSS-->
        {!!View('partials.include_css')!!}

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">

            function GetAddress() {
                //alert('g');
                var lat = parseFloat(document.getElementById("latitude").value);
                //alert(lat);
                var lng = parseFloat(document.getElementById("longitude").value);
                var latlng = new google.maps.LatLng(lat, lng);
                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({'latLng': latlng}, function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            //alert("Location: " + results[1].formatted_address);
                            document.getElementById("location").value = results[1].formatted_address;
                        }
                    }
                });
            }

        </script>


    </head>
    <body class="app sidebar-mini rtl" >
        <!-- Navbar-->
        {!!View('partials.header')!!}

        <!-- Sidebar menu-->
        {!!View('partials.sidebar')!!}

        <!-- Main Content-->
        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1 class="heading_title">
                        <i class="fa fa-th-list"></i> Attendance Management 
                    </h1>
                </div>
                <a href="{{url('/attendance-view')}}/{{Auth::id()}}" class="btn btn-primary fa fa-eye">View Attendance</a>
            </div>
            <div class="row">
                <div class="col-md-12">   
                    <div class="tile">
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if(Session::has('message'))
                                    <div id="alert" class="alert alert-success">{{ Session::get('message') }}</div>
                                    @endif
                                    <form method="post" action="{{url('/attendance/store')}}"  id="attendance_form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="member_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="date" value="{{date('Y-m-d')}}">
                                        <input type="hidden" name="time" value="{{date('H:i')}}">
                                        <input type="hidden" name="sip" value="{{\Request::ip()}}">
                                        <center> 
                                            <h3 class="fa fa-user"> Name: {{Auth::user()->name}}</h3>
                                        </center> 
                                        <center> 
                                            <h3 class="fa fa-calendar"> Date: {{date('Y-m-d H:i:s')}}</h3>
                                        </center>  
                                        <center> <label>Latitude </label> <input type="text"  name="latitude" id="latitude" ><br>
                                            <label>Longitude </label>  <input type="text" name="longitude" id="longitude"><br>
                                            <!--   <label>Address </label>  --><input type="hidden" name="location" id="location">
                                        </center>
                                        @if(Session::has('attendType'))
                                        <input type="hidden" name="type" id="type" value="{{Session::get('attendType')}}">
                                        @endif

                                        @if($showInTime!='')
                                        <center><h6 class="fa fa-clock-o">  IN TIME  {{$showInTime}}</h6></center> 
                                        @endif    
                                        @if($showOutTime!='')
                                        <center><h6 class="fa fa-clock-o">  OUT TIME  {{$showOutTime}}</h6></center>
                                        @endif
                                        @if(Session::has('attendType')) 
                                        @if(Session::get('attendType')=='ATTENDANCE FOR TODAY HAVE BEEN MARKED!!')
                                        <center>
                                            <h6>
                                                <input type="text" name="" value="{{Session::get('attendType')}}" readonly style="width: 400px; text-align: center; color: red;font-style: bold">
                                            </h6>
                                        </center>

                                        <center> 
                                            <button class="btn btn-success btn-lg fa fa-check" type="submit" style="margin-top: 20px;" disabled=""> Attendence Marked </button>
                                        </center>

                                        @else 

                                        <center> <button  class="btn btn-success btn-lg fa fa-check" type="submit" style="margin-top: 20px;"> MARK YOUR {{Session::get('attendType')}} TIME</button></center>

                                        @endif
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </main>




        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}

        <script>
            $(document).ready(function () {
                $('#attendRecorded').hide();
                if ("geolocation" in navigator) { //check geolocation available 
                    //try to get user current location using getCurrentPosition() method
                    navigator.geolocation.getCurrentPosition(function (position) {
                        $("#latitude").val(position.coords.latitude);
                        $("#longitude").val(position.coords.longitude);

                        GetAddress();
                    });

                } else {
                    alert("Browser doesn't support geolocation!");
                }
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#attendance_form').submit(function () {
                    if ($('#latitude').val() == '' && $('#longitude').val() == '') {
                        alert('Please Turn-On your Mobile Location and reload the page');
                        return false;
                    }
                });
            });
        </script>

    </body>
</html>