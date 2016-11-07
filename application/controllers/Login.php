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
                    //success
                    $userdata = $this->session->set_userdata('user_logged_in', $result);
                    redirect('home');
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $user_title == 'Tenant') {
                    // Give error mesg for verify link
                    $this->session->set_flashdata('error_msg', 'Please verify your link before login!');
                    redirect('login');
                } elseif ($result['role_id'] == 1 && $result['status'] == 0 && $result['is_verified'] == 1 && $user_title == 'Tenant') {
                    // login sucess Give error mesg for unapproved user
                    $userdata = $this->session->set_userdata('user_logged_in', $result);
                    $this->session->set_flashdata('error_msg', 'You are not approved user by the admin!');
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

    public function signup() {

        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . TBL_USERS . '.email]', array('is_unique' => 'Email already exist!'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_check_email[' . $useremail . ']');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Signup | Support-Ticket-System';
            $this->template->load('frontend/page', 'Frontend/login_register', $data);
        } else {
            
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        if ($this->uri->segment(1) == 'admin') {
            redirect('admin/login');
        } else if ($this->uri->segment(1) == 'staff') {
            redirect('staff/login');
        } else {
            redirect('home');
        }
    }

}
