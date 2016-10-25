<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
//        $this->load->model('Tickets_model');
        $this->table = TBL_TICKETS;
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Tickets';
        $this->data['tickets'] = $this->Admin_model->get_tickets($this->table, 1);
         $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
         $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
         $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('admin', 'Admin/Tickets/index', $this->data);
    }
    
    public function changeAction(){
        $id= $this->input->post('id');
        $type= $this->input->post('action_type');
       $record_id = base64_decode($id);
       echo $record_id.'<br>type: '.$type;exit;
    }

}
