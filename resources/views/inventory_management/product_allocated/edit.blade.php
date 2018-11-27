<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Product Assignment Management</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    <h1><i class="fa fa-tasks "> Product Assignment Management </i></h1>
                </div>
                <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>
            </div>
            <div class="row  tile">
                <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
  @foreach($assigned_product as $assigned)
                <div class="col-md-12">
                    <form action="{{route('assign.update',$assigned->id)}}" method="post" enctype="multipart/form-data"  autocomplete="off">
                         {{method_field('PUT')}}
                        {{ csrf_field() }}
                        <ul style="list-style-type: none;" class="education_form">
                            <li>
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Code</label>
                                                <select class="form-control" name="pcode">
                                                    <option value="{{$assigned->id}}">{{$assigned->pcode}} {{$assigned->pro_name}} {{$assigned->pro_desc}}</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->pcode}} {{$product->pname}} {{$product->pmodel}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      
                                        <input type="hidden" name="assignedby" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="sip" value="{{\Request::ip()}}">
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Assign To</label>
                                                <select class="form-control" name="assign_to" required="" id="category" required="">
                                                    <option value="{{$assigned->user_id}}">{{$assigned->username}}</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->user_id}}">{{strtoupper($user->username)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Assign Date</label>
                                                <input class="form-control datepicker" id="pmodel" name="date" type="text" aria-describedby="emailHelp" placeholder="Assign Date" required value="{{$assigned->date}}">

                                            </div>
                                        </div>
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Location/Centre</label>
                                                <select class="form-control" name="location" required="" id="category" required="">
                                                    <option value="{{$assigned->loc_id}}">{{$assigned->loc_name}}</option>
                                                    @foreach($locations as $location)
                                                    <option value="{{$location->id}}">{{strtoupper($location->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Remark/Condition</label>  <textarea class="form-control" name="remark" placeholder="Remark/Condition" required rows="4">{{$assigned->remark}}</textarea>
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
                  @endforeach
            </div>

        </main>



        <script src="{{ asset('js/main.js') }}" ></script>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(function () {
                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true});
            });
        </script>

        <!-- Essential javascripts for application to work-->
    
        <script type="text/javascript">
            $(document).ready(function () {
                $('#category').on('change', function () {
                    var category = this.value;
                    $.ajax({
                        url: "/get-product/" + category,
                        type: 'GET',
                        dataType: 'json',
                        success: function (result) {

                            //console.log(result);
                            $('#productdesc').empty();
                            $('#productdesc')
                                    .append($("<option>" + 'Select Product Description' + "</option>"));
                            $.each(result, function (key, value) {
                                //console.log(value['pdescription']);  
                                $('#productdesc')
                                        .append($("<option value=" + value['id'] + ">" + value['pdescription'] + "</option>"));

                            });
                            result = '';

                        }});
                });

            });
        </script>
    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

