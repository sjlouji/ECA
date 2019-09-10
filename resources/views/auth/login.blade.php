
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Licet</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('/bower_components/admin-lte/plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>LIC</b>ET</a>
        </div>
        <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ route('login') }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"  autocomplete="email" >
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  autocomplete="current-password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" style="color: #f65151;margin-bottom: 20px;" role="alert">
                                        <strong>{{ $errors->first()}}</strong>
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                     </div>                              
                @endif
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" style="float:right;margin:15px" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </label>
                        </div>
                    </div>
         
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/bower_components/admin-lte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
    $(function () {

        $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
        });
    });
    
    </script>

</body>
</html>