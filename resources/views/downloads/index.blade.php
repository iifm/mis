<!DOCTYPE html>
<html lang="en">
  
<head>
  
    <title>Downloads</title> 
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
          @foreach($downloadType as $download)
          <h1 class="heading_title"><i class="fa fa-download"></i> {{$download->name}} Downloads</h1>
          @endforeach
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
                 @foreach($downloadDatas as $data)
              <div class="col-md-3">
                <div class="card">
                  <div class="card-header"><center><h6>{{$data->subject}}</h6></center> </div>
                    <div class="card-body">
                      
                           @if($data->filetype=='pdf')
                          <a href="{{URL::To('storage/app/newUploads')}}/{{$data->uploadfile}}" download="">
                      <center> <img class="img-responsive" src="{{URL::To('/public/images/pdf.png')}}" height="150px" width="150px"></center> </a>
                        <a href="{{url('/download/delete')}}/{{$data->id}}" class="btn btn-danger fa fa-trash pull-right" onclick="return confirm('Are You Sure You Want To Delete This?')"></a>
                          @elseif($data->filetype=='xls' || $data->filetype=='xlsx' || $data->filetype=='csv')
                           <a href="{{URL::To('storage/app/newUploads')}}/{{$data->uploadfile}}" download="">
                      <center> <img class="img-responsive" src="{{URL::To('/public/images/xls.png')}}" height="150px" width="150px"></center> </a>
                      <a href="{{url('/download/delete')}}/{{$data->id}}" class="btn btn-danger fa fa-trash pull-right" onclick="return confirm('Are You Sure You Want To Delete This?')"></a>
                          @elseif($data->filetype=='doc' || $data->filetype=='docx')
                           <a href="{{URL::To('storage/app/newUploads')}}/{{$data->uploadfile}}" download="">
                      <center> <img class="img-responsive" src="{{URL::To('/public/images/doc.png')}}" height="150px" width="150px"></center> </a>
                      <a href="{{url('/download/delete')}}/{{$data->id}}" class="btn btn-danger fa fa-trash pull-right" onclick="return confirm('Are You Sure You Want To Delete This?')"></a>
                       @elseif($data->filetype=='ppt' || $data->filetype=='pptx')
                           <a href="{{URL::To('storage/app/newUploads')}}/{{$data->uploadfile}}" download="">
                      <center> <img class="img-responsive" src="{{URL::To('/public/images/ppt.png')}}" height="150px" width="150px"></center> </a>
                      <a href="{{url('/download/delete')}}/{{$data->id}}" class="btn btn-danger fa fa-trash pull-right" onclick="return confirm('Are You Sure You Want To Delete This?')"></a>
                           @endif
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

