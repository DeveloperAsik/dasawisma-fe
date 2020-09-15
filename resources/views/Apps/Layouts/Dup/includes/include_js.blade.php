<script src="<?php echo $_path_templates . '/dup/js/vendor/jquery-2.2.4.min.js'; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="<?php echo $_path_templates . '/dup/js/vendor/bootstrap.min.js'; ?>"></script>
<script src="<?php echo $_path_templates . '/dup/js/jquery.ajaxchimp.min.js'; ?>"></script>
<script src="<?php echo $_path_templates . '/dup/js/owl.carousel.min.js'; ?>"></script>
<script src="<?php echo $_path_templates . '/dup/js/jquery.nice-select.min.js'; ?>"></script>
<script src="<?php echo $_path_templates . '/dup/js/jquery.magnific-popup.min.js'; ?>"></script>
<script src="<?php echo $_path_templates . '/dup/js/main.js'; ?>"></script>

<script src="<?php echo $_path_js . '/base64.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $_path_js . '/dateFormat.min.js'; ?>" type="text/javascript"></script>
<script src="<?php echo $_path_libs . '/toastr/build/toastr.min.js'; ?>"></script>
<script src="<?php echo $_path_libs . '/bodymovin/5.6.5/lottie.js'; ?>"></script>
<script>
<?php if (isset($_app_uuid) && !empty($_app_uuid)): ?>
        var _app_uuid = '<?php echo $_app_uuid; ?>';
<?php else: ?>
        var _app_uuid = '';
<?php endif; ?>
<?php if (isset($_config_base_url) && !empty($_config_base_url)): ?>
        var _config_base_url = '<?php echo $_config_base_url; ?>';
<?php else: ?>
        var _config_base_url = '';
<?php endif; ?>
<?php if (isset($_path_templates) && !empty($_path_templates)): ?>
        var _config_lib_url = '<?php echo $_path_templates; ?>';
<?php else: ?>
        var _config_lib_url = '';
<?php endif; ?>
<?php if (isset($_config_img_url) && !empty($_config_img_url)): ?>
        var _config_img_url = '<?php echo $_config_img_url; ?>';
<?php else: ?>
        var _config_img_url = '';
<?php endif; ?>

<?php if (isset($_token) && !empty($_token)) : ?>
        var _token = '<?php echo $_token; ?>';
<?php else: ?>
        var _token = '';
<?php endif; ?>
<?php if (isset($_is_logged_in) && !empty($_is_logged_in)) : ?>
        var _is_logged_in = '<?php echo $_is_logged_in; ?>';
<?php else: ?>
        var _is_logged_in = '';
<?php endif; ?>
<?php if (isset($_path_json) && !empty($_path_json)) : ?>
        var _path_json = '<?php echo $_path_json; ?>';
<?php else: ?>
        var _path_json = '';
<?php endif; ?>
</script>
<!-- load system variable to js function start here -->
<?php if (isset($js_var) && !empty($js_var)): ?>
    <script>
    <?php foreach ($js_var AS $key => $values): ?>
        <?php foreach ($values AS $k => $v): ?>
            <?php if ($k == 'app'): ?>
                <?php foreach ($v AS $j => $n): ?>
                        var <?php echo $j; ?> = '<?php echo $n ?>';
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($k == 'config'): ?>
                <?php foreach ($v AS $j => $n): ?>
                        var <?php echo $j; ?> = '<?php echo $n ?>';
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($k == 'path'): ?>
                <?php foreach ($v AS $j => $n): ?>
                        var <?php echo $j; ?> = '<?php echo $n ?>';
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($k == 'options'): ?>
                <?php foreach ($v AS $j => $n): ?>
                        var <?php echo $j; ?> = '<?php echo $n ?>';
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($k == 'appUri'): ?>
                <?php foreach ($v AS $j => $n): ?>
                        var <?php echo $j; ?> = '<?php echo $n ?>';
                <?php endforeach; ?>
            <?php endif; ?>
          
        <?php endforeach; ?>
    <?php endforeach; ?>
    </script>
<?php endif; ?>
<!-- load system variable to js function start here -->

<!-- load variable to js function from controller start here -->
<?php if (isset($load_ajax_var) && !empty($load_ajax_var)) : ?>
    <?php foreach ($load_ajax_var AS $key => $values): ?>
        <script> var <?php echo $values['key']; ?> = '<?php echo $values['val'] ?>';</script>
    <?php endforeach; ?>
<?php endif; ?>
<!-- load variable to js function from controller end here -->

<!-- load js lib / class / library from controller start here -->
<?php if (isset($load_js) && !empty($load_js)) : ?>
    <?php foreach ($load_js AS $key => $values) : ?>
        <script src="<?php echo $_config_lib_url . $values ?>" type="text/javascript"></script>
    <?php endforeach; ?>
<?php endif; ?>
<!-- load js lib / class / library from controller end here -->

<!-- load global js lib for every controller start here -->
<?php if ($_path_app_global_js): ?>
    @include("{$_path_app_global_js}")
<?php endif; ?>
<!-- load global js lib for every controller end here -->

<!-- load specified js lib for a view start here -->
<?php if ($_path_app_view_js): ?>
    @include("{$_path_app_view_js}")
<?php endif; ?>