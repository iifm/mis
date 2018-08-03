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
          <h4><i class="fa fa-product-hunt"></i>Product Management  <a href="{{route('product.create')}}" class="btn btn-primary fa fa-plus">ADD Product</a></h4>

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
                          <th>Product Code</th>
                          <th>Product Category</th>
                          <th>Product Name</th>
                          <th>Product Serial No.</th>
                          <th>Description</th>
                          <th>Product Model</th>
                          <th>Product Company</th>
                          <th>Condition/Remark</th>
                          <th>Product Invoice</th>
                          <th>Purchase Date</th>
                          <th >Action</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                      @foreach($product as $value)
                      <tr role="row" class="odd">
                        <td><?= $i++;?></td>
                        <td></td>
                        <td>{{$value->product_cat_name}}</td>
                        <td>{{$value->pname}}</td>
                        <td>{{$value->pserial}}</td>
                        <td>{{$value->pdescription}}</td>
                        <td>{{$value->pmodel}}</td>
                        <td>{{$value->pcompany}}</td>
                        <td>{{$value->pcondition}}</td>
                        <td>{{$value->pdate}}</td>
                        <td><a href="{{url('storage/product/'.$value->pinvoice)}}" target="_blank"><img src="{{url('storage/product/'.$value->pinvoice)}}" height="50px" width="50px"></a></td>
                        <td>
                          <a href="{{route('product.edit',$value->id)}}" class="btn btn-primary fa fa-pencil"></a>
                          <form id="delete-form-{{$value->id}}" method="post" action="{{route('product.destroy',$value->id)}}" >
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                          <button type="submit" value="" class="fa fa-trash btn btn-danger"></button>  
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