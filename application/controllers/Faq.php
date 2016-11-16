<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->table = TBL_FAQ;
        check_isvalidated_user();
        $this->load->model('User_model');
        $this->load->model('Article_model');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-question3';

        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'Faq | Support-Ticket-System';
        $data['header_title'] = 'Faq';
        $data['data'] = $this->Article_model->get_faq();
//        pr($data['data'],1);
        $this->template->load('frontend/page', 'Frontend/Faq/index', $data);
    }

}
