<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>IIFM MIS</title>

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
          <h4><i class="fa fa-th-list"></i>Leave Management  <a href="{{url('/leave-add')}}" class="btn btn-primary fa fa-plus">ADD Leave Request</a></h4>

        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Leave</li>
          <li class="breadcrumb-item active"><a href="#">Leave Management</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
           

          <div class="tile">
            <div class="tile-body">
              <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="sampleTable_length">
                   
                </div>
              </div>
              
            </div>
            <div class="row"><div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
              <table class="table table-hover table-bordered dataTable no-footer" id="sampleTable" role="grid" aria-describedby="sampleTable_info">
                <thead>
                  <tr role="row">
                    <th>#</th>
                     <th>Name</th>
                    <th>Email</th>
                    <th >Mobile</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th >End Date </th>
                    <th>Reason</th>
                    <th width="20%">Status</th>
                    <th style="text-align: center;">Approval From</th>
                    <th style="width: 20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
          <?php foreach ($leave as  $value) { ?>
                <tr role="row" class="odd">
                    <td><?= $i++;?></td>
                     <td><?= $value->empname ?></td>
                      <td><?= $value->empmail ?></td>
                       <td><?= $value->empmobile ?></td>
                    <td><?= $value->leavetype ?></td>
                    <td><?= $value->leavefrom ?></td>
                    <td><?= $value->leaveto ?></td>
                    <td><?= $value->reason ?></td>
                    <td><?= $value->status ?></td>
                    <td ><?= $value->approvalfrom ?></td>
                    <td ><a href="{{url('/leave-edit')}}/<?= $value->id;?>" class="btn btn-primary fa fa-pencil"></a>
                        <a href="{{url('/leave-delete')}}/<?= $value->id;?>"  class="btn btn-danger fa fa-trash "></a>
                    </td>
                  </tr>
                <?php } ?>
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