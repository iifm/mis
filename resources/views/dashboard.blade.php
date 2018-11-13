<!DOCTYPE html>
<html lang="en">
  
<head>
   
  <title>IIFM MIS - Dashboard</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Main CSS-->
{!!View('partials.include_css')!!}
<style type="text/css">
 table {
  height: 100px;
  overflow-y: scroll;
}
a {
    text-decoration: none !important;
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
          <h1 class="heading_title"><i class="fa fa-dashboard"></i> Dashboard</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
       <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <a href="{{url('/leave-view')}}/{{Auth::id()}}">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
             <center><h6 class="heading_title">Total Applied Leaves</h6></center> 
             @if($totleaves!='')
              <center><h3><b>{{$totleaves}}</b></h3></center>
            @else
              <center><h3><b>0</b></h3></center>
            @endif
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a href="#">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
            <center><h6 class="heading_title">This Month Conveyance(s)</h6></center> 
             <center><h3><span  class="fa fa-rupee"></span><b> {{$monthConveyance}} </b></h3></center> 
           
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a href="#" title="To Mark Attendance Please Login Through Mobile">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-map-marker fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
            <center>
               @if($agent->isMobile())
              @if($intime!='' && $outtime!='')
              <h6 class="heading_title">Today's Attendance</h6>
              <table style="height:auto; width:80%"><tr><td align="center"><b>IN</b> : {{$intime}}</td><td align="center"><b>OUT</b>: {{$outtime}}</td></tr></table>
              @elseif($intime)
              
                <table style="height:auto; width:80%"><tr><td align="center"><b>IN-TIME</b> : {{$intime}}</td></tr><tr><td><center><a href="{{url('/attendance')}}" class="btn btn-sm btn-warning" style="color: white">Mark Attendance</a></center> </td></tr></table>
               
              @else
                <h6 class="heading_title" style="color: black">Today's Attendance</h6>
                <a href="{{url('/attendance')}}" class="btn btn-warning" style="color: white">Mark Attendance</a>
              @endif
              @else
                @if($intime!='' && $outtime!='')
              <h6 class="heading_title">Today's Attendance</h6>
              <table style="height:auto; width:80%"><tr><td align="center"><b>IN</b> : {{$intime}}</td><td align="center"><b>OUT</b>: {{$outtime}}</td></tr></table>
              @elseif($intime)
               
                <table style="height:auto; width:80%"><tr><td align="center"><b>IN-TIME</b> : {{$intime}}</td></tr><tr><td align="center">Mark <b>OUT-TIME</b>  Via Mobile</td></tr></table>
               
              @else
               <h6 class="heading_title" style="color: black;">Today's Attendance</h6>
                <p>Mark Through Mobile</p>
              @endif
              @endif
            </center>
            </div>
          </div>
          </a>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="tile" style="min-height: 400px">
            <h5 class="heading_title">Employee of the Month</h5>
            <div class="">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">  
                <div class="carousel-inner">
                   @foreach( $eoms as $eom )
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}"">
                     <img   src="{{ URL::To('storage/app/public/images/'.$eom->image) }}"" alt="First slide" height="350px" width="100%">
                       <div style="width: 100%; padding:20px">
                         <h5 style="text-align: center;">{{ucwords(strtolower($eom->empname))}}</h5>
                          <p style="text-align: center;">{{$eom->month}} <br>
                          {{$eom->department}}</p>
                       <center><a href="{{url('/send-wish')}}/{{$eom->user_id}}/{{'Employee of Month'}}" class="btn btn-primary fa fa-envelope"> Send Wish</a></center>   

                      </div>
                  </div>
                 @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        
              
            <div class="col-md-4" >
                     <div class="row">
                <div class="col-md-12">
                <div class="tile">
                  <div class="table-wrapper-scroll-y"></div>
                   <h5 class="heading_title">Today's Event(s)</h5>  
                   @php $i=1; @endphp
                      <table width="100%" id="events">
                        <thead>
                          <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Event Name</th>
                          <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                       
                          @foreach($todays_event as $event)
                          <tr>
                          <td>{{$i++}}</td>
                          <td>{{ucwords(strtolower($event['name']))}}</td>
                          <td>{{$event['event']}}</td>
                          <td><a href="{{url('/send-wish')}}/{{$event['user_id']}}/{{$event['event']}}" class="btn btn-primary fa fa-envelope" title="Send Wish"></a></td>
                          </tr>
                          @endforeach
                         
                        </tbody>
                      </table>
                      
                    
                </div>
                </div>
              </div>
              <div class="tile">
                <h5 class="heading_title">Upcoming Events</h5> 
                 <li style="list-style-type: none;" class="dropdown"><a class="app-nav__item btn btn-success" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-birthday-cake  fa-lg"> BIRTHDAYS</i></a>
          <ul style="list-style-type: none;" class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">This month has {{count($monthBirthday)}} Birthdays.</li>
            <div class="app-notification__content">
              @foreach($monthBirthday as $value)
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">{{strtoupper($value['username'])}}</p>
                    <p class="app-notification__meta">{{ date('F j',strtotime($value['dob']))}}</p>
                  </div></a>
                </li>
                @endforeach
            </div>
          </ul>
        </li>
         <li style="list-style-type: none; margin-top: 10px;" class="dropdown"><a class="app-nav__item btn btn-info" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-gift"> ANNIVERSARIES</i></a>
          <ul style="list-style-type: none;" class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">This Month has {{count($monthAniversary)}}  Anniveraries  .</li>
            <div class="app-notification__content">
              @foreach($monthAniversary as $value)
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-gift fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">{{strtoupper($value['username'])}}</p>
                    <p class="app-notification__meta">{{ date('F j',strtotime($value['anniversary']))}}</p>
                  </div></a>
                </li>
              @endforeach
            </div>
          
          </ul>
        </li>
           <li style="list-style-type: none; margin-top: 10px;" class="dropdown"><a class="app-nav__item btn btn-danger" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-trophy">  WORK ANNIVERSARIES</i></a>
          <ul style="list-style-type: none;" class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">This Month has {{count($monthWorkAniversary)}} Work Aniversaries.</li>
            <div class="app-notification__content">
              @foreach($monthWorkAniversary as $mwa)
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-trophy fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">{{strtoupper($mwa['username'])}}</p>
                    <p class="app-notification__meta">{{ date('F j',strtotime($mwa['doj']))}}</p>
                  </div></a></li>
                  @endforeach
            </div>
          
          </ul>
        </li>
              </div>
       
          </div>
           <div class="col-md-4">
             
              <div class="tile">
                <h5 class="heading_title">Announcement(s)</h5>   
                <ul style="padding-left: 0px; list-style: none;">
                  @foreach($announcements as $announcement)
               <li class="fa fa-bullhorn" style="width: 100%"> {{$announcement->subject}}<a href="{{url('/post/view')}}/{{$announcement->id}}" class="btn btn-info fa fa-eye pull-right" style="color: #fff"></a></li>  
                 @endforeach
                   
                </ul>
              </div>

                 <div class="tile">
                <h5 class="heading_title ">Press Release(s)</h5>   
                <ul style="padding-left: 0px; list-style: none;">
                @foreach($pressReases as $pressRease)
               <li class=" fa fa-newspaper-o " style="width: 100%"> {{$pressRease->subject}} <a href="{{url('/post/view')}}/{{$pressRease->id}}" class="btn btn-warning fa fa-eye pull-right" style="color: #fff"></a></li>  
                @endforeach
                   
                </ul>
              </div>
          </div>
     
        </div>
     
      
    </main>

    <div class="modal" style="display: block; background:rgba(1,1,1,0.8);" id="popup_model">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Glimpses of Diwali Celebration</h5>
                      <button class="close" type="button" data-dismiss="modal" id="close_model" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                      <a href="{{url('/photo-album')}}">
                      <img src="http://www.prathamedu.com/Files_Upload/collage_popup_mis_file.jpg" width="100%">
                      </a>
                     
                    </div>
                    <div class="modal-footer">
                      <a href="{{url('/photo-album')}}" class="btn btn-primary" type="button">View All Images</a>
                    </div>
                  </div>
                </div>
              </div>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
  <!--   <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {

  $('#close_model').on('click',function(){
      $('#popup_model').hide();
  });

 $('.carousel').carousel({
  interval: 2000
});

});


</script>
    <style type="text/css">
      .modal.and.carousel {
      //position: fixed;
}
    </style>
  </body>


</html>