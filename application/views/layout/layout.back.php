<?php if(isset($user) && is_array($user)): ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url()?>public/ico/favicon.ico">
    <title><?php echo $titulo ?></title>
    <link href="<?php echo base_url()?>public/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>public/css/style.css" rel="stylesheet">
    <?php if (isset($css)): ?><?php foreach ($css as $key => $value): ?>
    <link href="<?php echo base_url()?>public/<?php echo $value; ?>" rel="stylesheet">
    <?php endforeach;?><?php endif;?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>  
  <body>
    <div class="container ">
    <?php if ($user['es_super_usuario'] == '1'): ?>
        <?php require_once "nav_administrador.php"; ?>
    <?php elseif ($user['es_super_usuario'] == '0'): ?>
        <?php require_once "nav_usuario.php"; ?>
    <?php endif; ?>      
    <!-- Mensajes yelowBox -->
    <?php if (isset($mensajeBox) && $mensajeBox != false): ?>    
    <div class="alert alert-warning fade in mensajeBox">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $mensajeBox; ?>
    </div>
    <?php endif; ?>
    
    <?php //var_dump($user);?>
    <div class="highlight"><?php echo $content_for_layout; ?></div>

    </div> <!-- /container -->
    <script src="<?php echo base_url()?>public/js/vendor/jquery/jquery-1.11.0.js"></script>
    <script src="<?php echo base_url()?>public/dist/js/bootstrap.min.js"></script>
    <?php if (isset($js)): ?><?php foreach ($js as $key => $value): ?>
    <script src="<?php echo base_url()?>public/<?php echo $value; ?>"></script>
    <?php endforeach;?><?php endif;?>
    
    <?php if (isset($jstring)) :?>
    <?php foreach ($jstring as $key => $value): ?>
    <script type="text/javascript"><?php echo $value; ?></script>
    <?php endforeach;?>        
    <?php endif; ?>
  </body>
</html>
<?php else: ?>
    <?php require_once "salir.php"; ?>
<?php endif;?>
