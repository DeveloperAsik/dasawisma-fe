<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Api;

/**
 * Description of IncidentsController
 *
 * @author root
 */
class IncidentsController extends Controller {

    //put your code here
//put your code here
    use Api;

    public function get_list(Request $request) {
        if ($request->isMethod('post')) {
            //dd($request->request->all());
            $post = $request->post();
            //init config for datatables
            $draw = $post['draw'];
            $start = $post['start'];
            $length = $post['length'];
            $search = trim($post['search']['value']);
            $keyword = 'all';
            $value = '';
            if ($search) {
                $keyword = 'title';
                $value = $search;
            }
            $param = [
                'uri' => config('app.base_api_uri') . '/fetch/report-incidents?page=' . $start . '&total=' . $length . '&keyword=' . $keyword . '&value=' . $value . '&token=' . $request->session()->get('_token_api'),
                'method' => 'GET'
            ];
            $res = $this->__init_request_api($param);
            $arr = array();
            if ($res->status == 200) {
                $i = $start + 1;
                foreach ($res->data as $d) {
                    $status = '';
                    if ($d->is_active == 1) {
                        $status = 'checked';
                    }
                    $action_status = '<div class="form-group">
                        <div class="col-md-9" style="height:30px">
                            <input type="checkbox" class="make-switch" data-size="small" data-value="' . $d->is_active . '" data-id="' . $d->id . '" name="status" ' . $status . '/>
                        </div>
                    </div>';
                    $data['rowcheck'] = '
                    <div class="form-group form-md-checkboxes">
                        <div class="md-checkbox-list">
                            <div class="md-checkbox">
                                <input type="checkbox" id="select_tr' . $d->id . '" class="md-check select_tr" name="select_tr[' . $d->id . ']" data-id="' . $d->id . '" />
                                <label for="select_tr' . $d->id . '">
                                    <span></span>
                                    <span class="check" style="left:20px;"></span>
                                    <span class="box" style="left:14px;"></span>
                                </label>
                            </div>
                        </div>
                    </div>';
                    $data['num'] = $i;
                    $data['title'] = $d->title; //optional		
                    $data['description'] = $d->description; //optional
                    $data['additional_info'] = $d->additional_info; //optional
                    $data['integrated_services_post_name'] = $d->integrated_services_post_name; //optional
                    $data['active'] = $action_status; //optional
                    $data['action'] = '<a style="color:#000;text-align:center" href="/detail-data-laporan/'.$d->id.'/'. strtolower(str_replace(' ', '-', $d->title)).'">lihat</a>'; //optional
                    $arr[] = $data;
                    $i++;
                }
            }
            $total_rows = $res->meta->total_rows;
            $output = array(
                'draw' => $draw,
                'recordsTotal' => $total_rows,
                'recordsFiltered' => $total_rows,
                'data' => $arr,
            );
            //output to json format
            echo json_encode($output);
        } else {
            echo json_encode(array());
        }
    }

}
