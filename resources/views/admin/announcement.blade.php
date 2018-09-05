<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>Press Release</title> 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
    
    <style type="text/css">
      td{padding:2px !important;
        border-top:0 !important;
        border-bottom: 1px solid #dee2e6;
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
  
      <!-- <div class="app-title"><div><h1 class="heading_title"><i class="fa fa-bullhorn"></i> Announcement</h1></div></div> -->
       <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
     
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                
              <div class="row">
                
              <div class="col-md-8">
                  <h3 class="heading_title" style="color:#007d71; font-weight:400;">{{$post->subject}}</h3>
                    <div class="card-body">                       
                        @if($post->filetype=='png'||$post->filetype== 'jpg' ||$post->filetype== 'jpeg')
                        <a href="#">
                          <center> <img class="img-responsive" src="{{URL::To('storage/app/newUploads')}}/{{$post->uploadfile}}" style="width:100%;" ></center> </a>
                      @elseif($post->filetype=='pdf') 
                        <center> <iframe src="{{URL::To('storage/app/newUploads')}}/{{$post->uploadfile}}" height="600px" width="100%"></iframe> </center>   
                      @else
                        <p>Nothing To display</p>
                      @endif
                    </div>
                  
              </div>
        

              <div class="col-md-4">
                <h5 class="heading_title" style="color:#007d71; font-weight:400; margin-bottom:20px;">Other </h5>   
                <table class="table">
               @foreach($otherpostDatas as $announcementData)
               <tr><td><span class="fa fa-bullhorn"></span></td><td><b>{{$announcementData->subject}}</b></td>
                <td><a href="{{url('/post/view')}}/{{$announcementData->id}}" class="btn btn-warning fa fa-eye pull-right" style="color: #fff;"></a></td></tr>


                 @endforeach
                   
                </table>
              </div>
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

