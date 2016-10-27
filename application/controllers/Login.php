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
            $flag = 0;
            
            if ($result) {
                if ($result['role_id'] == 1 && $result['is_verified'] == 1 && $result['status'] == 1 && $user_title=='Tenant') {
                    //success
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $user_title=='Tenant') {
                    // Give error mesg for verify link
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 0 && $result['status'] == 0 && $user_title=='Staff') {
                    // Give error msg for user is not approved by admin
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 1 && $user_title=='Staff') {
                    $userdata = $this->session->set_userdata('staffed_logged_in', $result);
                    redirect('staff');
                } elseif ($result['role_id'] == 3 && $user_title=='Admin') {
                    $userdata = $this->session->set_userdata('admin_logged_in', $result);
                    redirect('admin');
                }else{
                    $flag = 1;
                }
            }else{
                $flag = 1;
            }
            if($flag==1){
                $this->session->set_flashdata('error_msg', 'Invalid email or password!');
                if($this->uri->segment(1)=='login' || $this->uri->segment(1)==''){
                    redirect('login');
                }
                else{
                    redirect($this->uri->segment(1).'/login');
                }
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        if ($this->uri->segment(1) == 'admin') {
            redirect('admin/login');
        } else if ($this->uri->segment(1) == 'staff') {
            redirect('staff/login');
        }else{
            redirect('login');
        }
    }
}
