<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>NEWS UPLOADS/UPDATES</title>
 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
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
          <h1 class="heading_title"><i class="fa fa-newspaper-o "></i> News Upload/Update </h1>
        </div>
        <!--  <a href="{{url('admin/news-index')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Uploads</a>  -->  
      </div>
      <div class="row  tile">
        <div class="col-md-12">
          <form action="{{url('admin/news-upload/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
             

              <div class="row">
             <div class="col-md-7 col-md-offset-2"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                     <select name="category" id="category" class="form-control" required="">
                       <option value="">SELECT CATEGORY</option>
                       @foreach($categories as $categorie)
                       <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                      @endforeach
                     </select>
                </div>
             </div>
           </div>
           <div class="row">
            <div class="col-md-7 col-md-offset-2"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                   <input type="text" name="subject" id="subject"  placeholder="Subject" class="form-control" required="">
                   
                </div>
             </div>
             </div>
             <div class="row">
               <div class="col-md-7 col-md-offset-2"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Upload Image</label>
                    <input class="form-control" id="file" name="uploadimage[]"  type="file" aria-describedby="emailHelp" placeholder="Upload Image" value="" required="" multiple="">
                </div>
             </div>
             </div>
               <div class="row">
               <div class="col-md-7 col-md-offset-2"> 
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none; margin-top: 20px;">  Submit</button>  
             </div>

             </div>
           </div>
          
          
          </li>
        </ul>


            </form> 
        </div>
      </div>

    </main>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

