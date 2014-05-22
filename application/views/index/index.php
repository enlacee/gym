
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login Page - Admin</title>

        <meta name="description" content="GYM Application" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->        
        <link href="<?php echo getPublicUrl(); ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace.min.css" />
        <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace-rtl.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo getPublicUrl(); ?>/js/html5shiv.js"></script>
        <script src="<?php echo getPublicUrl(); ?>/js/respond.min.js"></script>
        <![endif]-->
        <meta content="<?php echo getPublicUrl(); ?>/images/favicon.png" itemprop="image">
    </head>

    <body class="login-layout">        
        <div class="main-container">
            <div class="main-content">                
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                    <?php $flashMessage=$this->load->get_var('flashMessage'); if(!empty($flashMessage)) : ?>    
                    <div class="alert alert-warning fade in">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo $flashMessage; ?>
                    </div>
                    <?php endif; ?>                         
                        <div class="login-container">                           
                            <div class="center">
                                <h1>
                                    <i class=" icon-cogs black"></i>
                                    <span class="red">GYM</span>
                                    <span class="white">Application</span>
                                </h1>
                                <!--<h4 class="blue">&copy; Company Name</h4>-->
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="green"></i>
                                                Ingrese sus datos
                                            </h4>

                                            <div class="space-6"></div>

<?php echo form_open('/index/login', $attributes=null, array('token' => $token));?>
                                        <!--<form method="post" action="/auth/login"> -->
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">                                                            
                                                            <input type="email" name="email" class="form-control" placeholder="Email" required="" autofocus=""value="root@gmail.com"/>
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                                                            <i class="icon-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <label class="inline">
                                                            <input type="checkbox" class="ace" />
                                                            <span class="lbl"> Recordar session</span>
                                                        </label>

                                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="icon-key"></i>
                                                            Entrar
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>

                                            <div class="social-or-login center">
                                                <span class="bigger-110">-</span>
                                            </div>


                                        </div><!-- /widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="#" onclick="show_box('forgot-box');
                                                        return false;" class="forgot-password-link">
                                                    <i class="icon-arrow-left"></i>
                                                    Olvidaste tu clave
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                                <div id="forgot-box" class="forgot-box widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header red lighter bigger">
                                                <i class="icon-key"></i>
                                                Recuperar Clave
                                            </h4>

                                            <div class="space-6"></div>
                                            <p>
                                                Ingrese su Email
                                            </p>

                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" placeholder="Email" />
                                                            <i class="icon-envelope"></i>
                                                        </span>
                                                    </label>

                                                    <div class="clearfix">
                                                        <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                            <i class="icon-lightbulb"></i>
                                                            Enviar!
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /widget-main -->

                                        <div class="toolbar center">
                                            <a href="#" onclick="show_box('login-box');
                                                    return false;" class="back-to-login-link">
                                                Retornar a login
                                                <i class="icon-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div><!-- /widget-body -->
                                </div><!-- /forgot-box -->


                            </div><!-- /position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->               
            </div>           
        </div><!-- /.main-container -->          

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo getPublicUrl(); ?>/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo getPublicUrl(); ?>/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='<?php echo getPublicUrl(); ?>/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->

        <script type="text/javascript">
            function show_box(id) {
                jQuery('.widget-box.visible').removeClass('visible');
                jQuery('#' + id).addClass('visible');
            }
        </script>
               
        <script src="<?php echo getPublicUrl()?>/js/bootstrap.min.js"></script>
    </body>
</html>
