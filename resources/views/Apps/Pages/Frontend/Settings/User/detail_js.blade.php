<script>
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                console.log('detail js successfully load');
            }
        };
    }();
    jQuery(document).ready(function () {
        Ajax.init();
    });
</script>