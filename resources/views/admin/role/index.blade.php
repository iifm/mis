<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> Role Management</title>

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
        <h1 class="heading_title"><i class="fa fa-tasks "></i> Role Management </h1>
        </div>
       <a href="{{url('role/create')}}" class="fa fa-plus btn btn-primary " style="background: #009688; border:none; margin-left: auto;margin-right: 10px;"> Add Role</a>
       <a href="{{url('assign-role/index')}}" class="fa fa-handshake-o btn btn-primary" style="background: #009688; border:none;"> View And Edit User(s) Role</a> 
     
      </div>
     
      <div class="row">
        <div class="col-md-12">
          
          <div class="tile">
            <div class="tile-body">
              <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
             
            <div class="row"><div class="col-sm-12 ">
              <div id="successMsg" class="alert alert-success" style="display: none;">
                
              </div>
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
              <table id="sampleTable"  width="100%">
                <thead>
              
                  <tr role="row">
                    <th>#</th>
                    <th style="text-align: left;">Role Name</th>
                    <th>User's Access</th>
                     <th>Upload(s) Category </th>

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($roleDetails as $role)
                  
                <tr style="max-height: 100px;">
                    <td>{{ $i++ }}</td>
                     <td style="text-align: left;">{{$role['role_name']}}</td>
                    @if($role['access_users']=='')
                    <td>End User</td>
                    @else
                    <td style="text-align: left;">{{$role['access_users']}}</td>
                    @endif
                    @if($role['upload_category']=='')
                    <td>NA</td>
                    @else
                    <td style="text-align: left;">{{$role['upload_category']}}</td>
                    @endif
                    <td style="text-align: left;">
                      <a href="{{url('role/edit')}}/{{$role['role_id']}}" class="btn btn-primary btn-sm fa fa-edit"></a>
                     
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