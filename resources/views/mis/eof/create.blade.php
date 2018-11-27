<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title>Employee Of the Month</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


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
                <h1 class="heading_title"><i class="fa fa-trophy "></i> Hall Of Fame </h1>
            </div>
            <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
        </div>
        <div class="row  tile">
            <div class="col-md-12">
                <form action="{{url('/hall-of-fame/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employee Name</label>
                                            <select class="form-control" id="empname" name="empname" required="">
                                                <option value="">Select Employee</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->user_id}}">{{strtoupper($user->name)}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Month</label>
                                            <input type="text" class="form-control" name="month" id="month">
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Upload Image</label>
                                            <input class="form-control" id="file" name="image" onchange="return fileValidation();" type="file" aria-describedby="emailHelp" placeholder="Upload Image" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Department</label>
                                            <input type="text" name="department" id="department" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control capitalize char-only" rows="4" name="description" id="description" placeholder="Description" ></textarea>
                                        </div>
                                    </div>
                                </div>
                        </li>
                    </ul>

                    <div class="tile-footer">
                        <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none">  Submit</button>
                    </div>
                </form> 
            </div>
        </div>

    </main>


    <!-- Essential javascripts for application to work-->
    <!--  {!!View('partials.include_js')!!} -->
    <script src="{{ asset('js/main.js') }}" ></script>

    <script src="https://rawgit.com/zorab47/jquery.ui.monthpicker/master/jquery.ui.monthpicker.js"></script>
    <script>

                                                $(function () {
                                                    $('#month').monthpicker({changeYear: true, dateFormat: 'MM yy'});
                                                });

                                                function fileValidation() {
                                                    var fileInput = document.getElementById('file');
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
    <script type="text/javascript">
        $('#empname').on('change', function () {
            var id = $(this).val();
            $.get("{{url('employee-department')}}/" + id, function (data) {
                $('#department').val(data);
                // alert(data);
            });
        });
    </script>
</body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

