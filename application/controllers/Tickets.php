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
        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('filter')) {
            $this->filterSuffix = "?filter=" . $this->input->get('filter');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }

        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
    }

    public function index($type = NULL) {
        $data['title'] = 'Tickets | Support-Ticket-System';
        $data['header_title'] = 'My Tickets';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $config = init_pagination_tenant();
//        pr($config);
        $filter = '';
        if ($this->input->get('filter')) {
            $filter = $this->input->get('filter');
        }

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "tickets/index" . $this->perpageSuffix;
        }
        if ($this->input->get('filter'))
            $config['first_url'] = base_url() . "tickets/index" . $this->suffix;
        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "tickets/index";
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['total_rows'] = count($this->User_model->getUserTickets_tenant($userid, $filter));
        $this->pagination->initialize($config);
        $num_pages = (int) ceil($this->pagination->total_rows / $this->pagination->per_page);
        $v = $num_pages + $this->pagination->per_page;

        if ($v == $page) {
            $config['next_tag_open'] = '<li class="disabled">';
        } else {
            $config['next_tag_open'] = '<li>';
        }
        $data["links"] = $this->pagination->create_links();
//        pr($config,1);
        $data['tickets'] = $this->User_model->getUserTickets_tenant($userid, $filter, $config['per_page'], $page);

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
        $useremail = $this->session->userdata('user_logged_in')['email'];

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
                'status_id' => 3,
                'description' => $this->input->post('description'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
            );
//                    p($data, 1);
            $this->Admin_model->manage_record($this->table, $data_tickets);
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');
            
            /*--- Get department series name and update ticket for series number ---*/
            $lastTicketId = $this->Admin_model->getLastInsertId(TBL_TICKETS);
            $dept_id = $data_tickets['dept_id'];
            $series_name = $this->Ticket_model->getSeriesName($dept_id);
            $series_no = $series_name . '-T' . $lastTicketId;
            $ticArray = array(
                'series_no' => $series_no
            );
            $upadte =  $this->Admin_model->manage_record($this->table, $ticArray,$lastTicketId);
            $getDeptStaff = $this->Ticket_model->getDeptStaff($dept_id);
//            echo $getDeptStaff;
            $getStaffEmail = $this->Ticket_model->getStaffEmail($getDeptStaff);
                    /* To send mail to the user */
                    $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from($useremail,'Support-Ticket-System');
            $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
            $get_email = $get_email_admin->value;
            $this->email->to($get_email,$getStaffEmail);
//            $this->email->to($getStaffEmail);

            //--- set email template
            $firstname = $this->session->userdata('user_logged_in')['fname'];
            $lastname = $this->session->userdata('user_logged_in')['lname'];
//            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);
            
            $message = "Hello Admin,<br/><br/><div>The new ticket has been generated by the <strong>" . $firstname . " " . $lastname . "</strong>"
                    . "<br/><strong>Series Number</strong> : " . $series_no
                    . "<br/><strong>Ticke Title</strong> : " . $this->input->post('title')
                    . "<br/><strong>Description </strong>: " . $this->input->post('description')
                    . "</div><br/>Thanks";

            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body = $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $this->email->subject('The new ticket has been generated for dev.supportticket.com');
            $this->email->message($mail_body);
            $this->email->send();
            $this->email->print_debugger();


            redirect('tickets');
        }
    }

    public function view($id) {
        $data['news_announcements'] = $this->User_model->getlatestnews();
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
                        $this->session->set_flashdata('success_msg', 'Message sent successfully.');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to send message.');
                    }

                    redirect('tickets/view/' . $id);
                }

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
