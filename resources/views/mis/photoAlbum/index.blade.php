<!DOCTYPE html>
<html lang="en">

    <head>

        <title>Photo Album</title>


        <!-- Main CSS-->
        {!!View('partials.include_css')!!}
        <link rel="stylesheet" href="{{ URL::To('public/css/common_css/baguetteBox.min.css') }}">
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
                @if(Session::get('manager_zone')=='show' || Session::get('access_zones')=='All')
                <a href="{{url('/photo-album/create')}}" class="btn btn-success fa fa-plus pull-right" style="background: #009688; border:none">Add Photo</a>
                @endif
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif

            <div class="row tile">

                <div class="tz-gallery">

                    <div class="row">
                        @foreach($photos as $photo)
                        <div class="col-lg-4">

                            <table style="text-align: center; width:90% !important">
                                <tr>
                                    <td>
                                        <a class="lightbox" href="{{ URL::To('storage/app/public/photos')}}/{{$photo->photo}}" lightbox-caption="<p>sample text or the footer.</p>" >
                                            <img src="{{ URL::To('storage/app/public/photos')}}/{{$photo->photo}}" alt=""  style="width:100%">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="padding:10px; ">{{$photo->title}}</div>
                                        {{$photo->photo_category}}  
                                        @if(Auth::user()->role==1)
                                        <a href="{{url('/photo-album-delete')}}/{{$photo->photo_id}}" class="fa fa-trash" style="color: red" title="Delete This Image"></a>
                                        @endif  
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p></p>
                                    </td>
                                </tr>
                            </table>



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