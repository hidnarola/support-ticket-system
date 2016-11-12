<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
    }

    public function index($type = null) {
        $this->data['title'] = $this->data['page_header'] = 'Articles';
        $this->data['icon_class'] = 'icon-magazine';
        $search_text = '';
        $this->data['search_text'] = $search_text;
        $get_data = $this->Article_model->get_data($type);
        $search_text = '';
        if ($this->input->get()) {
            $search_text = $this->input->get('search_text');
            $get_data = $this->Article_model->search_news($search_text, $type);
        }
        $this->data['articles'] = $get_data;
        $this->data['search_text'] = $search_text;
        // pr($get_data,1);

        $this->template->load('admin', 'Admin/Articles/index', $this->data);
    }
}