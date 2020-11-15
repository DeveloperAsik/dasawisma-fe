<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
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

    public function __construct(Request $request) {
        $this->initVar($request);
        $this->initAuth($request);
    }

    public function initVar($request) {
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

        if (!$request->session()->get('_uuid') || $request->session()->get('_uuid') == null) {
            $request->session()->put('_uuid', uniqid());
        }
        if (!$request->session()->get('_token_api') || $request->session()->get('_token_api') == null) {
            //request token
            $this->generate_token_api($request);
        } else {
            $param2 = [
                'uri' => config('app.base_api_uri') . '/validate-token?token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $validate_token_api = $this->__init_request_api($param2);
            if ($validate_token_api->status == 200 && $validate_token_api->data->valid == false) {
                $param = [
                    'uri' => config('app.base_api_uri') . '/drop-user-session?token=' . $request->session()->get('_token_api'),
                    'method' => 'GET'
                ];
                $this->__init_request_api($param);
                $this->generate_token_api($request);
            }
        }
        if ($request->session()->get('_token_api')) {
            View::share('_token_api', $request->session()->get('_token_api'));
            $param3 = [
                'uri' => config('app.base_api_uri') . '/fetch/about?token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $about = $this->__init_request_api($param3);
            if ($about->status == 200) {
                View::share('_about', $about->data);
            }
            $param4 = [
                'uri' => config('app.base_api_uri') . '/fetch/content?&page=1&total=1&keyword=category_name&values=homepage&token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $home_about = $this->__init_request_api($param4);
            if ($home_about->status == 200) {
                View::share('_content_homepage', $home_about->data[0]);
            }
        }

        //init menu value for global's layout
        $this->_menu($request);
    }

    public function generate_token_api($request) {
        $param = [
            'uri' => config('app.base_api_uri') . '/generate-token-access?deviceid=' . SesLibrary::_get('_uuid'),
            'method' => 'GET'
        ];
        $token = $this->__init_request_api($param);
        if ($token && $token->status == 200) {
            $request->session()->put('_token_api', $token->data->token);
        }
    }

    public function initAuth($request) {
        
        if (!$request->session()->get('_uuid') || $request->session()->get('_uuid') == null) {
            $request->session()->put('_uuid', uniqid());
        }
        if ($request->session()->get('_token_api')) {
            View::share('_token_api', $request->session()->get('_token_api'));
        }
        $param = [
            'uri' => config('app.base_api_uri') . '/is-logged-in',
            'method' => 'GET',
            'header' => ['token' => $request->session()->get('_token_api')]
        ];
        $is_logged_in = $this->__init_request_api($param);
        if ($is_logged_in->status == 200) {
            $request->session()->put('_is_logged_in', $is_logged_in->data->logged_in);
            View::share('_is_logged_in', $is_logged_in->data->logged_in);
        }
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

    public function _menu($request) {
        $data_menu = array(
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
        if ($request->session()->get('_is_logged_in') == true) {
            $data_menu[5] = array(
                'id' => 5,
                'type' => 'link2',
                'name' => 'Logout');
        }
        View::share('_menu', (object) $data_menu);
    }

}
