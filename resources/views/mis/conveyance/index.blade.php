<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>View Conveyance</title>
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
      <h4 class="heading_title">
        <i class="fa fa-th-list"></i> Conveyance Management     
      </h4>
    </div>
      <a href="{{url('/conveyance')}}" class="btn btn-primary fa fa-plus pull-right"> ADD Conveyance</a>
    
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div id="table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
              <div class="col-sm-12 pre-scrollable">
              <?php $i=1;?>
               <?php if(Session::has('message')) {?>
                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                </div><?php } ?>
                <div id="success_msg" class="alert alert-success" style="display: none;">
                  
                </div>
                  <table class="table table-hover table-stripped" id="sampleTable" role="grid" >
                     <thead>
                        <tr role="row">
                          <th>#</th>
                          <th>Conveyance Date</th>
                          <th>Travel From</th>
                          <th >Travel To</th>
                          <th>Travel Mode</th>
                          <th>Image</th>
                          <th>Distance</th>
                          <th>Amount</th>
                          <th>Manager's Action</th>
                         
                        </tr>
                    </thead>
                     
                    <tbody>
                     
                       @foreach($conveyance as $con)
                      <tr role="row" class="odd">
                        <td><?= $i++;?></td>
                        <td>{{$con->con_date}}</td>
                        <td>{{$con->disfrom}}</td>
                        <td>{{$con->disto}}</td>
                        @if($con->mode=="3.5")
                        <td>CAR</td>
                        @elseif($con->mode=="2.5")
                         <td>BIKE</td>
                         @else
                         <td>{{$con->mode}}</td>
                         @endif
                         <td><a href="{{URL::To('storage/app/conveyance')}}/{{$con->uploadcimg}}" target="_blank"><img src="{{URL::To('storage/app/conveyance')}}/{{$con->uploadcimg}}" height="50px" width="50px"></a></td>
                        <td>{{$con->distance}}</td>
                        <td>{{$con->amount}}</td>
                        @if($con->status=='PENDING')
                        <td align="right">
                           <input type="hidden" name="approver" id="approver" value="{{Auth::user()->id}}">
                          <input type="text" class="approved_amount" name="" value="{{$con->amount}}" id="approved_amount_{{$con->id}}" style="width:60px;">
                          <button type="button" value="{{$con->id}},approve," class="btn btn-primary fa fa-thumbs-up approve" id="{{$con->id}}"></button>
                          <button type="button" value="{{$con->id}},disapprove" class="btn btn-danger fa fa-thumbs-down disapprove" id="{{$con->id}}"></button>
                        </td>
                       @else
                           <td align="right"><b>{{$con->approved_amount}}  {{$con->status}}</b> <button value="{{$con->id}}" class="btn btn-danger fa fa-close action_again"></button> </td>
                       @endif
                   </tr>
                     @endforeach
                </tbody>
                
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
</main>

    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}
<script type="text/javascript">
  $(document).ready(function(){
    $('.approve').on('click',function(){
      var id_action=$(this).val();
      var con_id = $(this).attr('id');
      var approver=$('#approver').val();
      var appr_amount = $('#approved_amount_'+con_id).val();
        $.get("{{url('/conveyance-approve')}}/"+id_action+"/"+appr_amount+"/"+approver,function(data){
            alert(data);
            location.reload();
          
        });
    });
     $('.disapprove').on('click',function(){
       var id_action=$(this).val();
      var con_id = $(this).attr('id');
      var approver=$('#approver').val();
      var appr_amount = $('#approved_amount_'+con_id).val();
        $.get("{{url('/conveyance-approve')}}/"+id_action+"/"+appr_amount+"/"+approver,function(data){
             alert(data);
              location.reload();   
        });
    });
    $('.action_again').on('click',function(){
      var action_again=$(this).val();
      $.get("{{url('/conveyance/re-action')}}/"+action_again,function(data){
            alert(data);
             location.reload();  
      });
    })
  });
</script>
 </body>

</html>