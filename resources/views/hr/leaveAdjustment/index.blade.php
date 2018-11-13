<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> HR - Leave Management </title>

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
        <h1 class="heading_title"><i class="fa fa-calendar"></i> HR - Leave Management </h1>
        </div>
       <a href="{{url('hr/leave-adjustment/create')}}" class="fa fa-plus btn btn-primary" style="background: #009688; border:none; margin-left: 450px"> Add Leave</a> 
     
      </div>
     
      <div class="row">
        <div class="col-md-12">
          
          <div class="tile">
            <div class="tile-body">
              <div id="table">
             
            <div class="row"><div class="col-sm-12 ">
              <div id="successMsg" class="alert alert-success" style="display: none;">
                
              </div>
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
              <table id="sampleTable"  width="100%" class="table table-responsive">
                <thead>
              
                  <tr role="row">
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Leaves</th>
                    <th>Leave Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>  
                @foreach($total_leaves as $total_leave)    
                  <tr>
                    <td><?= $i++;?></td>
                    <td>{{$total_leave->username}}</td>
                    <td>{{date('j F Y',strtotime($total_leave->leavefrom))}}</td>
                    <td>{{date('j F Y',strtotime($total_leave->leaveto))}}</td>
                    <td>{{$total_leave->totalleave}}</td>
                    <td>{{$total_leave->leavetype}}</td>  
                    <td>{{$total_leave->status}}</td>

                    <td>
                        <a href="{{url('hr/leave-adjustment/edit')}}/{{$total_leave->leave_id}}" class="btn btn-primary btn-sm fa fa-edit"></a>
                        <a onclick="return confirm('Are you sure you want to delete this item?')" href="{{url('hr/leave-adjustment/delete')}}/{{$total_leave->leave_id}}" class="btn btn-danger btn-sm fa fa-trash"></a>
                    </td>
                  </tr>
                  @endforeach
                  
               </tbody>
 
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

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>