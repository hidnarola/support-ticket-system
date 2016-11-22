<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Ticket_model');
        $this->load->model('Staff_model');
        $this->table = TBL_TICKETS;
    }

    public function staff_index(){
         $this->data['icon_class'] = 'icon-user';
        $this->data['title'] = $this->data['page_header'] = 'Tickets';
        $this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('staff', 'Staff/Tickets/index', $this->data);
    }

    public function get_staff(){
        $dept = $this->input->post('dept');
        $staff = $this->Admin_model->get_staff($dept);
        $html = '<option value="">Select Staff</option>';
        foreach ($staff as $row) {
            $html .= '<option value="'. $row['user_id'] .'">'. $row['fname'].' '. $row['lname'] .'</option>';
        }
        echo $html;
        exit;
    }
}