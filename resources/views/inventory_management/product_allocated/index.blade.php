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
          <h4><i class="fa fa-tasks"></i>Product Assignment Management  <a href="{{route('assign.create')}}" class="btn btn-primary fa fa-plus">Assign Product</a></h4>

        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
           

          <div class="tile">
            <div class="tile-body">
             
                
            <div class="row"><div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
      <table class="table table-hover table-stripped table-responsive"  id="sampleTable" role="grid">
                     <thead>
                        <tr role="row">
                          <th>#</th>
                          <th>Product Name</th>
                          <th>Assigned To</th>
                          <th>Product Description</th>
                          <th>Assign Date</th>
                           <th>Remark/Condition</th>
                          <th>Assigned By</th>
                          <th >Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                      @foreach($assign as $value)
                      <tr role="row" class="odd">
                        <td><?= $i++;?></td>
                        <td>{{$value->product_category}}</td>
                        <td>{{$value->username}}</td>
                        <td>{{$value->productname}}</td> 
                        <td>{{$value->date}}</td>
                        <td>{{$value->remark}}</td>
                        <td>{{$value->assignedby}}</td>
                        
                       
                        <td>
                          <a href="{{route('assign.edit',$value->id)}}" class="btn btn-primary fa fa-pencil"></a>
                          <form id="delete-form-{{$value->id}}" method="post" action="{{route('assign.destroy',$value->id)}}" >
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                          <button type="submit" value="" class="fa fa-trash btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');"></button>  
                          </form>
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
    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>