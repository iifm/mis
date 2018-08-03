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
      <h4>
        <i class="fa fa-th-list"></i> Conveyance Management 
        <a href="{{url('/conveyance')}}" class="btn btn-primary fa fa-plus"> ADD Conveyance</a>
        <a href="{{url('/conveyance/policy')}}" class="btn btn-primary fa fa-eye"> View Conveyance Policy</a>
      </h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
              <div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                </div><?php } ?>
      
                  <table class="table table-hover table-stripped" id="sampleTable" role="grid" >
                     <thead>
                        <tr role="row">
                          <th>#</th>
                          <th>Conveyance Date</th>
                          <th>Travel From</th>
                          <th >Travel To</th>
                          <th>Travel Mode</th>
                          <th>Distance</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                      @foreach($conveyance as $con)
                    <tbody>
                      <tr role="row" class="odd">
                        <td><?= $i++;?></td>
                        <td>{{$con->con_date}}</td>
                        <td>{{$con->disfrom}}</td>
                        <td>{{$con->disto}}</td>
                        @if($con->mode=="3.5")
                        <td>CAR</td>
                        @elseif($con->mode=="2.5")
                         <td>BIKE</td>
                         @else
                         <td>{{$con->mode}}</td>
                         @endif
                        <td>{{$con->distance}}</td>
                        <td>{{$con->amount}}</td>
                        <td>{{$con->status}}</td>
                        <td>
                          <a href="" class="btn btn-primary fa fa-pencil"></a>
                          <a href="" onclick="return confirm('Are You Sure Want to delete this?')" class="btn btn-danger fa fa-trash"></a>
                        </td>
                   </tr>
                </tbody>
                 @endforeach
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
</main>

    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

 </body>

</html>