<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
//        if($_POST)
//            p($_POST);
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
            $data['title'] = 'Login | Support-Ticket-System';
            $this->template->load('frontend/page', 'Frontend/login_register', $data);
        }
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->User_model->check($email, $password);
            $flag = 0;

            if ($result) {
//                p($result);
                if ($result['role_id'] == 1 && $result['is_verified'] == 1 && $result['status'] == 1 && $user_title == 'Tenant') {
//                    echo 'in if1'; exit;  
                    //success
                    $userdata = $this->session->set_userdata('user_logged_in', $result);
                    redirect('profile');
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $user_title == 'Tenant') {
//                    echo 'in if2'; exit;
                    // Give error mesg for verify link
                    $this->session->set_flashdata('error_msg', 'Please verify your link before login!');
                    redirect('login');
                } elseif ($result['role_id'] == 1 && $result['status'] == 0 && $result['is_verified'] == 1 && $user_title == 'Tenant') {
//                    echo 'in if3'; exit;
                    // login sucess Give error mesg for unapproved user
                    $this->session->set_flashdata('error_msg', 'You are approved user by the admin!');
                    redirect('profile');
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 0 && $result['status'] == 0 && $user_title == 'Staff') {
                    // Give error msg for user is not approved by admin
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 1 && $user_title == 'Staff') {
                    $userdata = $this->session->set_userdata('staffed_logged_in', $result);
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    redirect('staff');
                } elseif ($result['role_id'] == 3 && $user_title == 'Admin') {
                    $userdata = $this->session->set_userdata('admin_logged_in', $result);
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    redirect('admin');
                } else {
                    $flag = 1;
                }
            } else {
                $flag = 1;
            }
            if ($flag == 1) {
                $this->session->set_flashdata('error_msg', 'Invalid email or password!');
                if ($this->uri->segment(1) == 'login' || $this->uri->segment(1) == '') {
                    redirect('login');
                } else {
                    redirect($this->uri->segment(1) . '/login');
                }
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        if ($this->uri->segment(1) == 'admin') {
            redirect('admin/login');
        } else if ($this->uri->segment(1) == 'staff') {
            redirect('staff/login');
        } else {
            redirect('login');
        }
    }

}
