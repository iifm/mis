@extends('partials.include_css')

<!DOCTYPE html>
<html>
  
<!-- Mirrored from pratikborsadiya.in/vali-admin/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jul 2018 06:07:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../../maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - MIS IIFM</title>
      <!-- Main CSS-->
    {!!View('partials.include_css')!!}

  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div >
        <h1 style="color: white; font-family: sans-serif;">IIFM MIS </h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="POST" action="{{ route('login') }}" >
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
            
          <div class="form-group">
            <label class="control-label" id="email">USERNAME</label>
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" placeholder="Email" value="{{ old('email') }}" autofocus>
          
            @if ($errors->has('email'))
                   <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                  </span>
           @endif

          </div>
         
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"" name="password" type="password" placeholder="Password">
         
             @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
           @endif
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                
              </div>
               <p class="semibold-text mb-2"><a href="#" data-toggle="flip"> NEW USER? SIGN UP</a></p>
              
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>

                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"
             class="register-form">
                        @csrf
          <h3 class="register-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN UP</h3>
           
          <div class="form-group">
            <label class="control-label">NAME</label>
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" name="email" type="text" name="name" placeholder="USERNAME" autofocus required>
             @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
           <div class="form-group">
            <label class="control-label">EMAIL ID</label>
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
            <label class="control-label">PASSWORD</label>
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" name="password" placeholder="PASSWORD" required>
             @if ($errors->has('password'))
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('password') }}</strong>
                 </span>
             @endif
          </div>
           <div class="form-group">
            <label class="control-label">CONFIRM PASSWORD</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="CONFIRM PASSWORD" required>
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                
              </div>
              
               <p class="semibold-text mb-2"><a href="#" data-toggle="flip">ALREADY REGISTERED ? SIGN IN HERE</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN UP</button>
          </div>
        </form>
      </div>
    </section>
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

