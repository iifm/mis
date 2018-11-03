<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> Manager Zone - Attendance Management</title>

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
        <h1 class="heading_title"><i class="fa fa-users "></i> Team Member(s) Attendance Details </h1>
        </div>
      <!--  <a href="{{url('/department/create')}}" class="fa fa-plus btn btn-primary" style="background: #009688; border:none; margin-left: 450px"> Add Department</a>  -->
     
      </div>
     
      <div class="row">
        <div class="col-md-12">
          
          <div class="tile">
            <div class="tile-body">
              <div id="table">
             
            <div class="row"><div >
              <div id="successMsg" class="alert alert-success" style="display: none;">
                
              </div>
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
              <table id="sampleTable"  width="100%"  class="table">
                <thead>
                  <tr role="row">
                    <th>#</th>
                    <th>User Name</th>
                    <th>Date </th>
                    <th>In-Time</th>
                    <th>Out-Time</th>
                    <th style="padding-left: 80px;padding-right: 80px;">Reason</th>
                    <th>Status</th>
                    <th>Action</th>        
                  </tr>
                </thead>
                <tbody>
               @foreach($attendances_manager_index as $attendance_manager_index)
                <tr>
                    <td><?= $i++;?></td>
                    <td><h6>{{$attendance_manager_index->username}}</h6></td>
                    <td>{{date('j F Y',strtotime($attendance_manager_index->date))}}</td>
                    <td>{{$attendance_manager_index->in_time}}</td>
                    <td>{{$attendance_manager_index->out_time}}</td>
                    <td>{{$attendance_manager_index->reason}}</td>
                    <td>{{$attendance_manager_index->status}}</td>
                    <td>
                      <a href="{{url('update-attendance/both')}}/{{$attendance_manager_index->att_id}}" class="btn btn-primary fa fa-thumbs-up"> Approve/Disapprove</a>
                    </td>
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