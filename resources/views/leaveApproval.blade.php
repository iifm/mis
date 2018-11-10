<!DOCTYPE html>
<html>
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     {!!View('partials.include_css')!!}

    <title>Approval - IIFM MIS</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="lockscreen-content">
         <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
    @foreach($user_details as $leave)
      <div class="lock-box" >
        <h4 class="text-center user-name">Leave Approval Form</h4>
      <!--   <p class="text-center text-muted">Account Locked</p> -->
        <form class="unlock-form" action="{{url('leave-approved')}}/{{$id}}/{{$uid}}" method="post" style="margin-top: 20px;">
          {{csrf_field()}}
         
         <div class="row">
          <div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Name</label>
            <input class="form-control" type="text" name="name"  value="{{$leave->name}}"  required="" readonly="">
          		</div>
          	</div>
          	<div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Email Id</label>
            <input class="form-control" type="text" name="email" value="{{$leave->email}}"  required="" readonly="">
          		</div>
          	</div>
          	<div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Mobile Number</label>
            <input class="form-control" type="text" name="mobile" value="{{$leave->mobile}}"  required="" readonly="">
          		</div>
          	</div>
          </div>
        
         <div class="row">
          <div class="col-md-4 col-sm-6">
            <div class="form-group">
            <label class="control-label">Leave Start Date</label>
            <input class="form-control" type="text" name="leavefrom" value="{{$leave->leavefrom}}" autofocus required="" readonly="">
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
            <div class="form-group">
            <label class="control-label">Leave End Date</label>
            <input class="form-control" type="text" name="leaveto" value="{{$leave->leaveto}}"  autofocus required="" readonly="">
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
            <div class="form-group">
            <label class="control-label">Total Leaves (in days)</label>
            <input class="form-control" type="text" name="totdays" value="{{$leave->totalleave}}"  autofocus required="" readonly="">
              </div>
            </div>
          </div>
            <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Leave Type</label>
            <input class="form-control" type="email" name="leaveoff" value="{{$leave->leavetype}}" autofocus required="" readonly="">
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Select Action <span style="color: red">*</span></label>
           <select class="form-control" name="actionstatus" required="">
             <option value="">Select Action</option>
             <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
            
           </select>
              </div>
            </div>
          </div>
             <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Reason for Leave</label>
            <textarea class="form-control" name="reason" id="" rows="3" readonly="">{{$leave->reason}}</textarea>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Commnent for Action(Not Mandatory)</label>
           <textarea class="form-control" name="comment" placeholder="Commnent for Action" id="" rows="3"></textarea>
              </div>
            </div>
           
          </div>
         <div class="row">
          <div class="col-md-12">
          <center> <button class="btn btn-primary" type="submit" style="margin-top: 10px;"><i class=""></i>SUBMIT YOUR RESPONSE </button></center> 
          </div>
          </div>
        </form>
     
      </div>
      @endforeach
    </section>
  
    <!-- Essential javascripts for application to work-->
      {!!View('partials.include_js')!!}

  </body>


</html>