<!DOCTYPE html>
<html lang="en">
  

<head>
    
    <title>User Profile</title> 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

     <style type="text/css">
       .tile-title .btn{float: right;}
     </style>

  </head>
  
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    
    {!!View('partials.header')!!}

    <!-- Sidebar menu-->
    {!!View('partials.sidebar')!!}


    
    <!-- Main Content-->
   <main class="app-content">

     @if(Session::has('message'))
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}
        </div>
     @endif
      

@if(count($user_detail)==0)

<div class="row">
  <div class="col-md-12">
    <div class="col-md-3">
      <div class="card tile" style="height: 320px;">
        <img class="" width="100%" height="200" src="{{ URL::asset('images/user.png') }}" alt="Profile image">
        <div class="card-body">
          <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{Auth::user()->name}}</h4>
          <p class="card-text" style="text-align: center">
        </div>
      </div> 
    </div>
    <div class="col-md-9 tile">
      <h3 class="tile-title heading_title">OFFICIAL INFORMATION 
       <a class="btn btn-success fa fa-pencil" href="{{url('/user-official')}}/{{Auth::user()->id}}"></a></h3>

          <table class="table">
            <tr>
              <th>Email ID</th>
              <td>{{Auth::user()->email}}</td>
            </tr>
             <tr>
              <th>Mobile</th>
              <td> Add Your Mobile</td>
            </tr>
             <tr>
              <th>Employee ID</th>
              <td><?php $id=Auth::user()->id; echo str_pad($id,8,"IIFM");?></td>
            </tr>
             <tr>
              <th>Department</th>
              <td> Add Your Department</td>
            </tr>
             <tr>
              <th>Location/Centre</th>
              <td> Add Your Location/Centre</td>
            </tr>
            <tr>
              <th>Date Of Joining</th>
              <td> Add Your Date Of Joining</td>
            </tr>
            <tr>
              <th>Date Of Birth</th>
              <td> Add Your Date Of Birth</td>
            </tr>
          </table>
       
    </div>  
  </div>
</div>
 <!-- url('storage/app/profile/'.$user->profile)  -->
@else
@foreach($user_detail as $user) 
<div class="row">
  <div class="col-md-12">
     @if($user->profile=='')
    <div class="col-md-3" style="padding: 0px;">
   <div class="card tile" style="min-height: 320px; margin-right: 20px; margin-left: -10px; padding: 0px">

    <img class="" width="100%" src="{{ URL::To('public/images/usser.png') }}" alt="Profile image">

    <div class="card-body">
        <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$user->name}}</h4>
       <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$user->designation}}</h4>

      
    </div>
  </div> 
    </div>
    @else
     <div class="col-md-3" style="padding: 0px;">
   <div class="card tile" style="min-height: 320px; margin-right: 20px; margin-left: -10px; padding: 0px;">
    <!-- <div style="padding:0; margin:0; width:100%; height:250px; background:url('{{URL::To('storage/app/profile/'.$user->profile)}}') no-repeat center;">
      
    </div> -->
    
    <img class="" width="100%" src="{{URL::To('storage/app/profile/'.$user->profile)}}" alt="Profile image">
    
    <div class="card-body">
      <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$user->name}}</h4>
       <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{$user->designation}}</h4>
       
    </div>
  </div> 
    </div>
      @endif

     <div class="col-md-9 tile">
        
       <h3 class="tile-title heading_title">OFFICIAL INFORMATION 
        @if($view_details=='SHOW' && $edit_option=='True')

        <a class="btn btn-success fa fa-pencil" href="{{url('/user-official')}}/{{$user_id}}" style="background: #009688;border: none;"></a>
        @endif
      </h3>
       
         <!--  @if(Auth::user()->role=='Admin')
        <a class="btn btn-info fa fa-eye" href="#"> VIEW ALL EMPLOYEE</a></h3>
        @endif -->
            <table class="table">
            <tr>
              <th>Email ID</th>
              <td>{{$user->email}}</td>
            </tr>
           <!--   <tr>
              <th>Mobile</th>
              <td>{{$user->mobile}}</td>
            </tr> -->
             <tr>
              <th>Employee ID</th>
              <td>IIFM{{ str_pad($user->user_id,4,"0",STR_PAD_LEFT) }}</td>
            </tr>
             <tr>
              <th>Department</th>
              <td>{{$user->department}}</td>
            </tr>
             <tr>
              <th>Location/Centre</th>
              <td>{{$user->locationcentre}}</td>
            </tr>
             <tr>
              <th>Date Of Joining</th>
              <td>{{date('j F  Y',strtotime($user->doj))}}</td>
            </tr>
            <tr>
              <th>Date Of Birth</th>
              <td>{{date('j F  Y',strtotime($user->dob))}}</td>
            </tr>
            </table>
       
    </div>
  </div>
</div>
@endforeach
@endif

@if($view_details=='SHOW')
<div class="row">
  <div class="col-md-12 tile">

     
     <h3 class="tile-title heading_title">EDUCATIONAL INFORMATION 
      @if($edit_option=='True' && $view_details=='SHOW')
      <a href="{{url('/user-education/add')}}/{{$user_id}}" class="btn btn-success fa fa-plus" style="background: #009688;border: none;"></a> 
      @endif
    </h3>


      <table class="table-responsive table" >     
           <thead >
            <tr>
              <th>#</th>
              <th width="10%">Course Name</th>
               <th width="10%">College/Institution</th>
              <th>Board/University</th>
              <th>Start Year</th>
              <th>End Year</th>
              <th>Specialization</th>
              <th>Percentage/Grades</th>
              <th>Certificate</th>
              @if($edit_option=='True' && $view_details=='SHOW')
              <th width="10%">Action</th>
            @endif
              <!-- <th>Action</th> -->
              
            </tr>
          </thead><?php $i=1; ?>
          @foreach($useredu as $value)

          <tbody>
            <tr>
              <td>{{$i++}}</td>
              <td >{{$value->course_type}}</td>
               <td>{{$value->schoolname}}</td>
              <td>{{$value->board}}</td>
              <td>{{$value->strtyear}}</td>
              <td>{{$value->endyear}}</td>
              <td>{{$value->specialization}}</td>
              <td>{{$value->percentage}}</td>
             
              <td>
                 @if(($value->certificate)!='')
                <a href="{{ URL::To('storage/app/education/'.$value->certificate) }}" target="_blank"><img src="{{ URL::To('storage/app/education/'.$value->certificate) }}"  height="50px" width="50px"></a>
                @endif
              </td>
                @if($edit_option=='True' && $view_details=='SHOW')
              <td>
                <a href="{{url('/education-edit')}}/{{$value->id}}/{{$user_id}}" class="btn btn-primary fa fa-pencil" style="background: #009688; border:none"></a>
               <!--  <a href="{{url('/education-delete')}}/{{$value->id}}/{{$user_id}}" class="btn btn-danger fa fa-trash" onclick="return confirm('Are you sure you want to delete this item?');"></a> -->
              </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12 tile">
    
     <h3 class="tile-title heading_title">WORK EXPERIENCE(S)
       @if($edit_option=='True' && $view_details=='SHOW')
      <a href="{{url('/user-professional')}}/{{$user_id}}" class="btn btn-success fa fa-plus" style="background: #009688;border: none;"></a>
       @endif
    </h3>
     
       <table class="table-responsive table" >
           <thead>
            <tr>
              <th>#</th>
              <th width="10%">Company Name</th>
              <th width="10%">Designation</th>
              <th width="10%">From</th>
              <th width="10%">To</th>
              <th width="20%">Company Address</th>
              <th width="10%">Offer/Appointment Letter</th>
              <th width="10%" align="center">Relieving/Experience Letter</th>
                @if($edit_option=='True' && $view_details=='SHOW')
               <th width="10%">Action</th>
               @endif
             
              
            </tr>
          </thead>
          <?php $J=1; ?>
          @foreach($user_work as $value)
          <tbody>
            <tr>
              <td>{{$J++}}</td>
              <td>{{$value->company}}</td>
              <td>{{$value->designation1}}</td>
              <td>{{$value->fromdate}}</td>
              <td>{{$value->todate}}</td>
              <td>{{$value->address}}</td>

               <td>
                @if(($value->offerletter)!='')
                <a href="{{ URL::To('storage/app/professional/'.$value->offerletter) }}" target="_blank"><img src="{{ URL::To('storage/app/professional/'.$value->offerletter) }}" alt="Click Here"  height="50px" width="50px">
                </a>
                @endif
              </td>
               <td>
                 @if(($value->relievingletter)!='')
                <a href="{{ URL::To('storage/app/professional/'.$value->relievingletter) }}" target="_blank"><img src="{{ URL::To('storage/app/professional/'.$value->relievingletter) }}" alt="Click Here"  height="50px" width="50px">
                  @endif
                </a>
              </td>
                @if($edit_option=='True' && $view_details=='SHOW')
               <td><a href="{{url('/user-professional/edit')}}/{{$value->id}}/{{$user_id}}" class="btn btn-primary fa fa-pencil" style="background: #009688; border:none"></a>
            <!--   <a href="{{url('/profession-delete')}}/{{$value->id}}/{{$user_id}}" class="btn btn-danger fa fa-trash" onclick="return confirm('Are you sure you want to delete this item?');"></a> --></td>
            @endif

             
            </tr>
          </tbody>
          @endforeach
        </table>
           
  </div>
</div>

<div class="row">
  <div class="col-md-12 tile">
    
     <h3 class="tile-title heading_title">PERSONAL INFORMATION 
        @if($edit_option=='True' && $view_details=='SHOW')
      <a href="{{url('/user-personal')}}/{{$user_id}}" class="btn btn-success fa fa-pencil" style="background: #009688;border: none;"></a>
      @endif
    </h3>
    
     @foreach($user_detail as $detail)
      <table class="table" width="100%">
            <tr>
              <th>Gender</th>
              <td>{{$detail->gender}}</td>
            </tr>
             <tr>
              <th>Date of Birth</th>
              <td>{{$detail->dob}}</td>
            </tr>
             <tr>
              <th>Current Address</th>
              <td>{{$detail->cstreet}} {{$detail->ccity}} {{$detail->cstate}}</td>
            </tr>
             <tr>
              <th>Permanent Address</th>
              <td>{{$detail->pstreet}} {{$detail->pcity}} {{$detail->pstate}}</td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td>{{$detail->mobile}}</td>
            </tr>
             <tr>
              <th>Alternate Contact Number</th>
              <td>{{$detail->altno}}</td>
            </tr>
            @endforeach
            </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12 tile">
    
     <h3 class="tile-title heading_title">FAMILY INFORMATION 
        @if($edit_option=='True' && $view_details=='SHOW')
      <a href="{{url('/user-family')}}/{{$user_id}}" class="btn btn-success fa fa-pencil" style="background: #009688;border: none;"></a>
      @endif
    </h3>
    
     @foreach($user_detail as $family)
      <table class="table">
            <tr>
              <th>Father Name</th>
              <td>{{$family->fname}}</td>
            </tr>
             <tr>
              <th>Father's Occuption</th>
              <td>{{$family->foccup}}</td>
            </tr>
             <tr>
              <th>Father's Contact Number</th>
              <td>{{$family->fcontact}}</td>
            </tr>
            <tr>
              <th>Mother Name</th>
              <td>{{$family->mname}}</td>
            </tr>
             <tr>
              <th>Mother's Occuption</th>
              <td>{{$family->moccup}}</td>
            </tr>
             <tr>
              <th>Mother's Contact Number</th>
              <td>{{$family->mcontact}}</td>
            </tr>
             <tr>
              <th>Marital Status</th>
              <td>{{$family->maritalstatus}}</td>
            </tr>
             <tr>
              <th>Spouse Name</th>
              <td>{{$family->spname}}</td>
            </tr>
            <tr>
              <th>Spouse Occuption</th>
              <td>{{$family->spoccup}}</td>
            </tr>
            <tr>
              <th>Marriage Anniversery Date</th>
              <td>{{$family->anniversary}}</td>
            </tr>
          </table>
          @endforeach
  </div>
</div>
@endif
</main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>