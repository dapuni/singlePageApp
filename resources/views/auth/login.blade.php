<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login Form| </title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    </head>

    <body class="login">
        <div>
          <a class="hiddenanchor" id="signup"></a>
          <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                <form action="/login" method="POST" id="login-form">
                    {{ csrf_field() }}  
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" name="name" />
                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password" />
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div>
                        <button class="btn btn-default submit">Log in </button> 
                    </div>

                    <div class="clearfix"></div>
                </form>
            </section>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
