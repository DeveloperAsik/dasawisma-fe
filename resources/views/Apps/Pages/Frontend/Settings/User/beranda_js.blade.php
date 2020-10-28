<script>
    var openTab = function (evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    };
    var fnInitTab = function () {
        var openTab = document.getElementById("defaultOpen");
        if (openTab) {
            var id = $(openTab).data('id');

            document.getElementById(id).style.display = "block";
        }
    };
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                console.log('beranda js successfully load');
                fnInitTab();
                $('.tablinks').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    openTab(e, id);
                });

                $('select[name="province"]').change(function () {
                    var id = $(this).val();
                    if (id) {
                        var uri = _config_api_base_url + '/fetch/districts';
                        var type = 'GET';
                        var data = {
                            token: _app_uuid,
                            key: 'id',
                            value:id
                        };
                        var result = fnAjaxSend(data, uri, type, {}, false);
                        console.log(result);return false;
                    }
                });
            }
        };
    }();
    jQuery(document).ready(function () {
        Ajax.init();
    });
</script>