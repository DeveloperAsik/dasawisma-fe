<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend\Settings;

use App\Http\Controllers\Controller;
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
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
        $param = [
            'uri' => config('app.base_api_uri') . '/fetch/content?page=1&total=15',
            'method' => 'GET',
            'header' => [
                'token' => 'EKDgPf6RVvN6YIGYx9Unzdws74xiUAcOVW6r5KaP21bPkko3RmKWEx2MBvUmroalcgE1L1Tmk4YS6pzWXq52ZBGlgj9djTRzHOFM2pSiQOPL8aCCSmUJWaB3JKaTy7ia'
            ],
            'body' => []
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
        $data['title_for_layout'] = 'Welcome to orenoproject.com';
        if ($id) {
            $param = [
                'uri' => config('app.base_api_uri') . '/fetch/content',
                'method' => 'GET',
                'header' => [
                    'token' => 'EKDgPf6RVvN6YIGYx9Unzdws74xiUAcOVW6r5KaP21bPkko3RmKWEx2MBvUmroalcgE1L1Tmk4YS6pzWXq52ZBGlgj9djTRzHOFM2pSiQOPL8aCCSmUJWaB3JKaTy7ia'
                ],
                'body' => [
                    'id' => $id
                ]
            ];
            $data['detail'] = $this->__init_request_api($param);
        }
        return view($this->_config_path_layout . 'Dup.index', $data);
    }

}
