<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Test extends REST_Controller {

	function __construct() {
        parent::__construct();
        //instanciate
        $this->load->model('test_model');
    }

	public function db_test_connect_post() { 

		$response = $this->test_model->db_test_connect();

		$this->response($response);

	}

	public function sample_select_qry_post() { 

		$accountno = $this->post('accountno');

		if ($accountno == null || $accountno == '') {
			$resultset['errorcode'] = 'ERRPARAM0001';
			$resultset['errormsg'] = 'accountno is REQUIRED';
			$this->response($resultset);
		}

		$response = $this->test_model->sample_select_qry($accountno);

		$this->response($response);

	}

	public function sample_update_qry_post() { 

		$post_params = $this->post();

		if ($post_params['hash'] == null || $post_params['hash'] == '') {
			$resultset['errorcode'] = 'ERRPARAM0001';
			$resultset['errormsg'] = 'Pass is REQUIRED';
			$this->response($resultset);
		}

		if ($post_params['password_recovery_key'] == null || $post_params['password_recovery_key'] == '') {
			$resultset['errorcode'] = 'ERRPARAM0001';
			$resultset['errormsg'] = 'Pin is REQUIRED';
			$this->response($resultset);
		}

		$response = $this->test_model->sample_update_qry($post_params['hash'], $post_params['password_recovery_key']);

		$this->response($response);

	}

}