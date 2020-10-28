<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use App\Http\Libraries\Session_Library AS SesLibrary;
use App\Traits\Api;
use Closure;

/**
 * Description of OrenoAuth
 *
 * @author root
 */
class OrenoAuth {

    //put your code here
    use Api;

    public function handle($request, Closure $next) {
        $token = $request->token;
        if (empty(SesLibrary::_get('_token')) || SesLibrary::_get('_token') == null || SesLibrary::_get('_token') == '') {
            $token = OrenoAuth::init_token(SesLibrary::_get('_token'));
            $response_data = array('status' => 200, 'message' => 'Successfully login, user login new token acquired', 'data' => array('token' => $token));
            return response()->json($response_data, 200);
            //return response(['successfully login'],200);
            //return $next(json_encode());
        } else {
            SesLibrary::_destroy();
            SesLibrary::_remove('_token');
            $token = OrenoAuth::init_token(SesLibrary::_get('_token'));
            $response_data = array('status' => 200, 'message' => 'Successfully login, user login re-activated ', 'data' => array('token' => $token));
            return response()->json($response_data, 200);
        }
    }

    public static function init_token() {
        $token = SesLibrary::_get('_token');
        if (empty($token) || $token == null || $token == '') {
            $param = [
                'uri' => config('app.base_api_uri') . '/user-details?token=' . $token,
                'method' => 'GET'
            ];
            $user = $this->Api->__init_request_api($param);
            SesLibrary::_set('_is_logged_in', true);
            SesLibrary::_set('_user_logged_in', $user->data);
            SesLibrary::_set('_token', $token);
            return $token;
        } else {
            return $token;
        }
    }
    
    
    public function logout(){
        $token = SesLibrary::_get('_token');
        dd($token);
    }

}
