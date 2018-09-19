<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>Product Assignment Management</title>
    
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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
          <h1><i class="fa fa-tasks "> Product Assignment Management </i></h1>
        </div>
          <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
     
        <div class="col-md-12">
          <form action="{{route('assign.store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
               <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input class="form-control" id="pcode" name="pcode" type="text" aria-describedby="emailHelp" placeholder="Product Code" readonly="">
                </div>
             </div>
           <input type="hidden" name="product_id" id="product_id" value="">
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Category</label>
                    <select class="form-control" name="product_cat" required="" id="category">
                      <option value="">Select Category</option>
                      @foreach($category as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Select Product</label>
                  <select class="form-control" name="product_id" required="" id="productdesc">
                      <option value="">Select Product </option>
                     <!--  @foreach($category as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach -->
                    </select>

                </div>
             </div>
             <input type="hidden" name="assignedby" value="{{Auth::user()->name}}">
             <input type="hidden" name="sip" value="{{\Request::ip()}}">
               <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Assign To</label>
                    <select class="form-control" name="user_id" required="" id="category" required="">
                      <option value="">Select Employee</option>
                      @foreach($users as $user)
                      <option value="{{$user->user_id}}">{{strtoupper($user->username)}}</option>
                      @endforeach
                     
                    </select>
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Assign Date</label>
                    <input class="form-control demoDate" id="pmodel" name="date" type="text" aria-describedby="emailHelp" placeholder="Product Model" required="">

                </div>
             </div>
          
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Remark/Condition</label>
                    <input class="form-control" id="remark" name="remark" type="text" aria-describedby="emailHelp" placeholder="Product Serial Number" required="">
                </div>
             </div>

             
          </div>
          </li>
        </ul>
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
    <script type="text/javascript">
      $(document).ready(function(){
      $('#category').on('change',function(){
          var category =  this.value;
          $.ajax({
              url: "/get-product/"+category,
              type: 'GET',
              dataType : 'json', 
           success: function(result){

            //console.log(result);
            $('#productdesc').empty();
            $('#productdesc')
            .append($("<option>"+'Select Product Description'+"</option>"));
            $.each(result, function(key, value) { 
            //console.log(value['pdescription']);  
            $('#productdesc')
            .append($("<option value="+value['id']+">"+value['pdescription']+"</option>"));
                    
            });
            result='';
            
        }});
      });

     });
    </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

