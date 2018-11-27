<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title> Upload Category Management</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

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
                <h1 class="heading_title"><i class="fa fa-list "></i> Upload Category Management </h1>
            </div>
            <a href="{{url('/upload/category/index')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Categories</a>   
        </div>
        <div class="row  tile">
            <div class="col-md-12">
                <form action="{{url('/upload/category/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Category Name</label>
                                            <input type="text" name="name" id="name" placeholder="Category Name" class="form-control" required="">

                                        </div>
                                    </div>
                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Category Type</label>
                                            <select class="form-control" name="type" required="">
                                                <option value="">Category Type</option>
                                                <option value="file">Upload/Download</option>
                                                <option value="text">Policy</option>
                                                <option value="press">Press Release</option>
                                                <option value="announcement">Announcement</option>
                                                <option value="diwali">Diwali Celebration</option>
                                            </select>

                                        </div>
                                    </div>
                                    <input type="hidden" name="addedby" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="sip" value="{{\Request::ip()}}">
                                    <input type="hidden" name="status" value="Active">




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


</body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

