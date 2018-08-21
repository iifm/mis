<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    
    <title>IIFM MIS</title>
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
   
<style>
* {
    box-sizing: border-box;
}

.zoom {
    padding: 20px;
    background-color: white;
    transition: transform .2s;
    width: 230px;
    height: 250px;
    margin: 0 auto;
}

.zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
}
</style>
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
          <h4><i class="fa fa-file-image-o"></i> Photo Album Management   <a href="{{url('/photo-album/create')}}" class="btn btn-success fa fa-plus">Add Photo</a></h4>
 
        </div>
      </div>
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
      <div class="row tile">
        <div class="col-md-12">
        @foreach($photos as $photo)
        <div class="col-md-4"  style="height: 350px;">

            <div class="card">

                <img class="zoom" width="100%" height="" src="{{ URL::To('storage/app/public/photos/'.$photo->photo) }}" alt="Card image">

                <div class="card-body">
              <center><strong>Added By</strong></center> 
               <center><strong>   <p class="card-text">{{$photo->addedby}}</p></strong>
                 <strong>Photo Category : {{$photo->category}}</strong>
                  <strong><p class="card-text"></p></strong>
                  <a href="{{url('/photo-album-delete')}}/{{$photo->id}}" class="card-text btn btn-danger fa fa-trash"> Delete Image</a></center>
                </div>

          </div>

        </div>
      @endforeach
           
        </div>
      </div>
    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>