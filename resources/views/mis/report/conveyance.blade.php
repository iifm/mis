<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>Conveyance Report</title>

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js
"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js "></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css
">

</script>
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
          <h1 class="heading_title"><i class="fa fa-file-excel-o"></i> Conveyance Report</h1>
          
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form action="{{url('/conveyance-report/data')}}" method="get" autocomplete="off">
                {{csrf_field()}}
                <table width="50%" style="min-width:600px; ">
                  <thead>
                    <tr>
                  <th width="20%"><label class="form-group">TO</label></th>
                  <th width="20%"><label class="form-group">FROM</label></th>
                    <th width="40%"><label class="form-group">SELECT EMPLOYEE</label></th>
                  <th width="20%"><label class="form-group"></label></th>
                  </tr>
                  
                  </thead>
                  <tbody>
                    <tr>
                    <td><input type="text" class="form-control datepicker" placeholder="Start Date" name="strtDate"></td>
                    <td><input type="text" class="form-control datepicker" placeholder="End Date" name="endDate"></td>
                    <td><select class="form-control" name="employee">
                      <option value="">Select Employee</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </td>
                     <td align=""><input type="submit" name="" class="btn btn-primary" style="margin-left: 25px; width: 100px;"> </td>
                    </tr>
                    <tr>
                     
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>

            <div class="row" style="margin-top: 50px;">
              <div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                </div><?php } ?>
      
                  <table class="table table-hover table-stripped" id="table" role="grid" >
                    <thead>
                      <tr role="row">
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Conveyance Date</th>
                        <th>Travel From</th>
                        <th >Travel To</th>
                        <th>Travel Mode</th>
                        <th>Distance</th>
                        <th>Amount</th>
                        <th>Status</th>
                     
                      </tr>
                    </thead>
                
                    <tbody>
                      @foreach($conveyance as $value)
                      <tr role="row" class="odd">
                        <td><?= $i++;?></td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->con_date}}</td>
                        <td>{{$value->disfrom}}</td>
                        <td>{{$value->disto}}</td>
                       @if($value->mode=="3.5")
                        <td>CAR</td>
                        @elseif($value->mode=="2.5")
                         <td>BIKE</td>
                         @else
                         <td>{{$value->mode}}</td>
                         @endif
                        <td>{{$value->distance}}</td>
                        <td>{{$value->amount}}</td>
                        <td>{{$value->status}}</td>                     
                     </tr>
                     @endforeach
                    </tbody>
                  </table>
          
                </div>
              </div>
            </div>
          </div>
        </div>
      
    </main>




    <!-- Essential javascripts for application to work-->
      <script src="{{ asset('js/main.js') }}" ></script>

 <script>
  $( function() {
    $( ".datepicker" ).datepicker({
       dateFormat:'yy-mm-dd'
    });
  } );
  </script>

  <script type="text/javascript">
        $('#table').DataTable( {
        dom: 'lBfrtip',
        buttons: [
              
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">  Export To Excel</i>',
                titleAttr: 'Excel'
            },
      
           
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa fa-copy">  Copy</i>',
                titleAttr: 'Copy'

            },
        ]
    } );
  </script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>