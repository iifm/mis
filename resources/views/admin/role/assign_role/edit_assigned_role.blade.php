<!DOCTYPE html>
<html lang="en">

<head>
  
    <title> Role Management</title>
 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
   </head>

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
        <h1 class="heading_title"><i class="fa fa-handshake-o  "></i> Assign User(s) Role Management </h1>
        </div>
         <a href="{{url('/assign-role/index')}}" class="fa fa-handshake-o  btn btn-primary" style="background: #009688; border:none"> View All User's Assigned Role</a>   
      </div>
      <div class="row  tile">
        <div class="col-md-12">
          <form action="{{url('/assign-role/update')}}/{{$id}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
             @foreach($edit_user_roles as $edit_user_role)    
            <div class="row">
            <div class="col-md-12">
              
            <div class="col-md-10"> 
              <div class="form-group">
                    <label>Employee Name</label>
                   <input type="text" value="{{$edit_user_role['name']}}" class="form-control" name="name" >
                </div>
             </div>
              <div class="col-md-10"> 
              <div class="form-group">
                    <label >Assigned Role </label>
                    <select class="form-control demoSelect" name="assigned-role[]"  multiple="" required="">
                      @foreach($role_name as $role_names)
                        @foreach($role_names as $role)

                      <option value="{{$role['id']}}" selected="selected">{{$role['name']}}</option>
                        @endforeach
                       @endforeach

                       @foreach($all_roles as $all_role)
                      <option value="{{$all_role->id}}">{{$all_role->name}}</option>
                       @endforeach
                    </select>
                   
                </div>
             </div>
             </div>
           </div>
           @endforeach      
          </li>
        </ul>
       
    <div class="tile-footer">
              <button  class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none;">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
<script type="text/javascript" src="{{URL::To('public/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $('.demoSelect').select2();
</script>

  </body>

</html>

