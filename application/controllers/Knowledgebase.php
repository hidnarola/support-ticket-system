<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledgebase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
       check_isvalidated_user();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
    }

    public function index() {
       $userid = $this->session->userdata('user_logged_in')['id'];
         $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'Knowledge Base | Support-Ticket-System';
        $data['header_title'] = 'Knowledge Base';
        $this->template->load('frontend/page', 'Frontend/Knowledgebase/index', $data);
    }
}