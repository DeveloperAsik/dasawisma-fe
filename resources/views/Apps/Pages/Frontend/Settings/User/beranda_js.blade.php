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

    var fnTable = function () {
        var table = $('#datatable_ajax').DataTable({
            "lengthChange": false,
            "lengthMenu": [[5], [5]],
            "paging": true,
            "pagingType": "full_numbers",
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "ajax": {
                url: _config_base_url + '/incidents/get_list',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columns": [
                {"data": "rowcheck"},
                {"data": "num"},
                {"data": "title"},
                {"data": "description"},
                {"data": "additional_info"},
                {"data": "integrated_services_post_name"},
                {"data": "active"},
                {"data": "action"}
            ],
            "drawCallback": function (master) {
                //$('.make-switch').bootstrapSwitch();
            }
        });

        $('a.btn').on('click', function () {
            var action = $(this).attr('data-id');
            var count = $('input.select_tr:checkbox').filter(':checked').length;
            switch (action) {
                case 'add':
                    $('.modal-title').html('Insert New Group');
                    break;

                case 'edit':
                    $('.modal-title').html('Update Exist Group');
                    var status_ = $(this).hasClass('disabled');
                    var id = $('input.select_tr:checkbox:checked').attr('data-id');
                    if (status_ == 0) {
                        var formdata = {
                            id: Base64.encode(id)
                        };
                        $.ajax({
                            url: base_backend_url + 'master/group/get_data/',
                            method: "POST", //First change type to method here
                            data: formdata,
                            success: function (response) {
                                var row = JSON.parse(response);
                                var status_ = false;
                                if (row.is_active === 1) {
                                    status_ = true;
                                }
                                $('input[name="id"]').val(row.id);
                                $('input[name="name"]').val(row.name);
                                $("[name='status']").bootstrapSwitch('state', status_);
                                $('textarea[name="description"]').val(row.description);
                                $('#modal_add_edit').modal('show');
                            },
                            error: function () {
                                fnToStr('Error is occured, please contact administrator.', 'error');
                            }
                        });
                        return false;
                    }
                    break;

                case 'delete':
                    bootbox.confirm("Are you sure to delete this id?", function (result) {
                        if (result == false) {
                            $('.modal-backdrop').hide();
                            $('.bootbox ').hide();
                            return false;
                        }
                        var uri = base_backend_url + 'master/group/delete/';
                        id = [];
                        $("input.select_tr:checkbox:checked").each(function () {
                            id.push($(this).data("id"));
                        });
                        fnAjaxPost(uri, {id: id}, 'remove');
                        fnRefreshDataTable();
                        fnResetBtn();
                    });
                    break;

                case 'refresh':
                    fnRefreshDataTable();
                    break;
            }
        });

        $("#add_edit").submit(function () {
            var id = $('input[name="id"]').val();
            var is_active = $("[name='status']").bootstrapSwitch('state');
            var uri = base_backend_url + 'master/group/insert/';
            var txt = 'add new group';
            var formdata = {
                name: $('input[name="name"]').val(),
                description: $('textarea[name="description"]').val(),
                active: is_active
            };
            if (id) {
                uri = base_backend_url + 'master/group/update/';
                txt = 'update group';
                formdata = {
                    id: Base64.encode(id),
                    name: $('input[name="name"]').val(),
                    description: $('textarea[name="description"]').val(),
                    active: is_active
                };
            }
            $.ajax({
                url: uri,
                method: "POST", //First change type to method here
                data: formdata,
                success: function (response) {
                    fnToStr('Successfully ' + txt);
                    fnCloseModal();
                    fnRefreshDataTable();
                },
                error: function () {
                    toastr.error('Failed ' + txt);
                    fnCloseModal();
                }
            });
            return false;
        });
    };
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                console.log('beranda js successfully load');
                fnTable();
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
                            page: 1,
                            total: 25,
                            keyword: 'province_id',
                            value: id,
                            token: _token_api
                        };
                        var result = fnAjaxSend(data, uri, type, {}, false);
                        var str = '<option>-- pilih satu --</option>';
                        if (result.responseJSON.status === 200) {
                            for (var i = 0; i < result.responseJSON.data.length; i++) {
                                str = str + '<option value="' + result.responseJSON.data[i].id + '">' + result.responseJSON.data[i].name + '</option>';
                            }
                        }
                        $('select.city').html(str);
                        return false;
                    }
                });

                $('select[name="city"]').change(function () {
                    var id = $(this).val();
                    if (id) {
                        var uri = _config_api_base_url + '/fetch/sub-districts';
                        var type = 'GET';
                        var data = {
                            page: 1,
                            total: 25,
                            keyword: 'district_id',
                            value: id,
                            token: _token_api
                        };
                        var result = fnAjaxSend(data, uri, type, {}, false);
                        var str = '<option>-- pilih satu --</option>';
                        if (result.responseJSON.status === 200) {
                            for (var i = 0; i < result.responseJSON.data.length; i++) {
                                str = str + '<option value="' + result.responseJSON.data[i].id + '">' + result.responseJSON.data[i].name + '</option>';
                            }
                        }
                        $('select.district').html(str);
                        return false;
                    }
                });

                $('select[name="district"]').change(function () {
                    var id = $(this).val();
                    if (id) {
                        var uri = _config_api_base_url + '/fetch/areas';
                        var type = 'GET';
                        var data = {
                            page: 1,
                            total: 25,
                            keyword: 'sub_district_id',
                            value: id,
                            token: _token_api
                        };
                        var result = fnAjaxSend(data, uri, type, {}, false);
                        var str = '<option>-- pilih satu --</option>';
                        if (result.responseJSON.status === 200) {
                            for (var i = 0; i < result.responseJSON.data.length; i++) {
                                str = str + '<option value="' + result.responseJSON.data[i].id + '">' + result.responseJSON.data[i].name + '</option>';
                            }
                        }
                        $('select.sub_district').html(str);
                        return false;
                    }
                });

                $('select[name="sub_district"]').change(function () {
                    var id = $(this).val();
                    if (id) {
                        var uri = _config_api_base_url + '/fetch/isp';
                        var type = 'GET';
                        var data = {
                            page: 1,
                            total: 25,
                            keyword: 'area_id',
                            value: id,
                            token: _token_api
                        };
                        var result = fnAjaxSend(data, uri, type, {}, false);
                        var str = '<option>-- pilih satu --</option>';
                        if (result.responseJSON.status === 200) {
                            for (var i = 0; i < result.responseJSON.data.length; i++) {
                                str = str + '<option value="' + result.responseJSON.data[i].id + '">' + result.responseJSON.data[i].name + '</option>';
                            }
                        }
                        $('select.service_post').html(str);
                        return false;
                    }
                });

                $('form.form-submit-report').on('submit', function (e) {
                    e.preventDefault();
                    var title = $('input[name="title"]').val();
                    var type = $('.type').val();
                    var level = $('.level').val();
                    var province = $('.province').val();
                    var city = $('.city').val();
                    var district = $('.district').val();
                    var sub_district = $('.sub_district').val();
                    var service_post = $('.service_post').val();
                    var description = $('textarea[name="description"]').val();
                    var additional = $('textarea[name="additional"]').val();
                    var data = {
                        title: title,
                        description: description,
                        additional_info: additional,
                        type_id: type,
                        level_id: level,
                        province_id: province,
                        district_id: city,
                        sub_district_id: district,
                        area_id: sub_district,
                        integrated_services_post_id: service_post
                    };
                    if (data) {
                        var uri = _config_api_base_url + '/transmit/report-incidents';
                        var type = 'POST';
                        var result = fnAjaxSend(data, uri, type, {'token': _token_api}, false);
                        if (result.responsJSON.status === 200) {
                            setTimeout(function () {
                                window.location.href = _config_base_url + '/beranda';
                            }, 2500);
                        }
                    }
                    return false;
                });
            }
        };
    }();
    jQuery(document).ready(function () {
        Ajax.init();
    });
</script>