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

    public function index($type = NULL) {
        $segment = $this->uri->segment(1);
        $this->data['icon_class'] = 'icon-ticket';
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = 'Tickets';

        $this->data['tickets'] = $this->Admin_model->get_tickets($type);
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
        $this->data['tenants'] = $this->Admin_model->get_tenants();
        $created_by = $this->session->userdata('admin_logged_in')['id'];

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required');
        $this->form_validation->set_rules('priority_id', 'Ticket Priority', 'trim|required');
        $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['icon_class'] = 'icon-ticket';
            $this->data['title'] = $this->data['page_header'] = 'Add ticket';
            $this->template->load('admin', 'Admin/Tickets/add', $this->data);
        } else {

            $data = array(
                'user_id' => $this->input->post('user_id'),
                'title' => $this->input->post('title'),
                'dept_id' => $this->input->post('dept_id'),
                'ticket_type_id' => $this->input->post('ticket_type_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => $this->input->post('status_id'),
                'description' => $this->input->post('description'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
                'created_by' => $created_by
            );
//                    pr($data, 1);
            $this->Admin_model->manage_record($this->table, $data);
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');
            redirect('admin/tickets');
        }
    }

    public function edit($id = NULL) {
        $flag = 1;
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            if (!empty($this->data['ticket'])) {
                $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
                $this->data['tickets_types'] = $this->Admin_model->get_records(TBL_TICKET_TYPES);
                $this->data['tickets_priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
                $this->data['tickets_statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
                $this->data['tenants'] = $this->Admin_model->get_tenants();
                $created_by = $this->session->userdata('admin_logged_in')['id'];

                $this->form_validation->set_rules('title', 'Title', 'trim|required');
                $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
                $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required');
                $this->form_validation->set_rules('priority_id', 'Ticket Priority', 'trim|required');
                $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
                $this->form_validation->set_rules('description', 'Description', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $this->data['icon_class'] = 'icon-ticket';
                    $this->data['title'] = $this->data['page_header'] = 'Edit ticket';
                    $this->template->load('admin', 'Admin/Tickets/add', $this->data);
                } else {

                    $data = array(
                        'user_id' => $this->input->post('user_id'),
                        'title' => $this->input->post('title'),
                        'dept_id' => $this->input->post('dept_id'),
                        'ticket_type_id' => $this->input->post('ticket_type_id'),
                        'priority_id' => $this->input->post('priority_id'),
                        'status_id' => $this->input->post('status_id'),
                        'description' => $this->input->post('description'),
                        'is_delete' => 0,
                        'created' => date('Y-m-d H:i:s'),
                        'created_by' => $created_by
                    );
//                    pr($data, 1);
                    $this->Admin_model->manage_record($this->table, $data, $record_id);
                    $this->session->set_flashdata('success_msg', 'Ticket updated succesfully.');
                    redirect('admin/tickets');
                }
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
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

        $record_id = base64_decode(urldecode($id));


        $form['dept_id'] = explode('=', $form[3]);
        $dept_id = $form['dept_id'][1];
        $form['status_id'] = explode('=', $form[4]);
        $status_id = $form['status_id'][1];
        $form['priority_id'] = explode('=', $form[5]);
        $priority_id = $form['priority_id'][1];
        $form['staff_id'] = explode('=', $form[6]);
        $staff_id = $form['staff_id'][1];

        $update_data = array();
        if ($type == 'dept_id') {
            $update_data = array(
                'dept_id' => $dept_id,
                'staff_id' => NULL
            );
        } else if ($type == 'status_id') {
            $update_data = array(
                'status_id' => $status_id
            );
        } else if ($type == 'priority_id') {
            $update_data = array(
                'priority_id' => $priority_id
            );
        } else if ($type == 'staff_id') {
            $update_data = array(
                'staff_id' => $staff_id
            );
            $get_staff = $this->User_model->getFieldById($staff_id, 'email, fname, lname', TBL_USERS);
            $get_ticket = $this->User_model->getFieldById($record_id, 'title', TBL_TICKETS);
            $email = $get_staff->email;
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from('demo.narola@gmail.com', 'dev.supportticket.com');
            $this->email->to($email);

            //--- set email template

            $msg = 'Hello ' . $get_staff->fname . ' ' . $get_staff->lname;
            $msg .= '<p>You have been assigned a Ticket - <a href="' . base_url() . 'staff/tickets/view/' . urldecode($id) . '"><b>' . $get_ticket->title . '</b></a></p>';
            $msg .= '<p>Thank you</p>';
            $msg .= '<p>Support Ticket</p>';

            $this->email->subject('New Ticket Assigned');
            $this->email->message($msg);
            $this->email->send();
        }
        //pr($update_data);
        $rec = $this->Ticket_model->updateField('id', $record_id, $update_data, $this->table);

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

    public function view($id = null) {
        $flag = 1;
        if ($id != '') {
            $segment = $this->uri->segment(1);
//            echo $segment; exit;
            $record_id = base64_decode($id);
            $ticket = $this->Ticket_model->get_ticket($record_id);
            $this->data['ticket_coversation'] = $this->Ticket_model->get_ticket_conversation($record_id);
            $sent_from = $this->session->userdata('admin_logged_in')['id'];
            if ($segment == 'staff') {
                $sent_from = $this->session->userdata('staffed_logged_in')['id'];
            }
            if (!empty($ticket)) {

                $this->data['ticket'] = $ticket;

                $this->data['title'] = $this->data['page_header'] = 'Tickets / View ticket';
                $this->data['icon_class'] = 'icon-ticket';
                if ($segment == 'admin')
                    $this->template->load('admin', 'Admin/Tickets/view', $this->data);
                else
                    $this->template->load('staff', 'Staff/Tickets/view', $this->data);
                //            $this->template->load('admin', 'Admin/Tickets/view', $this->data);
                /* check ticket is read or not */
                $check = $this->Ticket_model->isTicketRead($record_id);
                $data = array();
                if ($segment == 'admin') {
                    if ($check == 0) {
                        /* if ticket is not read, change is_read = 1  */
                        $data = array(
                            'is_read' => 1
                        );
                    } else if ($check == 2) {
                        $data = array(
                            'is_read' => 3
                        );
                    }
                } else {
                    if ($check == 0) {
                        /* if ticket is not read, change is_read = 1  */
                        $data = array(
                            'is_read' => 2
                        );
                    } else if ($check == 1) {
                        $data = array(
                            'is_read' => 3
                        );
                    }
                }
                if (!empty($data)) {
                    $this->Admin_model->manage_record(TBL_TICKETS, $data, $record_id);
                }
                if ($this->input->post()) {
                    $msg_data = array(
                        'ticket_id' => $record_id,
                        'message' => $this->input->post('enter-message'),
                        'sent_from' => $sent_from
                    );
                    if ($this->Ticket_model->save_ticket_conversation($msg_data)) {
                        $this->session->set_flashdata('success_msg', 'Message send successfully.');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to send message.');
                    }
                    if ($segment == 'admin') {
                        redirect('admin/tickets/view/' . $id);
                    } else if ($segment == 'staff') {
                        redirect('staff/tickets/view/' . $id);
                    }
                }
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

    public function reply($id = NULL) {
        $flag = 1;
        $logged_in = $this->uri->segment(1);

        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
            $this->data['ticket_coversation'] = $this->Ticket_model->get_ticket_conversation($record_id);
            $this->data['icon_class'] = 'icon-ticket';
            $this->data['title'] = $this->data['page_header'] = 'Tickets / Replies';

            $sent_from = $this->session->userdata('admin_logged_in')['id'];
            if ($logged_in == 'staff') {
                $sent_from = $this->session->userdata('staffed_logged_in')['id'];
            }

            if ($this->input->post()) {
                $msg_data = array(
                    'ticket_id' => $record_id,
                    'message' => $this->input->post('enter-message'),
                    'sent_from' => $sent_from
                );
                if ($this->Ticket_model->save_ticket_conversation($msg_data)) {
                    $this->session->set_flashdata('success_msg', 'Message send successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to send message.');
                }
                if ($logged_in == 'admin') {
                    redirect('admin/tickets/reply/' . $id);
                } else if ($logged_in == 'staff') {
                    redirect('staff/tickets/reply/' . $id);
                }
            }
            if (!empty($this->data['ticket'])) {
                if ($logged_in == 'admin') {
                    $this->template->load('admin', 'Admin/Tickets/reply', $this->data);
                } else if ($logged_in == 'staff') {
                    $this->template->load('staff', 'Staff/Tickets/reply', $this->data);
                }
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('admin/error/404_notfound', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($table_name, $record_id)) {
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

    /*
      public function reply($id) {
      if ($id != '') {
      $record_id = base64_decode($id);
      $this->data['ticket'] = $this->Ticket_model->get_ticket($record_id);
      $this->data['ticket_coversation'] = $this->Staff_model->get_ticket_conversation($record_id);
      $this->data['title'] = $this->data['page_header'] = 'Tickets / Replies';

      if($this->input->post()){
      $msg_data = array(
      'ticket_id' => $record_id,
      'message' => $this->input->post('enter-message'),
      'sent_from' => $this->session->userdata('staffed_logged_in')['id']
      );
      if($this->Ticket_model->save_ticket_conversation($msg_data)){
      $this->session->set_flashdata('success_msg', 'Message send successfully.');
      }else{
      $this->session->set_flashdata('error_msg', 'Unable to send message.');
      }
      redirect('admin/tickets/reply/'.$id);
      }

      $this->template->load('staff', 'Staff/Tickets/reply', $this->data);
      } else {
      $data['view'] = 'admin/404_notfound';
      $this->load->view('admin/error/404_notfound', $data);
      }
      }

     */
}
