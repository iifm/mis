<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title>Edit Policy</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
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
                @foreach($policydata as $data)
                <h1 class="heading_title"><i class="fa fa-edit "></i> Edit {{$data->name}}</h1>
            </div>
            @endforeach
        </div>
        <div class="row  tile">
            <div class="col-md-12">
                <form action="{{url('/policy/update')}}/{{$id}}" method="post" enctype="multipart/form-data"  autocomplete="off">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-12 description" >
                                        <div class="form-group">
                                            @foreach($content as $data)
                                            <textarea class="form-control capitalize char-only" name="description" id="description" placeholder="Description" >{{$data->description}}</textarea>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="" id="viewImg"   />

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
    {!!View('partials.include_js')!!}
    <script type="text/javascript">
CKEDITOR.replace('description', {
    height: 300
});
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file").change(function () {
            readURL(this);
        });
    </script>

</body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

