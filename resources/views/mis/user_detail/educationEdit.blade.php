<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:13 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title>IIFM MIS</title>



        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    </head>


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
                <h1 class="heading_title"><i class="fa fa-graduation-cap "></i> Edit Educational Information</h1>
            </div>
            <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
        </div>
        <div class="row  tile">
            <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
            @foreach($edu_datas as $data)

            <div class="col-md-12">
                <form action="{{url('/user/education/update')}}/{{$id}}/{{$user_id}}" method="post" autocomplete="off" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Name</label>
                                            <select class="form-control" name="edu_option" id="edu_option" required="">
                                                <option value="{{$data->education_id}}">{{$data->education_name}}</option> 
                                                @foreach($education_options as $edu)
                                                <option value="{{$edu->id}}">{{$edu->name}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School/Institution</label>
                                            <input type="text" name="schoolname" value="{{$data->schoolname}}" class="form-control char-only capitalize" id="schoolname" placeholder="School/Institution" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Board/University</label>
                                            <input class="form-control capitalize char-only" value="{{$data->board}}" id="board" name="board" type="text" aria-describedby="emailHelp" placeholder="Board/University" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-3 "> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Specialization</label>
                                            <input class="form-control capitalize char-only" value="{{$data->specialization}}" id="specialization" name="specialization" type="text" aria-describedby="emailHelp" placeholder="Specialization" required="">
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Start Year</label>
                                            <input class="form-control date-own" id="strtyear" value="{{$data->strtyear}}" name="strtyear" type="text" aria-describedby="emailHelp" placeholder="Start Year" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">End Year</label>
                                            <input class="form-control date-own" id="endyear" value="{{$data->endyear}}" name="endyear" type="text" aria-describedby="emailHelp" placeholder="End Year" required="">
                                        </div>
                                    </div>


                                    <div class="col-md-3 "> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Percentage/Grades</label>
                                            <input class="form-control numbers-only" id="percentage" value="{{$data->percentage}}" maxlength="2" name="percentage" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 "> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Upload Certificate/Degree</label>
                                            <input class="form-control" id="certificate" onchange="return fileValidation()" name="certificate" type="file" aria-describedby="emailHelp" placeholder="Upload Certificate/Degree">
                                        </div>
                                    </div>
                                    <input  id="addedby" name="addedby" type="hidden" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="tile-footer">
                        <button class="btn btn-success fa fa-save" type="submit" style="background: #009688;border: none;">  Submit</button>

                    </div>
                </form> 
            </div>
            @endforeach
        </div>

    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}




    <script type="text/javascript">
        $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true,
        });
    </script>

    <script>
        function fileValidation() {
            var fileInput = document.getElementById('certificate');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            } else {
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '" height="150px" width="150px"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>


</body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

