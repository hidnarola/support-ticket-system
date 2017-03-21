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
        $data['news_announcements'] = $this->User_model->getlatestnews();
        if ($this->uri->segment(1) == 'support') {
            if ($this->session->userdata('staffed_logged_in')) {
                redirect('staff');
            } else if ($this->session->userdata('admin_logged_in')) {

                redirect('admin');
            }
        } else if ($this->session->userdata('user_logged_in')) {
            redirect('home');
        }
        $user_title = 'Tenant';
        if ($this->uri->segment(1) == 'support') {
            $user_title = 'Support';
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
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    $this->session->set_userdata('role_id', $result['role_id']);
                    $userdata = $this->session->set_userdata('user_logged_in', $result);
                    $force_redirect = $this->session->userdata('force_redirect');
                    if(!empty($force_redirect)){
                        $this->session->unset_userdata('force_redirect');
                        redirect($force_redirect);
                    }
                    redirect('home');
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $user_title == 'Tenant') {
                    // Give error mesg for verify link
                    $this->session->set_flashdata('error_msg', 'Please verify your email address before login!');
                    redirect('login');
                } elseif ($result['role_id'] == 1 && $result['is_verified'] == 0 && $result['password'] != '' && $user_title == 'Tenant') {
                    // Give error mesg for verify link
                    $this->session->set_flashdata('error_msg', 'Please verify your email address before login!');
                    redirect('login');
                } elseif ($result['role_id'] == 1 && $result['status'] == 0 && $result['is_verified'] == 1 && $user_title == 'Tenant') {
                    // login sucess Give error mesg for unapproved user
                    $userdata = $this->session->set_userdata('user_logged_in', $result);
                    $this->session->set_userdata('role_id', $result['role_id']);
                    $this->session->set_flashdata('error_msg', 'Your account approval is in progress.');
                    redirect('profile');
                } elseif ($result['role_id'] == 2 && $result['is_verified'] == 1 && $user_title == 'Support') {

                    $head_staff = $this->User_model->check_head_staff($result['id']);
                    $result['is_head'] = $head_staff['is_head'];
                    $result['dept_id'] = $head_staff['dept_id'];
                    $dept_name = (array) $this->User_model->getFieldById($head_staff['dept_id'], 'name', TBL_DEPARTMENTS);

                    $result['dept_name'] = $dept_name['name'];
                    $this->session->set_userdata('logged_in', true);
                    $this->session->set_userdata('role_id', $result['role_id']);
                    $userdata = $this->session->set_userdata('staffed_logged_in', $result);
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    redirect('staff');
                } elseif ($result['role_id'] == 3 && $user_title == 'Support') {
                    $this->session->set_userdata('logged_in', true);
                    $userdata = $this->session->set_userdata('admin_logged_in', $result);
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    $this->session->set_userdata('role_id', $result['role_id']);
//                    $seg = $this->uri->segment(1);
//                    echo $seg;exit;
//                    if ($seg == 'admin')
//                        redirect('admin/tickets');
//                    else
                    redirect('admin');
                } elseif ($result['role_id'] == 4 && $user_title == 'Support') {
                    $result['subadmin_id'] = $result['id'];
                    $this->session->set_userdata('logged_in', true);
                    $userdata = $this->session->set_userdata('admin_logged_in', $result);
                    $settings = $this->User_model->viewAll('settings', "");
                    $this->session->set_userdata('settings', $settings);
                    $this->session->set_userdata('role_id', $result['role_id']);
                    $this->load->model('Subadmin_Model');
                    $permissions = $this->Subadmin_Model->get_subadmin_modules($result['id']);
                    if ($permissions['module_ids'] != '') {
                        $this->session->set_userdata('module_ids', $permissions['module_ids']);
                    }
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
        $data['news_announcements'] = $this->User_model->getlatestnews();
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
            echo $this->input->post('usertype'); die;
            $start_date = $end_date = '';
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

                $daterange = $this->input->post('daterange');
                $dates = explode('-', $daterange);
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));


//                $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
//                $end_date = date('Y-m-d', strtotime($this->input->post('end_date')));
            } else {
                $contract = '';
            }
            $role_id = 1;
            if($this->input->post('usertype')!=''){
                $role_id = $this->input->post('usertype');
            }

            $password = $this->encrypt->encode($this->input->post('password'));
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $useremail,
                'role_id' => $role_id,
                'contactno' => $this->input->post('contactno'),
                'password' => $password,
                'address' => $this->input->post('address'),
                'is_verified' => 0,
                'status' => 0,
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
                'contract' => $contract
            );
            $username = $this->input->post('fname') . ' ' . $this->input->post('lname');

            $this->Admin_model->manage_record($this->table, $data);
            $lastUserId = $this->Admin_model->getLastInsertId(TBL_USERS);
            if ($contract != '') {
                $contract_array = array(
                    'contract' => $contract,
                    'user_id' => $lastUserId,
                    'current' => 1,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
                $this->User_model->insert_contract($contract_array);
            }
            /* To send mail to the user */
            $email_template = get_template_details(1);
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $this->email->to($useremail);
            $lastUserId1 = base64_encode($lastUserId);
            $unique_code = md5($useremail);
            $url = base_url() . '/home/tenantverify?key=' . $unique_code . '&u=' . $lastUserId1;

            $message = $email_template['email_description'];
            eval("\$message = \"$message\";");
            $data_array = array(
                'firstname' => $this->input->post('fname'),
                'lastname' => $this->input->post('lname'),
                'email' => $useremail,
                'url' => $url
            );
            $msg = $this->load->view('Admin/emails/send_mail_new', $data_array, TRUE);
            $this->email->subject($email_template['email_subject']);
            $this->email->message($msg);
            $this->email->send();
            // $this->email->print_debugger();
            $this->session->set_flashdata('success_msg', 'Registration success! please verify your email address.');
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
        $this->session->unset_userdata('logged_in');
        if ($this->uri->segment(1) == 'admin') {
            $this->session->unset_userdata('admin_logged_in');
            $this->session->unset_userdata('module_ids');
            redirect('support/login');
        } else if ($this->uri->segment(1) == 'staff') {
            $this->session->unset_userdata('staffed_logged_in');
            redirect('support/login');
        } else {
            $this->session->unset_userdata('user_logged_in');
            $force_redirect = $this->session->userdata('force_redirect');
            if(!empty($force_redirect)){
                $this->session->unset_userdata('force_redirect');
                redirect($force_redirect);
            }
            redirect('home');
        }
    }

    public function page_not_found() {
        $data['title'] = 'Page Not Found';
        $data['view'] = 'admin/404_notfound';
        $this->load->view('Admin/error/404_notfound', $data);
    }

}
