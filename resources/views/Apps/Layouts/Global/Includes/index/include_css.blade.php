<link rel="stylesheet" type="text/css" href="<?php echo $_path_templates . '/global/css/main.css' ?>">
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_path_templates ?>/metronic/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_path_libs ?>/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>


<!-- load css lib / class / library from controller start here -->
<?php if (isset($load_css) && !empty($load_css)) : ?>
    <?php foreach ($load_css AS $key => $values) : ?>
        <link href="<?php echo $_path_templates . $values ?>" rel="stylesheet" type="text/css"/>
    <?php endforeach; ?>
<?php endif; ?>
<!-- load css lib / class / library from controller end here -->

<link rel="shortcut icon" href="favicon.ico"/>
<style>
    table.dataTable tbody tr {
        background-color: #ffffff;
        color: #000;
    }
    table.dataTable thead tr {
        background-color: #fff;
        color: #000;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 18px;
        border-bottom:1px solid #ddd;
    }
    table.dataTable.cell-border thead th, table.dataTable.cell-border thead td {
        border-top: 1px solid #ddd;
        border-right: 1px solid #ddd;
    }
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
        color: #fff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #fff !important;
        border: 1px solid transparent;
        background: transparent;
        box-shadow: none;
    }
    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
        padding: 0px 0px 10px 0px;
    }
</style>