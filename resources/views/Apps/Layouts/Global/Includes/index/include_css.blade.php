<link rel="stylesheet" type="text/css" href="<?php echo $_path_templates . '/global/css/main.css' ?>">
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>


<!-- load css lib / class / library from controller start here -->
<?php if (isset($load_css) && !empty($load_css)) : ?>
    <?php foreach ($load_css AS $key => $values) : ?>
        <link href="<?php echo $_path_templates . $values ?>" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
<?php endif; ?>
<!-- load css lib / class / library from controller end here -->

<link rel="shortcut icon" href="favicon.ico"/>