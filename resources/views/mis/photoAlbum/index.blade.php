<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Photo Album</title>
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link href="{{ URL::To('public/css/common_css/thumbnail-gallery.css') }}" rel="stylesheet">


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
          <h3 class="heading_title"><i class="fa fa-file-image-o"></i> Photo Album Management  </h3>
 
        </div>
         <a href="{{url('/photo-album/create')}}" class="btn btn-success fa fa-plus pull-right" style="background: #009688; border:none">Add Photo</a>
      </div>
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    
    <div class="row tile">

       <div class="tz-gallery">

        <div class="row">
            @foreach($photos as $photo)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a class="lightbox" href="{{ URL::To('storage/app/public/photos/'.$photo->photo) }}" lightbox-caption="<p>sample text or the footer.</p>" >
                        <img src="{{ URL::To('storage/app/public/photos/'.$photo->photo) }}" alt="" width="350" style="max-height: 350px">
                    </a>
                    <div class="caption">
                        <h3>{{$photo->category}} 
                       <a href="{{url('/photo-album-delete')}}/{{$photo->id}}" class="fa fa-trash" style="margin-top: 10px; color: red" title="Delete This Image"></a> </h3>
                    </div>
                </div>
            </div>
            @endforeach
         
        </div>

    </div>

     </div>
    </main>

    <!-- Essential javascripts for application to work-->

<script src="{{URL::To('public/js/baguetteBox.min.js')}}"></script>
<script src="{{ asset('js/main.js') }}" ></script>

<script>
    baguetteBox.run('.tz-gallery');
</script>

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>