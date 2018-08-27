<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>Send Wish</title>

    <!-- Main CSS-->
    {!!View('partials.include_css')!!}

  </head>
  
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>

    {!!View('partials.header')!!}


    <!-- Sidebar menu-->
    {!!View('partials.sidebar')!!}


    
    <!-- Main Content-->
 <main class="app-content">
      <div class="app-title">
        <div>
          <h1 class="heading_title" style="color:#007d71;"><i class="fa fa-birthday-cake"></i> Wish </h1>
        </div>
          <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-danger" style="background: #009688; border:none"> Back</a>   
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="col-md-12">
          @foreach($user_data as $user)
            <h3 class="tile-title">Send your best wishes to<span style="color: red"> {{$user->name}}</span></h3>
            <div class="tile-body">
              <form class="row" method="post" action="{{route('wish-send')}}">
                {{ csrf_field() }}

               
                
                <div class="row col-md-12">
                <div class="form-group col-md-4">
                  <input class="form-control" value="{{$user->name}}" type="text" name="name"  readonly="">
                </div>
                <div class="form-group col-md-4">
                  <input class="form-control" name="email" value="{{$user->email}}" type="text"  readonly="">
                </div>

                <div class="form-group col-md-4">  
                 <input type="text" name="subject" value="{{$subject}}" class="form-control" readonly="">
                </div>

                <input type="hidden" value="{{$user->id}}" name="receiver_id">
                 <div class="form-group col-md-12 ">
                  <textarea class="form-control" rows="6" name="message" required="" placeholder="Type your message here..."></textarea>
                </div><br>
                @endforeach
                </div> 
                

       
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Send Mail</button>
                </div>
              </form>
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
      CKEDITOR.replace( 'message' , {
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