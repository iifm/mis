<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>SEARCH</title>

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
          <h1 class="heading_title"><i class="fa fa-search"></i> Search</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
             <div class="col-md-6 col-lg-4 col-lg-offset-1">
              <label>Search By Name</label>
                <div class="input-group">
                    <input type="text" autocomplete="off" id="search" style="text-align: left;" class="form-control input-lg" placeholder="Enter Name">
                </div>
                <div id="txtHint" class="title-color col-lg-12" style="padding-top:0px; margin-left: -10px;  " >
                
              </div>    

              </div>
              <div class="col-md-6 col-lg-4 col-lg-offset-1">
                <label>Search By Department</label>
                <div class="input-group">
                    <select class="form-control" name="department" id="department">
                      <option value="">Select Department</option>
                      @foreach($departments as $department)
                      <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                </div>
                <ol  id="departmentResult" style="list-style: none;">
                
                </ol>
              </div>
              </div>
                          
            </div>
          </div>
        </div>
      </div>
    </main>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
   <script>

  $( function() {
    $('#search').on('keyup',function(){
       var search=$('#search').val();
       if(search.length>2){
        //alert(search);
       
           $.get("{{url('/search/user/action')}}/"+search, function(data){
                  
                 $('#txtHint').html(data);

           }); 
        }

  });
});


  $('#department').on('change',function(){
     var department= $(this).val();
     var result='';
     $.get("{{url('/search-by-department')}}/"+department,function(data){
        $.each(data,function(i,item){
          result+="<li  style='padding:0px; margin-left:-30px;'><a href='{{url('/user-details')}}/"+data[i].user_id+"' style='color: black; '>"+data[i].name+" ("+data[i].designation+")</a></li>"
        });

        $('#departmentResult').html(result);
         
     });
  });
   

</script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>