<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use App\MY_Model;

/**
 * Description of Tbl_user_devices
 *
 * @author root
 */
class Tbl_user_devices extends MY_Model {

    //put your code here
    protected $table_name = 'tbl_user_devices';

    public function __construct() {
        parent::__construct();
    }

}
