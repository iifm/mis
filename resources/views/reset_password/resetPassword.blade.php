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
            <?php if (Session::has('message')) { ?>
                <div id="alert" class="alert alert-success">{{ Session::get('message') }}

                </div><?php } ?>
            <div class="">
                <h1 class="" style="color: #fff">IIFM MIS</h1>
            </div>
            <div class="lock-box"><img class="rounded-circle user-image" src="{{URL::To('/public/images/usser.png')}}">
                <h4 class="text-center user-name"></h4>
                <p class="text-center text-muted"></p>
                <form class="unlock-form" action="{{url('/reset-password/send')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">Enter Official Email ID</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter Official Email ID" autofocus required="">
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg"></i>SUBMIT </button>
                    </div>
                </form>
                <p><a href="{{url('/')}}" style="font-weight: bold;"> Login Here</a></p>
            </div>
        </section>
        <!-- Essential javascripts for application to work-->
        {!!View('partials.include_js')!!}

    </body>


</html>