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
   
      <div class="lock-box" style="min-height: 500px;min-width: 700px;">
        <h4 class="text-center user-name">Attendance Approval Form</h4>
      <!--   <p class="text-center text-muted">Account Locked</p> -->
        <form class="unlock-form" action="{{url('/update-attendance/approved/store')}}/{{$id}}" method="post" style="margin-top: 20px;">
          {{csrf_field()}}
         
         <div class="row">

          <div class="col-md-12" style="font-size:16px; color:red; padding-bottom:20px;"><center>{{$message}}</center></div>

          <div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Name</label>
            <input class="form-control" type="text" name="name"  value="{{$attendance_details->username}}"  required="" readonly="">
          		</div>
          	</div>
          	<div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Email Id</label>
            <input class="form-control" type="text" name="email" value="{{$attendance_details->email}}"  required="" readonly="">
          		</div>
          	</div>
          	<div class="col-md-4">
          	<div class="form-group">
            <label class="control-label">Applicant Mobile Number</label>
            <input class="form-control" type="text" name="emobile" value="{{$attendance_details->mobile}}"  required="" readonly="">
          		</div>
          	</div>
          </div>
        
         <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <label class="control-label">Attendance Date</label>
            <input class="form-control" type="text" name="date" value="{{date('j F Y',strtotime($attendance_details->date))}}" autofocus required="" readonly="">
              </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
            <label class="control-label">IN Time</label>
            <input class="form-control" type="text" name="in_time" value="{{$attendance_details->in_time}}"  autofocus required="" readonly="">
              </div>
            </div>
             <div class="col-md-4">
            <div class="form-group">
            <label class="control-label">OUT Time</label>
            <input class="form-control" type="text" name="out_time" value="{{$attendance_details->out_time}}"  autofocus required="" readonly="">
              </div>
            </div>
           
          </div>
           
             <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Reason for Leave</label>
            <textarea class="form-control" name="reason" id="" rows="3" readonly="">{{$attendance_details->reason}}</textarea>
              </div>
            </div>
         
            <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Comment for Action(Not Mandatory)</label>
           <textarea class="form-control" name="comment" placeholder="Comment for Action" id="" rows="3"></textarea>
              </div>
            </div>
                  <div class="col-md-6">
            <div class="form-group">
            <label class="control-label">Select Action <span style="color: red">*</span></label>
           <select class="form-control" name="action" required="">
             <option value="">Select Action</option>
             <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
            
           </select>
              </div>
            </div>
             <div class="col-md-6">
           
           <button class="btn btn-primary" type="submit" style="margin-top: 25px; "><i class=""></i>SUBMIT YOUR RESPONSE </button>
              
            </div>
            
          </div>
        
        </form>
     
      </div>
     
    </section>
    <img src="{{URL::To('public/images/mis-logo.png')}}" class="pull-left" height="60" style="position: fixed;left: 20px;bottom: 20px;"> 
    <!-- Essential javascripts for application to work-->
      {!!View('partials.include_js')!!}

  </body>


</html>