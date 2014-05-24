
<!-- basic scripts -->
<script src="<?php echo getPublicUrl(); ?>/js/jquery.min.js"></script>

<script src="<?php echo getPublicUrl(); ?>/js/bootstrap.min.js"></script>
<!--<script src="<?php echo getPublicUrl(); ?>/js/typeahead-bs2.min.js"></script>-->


<!-- page specific plugin scripts -->
<?php if (!empty($this->load->get_var('js'))) : ?>
    <?php foreach ($js as $key => $value) : ?><script type="text/javascript" src="<?php echo getPublicUrl() . $value; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($this->load->get_var('jstring'))) : ?>
    <?php foreach ($jstring as $key => $value): ?>
    <script type="text/javascript">
        <?php echo $value; ?>
    </script>
    <?php endforeach; ?>        
<?php endif; ?>

<!-- ace scripts -->
<script src="<?php echo getPublicUrl(); ?>/js/ace-elements.min.js"></script>
<script src="<?php echo getPublicUrl(); ?>/js/ace.min.js"></script>
<!-- inline scripts related to this page -->
        