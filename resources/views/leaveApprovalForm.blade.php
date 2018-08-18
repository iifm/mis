<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
<div class="col-md-12">
	<div class="col-md-1"></div>
    <div class="col-md-10">
    
    	<div class="row">
            <div class="col-md-3" align="center"><img src="http://iifm.co.in/Images/logo.png" style="min-width:250px;" class="img-responsive"></div>
		</div>    
        
@foreach($leave_id as $leave)
		 
 <form name="empform" id="empform" method="post" action="{{url('leave-approved')}}/{{$leave->id}}/{{$uid}}">
        	<div id="responce-e" style="color:#FF0000;">
						</div>
                        {{csrf_field()}}
            <div class="panel-group" id="accordion"><!-- Starting of Toggle Parents Div -->
                <div class="panel panel-default"><!-- Starting of Toggle Div 1 --> 
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <p class="btn btn-primary form-control">Aprroval Form for Leave</p>
                        </h4>
                    </div>

					@foreach($userDetail as $user)
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="col-md-4">
                            	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Applicant Name</h4></label>
                            	<input readonly="" class="form-control" value="{{$user->user_name}}" type="text" name="efname" id="efname" >
                           	</div>
                            
                            <div class="col-md-4">
                            	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Applicant Email Id</h4></label>
                                <input readonly="" class="form-control" type="email" value="{{$user->user_email}}" name="elname" id="elname" >
                          	</div>
							
							
							<div class="col-md-4">
                            	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Mobile Number</h4></label>
                                <input readonly="" class="form-control" value="{{$user->user_mobile}}" type="mobile" name="emobile" id="emobile" value="">
                          	</div>
                        @endforeach
							
                            <div class="col-md-12" style="padding:0; margin-bottom:10px;">
                            
                                <div class="col-md-4">
                                	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Leave Start Date</h4></label>
                                	<input readonly="" class="form-control" value="{{$leave->leavefrom}}" type="text" name="leavefrom" id="leavefrom" >
                                </div>    
								
								                            
                                <div class="col-md-4">
                                	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Leave End Date</h4></label>
                                    <input readonly="" class="form-control" type="text" value="{{$leave->leavefrom}}" name="leaveto" id="leaveto" >
                               	</div>
                                
                                <div class="col-md-4">
                                	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Total Leaves (in days)</h4></label>
                                    <input class="form-control" type="text" value="{{$leave->totalleave}}" name="totdays" id="totdays"  readonly="">
                                </div>
                            </div>   
                                             
                            <div class="col-md-12" style="padding:0; margin-bottom:10px;">
                                <div class="col-md-6">
                                	<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Leave Type</h4></label><br>
                                    <input readonly="" class="form-control" value="{{$leave->leavetype}}" type="text" name="leaveoff" id="leaveoff" >
                                </div>
								<div class="col-md-6" style="margin-bottom:10px;">
								    <label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Select Action*</h4></label><br>
									<select id="laction" class="form-control" name="actionstatus" required="">
									<option >Please Select Action</option>
									<option value="approved">Approved</option>
									<option value="disapproved">Disapproved</option>
									<option value="pending">Pending</option>
									</select>
							    </div> 
                            </div>
                        
							
							<div class="col-md-12" style="padding:0; margin-bottom:10px;">
								<div class="col-md-6" style="margin-bottom:10px;">
									<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Reason for Leave</h4></label><br>
									<textarea class="form-control" name="reason" id="reason" readonly=""> {{$leave->reason}}</textarea>
								</div> 
								
								<div class="col-md-6">
									<label><h4 style="font-weight:lighter; margin-bottom:0; color:#FF5722;">Commnent for Action(Not Mandatory)</h4></label><br>
									<textarea class="form-control" name="comment" id="comment"></textarea>
								</div>
							</div>
                         
							<div class="col-md-12" align="center"><br>
								<button type="submit" class="btn btn-primary" name="doaction" id="docomplete">Take Action</button><br>
								<br> 
							</div>  
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!-- END of Toggle Parents Div -->
		</form>
     </div>
</div>
</body>
</html>