<!DOCTYPE html>
<html lang="en">


    <head>

        <title>IIFM MIS</title>


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

            @if(Session::has('message'))
            <div id="alert" class="alert alert-success">{{ Session::get('message') }}
            </div>
            @endif

            <div class="row">
                @foreach($official_datas as $official_data)
                <div class="col-md-12">
                    @if($official_data->profile=='')
                    <div class="col-md-3">
                        <div class="card tile" style="height: 320px;">
                            <img class="" width="100%" height="200" src="{{ URL::To('public/images/usser.png') }}" alt="Profile image">
                            <div class="card-body">
                                <h4 class="card-title" style="font-family: Times New Roman;text-align: center;"></h4>

                                <p class="card-text" style="text-align: center">
                            </div>
                        </div> 
                    </div>
                    @else
                    <div class="col-md-3">
                        <div class="card tile" style="height: 320px;">
                            <img class="" width="100%" height="200" src="{{URL::To('storage/app/profile/'.$official_data->profile)}}" alt="Profile image">
                            <div class="card-body">
                                <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$official_data->name}}</h4>
                                <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$official_data->designation}}</h4>
                            </div>
                        </div> 
                    </div>
                    @endif
                    <div class="col-md-9 tile">
                        <h3 class="tile-title" style="font-family: Times New Roman">OFFICIAL INFORMATION  </h3>

                        <table class="table">
                            <tr>
                                <th>Email ID</th>
                                <td>{{$official_data->email}}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td> {{$official_data->mobile}}</td>
                            </tr>
                            <tr>
                                <th>Employee ID</th>
                                <td>IIFM{{ str_pad($official_data->user_id,4,"0",STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td> {{$official_data->department}}</td>
                            </tr>
                            <tr>
                                <th>Location/Centre</th>
                                <td> {{$official_data->locationcentre}}</td>
                            </tr>
                            <tr>
                                <th>Date Of Joining</th>
                                <td> {{$official_data->doj}}</td>
                            </tr>

                        </table>

                    </div>  
                </div>
                @endforeach
            </div>
            <!-- url('storage/app/profile/'.$user->profile)  -->

            <div class="row">
                <div class="col-md-12 tile">
                    <h3 class="tile-title" style="font-family: Times New Roman">EDUCATIONAL INFORMATION  </h3>
                    <table class="table-responsive table"  width="100%">

                        <thead >
                            <tr>
                                <th>#</th>
                                <th >Course Name</th>
                                <th >College/Institution</th>
                                <th>Board/University</th>
                                <th>Start Year</th>
                                <th>End Year</th>
                                <th>Specialization</th>
                                <th>Percentage/Grades</th>
                                <th>Certificate</th>
                            </tr>
                        </thead><?php $i = 1; ?>


                        <tbody>
                            @foreach($educational_datas as $educational_data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$educational_data->education}}</td>
                                <td>{{$educational_data->schoolname}}</td>
                                <td>{{$educational_data->board}}</td>
                                <td>{{$educational_data->strtyear}}</td>
                                <td>{{$educational_data->endyear}}</td>
                                <td>{{$educational_data->specialization}}</td>
                                <td>{{$educational_data->percentage}}</td>
                                <td>
                                    @if(($educational_data->certificate)!='')
                                    <a href="{{ URL::To('storage/app/education/'.$educational_data->certificate) }}" target="_blank"><img src="{{ URL::To('storage/app/education/'.$educational_data->certificate) }}"  height="50px" width="50px"></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 tile">
                    <h3 class="tile-title" style="font-family: Times New Roman">WORK EXPERIENCE(S)</h3>
                    <table class="table-responsive table" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="10%">Company Name</th>
                                <th width="10%">Designation</th>
                                <th width="10%">From</th>
                                <th width="10%">To</th>
                                <th width="20%">Company Address</th>
                                <th width="10%">Offer/Appointment Letter</th>
                                <th width="10%" align="center">Relieving/Experience Letter</th>  
                            </tr>
                        </thead>
                        <?php $J = 1; ?>

                        <tbody>
                            @foreach($work_datas as $work_data)
                            <tr>
                                <td>{{$J++}}</td>
                                <td>{{$work_data->company}}</td>
                                <td>{{$work_data->designation1}}</td>
                                <td>{{$work_data->fromdate}}</td>
                                <td>{{$work_data->todate}}</td>
                                <td>{{$work_data->address}}</td>
                                <td>
                                    @if(($work_data->offerletter)!='')
                                    <a href="{{ URL::To('storage/app/professional/'.$work_data->offerletter) }}" target="_blank"><img src="{{ URL::To('storage/app/professional/'.$work_data->offerletter) }}" alt="Click Here"  height="50px" width="50px">
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if(($work_data->relievingletter)!='')
                                    <a href="{{ URL::To('storage/app/professional/'.$work_data->relievingletter) }}" target="_blank"><img src="{{ URL::To('storage/app/professional/'.$work_data->relievingletter) }}" alt="Click Here"  height="50px" width="50px">
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 tile">
                    <h3 class="tile-title" style="font-family: Times New Roman">PERSONAL INFORMATION </h3>

                    <table class="table" width="100%">
                        @foreach($personal_datas as $personal_data)
                        <tr>
                            <th>Gender</th>
                            <td>{{$personal_data->gender}}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{$personal_data->dob}}</td>
                        </tr>
                        <tr>
                            <th>Current Address</th>
                            <td>{{$personal_data->cstreet}} {{$personal_data->ccity}} {{$personal_data->cstate}} </td>
                        </tr>
                        <tr>
                            <th>Permanent Address</th>
                            <td>{{$personal_data->pstreet}} {{$personal_data->pcity}} {{$personal_data->pstate}}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{$personal_data->mobile}}</td>
                        </tr>
                        <tr>
                            <th>Alternate Contact Number</th>
                            <td>{{$personal_data->altno}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 tile">
                    <h3 class="tile-title" style="font-family: Times New Roman">FAMILY INFORMATION  </h3>
                    @foreach($family_datas as $family_data)
                    <table class="table">

                        <tr>
                            <th>Father Name</th>
                            <td>{{$family_data->fname}}</td>
                        </tr>
                        <tr>
                            <th>Father's Occuption</th>
                            <td>{{$family_data->foccup}}</td>
                        </tr>
                        <tr>
                            <th>Father's Contact Number</th>
                            <td>{{$family_data->fcontact}}</td>
                        </tr>
                        <tr>
                            <th>Mother Name</th>
                            <td>{{$family_data->mname}}</td>
                        </tr>
                        <tr>
                            <th>Mother's Occuption</th>
                            <td>{{$family_data->moccup}}</td>
                        </tr>
                        <tr>
                            <th>Mother's Contact Number</th>
                            <td>{{$family_data->mcontact}}</td>
                        </tr>
                        <tr>
                            <th>Marital Status</th>
                            <td> {{$family_data->maritalstatus}}</td>
                        </tr>
                        <tr>
                            <th>Spouse Name</th>
                            <td>{{$family_data->spname}}</td>
                        </tr>
                        <tr>
                            <th>Spouse Occuption</th>
                            <td>{{$family_data->spoccup}}</td>
                        </tr>
                        <tr>
                            <th>Marriage Anniversery Date</th>
                            <td>{{$family_data->anniversary}}</td>
                        </tr>

                    </table>
                    @endforeach

                </div>
            </div>
        </main>




        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}


    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>