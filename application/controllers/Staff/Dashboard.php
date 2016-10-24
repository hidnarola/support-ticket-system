<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('Staff_model');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Dashboard';

        $this->data['total_tickets'] = $this->Staff_model->get_total_tickets($this->session->userdata('staffed_logged_in')['id']);
        $this->data['total_replies'] = $this->Staff_model->get_total_replies($this->session->userdata('staffed_logged_in')['id']);
        $this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
        // pr($this->data['tickets'],1);
        $this->template->load('staff', 'Staff/Dashboard/index', $this->data);       
    }

    
    
   

}
