<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Ticket_model');
        $this->table = TBL_TICKETS;
    }

    public function index() {
        $segment = $this->uri->segment(1);
        $this->data['icon_class'] = 'icon-ticket';
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Tickets';
        $this->data['tickets'] = $this->Admin_model->get_tickets();
//        echo '<pre>';
//        print_r($this->data['tickets']);
//        exit;
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        if ($segment == 'admin')
            $this->template->load('admin', 'Admin/Tickets/index', $this->data);
        else
            $this->template->load('staff', 'Admin/Tickets/index', $this->data);
    }

    public function add() {

        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['tickets_types'] = $this->Admin_model->get_records(TBL_TICKET_TYPES);
        $this->data['tickets_priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->data['tickets_statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['tickets_categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);
        $user_id = $this->session->userdata('admin_logged_in')['id'];

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required');
        $this->form_validation->set_rules('priority_id', 'Ticket Priority', 'trim|required');
        $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['icon_class'] = 'icon-ticket';
            $this->data['title'] = $this->data['page_header'] = 'Tickets / Add ticket';
            $this->template->load('admin', 'Admin/Tickets/add', $this->data);
        } else {

            $data = array(
                'user_id' => $user_id,
                'title' => $this->input->post('title'),
                'dept_id' => $this->input->post('dept_id'),
                'ticket_type_id' => $this->input->post('ticket_type_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => $this->input->post('status_id'),
                'category_id' => $this->input->post('category_id'),
                'description' => $this->input->post('description'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
            );
//                    pr($data, 1);
            $this->Admin_model->manage_record($this->table, $data);
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');
            redirect('admin/tickets');
        }
    }

    public function edit($id = NULL) {
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
            $this->data['tickets_types'] = $this->Admin_model->get_records(TBL_TICKET_TYPES);
            $this->data['tickets_priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
            $this->data['tickets_statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
            $this->data['tickets_categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);

            $user_id = $this->session->userdata('admin_logged_in')['id'];

            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
            $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required');
            $this->form_validation->set_rules('priority_id', 'Ticket Priority', 'trim|required');
            $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->data['icon_class'] = 'icon-ticket';
                $this->data['title'] = $this->data['page_header'] = 'Tickets / Edit ticket';
                $this->template->load('admin', 'Admin/Tickets/add', $this->data);
            } else {

                $data = array(
                    'user_id' => $user_id,
                    'title' => $this->input->post('title'),
                    'dept_id' => $this->input->post('dept_id'),
                    'ticket_type_id' => $this->input->post('ticket_type_id'),
                    'priority_id' => $this->input->post('priority_id'),
                    'status_id' => $this->input->post('status_id'),
                    'category_id' => $this->input->post('category_id'),
                    'description' => $this->input->post('description'),
                    'is_delete' => 0,
                    'created' => date('Y-m-d H:i:s'),
                );
//                    pr($data, 1);
                $this->Admin_model->manage_record($this->table, $data, $record_id);
                $this->session->set_flashdata('success_msg', 'Ticket updated succesfully.');
                redirect('admin/tickets');
            }
        } else {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

    /**
     * To perform quick actions like dept,status,priority 
     */
    public function changeAction() {
        $form = $this->input->get_post('form');
        $form = explode('&', $form);
        $form['select_type'] = explode('=', $form[1]);
        $type = $form['select_type'][1];

        $form['hidden_id'] = explode('=', $form[2]);
        $id = $form['hidden_id'][1];
        $record_id = base64_decode($id);

        $form['dept_id'] = explode('=', $form[3]);
        $dept_id = $form['dept_id'][1];
        $form['status_id'] = explode('=', $form[4]);
        $status_id = $form['status_id'][1];
        $form['priority_id'] = explode('=', $form[5]);
        $priority_id = $form['priority_id'][1];

        if ($type == 'dept_id') {
            $select_data = $dept_id;
        } else if ($type == 'status_id') {
            $select_data = $status_id;
        } else if ($type == 'priority_id') {
            $select_data = $priority_id;
        }
        $rec = $this->Ticket_model->updateField('id', $record_id, $type, $select_data, $this->table);
        if ($rec) {
            $this->session->set_flashdata('success_msg', 'Data is updated succesfully..!!');
            $data = 'success';
        } else {
            $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
            $data = 'error';
        }
        echo json_encode($data);
        exit;
    }

    public function view($id) {
        if ($id != '') {
            $segment = $this->uri->segment(1);
//            echo $segment; exit;
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            $this->data['title'] = $this->data['page_header'] = 'Tickets / View ticket';
            $this->data['icon_class'] = 'icon-ticket';
            if ($segment == 'admin')
                $this->template->load('admin', 'Admin/Tickets/view', $this->data);
            else
                $this->template->load('staff', 'Staff/Tickets/view', $this->data);
//            $this->template->load('admin', 'Admin/Tickets/view', $this->data);
            /* check ticket is read or not */
            $check = $this->Ticket_model->isTicketRead($record_id);
            if ($check == 0) {
                /* if ticket is not read, change is_read = 1  */
                $data = array(
                    'is_read' => 1
                );
                $this->Admin_model->manage_record(TBL_TICKETS, $data, $record_id);
            }
        } else {
            
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

    public function reply($id) {
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            $this->data['ticket_coversation'] = $this->Ticket_model->get_ticket_conversation($record_id);
$this->data['icon_class'] = 'icon-ticket';
            $this->data['title'] = $this->data['page_header'] = 'Tickets / Replies';
            $this->template->load('admin', 'Admin/Tickets/reply', $this->data);
        } else {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }
    
     public function delete(){
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if($id!=''){
            $record_id = base64_decode($id);
            if($this->Admin_model->delete($table_name, $record_id)){
                $this->session->set_flashdata('success_msg', 'Record deleted successfully!');  
                $status = 1;
            }else{  
                $this->session->set_flashdata('error_msg', 'Unable to delete the record.');               
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
                'id'=>$id
                );
            echo json_encode($return_array);
        }
    }


}
