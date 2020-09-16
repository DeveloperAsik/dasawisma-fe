<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//load laravel feature
use View;
use App\Traits\Api;
//load custom libraries class
use App\Http\Libraries\Variables_Library AS VLibrary;
use App\Http\Libraries\Session_Library AS SesLibrary;

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
        if (!SesLibrary::_get('_token')) {
            //request token
            $param = [
                'uri' => config('app.base_api_uri') . '/generate-token-access?deviceid=' . SesLibrary::_get('_uuid'),
                'method' => 'GET'
            ];
            $token = $this->__init_request_api($param);
            if ($token->status == 200) {
                SesLibrary::_set('_token', $token->data->token);
            }
        }
        if (SesLibrary::_get('_token')) {
            $param2 = [
                'uri' => config('app.base_api_uri') . '/fetch/about?token=' . SesLibrary::_get('_token'),
                'method' => 'GET'
            ];
            $about = $this->__init_request_api($param2);
            if ($about->status == 200) {
                View::share('_about', $about->data);
            }
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

    protected function get_module($id = null) {
        $res = array();
        if ($id != null) {
            $Tbl_modules = new Tbl_modules();
            $res = $Tbl_modules->find('first', array('fields' => 'all', 'table_name' => 'tbl_modules', 'conditions' => array('where' => array('a.is_active' => '= "1"', 'a.id' => '= "' . $id . '"'))));
        }
        return $res;
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

}
