<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:14 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  
    <title>IIFM MIS</title>
    
    

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
          <h1><i class="fa fa-edit"></i> User Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">User Profile</li>
          <li class="breadcrumb-item"><a href="#">User Profile Edit</a></li>
        </ul>
      </div>
      <div class="row">
        <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-primary btn-lg"> Back</a>
        <form action="{{url('/user-details/store')}}" method="post">

            {{ csrf_field() }}
      <div id="official_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-graduation-cap"> Official Information</p></h5>
            <div class="row">
             
             <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{Auth::user()->name}}" aria-describedby="emailHelp" placeholder="Enter Full Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Email ID</label>
                    <input class="form-control" id="email" name="email" value="{{Auth::user()->email}}" type="email" aria-describedby="emailHelp" placeholder="Email Id (Enter Only Official-ID)">
                </div>
             </div>
            
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Joining</label>
                    <input class="form-control demoDate" id="doj"  name="doj" type="text" aria-describedby="emailHelp" placeholder="Date Of Joining">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Designation</label>
                    <input class="form-control" id="designation"  name="designation" type="text" aria-describedby="emailHelp" placeholder="Enter Designation">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Department</label>
                    <input class="form-control" id="dept" name="dept" type="text" aria-describedby="emailHelp" placeholder="Enter Department">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Location/Center</label>
                    <input class="form-control" id="locationcentre" name="locationcentre"  type="text" aria-describedby="emailHelp" placeholder="Enter Location/Center">
                </div>
             </div>
         
            <center><strong style="color: #009688; margin-left: 200px;">NOTE : Please Do not use Short Forms (For Example: Use Department instead Dept.)</strong></center> 
            </div>
            <div class="tile-footer">
             <!--  <button class="btn btn-primary" type="submit">Submit</button> -->
            <a href="#professional_info"  class="btn btn-primary fa fa-arrow-circle-right"  style="margin-left: 900px;"> Next</a>
            </div>
          </div>
        </div>
      </div>
       <div id="professional_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-graduation-cap"> Professional Information</p></h5>
            <div class="row">
            
             <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Name</label>
                    <input class="form-control" id="company"  name="company" type="text" aria-describedby="emailHelp" placeholder="Company Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Designation </label>
                    <input class="form-control" id="designation1" name="designation1" type="text" aria-describedby="emailHelp" placeholder="Designation">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">From</label>
                    <input class="form-control demoDate" id="fromdate" name="fromdate" type="text" aria-describedby="emailHelp" placeholder="Date Of Joining">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">To</label>
                    <input class="form-control demoDate" id="todate" name="todate" type="text" aria-describedby="emailHelp" placeholder="Enter Designation">
                </div>
             </div>
            
            </div>
            <div class="tile-footer">
             <!--  <button class="btn btn-primary" type="submit">Submit</button> -->
            <a href="#" class="btn btn-primary fa fa-arrow-circle-right"  style="margin-left: 900px;"> Next</a>
            </div>
          </div>
        </div>
        </div>
        <div id="educational_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><a class="fa fa-graduation-cap"> Educational Information</a></h5>
            
            <div class="row">
             
             <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Post Graducation Degree</label>
                    <input class="form-control" id="postgradegree"  name="postgradegree" type="text" aria-describedby="emailHelp" placeholder="Post Graducation Degree">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Passing Year </label>
                    <input class="form-control" id="postgrayear" name="postgrayear" type="text" aria-describedby="emailHelp" placeholder="Year">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Percentage(%)</label>
                    <input class="form-control" id="postgrapercentage" name="postgrapercentage" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Collage/University</label>
                    <input class="form-control" id="postgracoll" name="postgracoll" type="text" aria-describedby="emailHelp" placeholder="Collage/University">
                </div>
             </div>

              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1"> Graducation Degree</label>
                    <input class="form-control" id="gradegree" name="gradegree" type="text" aria-describedby="emailHelp" placeholder=" Graducation Degree">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Passing Year </label>
                    <input class="form-control" id="grayear" name="grayear" type="text" aria-describedby="emailHelp" placeholder="Year">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Percentage(%)</label>
                    <input class="form-control" id="grapercentage" name="grapercentage" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Collage/University</label>
                    <input class="form-control" id="gracoll" name="gracoll" type="text" aria-describedby="emailHelp" placeholder="Collage/University">
                </div>
             </div>
              </div>
             <div class="row">
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">12th School Name</label>
                    <input class="form-control" id="twelvethschname" name="twelvethschname" type="text" aria-describedby="emailHelp" placeholder="12th School Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Passing Year </label>
                    <input class="form-control" id="twelvethschyear" name="twelvethschyear" type="text" aria-describedby="emailHelp" placeholder="Year">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Percentage(%)</label>
                    <input class="form-control" id="twelvethschpercent" name="twelvethschpercent" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)">
                </div>
             </div>
             </div>
             <div class="row">
              <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">10th School Name</label>
                    <input class="form-control" id="tenthschname" name="tenthschname" type="text" aria-describedby="emailHelp" placeholder="10th School Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Passing Year </label>
                    <input class="form-control" id="tenthschyear" name="tenthschyear" type="text" aria-describedby="emailHelp" placeholder="Year">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Percentage(%)</label>
                    <input class="form-control" id="tenthschpercent" name="tenthschpercent" type="text" aria-describedby="emailHelp" placeholder="Percentage(%)">
                </div>
             </div>
          
              </div>
            
            <div class="tile-footer">
             <!--  <button class="btn btn-primary" type="submit">Submit</button> -->
            <a href="#" class="btn btn-primary fa fa-arrow-circle-right"  style="margin-left: 900px;"> Next</a>
            </div>
          </div>
        </div>
        </div>
        <div id="personal_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-graduation-cap"> Personal Information</p></h5>
            <div class="row">
             
             <div class="col-md-6"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                   <select class="form-control" name="gender" id="gender">
                     <option>Select Your Gender</option>
                     <option>Male</option>
                      <option>Female</option>
                   </select>
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Birth </label>
                    <input class="form-control" id="dob" name="dob" type="date" aria-describedby="emailHelp" placeholder="">
                </div>
             </div>
              
             
            </div>
            <div class="tile-footer">
             <!--  <button class="btn btn-primary" type="submit">Submit</button> -->
            <a href="#" class="btn btn-primary fa fa-arrow-circle-right"  style="margin-left: 900px;"> Next</a>
            </div>
          </div>
        </div>
        </div>
         <div id="personal_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-graduation-cap"> Contact Information</p></h5>
            <strong> <p>Current Address</p></strong>
            <div class="row">
            
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="">Street Address </label>
                   <textarea rows="4" class="form-control" name="cadd" id="cadd" placeholder="Address"></textarea>
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">State </label>
                    <input class="form-control" id="cstate" name="cstate" type="text" aria-describedby="emailHelp" placeholder="State">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">City </label>
                    <input class="form-control" id="ccity" name="ccity" type="text" aria-describedby="emailHelp" placeholder="City">
                </div>
             </div>
            </div>
             <strong> <p>Permanent Address</p></strong>
            <div class="row">
            
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Street Address </label>
                   <textarea rows="4" class="form-control" name="padd" id="padd" placeholder="Address"></textarea>
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">State </label>
                    <input class="form-control" id="pstate" name="pstate" type="text" aria-describedby="emailHelp" placeholder="State">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">City </label>
                    <input class="form-control" id="pcity" name="pcity" type="text" aria-describedby="emailHelp" placeholder="City">
                </div>
             </div>
            </div>
             <div class="row">
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Contact Number </label>
                    <input class="form-control" id="mobile" name="mobile" type="text" aria-describedby="emailHelp" placeholder="Mobile Number">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Alternate Mobile Number </label>
                    <input class="form-control" id="altno" name="altno" type="text" aria-describedby="emailHelp" placeholder="Alternate Mobile Number">
                </div>
             </div>
            </div>
            <div class="tile-footer">
             <!--  <button class="btn btn-primary" type="submit">Submit</button> -->
            <a href="#" class="btn btn-primary fa fa-arrow-circle-right"  style="margin-left: 900px;"> Next</a>
            </div>
          </div>
        </div>
        </div>
        <div id="family_info" class="row">
        <div class="col-md-12">
          <div class="tile">
             <h5 class="tile" style="color: #009688; text-align: center;"><p class="fa fa-users"> Family Information</p></h5>
             <strong><h4>Father Details</h4></strong>
            <div class="row">
             
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Father Name </label>
                    <input class="form-control" id="fname" name="fname" type="text" aria-describedby="emailHelp" placeholder="Father Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Father's Occuption</label>
                    <input class="form-control" id="foccup" name="foccup" type="text" aria-describedby="emailHelp" placeholder="Father's Occuption">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Father's Contact Number</label>
                    <input class="form-control" id="fcontact" name="fcontact" type="text" aria-describedby="emailHelp" placeholder="Father's Contact Number">
                </div>
             </div>
              </div>
              <strong><h4>Mother Details</h4></strong>
              <div class="row">
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mother Name </label>
                    <input class="form-control" id="mname" name="mname" type="text" aria-describedby="emailHelp" placeholder="Mother Name">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mother's Occuption</label>
                    <input class="form-control" id="moccup" name="moccup" type="text" aria-describedby="emailHelp" placeholder="Mother's Occuption">
                </div>
             </div>
             <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Mother's Contact Number</label>
                    <input class="form-control" id="mcontact" name="mcontact" type="text" aria-describedby="emailHelp" placeholder="Mother's Contact Number">
                </div>
             </div>
            </div>
            <strong><h4>Marital Status</h4></strong>
            <div class="row">
               <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Marital Status</label>
                    <select class="form-control" name="maritalstatus" id="maritalstatus">
                      <option>Select Marital Status</option>
                      <option>Single</option>
                      <option>Married</option>
                    </select>
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Spouse Name</label>
                    <input class="form-control" id="spname" name="spname" type="text" aria-describedby="emailHelp" placeholder="Spouse Name">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Spouse Occuption</label>
                    <input class="form-control" id="spoccup" name="spoccup" type="text" aria-describedby="emailHelp" placeholder="Spouse Occuption">
                </div>
             </div>
              <div class="col-md-6"> 
              <div class="form-group">
                    <label for="exampleInputEmail1">Marriage Anniversary Date</label>
                    <input class="form-control" id="anniversary" name="anniversary" type="date" aria-describedby="emailHelp" placeholder="Marriage Anniversary Date">
                </div>
             </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary fa fa-save" type="submit">  Submit</button>
           
            </div>
          </div>
        </div>
        </div>

        </form>
</div>

         
        

          

    </main>


    <!-- Essential javascripts for application to work-->
    {!!View('partials.include_js')!!}

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>

