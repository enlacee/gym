<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo getPublicUrl(); ?>/ico/favicon.ico">
    <title>Login</title>
    <link href="<?php echo getPublicUrl(); ?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <style>
    .container {
        margin-right: auto;
        margin-left: auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin > input {margin-top: 12px;}
    </style>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>  
  <body>
    <div class="container">

        <form class="form-signin" role="form" action="/auth/login" method="POST">
        <h2 class="form-signin-heading">Login</h2>
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="root@gmail.com">
            <input type="password" name="password" class="form-control" placeholder="Password" required value="123456">
        <label class="checkbox">
            <input type="checkbox" checked="" value="remember-me"> Recordar
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div> <!-- /container -->
    <script src="<?php echo getPublicUrl(); ?>/js/vendor/jquery/jquery-1.11.0.js"></script>
    <script src="<?php echo getPublicUrl(); ?>/dist/js/bootstrap.min.js"></script>
  </body>
</html>