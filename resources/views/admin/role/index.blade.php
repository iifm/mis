<!DOCTYPE html>
<html lang="en">
  
<head>
    <title> Department Management</title>

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
       <a href="{{url('role/create')}}" class="fa fa-plus btn btn-primary" style="background: #009688; border:none; margin-left: 450px"> Add Role</a> 
     
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
              <table id="sampleTable"  width="100%">
                <thead>
              
                  <tr role="row">
                    <th>#</th>
                    <th style="text-align: left;">Role Name</th>
                    <th style="text-align: left;">Modified By</th>

                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach($roles as $role)
                <tr style="max-height: 100px;">
                    <td>{{ $i++ }}</td>
                     <td style="text-align: left;">{{$role->name}}</td>
                    <td style="text-align: left;">{{$role->username}}</td>

                    <td style="text-align: left;">
                      <a href="{{url('role/edit')}}/{{$role->id}}" class="btn btn-primary btn-sm fa fa-edit"></a>
                        <a onclick="return confirm('Are you sure you want to delete this item?')" href="{{url('role/delete')}}/{{$role->id}}" class="btn btn-danger btn-sm fa fa-trash"></a>
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