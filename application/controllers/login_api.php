<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Login_api extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('login_api_model');

	}

	public function validate_post(){

		$posted = $this->post();

		if (!isset($posted['email']) || !isset($posted['password']) || $posted['email'] == '' || $posted['password'] == '') {

			$errors['response'] = 401;
			$errors['message'] = 'Username or Password is incorrect.';
			
			$this->response($errors);
		}

		$params['email'] = $posted['email'];
		$params['password'] = $posted['password'];

		$result = $this->login_api_model->validate_creds($params);

		$this->response($result);

	}

}