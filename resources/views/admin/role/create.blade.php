<!DOCTYPE html>
<html lang="en">

    <head>

        <title> Role Management</title>

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
                <h1 class="heading_title"><i class="fa fa-tasks "></i> Role Management </h1>
            </div>
            <a href="{{url('/role/index')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Roles</a>   
        </div>
        <div class="row  tile">
            <div class="col-md-12">
                <form action="{{url('/role/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Designation</label>
                                            <input type="text" name="name" id="name" placeholder="Enter Designation" class="form-control" required="">

                                        </div>
                                    </div>
                                    <input type="hidden" name="addedby" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="updatedby" value="{{Auth::user()->id}}">

                                </div>
                            </div>      
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Role Name</label>
                                            <select class="form-control demoSelect" name="access_zone[]"  multiple="" required="">
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Upload Category </label>
                                            <select class="form-control demoSelect" name="upload_category_option[]"  multiple="" required="">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>      
                        </li>
                    </ul>

                    <div class="tile-footer">
                        <button  class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none;">  Submit</button>

                    </div>
                </form> 
            </div>
        </div>

    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
    <script type="text/javascript" src="{{URL::To('public/js/select2.min.js')}}"></script>
    <script type="text/javascript">
$('.demoSelect').select2();
    </script>

</body>

</html>

