<!DOCTYPE html>
<html>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!!View('partials.include_css')!!}

        <title>Forgot Password - IIFM MIS</title>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="lockscreen-content">
            <div class="">
                <h1 class="" style="color: #fff">IIFM MIS</h1>
            </div>
            <?php if (Session::has('message')) { ?>
                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                </div><?php } ?>
            @foreach($user_data as $data)
            @if($data->profile!='')
            <div class="lock-box"><img class="rounded-circle user-image" src="{{URL::To('/storage/app/profile')}}/{{$data->profile}}">
                @else
                <div class="lock-box"><img class="rounded-circle user-image" src="{{URL::To('/public/images/usser.png')}}">
                    @endif

                    <h4 class="text-center user-name">{{$data->name}}</h4>
                   <!--  <p class="text-center text-muted">Account Locked</p> -->
                    <form class="unlock-form" action="{{url('/reset-password/change-password')}}/{{$data->user_id}}" method="post" style="margin-top: 30px;">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <input class="form-control" type="password" name="password" placeholder="New Password" autofocus required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm New Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm New Password" autofocus required="">
                        </div>
                        <div class="form-group btn-container">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg"></i>SUBMIT </button>
                        </div>
                    </form>
                    @endforeach
                    <p><a href="{{url('/')}}"> Login Here.</a></p>
                </div>
        </section>
        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}

    </body>


</html>