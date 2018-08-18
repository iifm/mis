<script src="{{ asset('/js/jquery-3.2.1.min.js') }}" defer ></script>
<script src="{{ asset('/js/popper.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('js/main.js') }}" ></script>
<script src="{{ asset('js/plugins/pace.min.js') }}" ></script>
<script src="{{ asset('js/plugins/chart.js') }}" ></script>
<script type="text/javascript">
      var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56]
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
          }
        ]
      };
      var pdata = [
        {
          value: 300,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Complete"
        },
        {
          value: 50,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "In-Progress"
        }
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
</script>
<!-- Session Message Fade up -->
<script>
   window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);
    </script>

<!-- Data tables 
 js/plugins/jquery.dataTables.min.js 
 js/plugins/dataTables.bootstrap.min.js

  -->
    <!--   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
 <!-- Data table plugin-->
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
<script type="text/javascript" src="http://weareoutman.github.io/clockpicker/dist/jquery-clockpicker.min.js"></script>

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
          if (e.shiftKey || e.ctrlKey || e.altKey) {
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