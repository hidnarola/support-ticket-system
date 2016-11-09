<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Staff_model');
        $this->load->model('Ticket_model');
        $this->load->model('User_model');
    }

    public function index(){
        $data['title'] = 'Tickets | Support-Ticket-System';
        $data['header_title'] = 'My Tickets';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $data['tickets'] = $this->User_model->getUserTickets($userid);
//        p($data['tickets'],1);
        $this->template->load('frontend/page', 'Frontend/Tickets/index', $data);
    }
    
    public function add(){
        $data['title'] = 'Tickets | Support-Ticket-System';
        $data['header_title'] = 'Add Ticket';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $this->template->load('frontend/page', 'Frontend/Tickets/add', $data);
    }
    
}