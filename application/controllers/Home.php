<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
    }

    public function verify() {
        $key = $this->input->get('key');
        $decode = urldecode($key);
        $val = explode('=', $decode);
        $this->data['email'] = $val[1];
//        $this->data['title'] = $this->data['page_header'] = 'Tenants / Add Tenant';
        $this->template->load('admin_login', 'Admin/Users/password_recovery', $this->data);
    }

}
