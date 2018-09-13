
<!DOCTYPE html>
<html>
<head>
  
    <title>Login - MIS IIFM</title>
      <!-- Main CSS-->
    {!!View('partials.include_css')!!}

  </head>
  <body>

    <section class="material-half-bg">

      <div class="cover"></div>
    </section>
    <section class="login-content">
       <h3 class="pull pull-right" ><a href="{{url('/feedback/index')}}" style="color: black;text-decoration: none;">Give Your Feedback </a> </h3>
      <div >
        <h1 style="color: white; font-family: sans-serif;"> </h1>
      </div>
        <?php if(Session::has('message')) {?>
        <div id="alert" class="alert alert-success">{{ Session::get('message') }}

        </div><?php } ?>
      <div class="login-box" >
        <form class="login-form" method="POST" action="{{ route('login') }}" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Sign In</h3>
            
          <div class="form-group">
            <label class="control-label" id="email">Username</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" placeholder="Email" value="{{ old('email') }}" autofocus>
          
            @if ($errors->has('email'))
                   <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                  </span>
           @endif

          </div>
         
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"" name="password" type="password" placeholder="Password">
         
             @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                </span>
           @endif
          </div>
     
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Sign In</button>
            <a href="{{url('/reset-password')}}"  class="pull-right" style="font-weight: bold; margin-top: 25px;"> Forgot Password</a>
          </div>
          <div> <p class="semibold-text mb-2 " style="margin-top: 27px;"><a href="#" data-toggle="flip"> Sign Up</a></p></div>
          <!-- <div> <p class="semibold-text mb-2 " style="margin-top: 50px;"><a href="#" data-toggle="flip"> Give Your Feedback</a></p></div> -->
        </form>

                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"
             class="register-form">
                          {{csrf_field()}}
          <h3 class="register-head"><i class="fa fa-lg fa-fw fa-user"></i>Sign Up</h3>
           
          <div class="form-group">
            <label class="control-label">Name</label>
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" name="email" type="text" name="name" placeholder="USERNAME" autofocus required>
             @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
           <div class="form-group">
            <label class="control-label">Email Id</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" type="text" name="email" placeholder="EMAIL ID" autofocus required>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                 </span>
            @endif
          </div>
          <!--  <div class="form-group">
            <label class="control-label">MOBILE</label>
            <input class="form-control" name="email" type="text" name="mobile" placeholder="MOBILE" autofocus required>
          </div> -->
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" name="password" placeholder="PASSWORD" required>
             @if ($errors->has('password'))
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('password') }}</strong>
                 </span>
             @endif
          </div>
           <div class="form-group">
            <label class="control-label">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="CONFIRM PASSWORD" required>
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                
              </div>
              
              
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Sign Up</button>
          </div>
           <p class="semibold-text mb-2" style="text-align:center; padding:20px;"><a href="#" data-toggle="flip">Login Here</a></p>
        </form>
      </div>
 

    </section>
    <img src="{{URL::To('public/images/mis-logo.png')}}" class="pull-left" height="60" style="position: fixed;left: 20px;bottom: 20px;">   

    <!-- Essential javascripts for application to work-->
     {!!View('partials.include_js')!!}
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>

<!-- Mirrored from pratikborsadiya.in/vali-admin/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:29 GMT -->
</html>

