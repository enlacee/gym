<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?php echo getPublicUrl(); ?>/js/ace-extra.min.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>
<script src="<?php echo getPublicUrl(); ?>/js/html5shiv.js"></script>
<script src="<?php echo getPublicUrl(); ?>/js/respond.min.js"></script>
<![endif]-->


<!----- Paryt 2 ------->
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
<script src="<?php echo getPublicUrl(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo getPublicUrl(); ?>/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->
<!-- ace scripts -->
<script src="<?php echo getPublicUrl(); ?>/js/ace-elements.min.js"></script>
<script src="<?php echo getPublicUrl(); ?>/js/ace.min.js"></script>
<!-- inline scripts related to this page -->

        
<?php if (!empty($this->load->get_var('js'))) : ?>
    <?php foreach ($js as $key => $value) : ?><script type="text/javascript" src="<?php echo getPublicUrl() . $value; ?>"></script><?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($this->load->get_var('jstring'))) : ?>
    <?php foreach ($jstring as $key => $value): ?><script type="text/javascript"><?php echo $value; ?></script><?php endforeach; ?>        
<?php endif; ?>