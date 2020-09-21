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

        $param = [
            'uri' => config('app.base_api_uri') . '/fetch/content?page=1&total=15&token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $carousel = $this->__init_request_api($param);
        $data['carousel'] = null;
        if ($carousel->status == 200) {
            $data['carousel'] = $carousel->data;
        }
        return view($this->_config_path_layout . 'Dup.index', $data);
    }

    public function about() {
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
        return view($this->_config_path_layout . 'Dup.index', $data);
    }

    public function contact() {
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
        return view($this->_config_path_layout . 'Dup.index', $data);
    }

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
