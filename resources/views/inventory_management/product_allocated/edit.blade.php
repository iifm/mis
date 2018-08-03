<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>IIFM MIS</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   

   </head>
    

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
          <h1><i class="fa fa-tasks "></i> Product Assignment Management </h1>
        </div>
      </div>
       
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
           @foreach($assign_product as $assign)
          <form action="{{route('assign.update',$assign->id)}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
             {{method_field('PUT')}}
         
              <div class="row">
            <div class="col-md-12">
               <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Code</label>
                    <input class="form-control" id="pcode" name="pcode" type="text" aria-describedby="emailHelp" placeholder="Product Code" readonly="">
                </div>
             </div>
           
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Category</label>
                    <select class="form-control" name="product_cat"  required="" id="category" required="">

                      <option value="">{{$assign->product_category}}</option>
                      @foreach($category as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Description</label>
                  <select class="form-control" name="product_id" required="" id="productdesc">
                      <option value="">{{$assign->product_descption}}</option>
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
                      <option value="">{{$assign->username}}</option>
                      <option>Select Employee</option>
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                     
                    </select>
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Assign Date</label>
                    <input class="form-control demoDate" value="{{$assign->date}}" id="pmodel" name="date" type="text" aria-describedby="emailHelp" placeholder="Product Model" required="">

                </div>
             </div>
          
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Remark/Condition</label>
                    <input class="form-control" value="{{$assign->remark}}"  id="remark" name="remark" type="text" aria-describedby="emailHelp" placeholder="Product Serial Number" required="">
                </div>
             </div> 
          </div>
        
       
          <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit">  Submit</button>
          </div>
          </form> 
           @endforeach
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

