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

    public function beranda() {
        $data['title_for_layout'] = 'Selamat datang di dasawisma Kota Bogor Kecamatan Bogor Timur';
        $data['page'] = 'dashboard-user';

        //report-types
        $param_type = [
            'uri' => config('app.base_api_uri') . '/fetch/report-types?page=1&total=25&token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $types = $this->__init_request_api($param_type);
        dd($types);
        if ($types && $types->status == 200) {
            $data['types'] = $types->data;
        }
        
        //report-level
        $param_level = [
            'uri' => config('app.base_api_uri') . '/fetch/report-level?page=1&total=25&token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $level = $this->__init_request_api($param_level);
        if ($level && $level->status == 200) {
            $data['level'] = $level->data;
        }
        
        //provinces
        $param_provinces = [
            'uri' => config('app.base_api_uri') . '/fetch/provinces?page=1&total=25&token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $provinces = $this->__init_request_api($param_provinces);
        if ($provinces && $provinces->status == 200) {
            $data['provinces'] = $provinces->data;
        }
        return view($this->_config_path_layout . 'Global.index', $data);
    }

    public function about() {
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
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
        $data['page'] = 'about';
        return view($this->_config_path_layout . 'Global.index', $data);
    }

    //public function contact() {
    //    $data['title_for_layout'] = 'Welcome to orenoproject.com';
    //    return view($this->_config_path_layout . 'Dup.index', $data);
    //}

    public function detail($id) {
        $data['title_for_layout'] = 'Selamat datang di dasawisma Kota Bogor Kecamtan Bogor Timur';
        if ($id) {
            $param = [
                'uri' => config('app.base_api_uri') . '/find/content?id=' . $id . '&token=' . SesLibrary::_get('_token'),
                'method' => 'GET'
            ];
            $detail = $this->__init_request_api($param);
            if ($detail->status == 200) {
                $data['detail'] = $detail->data[0];
            }
        }

        return view($this->_config_path_layout . 'Dup.index', $data);
    }

}
