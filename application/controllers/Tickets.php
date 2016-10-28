<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->load->model('Ticket_model');
    }

    public function staff_index(){
    	$this->data['title'] = $this->data['page_header'] = 'Tickets';
    	$this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
    	$this->template->load('staff', 'Staff/Tickets/index', $this->data);
    }

    
    public function reply($id) {
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            $this->data['ticket_coversation'] = $this->Staff_model->get_ticket_conversation($record_id);
            $this->data['title'] = $this->data['page_header'] = 'Tickets / Replies';
            $this->template->load('staff', 'Staff/Tickets/reply', $this->data);
        } else {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }
}