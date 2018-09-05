<!DOCTYPE html>
<html lang="en">
  

<head>
   
    <title>IIFM MIS Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
          <a href="{{url('/leave-view')}}">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
             <center><h6 class="heading_title">Total Applied Leaves</h6></center> 
              <center><h3><b>{{$totleaves}}</b></h3></center>
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a href="{{url('/on-duty/index')}}">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
            <center><h6 class="heading_title">Total Applied On-Duties</h6></center>  
             <center><h3><b>{{$totod}}</b></h3></center> 
            </div>
          </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-4">
          <a href="#">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-map-marker fa-3x"></i>
            <div class="" style="width: 100%; padding:14px 0 5px 0">
            <center>
              @if($intime!='' && $outtime!='')
              <h6 class="heading_title">Today's Attendance</h6>
              <table style="height:auto; width:80%"><tr><td align="center"><b>IN</b> : {{$intime}}</td><td align="center"><b>OUT</b>: {{$outtime}}</td></tr></table>
              @elseif($intime)
                <table style="height:auto; width:80%"><tr><td align="center"><b>IN-TIME</b> : {{$intime}}</td></tr><tr><td align="center"> <a href="{{url('/attendance')}}" class="btn btn-warning btn-sm" style="color:#fff; margin-top: 5px;">Mark Out Attendance</a></td></tr></table>
               
              @else
               <h6 class="heading_title" style="color: black;">Today's Attendance</h6>
              <a href="{{url('/attendance')}}" class="btn btn-warning btn-sm" style="color:#fff; margin-top:5px;">Mark Attendance</a>
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
                         <h5 style="text-align: center;">{{$eom->empname}}</h5>
                          <p style="text-align: center;">{{$eom->month}} {{$eom->created_at->year}} <br>
                          {{$eom->department}}</p>

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
                          <td>{{$event['name']}}</td>
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
            <li class="app-notification__title">This month have {{count($monthBirthday)}} Birthdays.</li>
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
            <li class="app-notification__title">This Month have {{count($monthAniversary)}}  Anniveraries  .</li>
            <div class="app-notification__content">
              @foreach($monthAniversary as $value)
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-gift fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">{{strtoupper($value['username'])}}</p>
                    <p class="app-notification__meta">{{ date('F j',strtotime($value['doj']))}}</p>
                  </div></a>
                </li>
              @endforeach
            </div>
          
          </ul>
        </li>
           <li style="list-style-type: none; margin-top: 10px;" class="dropdown"><a class="app-nav__item btn btn-danger" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-trophy">  WORK ANNIVERSARIES</i></a>
          <ul style="list-style-type: none;" class="app-notification dropdown-menu dropdown-menu-right">
            <li class="app-notification__title">This Month have {{count($monthWorkAniversary)}} Work Aniversaries.</li>
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
                <h5 class="heading_title">Announcements</h5>   
                <ul style="padding-left: 0px; list-style: none;">
                  @foreach($announcements as $announcement)
               <li class="fa fa-bullhorn" style="width: 100%"> {{$announcement->subject}}<a href="{{url('/announcement/view')}}/{{$announcement->id}}" class="btn btn-info fa fa-eye pull-right" style="color: #fff"></a></li>  
                 @endforeach
                   
                </ul>
              </div>

                 <div class="tile">
                <h5 class="heading_title ">Press Release</h5>   
                <ul style="padding-left: 0px; list-style: none;">
                @foreach($pressReases as $pressRease)
               <li class=" fa fa-newspaper-o " style="width: 100%"> {{$pressRease->subject}} <a href="{{url('/press-release/view')}}/{{$pressRease->id}}" class="btn btn-warning fa fa-eye pull-right" style="color: #fff"></a></li>  
                @endforeach
                   
                </ul>
              </div>
          </div>
       
        </div>
     
      
    </main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
  <!--   <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "scrollY":        "80px",
        "scrollCollapse": true,
        "paging":         false,
        "searching":  false,
        "bInfo" : false
    } );
} );


/*var numShown = 2; // Initial rows shown & index
var numMore = 5;  // Increment

var $table = $('table').find('tbody');  // tbody containing all the rows
var numRows = $table.find('tr').length; // Total # rows

$(function () {
    // Hide rows and add clickable div
    $table.find('tr:gt(' + (numShown - 1) + ')').hide().end()
        .after('<tbody id="more"><tr><td colspan="' +
               $table.find('tr:first td').length + '"><div><a style="cursor: pointer; ">Show <span>' +
               numMore + '</span> More</a></div</tbody></td></tr>');

    $('#more').click(function() {
        numShown = numShown + numMore;
        // no more "show more" if done
        if (numShown >= numRows) {
            $('#more').remove();
        }
        // change rows remaining if less than increment
        if (numRows - numShown < numMore) {
            $('#more span').html(numRows - numShown);
        }
        $table.find('tr:lt(' + numShown + ')').show();
    });

});*/

 $('.carousel').carousel({
  interval: 2000,
})


</script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>