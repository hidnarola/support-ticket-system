<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
    }

    public function index() {
    	
    }
}