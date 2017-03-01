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
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/custom.min.css')); ?>" rel="stylesheet">
    </head>

    <body class="login">
        <div>
          <a class="hiddenanchor" id="signup"></a>
          <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                <form action="/login" method="POST" id="login-form">
                    <?php echo e(csrf_field()); ?>  
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" name="name" />
                    </div>
                    <?php if($errors->has('name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </span>
                    <?php endif; ?>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password" />
                    </div>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
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
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
  </body>
</html>
