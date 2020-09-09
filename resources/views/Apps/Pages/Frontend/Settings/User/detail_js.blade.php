<script>
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('detail js successfully load', 'success', {timeOut: 2000});
            }
        };
    }();
    jQuery(document).ready(function () {
        Ajax.init();
    });
</script>