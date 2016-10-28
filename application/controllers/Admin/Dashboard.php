<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->popular_limit = 5;
        $this->type_table = array(
            'roles' => 'roles',
            'categories' => 'categories',
            'departments' => 'departments',
            'ticket_priorities' => 'ticket_priorities',
            'ticket_statuses' => 'ticket_statuses',
            'ticket_types' => 'ticket_types',
        );
        $this->load->model('Admin_model');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Dashboard';
        $this->data['icon_class'] = 'icon-home4';
        $this->data['total_departments'] = $this->Admin_model->get_total(TBL_DEPARTMENTS);
        $this->data['total_tenants'] = $this->Admin_model->get_total_users(1);
        $this->data['total_staffs'] = $this->Admin_model->get_total_users(2);
        $this->data['total_tickets'] = $this->Admin_model->get_total(TBL_TICKETS);
        $this->data['tickets'] = $this->Admin_model->get_tickets();
//        $this->data['tickets'] = $this->Admin_model->get_tickets($this->table, 1);
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('admin', 'Admin/Dashboard/index', $this->data);
    }

    public function manage($type) {
        $type = strtolower($type);

        if ($type != '' && array_key_exists($type, $this->type_table)) {
            $table_name = $this->type_table[$type];
            $title = ucwords(str_replace('_', ' ', $table_name));
            if($title == 'Categories'){
                $this->data['icon_class'] = 'icon-grid2';
            }else if($title == 'Departments'){
                $this->data['icon_class'] = 'icon-grid2';
            }else if($title == 'Roles'){
                $this->data['icon_class'] = 'icon-vcard';
            }else if($title == 'Ticket Priorities'){
                $this->data['icon_class'] = 'icon-list-numbered';
            }else if($title == 'Ticket Statuses'){
                $this->data['icon_class'] = 'icon-stats-bars2';
            }else if($title == 'Ticket Types'){
                $this->data['icon_class'] = 'icon-grid-alt';
            }
            $this->data['title'] = $this->data['page_header'] = $this->data['record_type'] = $title;
            $this->data['records'] = $this->Admin_model->get_records($table_name);
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Enter Name.'));

            if ($this->form_validation->run() == TRUE) {

                $name = $this->input->post('name');
                $record_id = $this->input->post('record_id');
                $record_array = array(
                    'name' => $name,
                    'created' => date('Y-m-d H:i:s')
                );
                if ($record_id != '') {
                    $record_exist_condition = array(
                        'id' => $record_id
                    );
                    if ($this->Admin_model->record_exist($table_name, $record_exist_condition)) {
                        if ($this->Admin_model->manage_record($table_name, $record_array, $record_id)) {
                            $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                            redirect('admin/manage/' . $type);
                        } else {
                            $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                            redirect('admin/manage/' . $type);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'No such record found. Please try again..!!');
                        redirect('admin/manage/' . $type);
                    }
                } else {
                    if ($this->Admin_model->manage_record($table_name, $record_array)) {
                        $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                        redirect('admin/manage/' . $type);
                    } else {
                        $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                        redirect('admin/manage/' . $type);
                    }
                }
            }
            $this->template->load('admin', 'Admin/Dashboard/manage_record', $this->data);
        } else {
            redirect('admin');
        }
    }

    public function get_detail() {
        $type = strtolower($this->input->post('type'));
        $id = $this->input->post('id');
        if ($type != '' && array_key_exists($type, $this->type_table) && $id != '') {
            $table_name = $this->type_table[$type];
            $record_id = base64_decode($id);
            $record = $this->Admin_model->get_records($table_name, $record_id);
            if (count($record) > 0) {
                $return_array = array(
                    'status' => 1,
                    'record' => $record
                );
            } else {
                $return_array = array(
                    'status' => 0
                );
            }
        } else {        
            $return_array = array(
                'status' => 0
            );
        }
        echo json_encode($return_array);
    }

    public function delete() {
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($table_name, $record_id)) {
                $msg = 'Record deleted successfully';
                $status = 1;
            } else {
                $msg = 'Unable to delete the record.';
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
                'msg' => $msg,
                'id' => $id
            );
            echo json_encode($return_array);
        }
    }

    public function profile() {
        $this->data['title'] = $this->data['page_header'] = 'My Profile';
        $this->data['icon_class'] = 'icon-user-plus';
        
        $id = $this->session->userdata('admin_logged_in')['id'];
        $profile = $this->Admin_model->get_profile($id);
        // pr($profile,1);
        $this->data['profile'] = $profile;
        $this->template->load('admin', 'Admin/Dashboard/profile', $this->data);
    }

    public function company(){
        $this->data['title'] = $this->data['page_header'] = 'Company Details';
        $company_details = $this->Admin_model->get_company_details();
        $keys = array_column($company_details, 'key');
        $values = array_column($company_details, 'value');
        $combined = array_combine($keys, $values);
        $this->data['company'] = $combined;
        $this->template->load('admin', 'Admin/Dashboard/company', $this->data);
        if($this->input->post()){
            $company_data = $this->input->post();
            if($this->Admin_model->save_company_details($company_data)){
                $this->session->set_flashdata('success_msg', 'Successfully Updated Company Details');
            }else{
                $this->session->set_flashdata('error_msg', 'Unable to update Company Details.');
            }
            redirect('admin/manage/company');
            //pr($company_data,1);
        }
    }
}
