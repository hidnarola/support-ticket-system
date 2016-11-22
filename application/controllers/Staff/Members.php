<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_if_staff_validated();
        $this->data = array();
        $this->load->model('Staff_model');
        $this->load->model('User_model');
        $this->load->model('Admin_model');
        $this->table = TBL_USERS;
    }


    public function index() {

        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['icon_class'] = 'icon-people';
        $this->data['page_header'] = 'Members';
        $users = $this->Staff_model->get_members($this->session->userdata('staffed_logged_in')['dept_id']);
        $this->data['users']= $users;

        $this->template->load('staff', 'Staff/Members/index', $this->data);
    }

    public function view($id){
        $record_id = base64_decode($id);
        $this->data['icon_class'] = 'icon-user';
        $this->data['page_header'] = 'Member';
        $this->data['member'] = $this->User_model->viewUser($record_id, $this->table);

        $this->template->load('staff', 'Staff/Members/view', $this->data);
    }
}