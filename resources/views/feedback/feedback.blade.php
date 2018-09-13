<!DOCTYPE html>
<html>
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     {!!View('partials.include_css')!!}
           <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>


    <title>Feedback - IIFM MIS</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="lockscreen-content">
         <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
     
      <div class="lock-box" style="width: 70%">

        <h4 class="text-center user-name">Feedback Form</h4>
        <p class="text-center text-muted"></p>
        <form class="unlock-form" action="{{url('/feedback/store')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
              <label for="exampleInputEmail1">Subject</label>
              <input type="text" name="subject" id="subject"  placeholder="Subject" class="form-control" required="">
          </div>
           <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                   <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                   
                </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary " type="submit"><i class=""></i>Submit Your Feedback </button>
              <a href="{{url('/')}}" class="btn btn-info pull pull-right" style="font-weight: bold;"> Login Here</a>
          </div>
          <h6 class="text-center user-name" style="color: red">Note:-This form does not capture any data/id of the sender it is completely anonymous.</h6>
        </form>
      
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
      {!!View('partials.include_js')!!}
<script>
      CKEDITOR.replace( 'description' , {
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


</html>