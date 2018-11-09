<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2016 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-6" /><!-- /Added by HTTrack -->
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
          <h1><i class="fa fa-file-image-o"></i> Photo Album Management</h1>
        </div>
      </div>
   
      <div class="col-lg-12" style="padding-top:20px; padding-bottom:20px; background:#fff;">
        
        <div class="col-lg-7" style="background:#fff;">
        <h4 style="font-family: Merienda-font; color:#203748; font-size:25px; margin-left:15px;" data-parent="#accordion" href="#collapseOne">
                 Upload New Picture if you have!
             </h4>
    
            <form action="{{url('/photo-album/store')}}" method="post" enctype="multipart/form-data">          
                 {{ csrf_field() }}
                
                <input  type="hidden" name="addedby" id="addedby" value="{{Auth::user()->id}}">
             
            
                 <div class="col-lg-10">
                     <label>Title</label>
                      <input type="text" class="form-control" name="title" required placeholder="Enter Title">
                </div>
                <div class="col-lg-10">
                     <label>Category</label>
                      <select class="form-control" name="category" id="category" required="">
                       <option value="">Select Category</option>
                        @foreach($category as $cat)
                       <option value="{{$cat->id}}">{{$cat->name}}</option> 
                          @endforeach                 
                     </select>
                </div>
                <input type="hidden" name="sip" value="{{\Request::ip()}}">
             
                <div class="col-lg-10"> 
                        <label>Upload Image</label>
                        <input class="form-control input-lg" type="file" name="photo[]" onchange="return fileValidation();" id="photo" placeholder="Upload your Image" required="" multiple>
                </div>   
                <div class="col-lg-12" ><br>
                    <button class="btn btn-success text-uppercase fa fa-save " type="submit" style="background: #009688; border:none">  Submit</button><br><br>
                </div> 
           </form>
           
           
           
    </div>

        <div class="col-lg-5" style="background:#fff;">
          
            <form action="{{url('/photo-album/add-category')}}" method="post">
               {{ csrf_field() }}
                <h4 style="font-family: Merienda-font; color:#203748; font-size:25px; margin-left:15px;" data-parent="#accordion" href="#collapseOne">
                 Create New Album
                </h4>
          
                <div class="col-lg-12" style="">
            
                <label>Write Your Desire Category</label>
                <input class="form-control input-lg" type="text" name="name" id="name" placeholder="Ex:- Birthday" required=""><br><br>
          
                <input class="btn btn-success" type="submit"  value="Add Category" style="background: #009688; border:none">
                  
                </div>
            </form>
        
        </div>
        
     </div>   
        
 
    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
<script>
 function fileValidation(){
    var fileInput = document.getElementById('photo');
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

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2016 06:07:27 GMT -->
</html>

