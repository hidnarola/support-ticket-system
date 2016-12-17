<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->table = TBL_USERS;
    }

    public function index() {
        $segment = $this->uri->segment(2);
        if ($segment == 'tenants') {
            check_permissions(1);
            $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Tenants';
            $this->data['icon_class'] = 'icon-users';
            $this->data['users'] = $this->User_model->get_users_records($this->table, 1);
        } else {
            check_permissions(2);
            $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
            $this->data['icon_class'] = 'icon-people';
            $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Staffs';
            if ($this->input->get() && $this->input->get('department') != 'all') {
                $users = $this->User_model->get_dept_users($this->table, $this->input->get('department'));
            } else {
                $users = $this->User_model->get_users_records($this->table, 2);
            }
            $this->data['users'] = $users;
        }
//            pr($this->data['users'],1);
        $this->template->load('admin', 'Admin/Users/index', $this->data);
    }

    public function add($user_type) {
        if ($user_type == 'tenant')
            $role_id = 1;
        else
            $role_id = 2;
//        $this->load->helper('security');
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
//        if ($user_type == 'staff') {
//            $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
//        }
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . TBL_USERS . '.email]', array('is_unique' => 'Email already exist!'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email[' . $useremail . ']');
        $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);

        if ($this->form_validation->run() == TRUE) {
            $isUserUnique = $this->User_model->isUnique('email', $useremail, $this->table);
//            if (!$isUserUnique) {
            $flag = 0;

            if ($_FILES['profile_pic']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['profile_pic']['name']);
                $name = $exts[0] . time() . "." . end($exts);
//                    $name = "profile-" . date("mdYhHis") . "." . $exts[1];

                $config['upload_path'] = USER_PROFILE_IMAGE;
                $config['allowed_types'] = implode("|", $img_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('profile_pic')) {
                    $flag = 1;
                    $data['profile_validation'] = $this->upload->display_errors();
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
                    'role_id' => $role_id,
                    'profile_pic' => $profile_pic,
                    'contactno' => $this->input->post('contactno'),
                    'address' => $this->input->post('address'),
                    'status' => 0,
                    'is_verified' => 0,
                    'is_delete' => 0,
                    'created' => date('Y-m-d H:i:s'),
                );
                $username = $this->input->post('fname') . ' ' . $this->input->post('lname');
                $this->Admin_model->manage_record($this->table, $data);
                $lastUserId = $this->Admin_model->getLastInsertId(TBL_USERS);
                if ($role_id == 2) {
                    $conditions = array('is_head'=>1,
                        'dept_id'=>$this->input->post('dept_id'),
                        'is_delete'=>0
                        );
                    $if_first = $this->Admin_model->record_exist(TBL_STAFF, $conditions);

                    $staff_array = array(
                        'user_id' => $lastUserId,
                        'dept_id' => $this->input->post('dept_id')
                    );
                    if($if_first==0){
                        $staff_array['is_head'] =1;
                    }
                    $this->Admin_model->manage_record(TBL_STAFF, $staff_array);
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
                if ($role_id == 1) {
                    $url = base_url() . 'home/verifytanant?key=' . $unique_code . '&u=' . $lastUserId1;
                } else {
                    $url = base_url() . 'home/verifyStaff?key=' . $unique_code . '&u=' . $lastUserId1;
                }
                
                $message = $email_template['email_description'];
                eval("\$message = \"$message\";");
                //--- set email template
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

                // $this->email->print_debugger();
// pr($data, 1);
                if ($user_type == 'tenant') {
                    $this->session->set_flashdata('success_msg', 'Tenant added succesfully.');
                    redirect('admin/tenants');
                } else {
                    $this->session->set_flashdata('success_msg', 'Staff added succesfully.');
                    redirect('admin/staff');
                }
//                }
//                else {
//                    if ($user_type == 'tenant') {
//                        redirect('admin/users/add/tenant');
//                    }else {
//                        redirect('admin/users/add/staff');
//                    }
//                }
            }
//            else {
//                if ($user_type == 'tenant') {
////                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
//                    redirect('admin/users/add/tenant');
//                } else {
////                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
//                    redirect('admin/users/add/staff');
//                }
//            }
        }
        if ($user_type == 'tenant') {
            $data['title'] = $data['page_header'] = 'Add Tenant';
            $data['page'] = 'Tenants';
            $data['icon_class'] = 'icon-users';
        } else {
            $data['icon_class'] = 'icon-people';
            $data['page'] = 'Staff';
            $data['title'] = $data['page_header'] = 'Add Staff';
        }
        $this->template->load('admin', 'Admin/Users/add', $data);
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

    function check_email_edit($email, $id) {
        $return_value = $this->User_model->check_email_edit($email, $id);
//        pr($return_value,1);
        if ($return_value == 1) {
            $this->form_validation->set_message('check_email_edit', 'Sorry, This email is already Exists..!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit($user_type, $id = NULL) {
        $flag = 1;
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['user'] = $this->User_model->viewUser($record_id, $this->table);
//            echo '<pre>';
//            print_r($this->data['user']);exit;
            if (!empty($this->data['user'])) {
                $useremail = $this->input->post('email');
                $image = $this->User_model->getFieldById($record_id, 'profile_pic', $this->table);
                $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
                $profile_pic = $image->profile_pic;
//            exit;
                $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
                $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email_edit[' . $record_id . ']');
                $this->form_validation->set_rules('contactno', 'Contact Number', 'trim|required');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    if ($user_type == 'tenant') {
                        $this->data['icon_class'] = 'icon-users';
                        $this->data['title'] = $this->data['page_header'] = ' Edit Tenant';
                        $this->data['page'] = 'Tenants';
                        $this->template->load('admin', 'Admin/Users/add', $this->data);
                    } else {
                        $this->data['icon_class'] = 'icon-people';
                        $this->data['page'] = 'Staff';
                        $this->data['title'] = $this->data['page_header'] = 'Edit Staff';
                        $this->template->load('admin', 'Admin/Users/add', $this->data);
                    }
                } else {
                    $flag = 0;
                    $useremail = $this->input->post('email');
//                    $isUserUnique = $this->User_model->isUnique('email', $useremail, $this->table, $record_id, 'AND id!='. $id .'AND is_delete != 0');
//                    if ($isUserUnique) {

                    if ($_FILES['profile_pic']['name'] != '') {
                        $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                        $exts = explode(".", $_FILES['profile_pic']['name']);
//                        $name = $exts[0] . time() . "." . $exts[1];
//                        $name = "profile-" . date("mdYhHis") . "." . $exts[1];
                         $name = $exts[0] . time() . "." . end($exts);

                        $config['upload_path'] = USER_PROFILE_IMAGE;
                        $config['allowed_types'] = implode("|", $img_array);
                        $config['max_size'] = '2048';
                        $config['file_name'] = $name;

                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('profile_pic')) {
                            $flag = 1;
                            $data['profile_validation'] = $this->upload->display_errors();
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
                        if ($this->data['user']->role_id == 2) {
                            $staff_array = array(
                                'dept_id' => $this->input->post('dept_id')
                            );
                            $this->User_model->edit($staff_array, TBL_STAFF, 'user_id', $record_id);
                        }
                        if ($user_type == 'tenant') {
                            $this->session->set_flashdata('success_msg', 'Tenant updated succesfully..!!');
                            redirect('admin/tenants');
                        } else {
                            $this->session->set_flashdata('success_msg', 'Staff updated succesfully..!!');
                            redirect('admin/staff');
                        }
                    } else {
                        redirect('admin/users/edit');
                    }
//                    } else {
//                        if ($user_type == 'tenant') {
//                            $data['error_msg'] = 'EmailId already exist. Please try again.';
////                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
//                            redirect('admin/users/edit/tenant/'.$id);
//                        } else {
//                             $data['error_msg'] = 'EmailId already exist. Please try again.';
////                    $this->session->set_flashdata('error_msg', 'EmailId already exist. Please try again.');
//                            redirect('admin/users/edit/staff/'.$id);
//                        }
//                    }
                }
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('Admin/error/404_notfound', $data);
        }
    }

    public function getPassword() {
        $id = $this->input->post('id');
        if ($id != '') {
            $id = base64_decode($id);
            $userPassword = $this->Admin_model->getFieldById($id, 'password', TBL_USERS);
            if ($userPassword) {
                $decodePwd = $this->encrypt->decode($userPassword);
                $data = $decodePwd;
            } else {
                $data = 'error';
            }
            echo json_encode($data);
        }
    }

    public function changePasswordAdmin() {
//        $form = $this->input->get_post('form');
//
//        $form = explode('&', $form);
//
//        $form['password'] = explode('=', $form[0]);
//        $form['user_id'] = explode('=', $form[1]);
//        $id = $form['user_id'][1];
        $id = $this->input->post('id');
        $password = $this->input->post('pwd');
        $user_id = base64_decode($id);
        $encrypt_password = $this->encrypt->encode($password);

        $array = array(
            'password' => $encrypt_password,
        );
        $result = $this->User_model->edit($array, $this->table, 'id', $user_id);
        if ($result) {
            $data = 'success';
        } else {
            $data = 'error';
        }
        echo json_encode($data);
        exit;
    }

    public function delete() {
        $id = $this->input->post('id');

        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($this->table, $record_id)) {
                $this->session->set_flashdata('success_msg', 'Record deleted successfully!');
                $status = 1;
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
                'id' => $id
            );
            echo json_encode($return_array);
        }
    }

    public function changeUserStatus() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($id != null) {
            $record_id = base64_decode($id);
            $status = $this->User_model->getFieldById($record_id, 'status', $this->table);
            $this->User_model->updateField('id', $record_id, 'status', ($status->status == 0) ? 1 : 0, $this->table);
            if ($status->status == 0) {
                $this->session->set_flashdata('success_msg', 'User has been approved!');
                $data['status'] = 1;
            } else {
                $this->session->set_flashdata('success_msg', 'User has been Unapproved!');
                $data['status'] = 0;
            }
            echo json_encode($data);
            exit;
        }
    }

    public function assign_head() {
        $id = $this->input->post('id');
        $dept = $this->input->post('dept');
        $action = ($this->input->post('action') == 'assign') ? 1 : 0;
        if ($id != null) {
            $record_id = base64_decode($id);
            $this->User_model->updateField('dept_id', $dept, 'is_head', 0, TBL_STAFF);
            $this->User_model->updateField('user_id', $record_id, 'is_head', $action, TBL_STAFF);
            if ($action == 0) {
                $this->session->set_flashdata('success_msg', 'Unassigned successfully!');
                $data['status'] = 1;
            } else {
                $this->session->set_flashdata('success_msg', 'Assigned Successfully');
                $data['status'] = 0;
            }
            echo json_encode($data);
            exit;
        }
    }
    
    public function view_previous_contract() {
        $id = $this->input->post('id');
        if ($id != null) {
            $record_id = base64_decode($id);
             $data = $this->User_model->get_contracts($record_id);
//             pr($data,1);
            echo json_encode($data);
            exit;
        }
    }

}
