<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//load laravel feature
use View;
//load custom libraries class
use App\Http\Libraries\Variables_Library AS VLibrary;
use App\Http\Libraries\Session_Library AS SesLibrary;
use App\Traits\Api;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        Api;

    public function __construct() {
        $this->initVar();
        $this->initAuth();
    }

    public function initVar() {
        $conf = VLibrary::init();
        if ($conf['PATH']) {
            foreach ($conf['PATH'] AS $key => $values) {
                /*
                 * enable actual config variable to load globally 
                 * start here
                 */
                View::share($key, $values);
                /*
                 * enable actual config variable to load globally 
                 * end here
                 */
                $this->{$key} = $values;
            }
        }

        if ($conf['CONFIG']) {
            foreach ($conf['CONFIG'] AS $key => $values) {
                /*
                 * enable actual config variable to load globally 
                 * start here
                 */
                View::share($key, $values);
                /*
                 * enable actual config variable to load globally 
                 * end here
                 */
                $this->{$key} = $values;
            }
        }

        if (!SesLibrary::_get('_uuid') || SesLibrary::_get('_uuid') == null) {
            SesLibrary::_set('_uuid', uniqid());
        }
        if (!SesLibrary::_get('_token') || SesLibrary::_get('_token') == null) {
            //request token
            $token = $this->generate_token();
            if ($token && $token->status == 200) {
                SesLibrary::_set('_token', $token->data->token);
            }
        } else {
            $param2 = [
                'uri' => config('app.base_api_uri') . '/validate-token?token=' . SesLibrary::_get('_token'),
                'method' => 'GET'
            ];
            $validate_token = $this->__init_request_api($param2);
            dd($validate_token);
            if ($validate_token->status == 200 && $validate_token->data->valid == false) {
                $param = [
                    'uri' => config('app.base_api_uri') . '/drop-user-session?token=' . SesLibrary::_get('_token'),
                    'method' => 'GET'
                ];
                $this->__init_request_api($param);
                $token = $this->generate_token();
                SesLibrary::_set('_token', uniqid());
                SesLibrary::_destroy();
            }
        }
        if (SesLibrary::_get('_token')) {
            $param3 = [
                'uri' => config('app.base_api_uri') . '/fetch/about?token=' . SesLibrary::_get('_token'),
                'method' => 'GET'
            ];
            $about = $this->__init_request_api($param3);
            if ($about->status == 200) {
                View::share('_about', $about->data);
            }

            $param4 = [
                'uri' => config('app.base_api_uri') . '/fetch/content?token=' . SesLibrary::_get('_token') . '&page=1&total=1&keyword=1',
                'method' => 'GET'
            ];
            $home_about = $this->__init_request_api($param4);
            if ($home_about->status == 200) {
                View::share('_content_homepage', $home_about->data[0]);
            }
        }

        //init menu value for global's layout
        $this->_menu();
    }

    public function generate_token() {
        $param = [
            'uri' => config('app.base_api_uri') . '/generate-token-access?deviceid=' . SesLibrary::_get('_uuid'),
            'method' => 'GET'
        ];
        $token = $this->__init_request_api($param);
        if ($token && $token->status == 200) {
            SesLibrary::_set('_token', $token->data->token);
        }
    }

    public function initAuth() {
        if (!SesLibrary::_get('_uuid') || SesLibrary::_get('_uuid') == null) {
            SesLibrary::_set('_uuid', uniqid());
        }
        if (SesLibrary::_get('_is_logged_in')) {
            View::share('_is_logged_in', SesLibrary::_get('_is_logged_in'));
        }
        if (SesLibrary::_get('_token')) {
            View::share('_token', SesLibrary::_get('_token'));
        }
        //AuthLibrary::verify_group_permission(\Request::route()->getName());
    }

    public function load_css($class = array()) {
        if ($class) {
            View::share('load_css', $class);
        }
    }

    public function load_js($class = array()) {
        if ($class) {
            View::share('load_js', $class);
        }
    }

    public function load_ajax_var($values = array()) {
        if ($values) {
            View::share('load_ajax_var', $values);
        }
    }

    public function _menu() {
        $data_menu = (object) array(
                    array(
                        'id' => 1,
                        'type' => 'btn',
                        'name' => 'Beranda'
                    ),
                    array(
                        'id' => 2,
                        'type' => 'btn',
                        'name' => 'Kegiatan'
                    ),
                    array(
                        'id' => 3,
                        'type' => 'btn',
                        'name' => 'Tentang'
                    ),
                    array(
                        'id' => 4,
                        'type' => 'btn',
                        'name' => 'Hubungi'
                    ),
                    array(
                        'id' => 5,
                        'type' => 'btn',
                        'name' => 'Laporan'
                    ),
                    array(
                        'id' => 5,
                        'type' => 'link',
                        'name' => 'Login'
                    )
        );

        View::share('_menu', $data_menu);
    }

}
