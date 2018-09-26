<script src="{{ asset('/js/jquery-3.2.1.min.js') }}" defer ></script>
<script src="{{ asset('/js/popper.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('js/main.js') }}" ></script>
<script src="{{ asset('js/plugins/pace.min.js') }}" ></script>
<script src="{{ asset('js/plugins/chart.js') }}" ></script>

<!-- Session Message Fade up -->
<script>
   window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);
    </script>


    <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">$('#sampleTable').DataTable();

  </script>
 
  <!-- Datepicker plugin-->
   <script type="text/javascript" src="{{ asset('js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap-datepicker.min.js') }}"></script>


    <script type="text/javascript">

      var dateToday = new Date();
      
      $('.demoDate').datepicker({
        format: "dd/mm/yyyy",
         minDate: dateToday,
        autoclose: true,
        todayHighlight: true
      });
    </script>
<!-- TimePicker -->
<script type="text/javascript" src="{{URL::To('public/js/jquery-clockpicker.min.js')}}"></script>

    <script type="text/javascript">
      var input = $('.input-a');
input.clockpicker({
    autoclose: true
});

 </script>

<!-- Alert -->

    <script type="text/javascript" src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>

<script type="text/javascript">
  
   $('.demoSwal').click(function(){
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        }, function(isConfirm) {
          if (isConfirm) {
            swal("Deleted!", "Your data file has been deleted.", "success");
            
          } else {
            swal("Cancelled", "Your data file is safe :)", "error");
          }
        });
      });
</script>


 <script type="text/javascript">
    $(document).ready(function(){
    
      $(function () {
      $('.char-only').keydown(function (e) {
          if (e.ctrlKey || e.altKey) {
              e.preventDefault();
          } else {
              var key = e.keyCode;
              if (!((key == 8) ||(key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                  e.preventDefault();
              }
          }
      });
  });

  $(".numbers-only").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
});
  </script>