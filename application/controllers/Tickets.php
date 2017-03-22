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
        $this->load->library('push_notification');

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
        $data['tickets'] = $this->User_model->getUserTickets_tenant($userid, $filter, $config['per_page'], $page);
        $data['news_announcements'] = $this->User_model->getlatestnews();
        if(TEMPLATE_ID==1){
            $this->template->load('frontend/page', 'Frontend/Tickets/index', $data);
        }else if(TEMPLATE_ID==2){
            $this->template->load('propertyfinder/frontend/page', 'Propertyfinder/Frontend/Tickets/index', $data);
        }
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
            if(TEMPLATE_ID==1){
                $this->template->load('frontend/page', 'Frontend/Tickets/add', $data);
            }else if(TEMPLATE_ID==2){
                $this->template->load('propertyfinder/frontend/page', 'Propertyfinder/Frontend/Tickets/add', $data);
            }
        } else {
            $getDeptStaff = $this->Ticket_model->getDeptStaff($this->input->post('dept_id'));
            
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
                'staff_id'=>$getDeptStaff
            );
             
            if ($_FILES['ticket_image']['name'] != '') {
              
                $type_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['ticket_image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];
                $name = "ticket-" . date("mdYhHis") . "." . $exts[1];

                $config['upload_path'] = TICKET_IMAGE;
                $config['allowed_types'] = implode("|", $type_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('ticket_image')) {
                    $flag = 1;
                    $data['contract_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $image = $file_info['file_name'];

                    $src = './' . TICKET_IMAGE . '/' . $image;
                    $thumb_dest = './' . TICKET_THUMB_IMAGE . '/';
                    $medium_dest = './' . TICKET_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            $data_tickets['image'] = $name;
            }
           
//                    p($data, 1);
            $this->Admin_model->manage_record($this->table, $data_tickets);
           
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');

            /* --- Get department series name and update ticket for series number --- */
            $lastTicketId = $this->Admin_model->getLastInsertId(TBL_TICKETS);
            $dept_id = $data_tickets['dept_id'];
            $series_name = $this->Ticket_model->getSeriesName($dept_id);
            $series_no = $series_name . '-T' . $lastTicketId;
            $ticArray = array(
                'series_no' => $series_no
            );

            $upadte =  $this->Admin_model->manage_record($this->table, $ticArray,$lastTicketId);
            
            $ticket_data = (array) $this->Ticket_model->get_ticket($lastTicketId);
               
                $pushData = array("notification_type" => "data",
                        "data"=> array(
                                "ticketId"=> $ticket_data['id'],
                                  "title"=> $ticket_data['title'],
                                  "deptId"=> $ticket_data['dept_id'],
                                  "departmentName"=> $ticket_data['dept_name'],
                                  "tickettypeId"=> $ticket_data['ticket_type_id'],
                                  "tickettypeName"=> $ticket_data['type_name'],
                                  "priorityId"=> $ticket_data['priority_id'],
                                  "ticketPriority"=> $ticket_data['priority_name'],
                                  "statusId"=> $ticket_data['status_id'],
                                  "ticketStatus"=> $ticket_data['status_name'],
                                  "userId"=> $ticket_data['user_id'],
                                  "is_read"=> $ticket_data['is_read'],
                                  "descriptions"=> $ticket_data['description'],
                                  "is_delete"=> $ticket_data['is_delete'],
                                  "seriesNo"=> $ticket_data['series_no'],
                                  "ticketImages"=> $ticket_data['image']
                            )
                        );
              

                   


                    $tenant = $this->User_model->getUserById($ticket_data['user_id']);
                    
                    
                        
                        if(!is_null($tenant['device_token'])){
                        if($tenant['device_make']==0){
                            $response = $this->push_notification->sendPushiOS(array('deviceToken' => trim($tenant['device_token']), 'pushMessage' => 'New Ticket'),$pushData);
                        }else{
                            $response = $this->push_notification->sendPushToAndroid(trim($tenant['device_token']), $pushData, FALSE);
                        }
                          
                        }
//            echo $getDeptStaff;
            $getStaffEmail = $this->Ticket_model->getStaffEmail($getDeptStaff);
            /* To send mail to the user */
            $configs = mail_config();
            $email_template = get_template_details(2);
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $this->email->from($useremail, 'Support-Ticket-System');
            $admin = $this->User_model->getAdmin();
            $get_email = $admin['email'];
            $recipientArr = array($get_email, $getStaffEmail);

            $this->email->to($recipientArr);
//            $this->email->to($getStaffEmail);
            //--- set email template
            $firstname = $this->session->userdata('user_logged_in')['fname'];
            $lastname = $this->session->userdata('user_logged_in')['lname'];
//            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);
            $name = $firstname . " " . $lastname;
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $message = $email_template['email_description'];
            eval("\$message = \"$message\";");

            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body = $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $this->email->subject($email_template['email_subject']);
            $this->email->message($mail_body);
            $this->email->send();
            $subadmins = send_mails_to_subadmin('1');
             if(!empty($subadmins)){
                foreach ($subadmins as $subadmin) {
                    $this->email->from($email_template['sender_email'], $email_template['sender_name']);

                    $this->email->to($subadmin['email']);


                    //--- set email template
                    $firstname = $this->session->userdata('user_logged_in')['fname'];
                    $lastname = $this->session->userdata('user_logged_in')['lname'];
                    $name = $firstname.' '.$lastname;
        //            $msg = $this->load->view('admin/emails/send_mail', $data_array, TRUE);

                    $message = $email_template['email_description'];
                    eval("\$message = \"$message\";");
                    $mail_body = "<html>\n";
                    $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                    $mail_body = $message;
                    $mail_body .= "</body>\n";
                    $mail_body .= "</html>\n";

                    $this->email->subject($email_template['email_subject']);
                    $this->email->message($mail_body);
                    $this->email->send();
                }
            }


            redirect('tickets');
        }
    }

    public function view($id) {
        $data['news_announcements'] = $this->User_model->getlatestnews();
        $flag = 1;
        if ($id != '' && $id!='home') {
            $segment = $this->uri->segment(1);
            $record_id = base64_decode($id);
            $data['ticket'] = $this->Ticket_model->get_ticket($record_id);

            $data['user'] = $this->User_model->getUserById($data['ticket']->user_id);
            $data['news_announcements'] = $this->User_model->getlatestnews();
            $userid = $this->session->userdata('user_logged_in')['id'];
            $data['title'] = 'Tickets | Support-Ticket-System';
            $data['header_title'] = 'View Ticket';
            $data['user'] = $this->User_model->getUserByID($userid);
            if (!empty($data['ticket'])) {

                $data['ticketname'] = $data['ticket']->title;
                $data['ticket_coversation'] = $this->Ticket_model->get_ticket_conversation($record_id);
                if ($this->input->post()) {
                    $msg_data = array(
                        'ticket_id' => $record_id,
                        'message' => $this->input->post('enter-message'),
                        'sent_from' => $userid
                    );
                    if ($this->Ticket_model->save_ticket_conversation($msg_data)) {
                        send_message_notification($record_id, 'tenant', $msg_data);
                        $this->session->set_flashdata('success_msg', 'Comment sent successfully.');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to send message.');
                    }
                    redirect('tickets/view/' . $id);
                }
                if(TEMPLATE_ID==1){
                    $this->template->load('frontend/page', 'Frontend/Tickets/view', $data);
                }else if(TEMPLATE_ID==2){
                    $this->template->load('propertyfinder/frontend/page', 'Propertyfinder/Frontend/Tickets/view', $data);
                }

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
