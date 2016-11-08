<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
    }

    public function index() {
//        $this->load->view('Frontend/home');
        $data['title'] = 'Home | Support-Ticket-System';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $this->template->load('frontend/home', 'Frontend/home', $data);
    }

    public function verify() {
        $key = $this->input->get('key');
        $decode = urldecode($key);
        $val = explode('=', $decode);
        $this->data['email'] = $val[1];
        $check = $this->User_model->passwordExist($this->data['email']);

        if ($check['role_id'] == 1) {
            //--- for tenant verifaication
            if ($check['is_verified'] == 1) {
                 //--- for tenant verifaication already Done or not
                $this->session->set_flashdata('success_msg', 'Your account is already verified, no need to activate again. You can login!');
                redirect('login');
            } else {
                $update = $this->User_model->updateField('id', $check['id'], 'is_verified', 1, TBL_USERS);
                $this->session->set_flashdata('success_msg', 'Your Email Id is verified. You can Login.');
                redirect('login');
            }
        } else {
            //--- For staff verifaication
            if ($check['password'] != 1) {
                  //--- for staff verifaication already Done or not
                $this->session->set_flashdata('error_msg', 'You have already setup password. You can login Now!');
                redirect('staff/login');
            } else {
                $this->template->load('admin_login', 'Admin/Users/password_recovery_staff', $this->data);
            }
        }
    }

    public function verifyPassword() {
        $email = $this->data = $this->input->post('email_hidden');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('repeat_password', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin_login', 'Admin/Users/password_recovery_staff', $this->data);
        } else {
            $password = $this->input->post('password');
            $encryptPassword = $this->encrypt->encode($password);
            $data = array(
                'password' => $encryptPassword,
                'status' => 0,
                'is_verified' => 1
            );
            $rec = $this->User_model->edit($data, TBL_USERS, 'email', $email);
            if ($rec) {
                $this->session->set_flashdata('success_msg', 'Your password is changed succesfully. You can login Now!');
                redirect('staff/login');
            }
        }
    }

}
