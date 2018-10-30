<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>IIFM MIS - User's Manager</title>

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
        <h1 class="heading_title"><i class="fa fa-users "></i> User's Manager </h1>
        </div>
    
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
                    <th style="text-align: left;">User Name</th>
                    <th style="text-align: left;">Manager</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                <tr style="max-height: 100px;">
                  <td><?= $i++;?></td>
                  <td style="text-align: left;"></td>
                  <td style="text-align: left;"></td>
                  <td style="text-align: left;">
                    <a href="#" class="btn btn-primary btn-sm fa fa-tasks"></a>
                 </td>
                </tr>
                 
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