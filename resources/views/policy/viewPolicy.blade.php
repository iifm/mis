<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>Policies</title> 
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
    
    @if($policyContent->count()>0)
    @foreach($policyContent as $content)
      <div class="app-title">
        <div>
          <h1 class="heading_title"><i class="fa fa-file"></i> {{$content->policyType}}</h1>
        </div>
           @if(Session::get('access_zones')=='All')
        <a href="{{url('/policy/edit')}}/{{$id}}" class="fa fa-edit btn btn-primary"> Edit {{$content->policyType}}</a>
        @endif
      </div>
          <?php $i=1;?>
               <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <?php echo htmlspecialchars_decode($content->description); ?>
               
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @else
      @foreach($policydata as $data)
       <div class="app-title">
        <div>
          <h1 class="heading_title"><i class="fa fa-file"></i> {{$data->name}} Policy </h1>
        </div>
          @if(Auth::user()->role==1 || Auth::user()->role==2)
        <a href="{{url('/policy/edit')}}/{{$id}}" class="fa fa-edit btn btn-primary"> Edit {{$data->name}}</a>
        @endif
      </div>
        
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
               
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </main>



    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

