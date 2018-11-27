<!DOCTYPE html>
<html lang="en">

    <head>
        <title>IIFM MIS</title>

        <!-- Main CSS-->
        {!!View('partials.include_css')!!}

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
                    <h4><i class="fa fa-tasks"></i>Product Assignment Management  </h4>

                </div>
                <a href="{{route('assign.create')}}" class="btn btn-primary fa fa-plus">Assign Product</a>
            </div>
            <div class="">
                <div class="col-md-12">

                    <div class="tile">
                        <div class="tile-body">

                                    <?php $i = 1; ?>
                                    <?php if (Session::has('message')) { ?>
                                        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                                        </div><?php } ?>
                                    <table class="table"  id="sampleTable" role="grid" width="100%">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Product Code</th>
                                                <th>Assigned To</th>   
                                                <th>Assign Date</th>
                                                <th>Location/Centre</th>
                                                <th>Remark/Condition</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($assign as $value)
                                            <tr role="row" class="odd">
                                                <td><?= $i++; ?></td>
                                                <td>{{$value->pcode}}</td>
                                                <td>{{$value->username}}</td> 
                                                <td>{{date('j F Y',strtotime($value->date))}}</td>
                                                <td>{{$value->loc_name}}</td>
                                                <td>{{$value->remark}}</td>
                                              
                                                <td>
                                                    <a href="{{route('assign.edit',$value->id)}}" class="btn btn-primary fa fa-pencil"></a>
                                                    <form id="delete-form-{{$value->id}}" method="post" action="{{route('assign.destroy',$value->id)}}" >
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" value="" class="fa fa-trash btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');"></button>  
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                               
                         
                        </div>
                    </div>
                </div>
            </div>
        </main>




        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}


    </body>

    <!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>