<!DOCTYPE html>
<html lang="en">
  

<head>
    
    <title>IIFM MIS</title>
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
       <h3 class="tile-title" style="font-family: Times New Roman">OFFICIAL INFORMATION  <a class="btn btn-success fa fa-plus" href="{{url('/user-official')}}"></a> <a class="btn btn-success fa fa-pencil" href="{{url('/user-official')}}"></a></h3>

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

            </table>
       
    </div>  
  </div>
</div>
 <!-- url('storage/app/profile/'.$user->profile)  -->
@else
@foreach($user_detail as $user) 
<div class="row">
  <div class="col-md-12">
    <div class="col-md-3">
    
   <div class="card tile" style="height: 320px;">
    <img class="" width="100%" height="200" src="{{URL::To('storage/app/profile/'.$user->profile)}}" alt="Profile image">
    <div class="card-body">
      <h4 class="card-title" style="font-family: Times New Roman;text-align: center;">{{Auth::user()->name}}</h4>
      <p class="card-text" style="text-align: center">{{$user->designation}}
    </div>
  </div>
      
    </div>
     <div class="col-md-9 tile">
       <h3 class="tile-title" style="font-family: Times New Roman">OFFICIAL INFORMATION  <a class="btn btn-success fa fa-pencil" href="{{url('/user-official')}}"></a> 
         <!--  @if(Auth::user()->role=='Admin')
        <a class="btn btn-info fa fa-eye" href="#"> VIEW ALL EMPLOYEE</a></h3>
        @endif -->
            <table class="table">
            <tr>
              <th>Email ID</th>
              <td>{{Auth::user()->email}}</td>
            </tr>
             <tr>
              <th>Mobile</th>
              <td>{{$user->mobile}}</td>
            </tr>
             <tr>
              <th>Employee ID</th>
              <td>IIFM{{ str_pad(Auth::user()->id,4,"0",STR_PAD_LEFT) }}</td>
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
              <td>{{$user->doj}}</td>
            </tr>

            </table>
       
    </div>
  </div>
</div>
@endforeach
@endif
<div class="row">
  <div class="col-md-12 tile">
     <h3 class="tile-title" style="font-family: Times New Roman">EDUCATIONAL INFORMATION <a href="{{url('/user-education/add')}}" class="btn btn-success fa fa-plus"></a> </h3>
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
              <th>Action</th>
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

              <td><a href="{{url('/education-delete')}}/{{$value->id}}" class="btn btn-danger fa fa-trash" onclick="return confirm('Are you sure you want to delete this item?');"></a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12 tile">
     <h3 class="tile-title" style="font-family: Times New Roman">PROFESSIONAL INFORMATION <a href="{{url('/user-professional')}}" class="btn btn-success fa fa-plus"></a></h3>
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
               <th width="5%">Action</th>
             
              
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
              <td><a href="{{url('/profession-delete')}}/{{$value->id}}" class="btn btn-danger fa fa-trash" onclick="return confirm('Are you sure you want to delete this item?');"></a></td>
            </tr>
          </tbody>
          @endforeach
        </table>
           
  </div>
</div>

  <div class="row">
  <div class="col-md-12 tile">
     <h3 class="tile-title" style="font-family: Times New Roman">PERSONAL INFORMATION <a href="{{url('/user-personal')}}" class="btn btn-success fa fa-plus"></a></h3>
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
     <h3 class="tile-title" style="font-family: Times New Roman">FAMILY INFORMATION  <a href="{{url('/user-family')}}" class="btn btn-success fa fa-plus"></a></h3>
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
</main>




    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>