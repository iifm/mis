<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> Manager Zone - Leave Management</title>

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
        <h1 class="heading_title"><i class="fa fa-users "></i> Team Member(s) Leave Details </h1>
        </div>
      <!--  <a href="{{url('/department/create')}}" class="fa fa-plus btn btn-primary" style="background: #009688; border:none; margin-left: 450px"> Add Department</a>  -->
     
      </div>
     
      <div class="row">
        <div class="col-md-12">
          
          <div class="tile">
            <div class="tile-body">
              <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
             
            <div class="row"><div class="col-sm-12 pre-scrollable">
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
                    <th width="20%"> Start Date </th>
                    <th width="20%"> End Date</th>
                    <th> Leave Type</th>
                    <th style="padding-left: 100px;padding-right: 100px;">Reason</th>
                    <th> Total Days</th>
                    <th> Status</th>
                    <th width="24%">Action</th>
                       
                  </tr>
                </thead>
                <tbody>
                @foreach($leave_details as $leave_detail)  
                <tr style="max-height: 100px;">
                    <td><?= $i++;?></td>
                     <td><h6>{{$leave_detail['user_name']}}</h6></td>
                    
                    <td>{{date('j F Y',strtotime($leave_detail['start_date']))}}</td>
                    <td>{{date('j F Y',strtotime($leave_detail['end_date']))}}</td>
                    <td>{{$leave_detail['leave_type']}}</td>
                    <td>{{$leave_detail['reason']}}</td>
                    <td>{{$leave_detail['total_leaves']}}</td>
                     <td>{{$leave_detail['status']}}</td>
                    <td><a href="{{url('leave-approval')}}/{{$leave_detail['leave_id']}}" class="btn btn-primary fa fa-thumbs-up"> Approve/Disapprove</a>
                       </a>
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