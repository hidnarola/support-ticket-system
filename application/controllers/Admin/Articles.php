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
        $get_data = $this->Article_model->get_data($type);
        $this->data['articles'] = $get_data;
        $this->template->load('admin', 'Admin/Articles/index', $this->data);
    }

    public function add() {
        $this->data['title'] = $this->data['page_header'] = 'Add Articles';
        $this->data['page'] = 'Articles';
        $this->data['icon_class'] = 'icon-magazine';
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('is_visible', 'Visibility', 'trim|required');
        $expiry_date = '';
        if($this->input->post('expiry_date'))
            $expiry_date = $this->input->post('expiry_date');
        if ($this->form_validation->run() == FALSE) {
           $this->template->load('admin', 'Admin/Articles/add', $this->data);
        } else {
            
        }
      
    }

}
