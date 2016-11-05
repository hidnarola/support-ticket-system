<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
//        check_isvalidated_user();
        $this->load->model('User_model');
        $this->load->helper('text');
    }

    public function index($type = null) {
                echo "<pre>";
print_r($this->session->all_userdata());
echo "</pre>";exit;
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'User Profile | Support-Ticket-System';
        $this->template->load('frontend/page', 'Frontend/profile', $data);
    }

}
