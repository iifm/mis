<!DOCTYPE html>
<html lang="en">
  
<head>
    <title>Send Wish</title>

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
          <h1><i class="fa fa-birthday-cake"></i> Wish </h1>

        </div>
      </div>
      <a href="{{URL::previous()}}" class="fa fa-arrow-circle-left btn btn-primary"> Back</a>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="col-md-12">
          
            <h3 class="tile-title">Send Your Best Wishes</h3>
            <div class="tile-body">
              <form class="row" method="post" action="{{route('wish-send')}}">
                {{ csrf_field() }}
                <div class="form-group col-md-6">
                  @foreach($user_data as $user)
                  <label class="control-label">Name</label>
                  <input class="form-control" value="{{$user->name}}" type="text" name="name"  readonly="">
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Email</label>
                  <input class="form-control" name="email" value="{{$user->email}}" type="text" >
                </div>
                <input type="hidden" value="{{$user->id}}" name="receiver_id">
                @endforeach
                <div class="form-group col-md-10 ">
                  <label class="control-label">Message</label>
                  <textarea class="form-control" rows="4" name="message">
                  </textarea>
                </div><br>
       
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

    
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:27 GMT -->
</html>