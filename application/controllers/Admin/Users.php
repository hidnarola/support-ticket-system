<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->table = TBL_USERS;
    }

    public function index() {
        $segment = $this->uri->segment(3);
        if ($segment == 'tenants') {
            $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Tenants';
            $this->data['users'] = $this->User_model->get_users_records($this->table, 1);
        } else {
            $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Staffs';
            $this->data['users'] = $this->User_model->get_users_records($this->table, 2);
        }
        $this->template->load('admin', 'Admin/Users/index', $this->data);
    }

    public function add($user_type) {
        if ($user_type == 'tenant')
            $user['role_id'] = 1;
        else
            $user['role_id'] = 2;
        $this->load->helper('security');
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . TBL_USERS . '.email]', array('is_unique' => 'Email already exist!'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_check_email[' . $useremail . ']');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if ($user_type == 'tenant') {
                $this->data['title'] = $this->data['page_header'] = 'Tenants / Add Tenant';
                $this->template->load('admin', 'Admin/Users/add', $this->data);
            } else {
                $this->data['title'] = $this->data['page_header'] = 'Staffs / Add staff';
                $this->template->load('admin', 'Admin/Users/add', $this->data);
            }
        } else {
            $flag = 0;

            $isUserUnique = $this->User_model->isUnique('email', $useremail, $this->table);
            if (!$isUserUnique) {
                $flag = 0;

                if ($_FILES['profile_pic']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['profile_pic']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "profile-" . date("mdYhHis") . "." . $exts[1];

                    $config['upload_path'] = USER_PROFILE_IMAGE;
                    $config['allowed_types'] = implode("|", $img_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profile_pic')) {
                        $flag = 1;
                        $data['profile_ validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $profile_pic = $file_info['file_name'];

                        $src = './' . USER_PROFILE_IMAGE . '/' . $profile_pic;
                        $thumb_dest = './' . PROFILE_THUMB_IMAGE . '/';
                        $medium_dest = './' . PROFILE_MEDIUM_IMAGE . '/';
                        thumbnail_image($src, $thumb_dest);
                        medium_image_user($src, $medium_dest);
                    }
                } else {
                    $profile_pic = '';
                }

                if ($flag != 1) {
                    $data = array(
                        'fname' => $this->input->post('fname'),
                        'lname' => $this->input->post('lname'),
                        'email' => $useremail,
                        'role_id' => $user['role_id'],
                        'profile_pic' => $profile_pic,
                        'contactno' => $this->input->post('contactno'),
                        'address' => $this->input->post('address'),
                        'is_verified' => 1,
                        'is_delete' => 0,
                        'created' => date('Y-m-d H:i:s'),
                    );
//                    pr($data, 1);
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

                    if ($user_type == 'tenant') {
                        $this->session->set_flashdata('success_msg', 'Tenant added succesfully.');
                        redirect('admin/users/tenants');
                    } else {
                        $this->session->set_flashdata('success_msg', 'Staff added succesfully.');
                        redirect('admin/users/staffs');
                    }
                } else {
                    redirect('admin/users/add');
                }
            } else {
                if ($user_type == 'tenant') {
//                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
                    redirect('admin/users/add/tenant');
                } else {
//                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
                    redirect('admin/users/add/staff');
                }
            }
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

    public function edit($user_type, $id = NULL) {
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['user'] = $this->User_model->view($record_id, $this->table);
            $image = $this->Admin_model->getFieldById($record_id, 'profile_pic', $this->table);
            $profile_pic = $image->profile_pic;
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
//            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . TBL_USERS . '.email]', array('is_unique' => 'Email already exist!'));
            $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                if ($user_type == 'tenant') {
                    $this->data['title'] = $this->data['page_header'] = 'Tenants / Edit ';
                    $this->template->load('admin', 'Admin/Users/add', $this->data);
                } else {
                    $this->data['title'] = $this->data['page_header'] = 'Staffs / Edit ';
                    $this->template->load('admin', 'Admin/Users/add', $this->data);
                }
            } else {

                $flag = 0;
                $useremail = $this->input->post('email');
                $isUserUnique = $this->User_model->isUnique('email', $useremail, $this->table, $record_id, 'AND id!= $id AND is_delete = 0');
                if (!$isUserUnique) {
                    $flag = 0;
                    if ($_FILES['profile_pic']['name'] != '') {
                        $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                        $exts = explode(".", $_FILES['profile_pic']['name']);
                        $name = $exts[0] . time() . "." . $exts[1];
                        $name = "profile-" . date("mdYhHis") . "." . $exts[1];

                        $config['upload_path'] = USER_PROFILE_IMAGE;
                        $config['allowed_types'] = implode("|", $img_array);
                        $config['max_size'] = '2048';
                        $config['file_name'] = $name;

                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('profile_pic')) {
                            $flag = 1;
                            $data['profile_ validation'] = $this->upload->display_errors();
                        } else {
                            $file_info = $this->upload->data();
                            $profile_pic = $file_info['file_name'];
                            unlink('./' . USER_PROFILE_IMAGE . '/' . $image->profile_image);
                            $src = './' . USER_PROFILE_IMAGE . '/' . $profile_pic;
                            $thumb_dest = './' . PROFILE_THUMB_IMAGE . '/';
                            $medium_dest = './' . PROFILE_MEDIUM_IMAGE . '/';
                            thumbnail_image($src, $thumb_dest);
                            medium_image_user($src, $medium_dest);
                        }
                    }

                    if ($flag != 1) {
                        $data = array(
                            'fname' => $this->input->post('fname'),
                            'lname' => $this->input->post('lname'),
                            'email' => $useremail,
                            'profile_pic' => $profile_pic,
                            'contactno' => $this->input->post('contactno'),
                            'address' => $this->input->post('address'),
                        );
//                        pr($data, 1);
                        $this->Admin_model->manage_record($this->table, $data, $record_id);

                        if ($user_type == 'tenant') {
                            $this->session->set_flashdata('success_msg', 'Tenant updated succesfully..!!');
                            redirect('admin/users/tenants');
                        } else {
                            $this->session->set_flashdata('success_msg', 'Staff updated succesfully..!!');
                            redirect('admin/users/staffs');
                        }
                    } else {
                        redirect('admin/users/edit');
                    }
                } else {
                    if ($user_type == 'tenant') {
//                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
                        redirect('admin/users/edit/tenant');
                    } else {
//                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
                        redirect('admin/users/edit/staff');
                    }
                }
            }
        } else {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

    public function getPassword() {
        $id = $this->input->post('id');
        if ($id != '') {
            $id = base64_decode($id);
            $userPassword = $this->Admin_model->getFieldById($id,'password',TBL_USERS);
           if($userPassword->password != NULL){
               $decodePwd = $this->encrypt->decode($userPassword->password); 
              $data = $decodePwd;
           }else{
               $data = 'error';
           }
           echo json_encode($data);
        }
    }

}
