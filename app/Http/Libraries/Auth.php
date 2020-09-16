<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Libraries;

use App\Http\Libraries\Session_Library AS SesLibrary;
use App\Traits\Api;

/**
 * Description of Auth
 *
 * @author root
 */
class Auth {

    use Api;

    //put your code here
    public static function set_token_access() {
        if (SesLibrary::_get('_uuid') || SesLibrary::_get('_uuid') == null) {
            $param = [
                'uri' => config('app.base_api_uri') . '/generate-token-access?deviceid=' . SesLibrary::_get('_uuid'),
                'method' => 'GET'
            ];
            $this->__init_request_api($param);
        }
    }

    public static function session_data_clear() {
        $param = [
            'uri' => config('app.base_api_uri') . '/drop-user-session?token=' . SesLibrary::_get('_token'),
            'method' => 'GET'
        ];
        $this->__init_request_api($param);
    }

}
