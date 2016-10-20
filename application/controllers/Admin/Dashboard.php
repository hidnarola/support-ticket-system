<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->data = get_admin_data();
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
        $this->data['total_users'] = $this->Admin_model->get_total_users(0);
        $this->data['total_companies'] = $this->Admin_model->get_total_users(1);
        $this->data['total_positions'] = $this->Position_model->get_total_positions();
        $this->data['total_resumes'] = $this->Resume_model->get_total_resume();
        $data['companies'] = $this->Company_model->filter_company(array(), 0, 0, $this->popular_limit, 1);
        $data['is_popular'] = 1;
        $this->data['company_list_html'] = $this->load->view('Admin/Users/company_list_block', $data, true);
        $positions['positions'] = $this->Position_model->filter_position(array(), 0, 0, $this->popular_limit, 1);
        $this->data['position_list_html'] = $this->load->view('Admin/Position/list_block', $positions, true);
        $this->template->load('admin', 'Admin/Home/index', $this->data);
    }

    public function manage($type) {
        $type = strtolower($type);
        
        if ($type != '' && array_key_exists($type, $this->type_table)) {
            $table_name = $this->type_table[$type];
            $title = ucwords(str_replace('_', ' ', $table_name));
            $this->data['title'] = $this->data['page_header'] = $this->data['record_type'] = $title;
            $this->data['records'] = $this->Admin_model->get_records($table_name);
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Enter english name.'));
            
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
    
    
    
    public function get_detail(){
        $type = strtolower($this->input->post('type'));
        $id = $this->input->post('id');
        if ($type != '' && array_key_exists($type, $this->type_table) && $id != '' ) {
            $table_name = $this->type_table[$type];
            $record_id = base64_decode($id);
            $record = $this->Admin_model->get_records($table_name, $record_id);
            if(count($record) > 0){
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

}
