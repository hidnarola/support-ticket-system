<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-question3';
        $this->data['faq'] = $this->Admin_model->get_records(TBL_FAQ);
        $this->template->load('admin', 'Admin/Faq/index', $this->data);
    }

    public function add() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-question3';
        $this->template->load('admin', 'Admin/Faq/add', $this->data);
        
    }

    public function edit($id = NULLL) {
        if ($id != '') {
            $this->data['title'] = $this->data['page_header'] = 'FAQ';
            $this->data['icon_class'] = 'icon-question3';
            $this->data['faq'] = $this->Admin_model->get_records(TBL_FAQ);
            $this->template->load('admin', 'Admin/Faq/index', $this->data);
        } else {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

}
