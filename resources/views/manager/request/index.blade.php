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
        <h1 class="heading_title"><i class="fa fa-user-plus "></i> Request Management </h1>
        </div>
       <a href="{{url('manager-zone/request')}}" class="fa fa-user-plus btn btn-primary" style="background: #009688; border:none; margin-left: 450px"> Add Request</a> 
     
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
              <table id="sampleTable"  class="table">
                <thead>
              
                  <tr role="row">
                    <th>#</th>
                    <th >User Name</th>
                    <th> Department </th>
                    <th width="20%">Subject</th>
                    <th width="60%">Description</th>
                   
                    <th>Action</th>
                       
                  </tr>
                </thead>
                <tbody>
                @foreach($requirements as $requirement)  
                <tr>
                    <td><?= $i++;?></td>
                     <td><h6>{{$requirement->username}}</h6></td>
                    <td>{{$requirement->dept_name}}</td>
                    <td>{{$requirement->subject}}</td>
                    <td><?php echo htmlspecialchars_decode($requirement->description) ?></td>
                
                  <td></td>
                  
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