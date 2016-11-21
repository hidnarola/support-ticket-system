<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->model('Media_model');
        $this->load->model('News_model');
    }

    public function index() {
//        $this->load->view('Frontend/home');
        $data['title'] = 'Home | Support-Ticket-System';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $images = $this->Media_model->get_home_images();
        $data['images'] = $images;
        $data['user'] = $this->User_model->getUserByID($userid);
        $this->template->load('frontend/home', 'Frontend/home', $data);
    }

    public function verify() {
        $key = $this->input->get('key');
        $decode = urldecode($key);
//        echo $decode;
        $val = explode('=', $decode);
        $this->data['email'] = $val[1];
//        echo '<br>'.$this->data['email'];
        $check = $this->User_model->passwordExist($this->data['email']);
        pr($check);
//        $update = $this->User_model->updateField('id', $check['id'], 'is_verified', 1, TBL_USERS);

        if ($check['role_id'] == 1) {
            //--- for tenant verifaication
            if ($check['is_verified'] == 1 && $check['approved'] == 1) {
                $this->session->set_flashdata('success_msg', 'Your Email has been verified Successfully! No need to verify again.');
                redirect('login');
            } elseif ($check['is_verified'] == 1 && $check['approved'] == 0) {
                $this->session->set_flashdata('success_msg', 'Your Email has been verified Successfully! No need to verify again.');
                redirect('login');
            } else {
                if ($check['is_verified'] == 0 && $check['password'] != '') {
                    //--- for tenant verifaication already Done or not
                    $update = $this->User_model->updateField('id', $check['id'], 'is_verified', 1, TBL_USERS);
                    $this->session->set_flashdata('success_msg', 'Your Email has been verified Successfully!');
                    redirect('login');
                } else {
//                echo 'in else';exit;
                    $this->data['title'] = 'Password Setup | Support-Ticket-System';
                    $this->data['header_title'] = 'Password Setup';
                    $update = $this->User_model->updateField('id', $check['id'], 'is_verified', 1, TBL_USERS);
                    $this->session->set_flashdata('success_msg', 'Your Email Id is verified. Please set your password!');
                    $this->template->load('frontend/page', 'Frontend/User/password_recovery_tenant', $this->data);
//                redirect('login');
                }
            }
        } else {
            //--- For staff verifaication
            if ($check['is_verified'] == 1 && $check['approved'] == 1) {
                $this->session->set_flashdata('success_msg', 'Your Email has been verified Successfully! No need to verify again.');
                redirect('login');
            } else {
                if ($check['password'] != '') {
                    //--- for staff verifaication already Done or not
                    $this->session->set_flashdata('error_msg', 'You have already setup password. You can login Now!');
                    redirect('staff/login');
                } else {
                    $update = $this->User_model->updateField('id', $check['id'], 'is_verified', 1, TBL_USERS);
                    $this->template->load('admin_login', 'Admin/Users/password_recovery_staff', $this->data);
                }
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
                $this->session->set_flashdata('success_msg', 'Your password is saved succesfully. You can login Now!');
                redirect('staff/login');
            }
        }
    }

    public function verifyPasswordTenant() {
        $email = $this->data = $this->input->post('email_hidden');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('conpassword', 'Confirm Password', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['title'] = 'Password Setup | Support-Ticket-System';
            $this->data['header_title'] = 'Password Setup';
            $this->template->load('frontend/page', 'Frontend/User/password_recovery_tenant', $this->data);
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
                redirect('login');
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
        if ($type == 0) {
            $type_id = 'article';
        } else if ($type == 1) {
            $type_id = 'news';
        } else {
            $type_id = 'announcement';
        }

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
            $firstname = $this->session->userdata('user_logged_in')['fname'];
            $lastname = $this->session->userdata('user_logged_in')['lname'];
//            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);

            $message = "Hello Admin,<br/><br/><div>There is an inquiry for the " . $type_id . " from <strong>" . $firstname . " " . $lastname . "</strong>"
                    . "<br/>Link Inquiry : <a href = " . $link . ">" . $link . "</a>"
                    . "<br/>Subject : " . $subject
                    . "<br/>Comment : " . $comment
                    . "</div><br/>Thanks, <br/>" . $firstname . " " . $lastname;

            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body = $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $this->email->subject('Inquiry for ' . $type_id . ' in the dev.supportticket.com');
            $this->email->message($mail_body);
            $this->email->send();
            $this->email->print_debugger();
        }

        echo json_encode($data);
        exit;
    }

    public function loadmore() {
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        $num_rows = $this->News_model->num_rows($type, $id);
        $rec = $this->News_model->load_rows($type, $id);
        $data['num_rows'] = $num_rows;
        $data['rec'] = $rec;
//        pr($rec);
        echo json_encode($data);
        exit;
    }

}
