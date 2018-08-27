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
             <div class="col-lg-12 col-lg-offset-1">
                <div class="input-group">
                   
                    <input type="text" autocomplete="off" id="search" class="form-control input-lg" placeholder="Search Here">
                </div>
              </div>
              <div id="txtHint" class="title-color col-lg-12" style="padding-top:0px; text-align:left; padding-left:30px; " >
                  <b>Search results will be listed here</b>
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
   

</script>
    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>