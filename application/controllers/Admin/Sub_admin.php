<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('Subadmin_model');
        $this->load->model('User_model');
        $this->data['icon_class'] = 'icon-user-tie';
    }

    public function index() {
        $this->data['title'] = 'Sub Admins';
        $subadmins = $this->Subadmin_model->get_subadmins();
        $email_notifications = $this->Subadmin_model->get_all_email_notifications();
        // $subadmin_email_notifications = $this->Subadmin_model->get_subadmin_email_notifications();
        //pr($email_notifications,1);
        $this->data['subadmins'] = $subadmins;
        $this->data['email_notifications'] = $email_notifications;
        // $this->data['subadmin_email_notifications'] = $subadmin_email_notifications;
        $this->template->load('admin', 'Admin/Sub_admin/index', $this->data);
    }

    public function manage($uid=null){
        $id = ($uid!==null) ? base64_decode($uid) : null;

        $this->data['title'] = ($id==null) ? 'Add Sub Admin' : 'Edit Sub Admin';
        $modules = $this->Subadmin_model->get_modules();
        // pr($modules,1);
        $subadmin_detail = array();
        $assigned_modules = array();
        if($id!=null){
            $subadmin_detail = $this->Subadmin_model->get_subadmin_detail($id);
            $subadmin_modules = $this->Subadmin_model->get_subadmin_modules($id);
            $assigned_modules = explode(",", $subadmin_modules['module_ids']);
            //pr($subadmin_modules,1);
        }
        $email = $this->input->post('email');
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == TRUE) {
                $personal_data = array(
                    'fname'=>$this->input->post('fname'),
                    'lname'=>$this->input->post('lname'),
                    'email'=>$this->input->post('email'),
                    );
                $modules = implode(",", $this->input->post('modules'));
                $module_data = array(
                        'module_ids'=>$modules
                    );
            if($id != null){
                $this->Subadmin_model->update_subadmin($id, $personal_data);
                $this->Subadmin_model->update_modules($id, $module_data);
            }else{
                $personal_data['created']=date('Y-m-d H:i:s');
                $personal_data['role_id']=4;
                $this->Subadmin_model->add_subadmin($personal_data);
                $last_id = $this->db->insert_id();
                $module_data['user_id'] = $last_id;
                $this->Subadmin_model->add_modules($module_data);

                $configs = mail_config();
                $this->load->library('email', $configs);
                $this->email->initialize($configs);
                $this->email->from('demo.narola@gmail.com', 'dev.supportticket.com');
                $this->email->to($email);

                $lastUserId1 = base64_encode($last_id);
                $unique_code = md5($email);
                $url = base_url() . 'home/verify?key=' . $unique_code . '&u=' . $lastUserId1;
                
                //--- set email template
                $data_array = array(
                    'firstname' => $this->input->post('fname'),
                    'lastname' => $this->input->post('lname'),
                    'email' => $email,
                    'url' => $url
                );
                $msg = $this->load->view('Admin/emails/send_mail_new', $data_array, TRUE);
                $this->email->subject('Your account is registred for dev.supportticket.com');
                $this->email->message($msg);
                $this->email->send();
            }
            $this->session->set_flashdata('success_msg', 'Details saved succesfully.');
            redirect('admin/sub_admin');
        }
        $this->data['modules'] = $modules;
        $this->data['subadmin_modules'] = $assigned_modules;
        $this->data['subadmin_detail'] = $subadmin_detail;
        $this->template->load('admin', 'Admin/Sub_admin/manage', $this->data);
    }

    public function delete($id){
        $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
        // $record_id = base64_decode($id);
        // if ($this->Admin_model->delete(TBL_USERS, $record_id)) {
        //     $this->session->set_flashdata('success_msg', 'Record deleted successfully!');
        // } else {
        //     $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
        // }
        redirect('admin/sub_admin');
    }

    public function get_subadmin_email_notifications(){
        $id = $this->input->post('subadmin_id');
        $result = $this->Subadmin_model->get_subadmin_email_notifications($id);
        $notifications = explode(',', $result['email_notifications']);
        echo json_encode($notifications);
        exit;
    }

    public function set_notifications(){
        $subadmin_id = $this->input->post('subadmin_id');
        $notifications = $this->input->post('email_notifications');
        $email_notifications = implode(',', $notifications);
        
        if($this->Subadmin_model->set_notifications($subadmin_id, $email_notifications)){
            $this->session->set_flashdata('msg', 'Saved successfully.');
        }else{
            $this->session->set_flashdata('msg', 'Something went wrong.');
        }
        redirect('admin/sub_admin');
    }
}