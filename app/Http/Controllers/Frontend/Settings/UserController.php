<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Libraries\Session_Library AS SesLibrary;
use App\Traits\Api;
use Illuminate\Http\Request;

/**
 * Description of UserController
 *
 * @author root
 */
class UserController extends Controller {

    //put your code here
    use Api;

    public function index() {
        $data['title_for_layout'] = 'Selamat datang di dasawisma Kota Bogor Kecamtan Bogor Timur';
        $data['page'] = 'home';
        $param = [
            'uri' => config('app.base_api_uri') . '/fetch/content?page=1&total=25&token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $carousel = $this->__init_request_api($param);
        //category_id
        $data['carousel'] = null;
        if ($carousel->status == 200) {
            $arr_result = array();
            foreach ($carousel->data AS $key => $values) {
                if ($values->category_id == 2) {
                    $arr_result[] = $values;
                }
            }
            $data['carousel'] = $arr_result;
        }
        return view($this->_config_path_layout . 'Global.index', $data);
    }

    public function beranda(Request $request) {
        $data['title_for_layout'] = 'Selamat datang di dasawisma Kota Bogor Kecamatan Bogor Timur';
        $data['page'] = 'dashboard-user';

        //report-types
        $param_type = [
            'uri' => config('app.base_api_uri') . '/fetch/report-types?page=1&total=25&keyword=all&token=' . $request->session()->get('_token_api'),
            'method' => 'GET'
        ];
        $types = $this->__init_request_api($param_type);
        if ($types && $types->status == 200) {
            $data['types'] = $types->data;
        }

        //report-level
        $param_level = [
            'uri' => config('app.base_api_uri') . '/fetch/report-level?page=1&total=25&keyword=all&token=' . $request->session()->get('_token_api'),
            'method' => 'GET'
        ];
        $level = $this->__init_request_api($param_level);
        if ($level && $level->status == 200) {
            $data['level'] = $level->data;
        }

        //provinces
        $param_provinces = [
            'uri' => config('app.base_api_uri') . '/fetch/provinces?page=1&total=25&keyword=all&token=' . $request->session()->get('_token_api'),
            'method' => 'GET'
        ];
        $provinces = $this->__init_request_api($param_provinces);
        if ($provinces && $provinces->status == 200) {
            $data['provinces'] = $provinces->data;
        }
        return view($this->_config_path_layout . 'Global.index', $data);
    }

    public function about(Request $request) {
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
        $param = [
            'uri' => config('app.base_api_uri') . '/fetch/content?page=1&total=25&token=' . $request->session()->get('_token_api'),
            'method' => 'GET'
        ];
        $carousel = $this->__init_request_api($param);
        //category_id
        $data['carousel'] = null;
        if ($carousel->status == 200) {
            $arr_result = array();
            foreach ($carousel->data AS $key => $values) {
                if ($values->category_id == 2) {
                    $arr_result[] = $values;
                }
            }
            $data['carousel'] = $arr_result;
        }
        $data['page'] = 'about';
        return view($this->_config_path_layout . 'Global.index', $data);
    }

    //public function contact() {
    //    $data['title_for_layout'] = 'Welcome to orenoproject.com';
    //    return view($this->_config_path_layout . 'Dup.index', $data);
    //}

    public function detail(Request $request, $id) {
        $data['title_for_layout'] = 'Selamat datang di dasawisma Kota Bogor Kecamtan Bogor Timur';
        if ($id) {
            $param = [
                'uri' => config('app.base_api_uri') . '/find/content?id=' . $id . '&token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $detail = $this->__init_request_api($param);
            if ($detail->status == 200) {
                $data['detail'] = $detail->data[0];
            }
        }

        return view($this->_config_path_layout . 'Dup.index', $data);
    }

    public function save_token(Request $request) {
        $token = $request->token;
        if ($token) {
            $param = [
                'uri' => config('app.base_api_uri') . '/user-details?token=' . $token,
                'method' => 'GET'
            ];
            $user = Api::__init_request_api($param);
            $request->session()->put('_token_api', $token);
            $request->session()->put('_is_logged_in', true);
            $request->session()->put('_user_logged_in', $user->data);
            $response_data = array('status' => 200, 'message' => 'Successfully login, user login new token acquired', 'data' => array('token' => $token));
            return response()->json($response_data, 200);
        } else {
            $response_data = array('status' => 201, 'message' => 'Failed login', 'data' => array('token' => $token));
            return response()->json($response_data, 200);
        }
    }

    public function logout(Request $request) {
        $param = [
            'uri' => config('app.base_api_uri') . '/drop-user-session?token=' . $request->session()->get('_token_api'),
            'method' => 'GET'
        ];
        $this->__init_request_api($param);
        if ($request->session()->get('_is_logged_in')) {
            $request->session()->forget('_token_api');
            $request->session()->put('_is_logged_in', false);
        }
        $request->session()->flush();
        return redirect()->route('/');
    }

}
