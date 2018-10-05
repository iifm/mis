<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>IIFM MIS - Leave Management </title>

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
          <h4><i class="fa fa-th-list"></i> Leave Management </h4>

        </div>
        <a href="{{url('/leave-add')}}" class="btn btn-primary fa fa-plus"> Apply Leave</a>
      </div>
      <div class="row">
        <div class="col-md-12">
           <div class="row">
             <div class="tile" style="width: 100%;margin-left: 12px; margin-right: 12px;">
               <h4 style="padding: 10px;">Leave Details</h4>
                  <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
            <div class="info">
              <h6 style="text-align: center;  padding:5px 0">Total Leave(s)</h5">
              <h3 style="text-align: center;"><b>{{$total_leaves}}</b></h3>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-calendar-o fa-3x"></i>
            <div class="info">
              <h6 style="text-align: center; padding:5px 0;">Leave(s) Applied</h5">
                @if($leave_applied!='')
              <h3 style="text-align: center;"><b>{{$leave_applied}}</b></h3>
              @else
               <h3 style="text-align: center;"><b>0</b></h3>
               @endif
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-calendar-check-o fa-3x"></i>
            <div class="info">
              <h6 style="text-align: center; padding:5px 0;">Leave(s) Approved</h5">
                @if($leave_approved!='')
              <h3 style="text-align: center;"><b>{{$leave_approved}}</b></h3>
              @else
            <h3 style="text-align: center;"><b>0</b></h3>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-clock-o fa-3x"></i>
            <div class="info">
              <h6 style="text-align: center; padding:5px 0">Leave(s) Balance</h5">
              <h3 style="text-align: center;"><b>{{$total_leaves-$leave_applied}}</b></h3>
            </div>
          </div> 
        </div>
      </div>
              
             </div>
           </div>

          <div class="tile">
            <div class="tile-body">
              <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            
            <div class="row">
              <div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
              <table class="table" id="sampleTable">
                <thead>
                  <tr role="row">
                    <th>#</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th >End Date </th>
                    <th >Status</th>
                    <th >Approval From</th>
                   <!--  <th style="padding-left: 50px; padding-right: 50px;">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                @php $i=1; @endphp

                @foreach($finaldatas as $data)
                <tr role="row" class="odd">
                    <td>{{$i++}}</td>
                    <td>{{$data['type']}}</td>
                    <td>{{$data['from']}}</td>
                    <td>{{$data['to']}}</td>
                    @if($data['status']=='approved')
                    <td>Approved</td>
                    @else
                    <td>{{$data['status']}}</td>
                    @endif
                  <td>{{$data['approval']}}</td>
                    
                  
                  </tr>
                  @endforeach
              
        </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-5">
         
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

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>