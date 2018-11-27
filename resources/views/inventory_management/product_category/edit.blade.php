<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>

        <title> Category Management </title>

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
                <h1 class="heading_title"><i class="fa fa-table "></i> Category Management </h1>
            </div>
            <a href="{{url('/product-categories/index')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Categories</a>   
        </div>
        <div class="row  tile">
            <div class="col-md-12">
                <form action="{{url('/product-categories/update')}}/{{$id}}" method="post" enctype="multipart/form-data"  autocomplete="off">

                    {{ csrf_field() }}
                    <ul style="list-style-type: none;" class="education_form">
                        <li>
                            @foreach($datas as $data)
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col-md-10"> 
                                        <div class="form-group">
                                            <label >Category Name</label>
                                            <input type="text" name="name" value="{{$data->name}}" id="name" placeholder="Category Name" class="form-control" required="">

                                        </div>
                                    </div>
                                    <input type="hidden" name="addedby" value="{{Auth::user()->id}}">
                                </div>
                            </div>  
                            @endforeach    
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

