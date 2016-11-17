<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
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

    public function articles() {

        $keyword = $this->input->post('term');

        $data['response'] = 'false'; //Set default response
        if (!empty($keyword) && isset($keyword)) {
            $query = $this->Article_model->getarticles($keyword);
            if (!empty($query)) {
                $data['response'] = 'true'; //Set response
                $data['message'] = array(); //Create array
                foreach ($query as $row) {
                    $data['message'][] = array('value' => $row['title'], 'id' => $row['id']);
                }
                echo json_encode($data);
                exit;
            }
        }
    }

    public function getArticle() {
        $id = $this->input->post('id');
        $data['data'] = $this->Article_model->get_data_by_id($id);
        echo json_encode($data);
        exit;
    }

    public function add_comments() {

        $subject = $this->input->get_post('subject');
        $comment = $this->input->get_post('comment');
        $link = $this->input->post('link');
        $type = $this->input->post('type');
        $article_id = $this->input->post('article_id');
        
        $userid = $this->session->userdata('user_logged_in')['id'];
        $useremail = $this->session->userdata('user_logged_in')['email'];
        $data['user'] = $this->User_model->getUserByID($userid);
       
        $data_rec = array(
            'user_id' => $this->session->userdata('user_logged_in')['id'],
            'article_id' => $article_id,
            'type' => $type,
            'subject' => $subject,
            'comment' => $comment,
            'created' => date('Y-m-d H:i:s')
        );
        
//        pr($_POST,1);

        if ($this->Admin_model->manage_record(TBL_ARTICLE_COMMENTS, $data_rec)) {
            /* To send mail to the admin */
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from($useremail);
            $this->email->to('rep@narola.email');

            //--- set email template
            $data_array = array(
                'firstname' => $this->session->userdata('user_logged_in')['fname'],
                'lastname' => $this->session->userdata('user_logged_in')['lname'],
                'subject' => $subject,
                'link' => $link,
                'email' => $useremail,
            );
            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);
            $this->email->subject('Your account is registed for dev.supportticket.com');
            $this->email->message($msg);
            $this->email->send();
            $this->email->print_debugger();
        }

        echo json_encode($data);
        exit;
    }

}
