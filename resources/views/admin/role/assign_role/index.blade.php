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
        <h1 class="heading_title"><i class="fa fa-edit "></i> Edit User Assigned Role  </h1>
        </div>
   
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
                    <th style="text-align: left;">Employee Name</th>
                    <th style="text-align: left;">Assigned Role</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users_has_role_details as $user_has_role) 
                <tr style="max-height: 100px;">
                    <td><?= $i++;?></td>
                     <td style="text-align: left;" class="userId">{{ucwords(strtolower($user_has_role->name))}}</td>
                     
                    <td style="text-align: left;">
                      <select class="form-control updated_role" style="width: 50%" id="updated_role">

                        <option value="{{$user_has_role->role_id}}" selected="selected">{{$user_has_role->user_role}}</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}},{{$user_has_role->user_id}}">{{$role->name}}</option>
                        @endforeach

                      </select>
                      
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
    <script type="text/javascript">
      $(document).ready(function(){

           $(document).on('change','.updated_role',function(){
          var roleId_userId= $(this).val();

          $.get("{{url('assign-role/edit')}}/"+roleId_userId,function(data){
              alert(data);
          });
        

        });
   
      });
    </script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>