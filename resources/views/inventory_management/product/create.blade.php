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
          <h1><i class="fa fa-product-hunt "></i> Product Management </h1>
        </div>
           <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border: none;"> Back</a>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
    
        <div class="col-md-12">
          <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

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
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Category</label>
                    <select class="form-control" name="category" required="" id="category" required="">
                      <option value="">Select Category</option>
                      @foreach($category as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                    </select>
                </div>
             </div>
            <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input class="form-control capitalize char-only" id="pname" name="pname" type="text" aria-describedby="emailHelp" placeholder="Product Name" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Company</label>
                   <input class="form-control capitalize char-only" id="pcompany" name="pcompany" type="text" aria-describedby="emailHelp" placeholder="Product Company" required="">

                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Model</label>
                    <input class="form-control" id="pmodel" name="pmodel" type="text" aria-describedby="emailHelp" placeholder="Product Model" required="">

                </div>
             </div>
          
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Product Serial Number</label>
                    <input class="form-control" id="pserial" name="pserial" type="text" aria-describedby="emailHelp" placeholder="Product Serial Number" required="">
                </div>
             </div>

              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Condition/Remarks</label>
                    <input class="form-control capitalize char-only" id="pcondition" name="pcondition" type="text" aria-describedby="emailHelp" placeholder="Condition/Remarks" required="">
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Purchase Date</label>
                    <input class="form-control demoDate" id="pdate" name="pdate" type="text" aria-describedby="emailHelp" placeholder="Purchase Date" required="">
                </div>
             </div>
            
             <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control " rows="3" placeholder="Product Brief Description" name="pdescription" id="pdescription" required=""></textarea>
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Upload Invoice</label>
                    <input class="form-control" id="pinvoice" onchange="return fileValidation();" name="pinvoice" type="file" aria-describedby="emailHelp" placeholder="Upload Invoice" required="">
                </div>
             </div>
          </div>
          </li>
        </ul>
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border: none;">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
<script>
 function fileValidation(){
    var fileInput = document.getElementById('pinvoice');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" height="150px" width="150px"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

