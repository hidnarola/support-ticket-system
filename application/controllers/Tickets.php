<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated_user();
        $this->load->model('Admin_model');
        $this->load->model('Ticket_model');
        $this->load->model('User_model');
        $this->table = TBL_TICKETS;
    }

    public function index($type = NULL) {
        $data['title'] = 'Tickets | Support-Ticket-System';
        $data['header_title'] = 'My Tickets';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $data['tickets'] = $this->User_model->getUserTickets($userid, $type);
         $data['news_announcements'] = $this->User_model->getlatestnews();
//        p($data['tickets'],1);
        $this->template->load('frontend/page', 'Frontend/Tickets/index', $data);
    }

    public function test() {
        $this->load->view('Frontend/Tickets/test');
    }

    public function add() {

        $data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $data['tickets_types'] = $this->Admin_model->get_records(TBL_TICKET_TYPES);
        $data['tickets_priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $data['tickets_statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
         $data['news_announcements'] = $this->User_model->getlatestnews();

        $userid = $this->session->userdata('user_logged_in')['id'];

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('dept_id', 'Department', 'trim|required');
        $this->form_validation->set_rules('ticket_type_id', 'Ticket Type', 'trim|required');
        $this->form_validation->set_rules('priority_id', 'Ticket Priority', 'trim|required');
//        $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tickets | Support-Ticket-System';
            $data['header_title'] = 'Add Ticket';
            $data['user'] = $this->User_model->getUserByID($userid);
            $this->template->load('frontend/page', 'Frontend/Tickets/add', $data);
        } else {

            $data_tickets = array(
                'user_id' => $userid,
                'title' => $this->input->post('title'),
                'dept_id' => $this->input->post('dept_id'),
                'ticket_type_id' => $this->input->post('ticket_type_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => 5,
                'description' => $this->input->post('description'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
            );
//                    p($data, 1);
            $this->Admin_model->manage_record($this->table, $data_tickets);
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');
            redirect('tickets');
        }
    }

    public function view($id) {
        $flag = 1;
        if ($id != '') {
            $segment = $this->uri->segment(1);
//            echo $segment; exit;
            $record_id = base64_decode($id);
            $data['ticket'] = $this->Ticket_model->get_ticket($record_id);
             $data['news_announcements'] = $this->User_model->getlatestnews();
            $userid = $this->session->userdata('user_logged_in')['id'];
            $data['title'] = 'Tickets | Support-Ticket-System';
            $data['header_title'] = 'View Ticket';
            $data['user'] = $this->User_model->getUserByID($userid);
            if (!empty($data['ticket'])) {
                $this->template->load('frontend/page', 'Frontend/Tickets/view', $data);
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['header_title'] = 'Page Not Found';
            $this->template->load('frontend/page', 'Frontend/error/404notfound', $data);
        }
    }

    public function reply($id) {
        $flag = 1;
        if ($id != '') {
            $segment = $this->uri->segment(1);
//            echo $segment; exit;
            $record_id = base64_decode($id);
            $data['ticket'] = $this->Ticket_model->get_ticket($record_id);
             $data['news_announcements'] = $this->User_model->getlatestnews();
//            p($data['ticket'],1);
            $userid = $this->session->userdata('user_logged_in')['id'];
                $data['title'] = 'Tickets | Support-Ticket-System';
                $data['header_title'] = 'Send Message Ticket';
                $data['user'] = $this->User_model->getUserByID($userid);
            if (!empty($data['ticket'])) {
                
                $data['ticketname'] = $data['ticket']->title;
                $data['ticket_coversation'] = $this->Ticket_model->get_ticket_conversation($record_id);
//            p($data['ticket_coversation'],1);

                if ($this->input->post()) {
                    $msg_data = array(
                        'ticket_id' => $record_id,
                        'message' => $this->input->post('enter-message'),
                        'sent_from' => $userid
                    );
                    if ($this->Ticket_model->save_ticket_conversation($msg_data)) {
                        $this->session->set_flashdata('success_msg', 'Message send successfully.');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to send message.');
                    }

                    redirect('tickets/reply/' . $id);
                }

                $this->template->load('frontend/page', 'Frontend/Tickets/reply', $data);
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['header_title'] = 'Page Not Found';
            $this->template->load('frontend/page', 'Frontend/error/404notfound', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($this->table, $record_id)) {
                $this->session->set_flashdata('success_msg', 'Ticket is deleted successfully!');
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

}
