<script>
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                console.log('index js successfully load');
                $('form.request-contact-form').on('submit', function (e) {
                    e.preventDefault();
                    var email = $('input[name="email"]').val();
                    if (email === '') {
                        $('.info-email').html('<p style="color:red">mohon isi surel anda di kolom ini...</p>');
                        return false;
                    }
                    var uri = _config_api_base_url + '/transmit/contact-us';
                    var type = 'POST';
                    var data = {
                        email: email,
                        fname: $('input[name="fname"]').val(),
                        lname: $('input[name="lname"]').val(),
                        content: $('textarea[name="content"]').val()
                    };
                    var result = fnAjaxSend(data, uri, type, {'token':_token_api}, false);
                    if (result.responseJSON && result.responseJSON.status === 200) {
                        
                    }
                });
                $('form.request-login-form').on('submit', function (e) {
                    e.preventDefault();
                    var user_id = $('input[name="userid"]').val();
                    var pass = $('input[name="password"]').val();
                    var pass2 = $('input[name="password2"]').val();

                    if (user_id === '') {
                        $('.info-userid').html('<p style="color:red">mohon isi surel atau id kader atau nama pengguna di kolom ini...</p>');
                        return false;
                    }
                    if (pass === '' || pass2 === '' || pass !== pass2) {
                        $('.info-password').html('<p style="color:red">mohon maaf password salah atau tidak sesuai...</p>');
                        return false;
                    }
                    var uri = _config_api_base_url + '/generate-token-user';
                    var type = 'GET';
                    var data = {
                        deviceid: _app_uuid,
                        username: user_id,
                        password: Base64.encode(pass)
                    };
                    var result = fnAjaxSend(data, uri, type, {}, false);
                    if (result.responseJSON && result.responseJSON.status === 200) {
                        var result2 = fnAjaxSend({token: result.responseJSON.data.token}, _config_base_url + '/save-token', 'POST', {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, false);
                        if (result2.status === 200) {
                            console.log(_config_base_url + '/beranda');
                            //return false;
                            setTimeout(function () {
                                //loadingImg('destroy');
                                console.log('harusnya redirect');
                                window.location.href = _config_base_url + '/beranda';
                            }, 2000);
                            return false;
                        } else {
                            setTimeout(function () {
                                //loadingImg('destroy');
                                console.log('harusnya redirect');
                                window.location.href = _config_base_url + '/logout';
                            }, 2500);
                            return false;
                        }
                    }
                });

                $('input[name="password2"]').on('keypress', function (e) {
                    if ($('input[name="password"]').val() === '') {
                        $('.info-password2').html('<p style="color:red">mohon isi kata sandi di kolom pertama...</p>');
                        return false;
                    }
                });
            }
        };
    }();
    jQuery(document).ready(function () {
        Ajax.init();
    });
</script>