<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>Press Release</title> 
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
        
          <h1 class="heading_title"><i class="fa fa-newspaper-o "></i> Press Release</h1>
         
        </div>
      </div>
       <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
     
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                
              <div class="row">
                @foreach($pressReases as $pressRease)
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header"><center><h6>{{$pressRease->subject}}</h6></center> </div>
                    <div class="card-body">
            
                       <a href="" >
                      <center> <img class="img-responsive" src="{{URL::To('storage/app/newUploads')}}/{{$pressRease->uploadfile}}" height="300px" width="300px"></center> </a>
                          
                    </div>
                  </div>
              </div>
              @endforeach
           
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

