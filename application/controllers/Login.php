<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
    }
	public function index(){
		$user_title = 'Tenant';
		if($this->uri->segment(1)=='admin'){
			$user_title = 'Admin';
		}else if($this->uri->segment(1)=='staff'){
			$user_title = 'Staff';
		}

		$data['title'] = $user_title.' Login';
		if($user_title != 'Tenant'){
			$this->template->load('admin_login', 'Admin/Users/login', $data);
		}else{
			echo 'load tenant template';
		}
	}
}