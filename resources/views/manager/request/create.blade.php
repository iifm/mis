<!DOCTYPE html>
<html lang="en">

<head>
  
    <title> Request Management</title>
 
    <!-- Main CSS-->
    {!!View('partials.include_css')!!}
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <h1 class="heading_title"><i class="fa fa-user-plus"></i> New Hiring </h1>
        </div>
         <a href="{{url('manager-zone/request/show-all')}}" class="fa fa-eye btn btn-primary" style="background: #009688; border:none"> View All Requests</a>   
      </div>
      <div class="row  tile">
        <div class="col-md-12">
          <form action="{{url('manager-zone/request/store')}}" method="post" enctype="multipart/form-data"  autocomplete="off">

            {{ csrf_field() }}
        
            
        <div class="row">
             
                <div class="col-md-4"> 
              <div class="form-group">
                  <strong><label for="">Department</label></strong>  
                    <select class="form-control" name="department" required="">
                      <option value="">Select Department</option>
                      @foreach($departments as $department )
                      <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for=""> Job Title</label></strong>
                    <input class="form-control" id="subject" name="subject" type="text" aria-describedby="emailHelp" placeholder="Title of your Request/Work" title="Ex:- I want to hire a team member." required>
                </div>
             </div>
               <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for="">Number of Opening(s)</label></strong>
                    <input class="form-control" id="subject" name="opening" type="text" aria-describedby="emailHelp" placeholder="Number of Opening(s)" title="Ex:- I want to hire a team member." required>
                </div>
             </div>
             </div>
             <div class="row">
               
               <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for=""> Location</label></strong>
                   <select class="form-control" name="location">
                     <option value="">Select Location</option>
                     <option></option>
                   </select>
                </div>
             </div>
              <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for=""> Type of Appointment</label></strong>
                   <select class="form-control" name="location">
                     <option value="">Select Type</option>
                     <option value="permanent">Permanent</option>
                     <option value="temporary">Temporary</option>
                     <option value="intern">Intern</option>
                   </select>
                </div>
             </div>
             <div class="col-md-4"> 
              <div class="form-group">
                   <strong> <label for=""> Existing Staff at present in this category</label></strong>
                   <select class="form-control" name="existing_staff">
                     <option value="">Select Employee</option>
                     <option value=""></option>
                    
                   </select>
                </div>
             </div>
             </div>
             <div class="row">
           <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Educational/Professional Qualification Required</label></strong>
                   <textarea class="form-control" placeholder="Educational/Professional Qualification Required" name="description" id="description" required=""></textarea>
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Skills Required</label></strong>
                   <textarea class="form-control" placeholder="Skills Required" name="description" id="description" required=""></textarea>
                </div>
             </div>
             <input type="hidden" name="sip" value="{{\Request::ip()}}">
             <input type="hidden" name="user_id" value="{{Auth::id()}}">
         
            
           </div>
           <div class="row">
             
             <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Job Description</label></strong>
                   <textarea class="form-control" name="jd" placeholder="Job Description" id="description" required=""></textarea>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Reason for Requirement</label></strong>
        <textarea class="form-control" name="reason" placeholder="Ex: Resignation / Work Load / Additional
Assignments" id="description" required=""></textarea>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Date by which Resource is Required</label></strong>
                   <input type="date" name="experience" class="form-control">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Experience Required</label></strong>
                   <input type="text" name="experience" class="form-control">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Can vacancy be filled through internal transfers/promotion</label></strong>
                   <textarea class="form-control" name="reason" placeholder="Can vacancy be filled through internal transfers/promotion" id="description" required=""></textarea>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                   <strong> <label for="">Benefits/Purpose for Additional Appointment</label></strong>
                   <textarea class="form-control" name="reason" placeholder="Benefits/Purpose for Additional Appointment" id="description" required=""></textarea>
                </div>
             </div>

           </div>
          
        
    <div class="tile-footer">
              <button  class="btn btn-success fa fa-save" type="submit" style="background: #009688; border:none;">  Submit</button>
           
            </div>
            </form> 
        </div>
      </div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
          <p>All <b>Recruitment Requisition</b>  procedure detailed below must be completed prior to the commencement on any recruitment procedure.<br><br>

a) Prior to the employment of any employee the Employee Requisition Form must be completed by the department Head.<br><br>

b) Requisition Form will be submitted to HR Department with a copy to the Director.  Upon receiving approval from the Director, 
HR Department will finally start processing the same.</p><br>
               
            </div>
        </div>
    </div>
</div>
    </main>

   


    <!-- Essential javascripts for application to work-->

   <!--  {!!View('partials.include_js')!!} -->
<script src="{{ asset('js/main.js') }}" ></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#myModal").modal('show');
  });
</script>
<script>
      CKEDITOR.replace( '' , {
    toolbar: [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    { name: 'links', items: ['Unlink', 'Anchor' ] },
    { name: 'insert', items: ['Flash', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'ShowBlocks' ] },
    { name: 'others', items: [ '-' ] },
    { name: 'about', items: [ 'About' ] }
]
});
     

    </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

