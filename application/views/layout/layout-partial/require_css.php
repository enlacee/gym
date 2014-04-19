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
<link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace-skins.min.css" />

<!--[if lte IE 8]>
  <link rel="stylesheet" href="<?php echo getPublicUrl(); ?>/css/ace-ie.min.css" />
<![endif]-->
        
<?php if (!empty($this->load->get_var('css'))) : ?>
    <?php foreach ($css as $key => $value): ?><link rel="stylesheet" type="text/css" href="<?php echo getPublicUrl() . $value; ?>" ><?php endforeach; ?>
<?php endif; ?>
 