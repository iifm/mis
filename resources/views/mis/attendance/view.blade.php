<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    
    <title>Attendance</title>
    

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
          <h1><i class="fa fa-eye"></i> View Attendance </h1>
          
        </div>
      </div>
       
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form action="{{url('/attendance-view')}}" method="get" autocomplete="off">
                {{csrf_field()}}
                <table width="50%" style="min-width:600px;">
                  <thead>
                    <tr>
                  <th width="20%"><label class="form-group">TO</label></th>
                  <th width="20%"><label class="form-group">FROM</label></th>
                   <!--   @if(Auth::user()->role==1)
                  <th width="40%"><label class="form-group">SELECT EMPLOYEE</label></th>
                   @elseif(Auth::user()->role==3)
                    <th width="40%"><label class="form-group">EMPLOYEE NAME</label></th>
                  @endif
                  <th width=""><label class="form-group"></label></th> -->
                  </tr>
                  
                  </thead>
                  <tbody>
                    <tr>
                    <td><input type="text" class="form-control datepicker" id="StartDate" placeholder="Start Date" name="strtDate"></td>
                    <td><input type="text" class="form-control datepicker" id="EndDate" placeholder="End Date" name="endDate" readonly=""></td>
                   <!--  @if(Auth::user()->role==1)
                    <td><select class="form-control" name="employee">
                      <option value="">Select Employee</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </td>
                  @elseif(Auth::user()->role==3)
                    <td><select class="form-control" name="employee" reaonly>
                      <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                     
                    </select>
                  </td>
                  @endif -->
                    <input type="hidden" name="employee" value="{{Auth::user()->id}}">
                     <td align=""><input type="submit" name="" class="btn btn-primary" style="margin-left: 25px; width: 100px;"> </td>
                    </tr>
                    <tr>
                     
                    </tr>
                  </tbody>
                </table>
              </form>
               <div class="row" style="margin-top: 50px;"></div>
                <table class="table table-hover table-stripped" id="table" role="grid"  style="margin-top: 100px;">
                    <thead>
                      <tr role="row">
                        <th>#</th>
                        <th>Name</th>
                         <th>DATE</th>
                        <th>IN TIME</th>
                        <th>OUT TIME</th>
                       
                      </tr>
                    </thead>
                @php $i=1 @endphp
                    <tbody>
                       @if(count($datas)!=0)
                        @foreach($datas as $data)
                      <tr role="row" class="odd">
                        <td>{{ $i++ }}</td>
                        <td>{{$data['username']}}</td>
                        <td>{{$data['date']}}</td> 
                        <td>
                            <?php
                              if($data['inTime']=='NA'){  $type='IN'?>
                                <a href="{{url('/update-user-attendance')}}/{{$data['user_id']}}/{{$data['date']}}/{{$type}}" class="btn btn-primary fa fa-edit btn-small" id="{{$data['user_id']}}"></a>

                              <?php }
                              else{ ?>
                                  {{$data['inTime']}}
                              <?php }  
                            ?>

                        </td>
                         <td>
                            <?php
                              if($data['outTime']=='NA'){  $type='OUT'?>
                                <a href="{{url('/update-user-out-attendance')}}/{{$data['user_id']}}/{{$data['date']}}/{{$type}}" class="btn btn-danger fa fa-edit btn-small" id="outTime"></a>

                              <?php }
                              else{ ?>
                                  {{$data['outTime']}}
                              <?php }  
                            ?>

                        </td>
                        

                       </tr>
                      @endforeach
                        @else
                        <td></td>  
                        <td></td>
                        <td></td>
                        <td></td>
                        @endif   
                    </tbody>
                  </table>
          
            </div>
          </div>
        </div>
      </div>
    </main>



    <!-- Essential javascripts for application to work-->
 
 <script src="{{ asset('js/main.js') }}" ></script>
 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 <script>
  $( function() {
    $( ".datepicker" ).datepicker({  maxDate: 0,
                                    dateFormat : "yy-mm-dd",
                                
                             });
                    });
     
  </script>
  <script type="text/javascript">
    $("#StartDate").datepicker({
    dateFormat: 'yy-mm-dd',
    maxDate: 0,
    onSelect: function (selectedDate) {
        if (this.id == 'StartDate') {
            //console.log(selectedDate);//2014-12-30
            var arr = selectedDate.split("/");
            var date = new Date(arr[2]+"-"+arr[1]+"-"+arr[0]);
            var d = date.getDate();
            var m = date.getMonth() + 1;
            var y = date.getFullYear();
            var minDate = new Date(y, m, d);
            $("#EndDate").datepicker('setDate', minDate);

        }
    }
});
//$("#EndDate").datepicker({dateFormat: 'dd/mm/yy'});

  </script>
<script type="text/javascript">
        $('#table').DataTable( {
        dom: 'lBfrtip',
       /* buttons: [
              
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
        ]*/
    } );
  </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>