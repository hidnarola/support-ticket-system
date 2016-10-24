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

}