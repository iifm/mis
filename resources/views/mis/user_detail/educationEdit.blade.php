<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>IIFM MIS</title>
    
    

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

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
          <h1><i class="fa fa-graduation-cap "></i> User Education </h1>
        </div>
      </div>
      <div class="row  tile">
      <!--   <a href="#" class="btn btn-primary fa fa-plus add_course">ADD</a> -->
       <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger"> Back</a>
        <div class="col-md-12">
          <form action="{{url('/user-education/update')}}" method="post" autocomplete="off">

            {{ csrf_field() }}
          <ul style="list-style-type: none;" class="education_form">
            <li>
              <div class="row">
            <div class="col-md-12">
               <div class="col-md-4"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Course Name</label>
                    <select class="form-control" name="edu_option" id="edu_option">
                      <option >Select Course</option> 
                      @foreach($education_options as $edu)
                      <option value="{{$edu->id}}">{{$edu->name}}</option> 
                     @endforeach
 
                    </select>
                </div>
             </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
               <div class="col-md-2"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Start Year</label>
                    <input class="form-control date-own" id="strtyear" name="strtyear" type="text" aria-describedby="emailHelp" placeholder="Start Year">
                </div>
             </div>
              <div class="col-md-2"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">End Year</label>
                    <input class="form-control date-own" id="endyear" name="endyear" type="text" aria-describedby="emailHelp" placeholder="End Year">
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">College/Institution</label>
                    <input class="form-control" id="college" name="college" type="text" aria-describedby="emailHelp" placeholder="College/Institution">
                </div>
             </div>

              <div class="col-md-3 "> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Specialization</label>
                    <input class="form-control" id="specialization" name="specialization" type="text" aria-describedby="emailHelp" placeholder="Specialization">
                </div>
             </div>
              <div class="col-md-3 "> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Percentage/Grades</label>
                    <input class="form-control" id="percentage" name="percentage" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)">
                </div>
             </div>
              <div class="col-md-3 "> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Added By</label>
                    <input class="form-control" id="addedby" name="addedby" type="text" aria-describedby="emailHelp" placeholder="Added By">
                </div>
             </div>
             
            </div>
          </div>
          </li>
        </ul>
       
    <div class="tile-footer">
              <button class="btn btn-success fa fa-save" type="submit">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>

    </main>

   


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
<script type="text/javascript">
  // Add new input with associated 'remove' link when 'add' button is clicked.
$('.add_course').click(function(e) {
    e.preventDefault();

    $(".education_form").append(
        '<li>'

      + '<div class="row"><div class="col-md-12"><div class="col-md-4"> <div class="form-group"><label for="exampleInputEmail1">Course Name</label><select class="form-control" name="course[]" id="course"><option>Select Course</option> <option>10th</option><option>12th</option><option>Graducation</option><option>Post Graducation</option><option>Diploma/Certificate</option><option>Other</option> </select></div></div><div class="col-md-2"><div class="form-group"><label for="exampleInputEmail1">Start Year</label><input class="form-control date-own" id="strtyear" name="strtyear[]" type="text" aria-describedby="emailHelp" placeholder="Start Year"></div></div><div class="col-md-2"> <div class="form-group"><label for="exampleInputEmail1">End Year</label><input class="form-control date-own" id="endyear" name="endyear[]" type="text" aria-describedby="emailHelp" placeholder="End Year"></div></div><div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">College/Institution</label><input class="form-control" id="college" name="college[]" type="text" aria-describedby="emailHelp" placeholder="College/Institution"></div></div><div class="col-md-3 "><div class="form-group"><label for="exampleInputEmail1">Specialization</label><input class="form-control" id="specialization" name="specialization[]" type="text" aria-describedby="emailHelp" placeholder="Specialization"></div></div><div class="col-md-3 "><div class="form-group"><label for="exampleInputEmail1">Percentage/Grades</label><input class="form-control" id="percentage" name="percentage[]" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)"></div></div><div class="col-md-3 "> <div class="form-group"><label for="exampleInputEmail1">Added By</label><input class="form-control" id="addedby" name="addedby[]" type="text" aria-describedby="emailHelp" placeholder="Added By"></div></div></div></div>'
      + '<a href="#" class="remove_education btn btn-danger fa fa-trash" > Remove</a>'
      + '</li>');
});



// Remove parent of 'remove' link when link is clicked.
$('.education_form').on('click', '.remove_education', function(e) {
    e.preventDefault();

    $(this).parent().remove();
});
</script>

<script type="text/javascript">
            // When the document is ready
         
    
     <script type="text/javascript">
      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
  </script>

  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

