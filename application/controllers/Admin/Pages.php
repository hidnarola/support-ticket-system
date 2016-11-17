<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('Pages_model');
    }

    public function index() {
    	$pages = $this->Pages_model->get_pages();
    	$data['pages'] = $pages;
    	$data['title'] = 'Manage Pages';
    	$this->template->load('admin', 'Admin/Pages/index', $data);
    }

    public function manage(){
    	$data['title'] = 'Add page';
    	$this->template->load('admin', 'Admin/Pages/manage', $data);
    }
}