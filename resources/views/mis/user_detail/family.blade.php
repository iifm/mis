<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>User Family Information</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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
          <h1 class="heading_title"><i class="fa fa-users"></i> User Family Information </h1>
        </div>
          <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
        <div class="col-md-12">
          <form action="{{url('/user-family/add')}}/{{$id}}" method="post" autocomplete="off">

            {{ csrf_field() }}
          @foreach($user_details as $data)
        <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
           
             <strong><h4 class="heading_title">Father's Detail</h4></strong>
             <hr>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Father Name</label>
                    <input class="form-control capitalize char-only" value="{{$data->fname}}" id="fname" name="fname" type="text" aria-describedby="emailHelp" placeholder="Father Name" required="">
                </div>
             </div>

              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Father's Occuption</label>
                    <input class="form-control capitalize char-only" value="{{$data->foccup}}" id="foccup" name="foccup" type="text" aria-describedby="emailHelp" placeholder="Father's Occuption" required="">
                </div>
             </div>
              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Father's Contact Number</label>
                    <input class="form-control numbers-only" maxlength="10"value="{{$data->fcontact}}" id="fcontact" name="fcontact" type="text" aria-describedby="emailHelp" placeholder="Father's Contact Number" required="">
             </div>
            </div>

       
      </div>    
    </div>
     <div class="row">
            <div class="col-md-12">
              
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
         
            <strong><h4 class="heading_title">Mother's Detail</h4></strong>
             <hr>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mother Name</label>
                    <input class="form-control capitalize char-only" value="{{$data->mname}}" id="mname" name="mname" type="text" aria-describedby="emailHelp" placeholder="Mother Name" required="">
                </div>
             </div>

              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Mother's Occuption</label>
                    <input class="form-control capitalize char-only" value="{{$data->moccup}}" id="moccup" name="moccup" type="text" aria-describedby="emailHelp" placeholder="Mother's Occuption" required="">
                </div>
             </div>
              <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Mother's Contact Number</label>
                    <input class="form-control numbers-only" id="mcontact" value="{{$data->mcontact}}" name="mcontact" type="text" aria-describedby="emailHelp" placeholder="Mother's Contact Number" required="">
             </div>
          </div>

       
      </div>    
    </div>
         <div class="row">
            <div class="col-md-12">
           
           <strong><h4 class="heading_title">Marital Status</h4></strong>
             <hr>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Marital Status</label>
                    <select class="form-control" name="maritalstatus" id="maritalstatus" required="">
                      <option value="{{$data->maritalstatus}}">{{$data->maritalstatus}}</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Spouse Name</label>
                    <input class="form-control" id="spname" name="spname" value="{{$data->spname}}" type="text" aria-describedby="emailHelp" placeholder="Spouse Name"  >
                </div>
             </div>
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Spouse Occuption</label>
                    <input class="form-control" id="spoccup" name="spoccup" value="{{$data->spoccup}}" type="text" aria-describedby="emailHelp" placeholder="Spouse Occuption">
             </div>
          </div>
           <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1 demoDate">Marriage Anniversery Date</label>
                    <input class="form-control demoDate" id="anniversary" value="{{$data->anniversary}}" name="anniversary" type="text" aria-describedby="emailHelp" placeholder="Marriage Anniversery Date">
             </div>
          </div>
          @endforeach
       
      </div>    
    </div>
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}




  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

