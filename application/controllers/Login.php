<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Admin_model');
        $this->table = TBL_USERS;
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
            $userid = $this->session->userdata('user_logged_in')['id'];
            $data['user'] = $this->User_model->getUserByID($userid);
            $data['title'] = 'Login | Support-Ticket-System';
            $data['header_title'] = 'Login';
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
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $result['password'] != '' && $user_title == 'Tenant') {
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
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email[' . $useremail . ']');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[conpassword]');
        $this->form_validation->set_rules('conpassword', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Signup | Support-Ticket-System';
            $data['header_title'] = 'Signup';
            $userid = $this->session->userdata('user_logged_in')['id'];
            $data['user'] = $this->User_model->getUserByID($userid);
            $this->template->load('frontend/page', 'Frontend/login_register', $data);
        } else {

            if ($_FILES['contract']['name'] != '') {
                    $type_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG', 'pdf', 'PDF');
                    $exts = explode(".", $_FILES['contract']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "contract-" . date("mdYhHis") . "." . $exts[1];

                    $config['upload_path'] = USER_CONTRACT;
                    $config['allowed_types'] = implode("|", $type_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('contract')) {
                        $flag = 1;
                        $data['contract_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $contract = $file_info['file_name'];

                        $src = './' . USER_CONTRACT . '/' . $contract;
                        
                    }
                } else {
                    $contract = '';
                }


            $password = $this->encrypt->encode($this->input->post('password'));
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $useremail,
                'role_id' => 1,
                'contactno' => $this->input->post('contactno'),
                'password' => $password,
                'address' => $this->input->post('address'),
                'is_verified' => 0,
                'status' => 0,
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
                'contract'=>$contract
            );
//            p($data, 1);
            $this->Admin_model->manage_record($this->table, $data);
            /* To send mail to the user */
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from('demo.narola@gmail.com', 'dev.supportticket.com');
            $this->email->to($useremail);

            //--- set email template
            $data_array = array(
                'firstname' => $this->input->post('fname'),
                'lastname' => $this->input->post('lname'),
                'email' => $useremail,
            );
            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);
            $this->email->subject('Your account is registed for dev.supportticket.com');
            $this->email->message($msg);
            $this->email->send();
            $this->email->print_debugger();
            $this->session->set_flashdata('success_msg', 'Registration success! now please verify link on your email address.');
            redirect('login');
        }
    }

    function check_email($email) {
        $return_value = $this->User_model->check_email($email);
        if ($return_value) {
            $this->form_validation->set_message('check_email', 'Sorry, This email is already Exists..!');
            return FALSE;
        } else {
            return TRUE;
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

    public function page_not_found(){
        $data['view'] = 'admin/404_notfound';
        $this->load->view('admin/error/404_notfound', $data);
    }

}
