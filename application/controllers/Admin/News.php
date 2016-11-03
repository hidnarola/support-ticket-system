<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('News_model');
    }

    public function index(){
        $this->data['title'] = $this->data['page_header'] = 'News And Announcements';
        $this->data['icon_class'] = 'icon-newspaper';
        $this->template->load('admin', 'Admin/News/index', $this->data);
    }
}