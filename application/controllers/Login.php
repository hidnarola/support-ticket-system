<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        $user_title = 'Tenant';
        if ($this->uri->segment(1) == 'admin') {
            $user_title = 'Admin';
        } else if ($this->uri->segment(1) == 'staff') {
            $user_title = 'Staff';
        }
        $data['title'] = $user_title . ' Login';
        if ($user_title != 'Tenant') {
            $this->template->load('admin_login', 'Admin/Users/login', $data);
        } else {
            echo 'load tenant template';
        }
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->User_model->check($email, $password);
       		
            if ($result) {
                if ($result['role_id'] == 1 && $result['is_verified'] == 1 && $result['status'] == 1) {
                    //success
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0) {
                    // Give error mesg for verify link
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 0 && $result['status'] == 0) {
                    // Give error msg for user is not approved by admin
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 1) {
                    $userdata = $this->session->set_userdata('staffed_logged_in', $result);
                    redirect('staff/dashboard');
                } elseif ($result['role_id'] == 3) {
                    $userdata = $this->session->set_userdata('admin_logged_in', $result);
                    redirect('admin/dashboard');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid username or password!');
                $this->template->load('admin_login', 'Admin/Users/login', $data);
            }
        }
    }
}
