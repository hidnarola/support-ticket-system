<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_if_support_login();
        check_permissions(3);
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Ticket_model');
        $this->table = TBL_TICKETS;
        $this->load->library('push_notification');
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
//        $this->form_validation->set_rules('status_id', 'Ticket Status', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['icon_class'] = 'icon-ticket';
            $this->data['title'] = $this->data['page_header'] = 'Add ticket';
            $this->template->load('admin', 'Admin/Tickets/add', $this->data);
        } else {
            $getDeptStaff = $this->Ticket_model->getDeptStaff($this->input->post('dept_id'));
            $data = array(
                'user_id' => $this->input->post('user_id'),
                'title' => $this->input->post('title'),
                'dept_id' => $this->input->post('dept_id'),
                'ticket_type_id' => $this->input->post('ticket_type_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => 3,
                'description' => $this->input->post('description'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
                'created_by' => $created_by,
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
                    // pr($data['contract_validation'],1);
                } else {
                    $file_info = $this->upload->data();
                    $image = $file_info['file_name'];

                    $src = './' . TICKET_IMAGE . '/' . $image;
                    $thumb_dest = './' . TICKET_THUMB_IMAGE . '/';
                    $medium_dest = './' . TICKET_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            $data['image'] = $name;
            }
                   // pr($data, 1);
            $this->Admin_model->manage_record($this->table, $data);
            $this->session->set_flashdata('success_msg', 'Ticket added succesfully.');
            /* --- Get department series name and update ticket for series number --- */
            $lastTicketId = $this->Admin_model->getLastInsertId(TBL_TICKETS);
            $dept_id = $data['dept_id'];
            $series_name = $this->Ticket_model->getSeriesName($dept_id);
            $series_no = $series_name . '-T' . $lastTicketId;
            $ticArray = array(
                'series_no' => $series_no
            );
            $upadte = $this->Admin_model->manage_record($this->table, $ticArray, $lastTicketId);

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
                            $response = $this->push_notification->sendPushToAndroid(trim($tenant['device_token']), $pushData, TRUE);
                        }
                          
                        }
                    







            $tenant_user = $this->User_model->getUserById($this->input->post('user_id'));
//            echo $getDeptStaff;
            $getStaffEmail = $this->Ticket_model->getStaffEmail($getDeptStaff);
//            echo $getStaffEmail;exit;

            /* To send mail to the user */
            $email_template = get_template_details(2);
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
            $get_email = $get_email_admin->value;
            $this->email->from($email_template['sender_email'], $email_template['sender_name']);

            $this->email->to($getStaffEmail);


            //--- set email template
            $firstname = $tenant_user['fname'];
            $lastname = $tenant_user['lname'];
            $name = $firstname.' '.$lastname;
//            $msg = $this->load->view('Admin/emails/send_mail', $data_array, TRUE);

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
                    $firstname = $tenant_user['fname'];
                    $lastname = $tenant_user['lname'];
                    $name = $firstname.' '.$lastname;
        //            $msg = $this->load->view('Admin/emails/send_mail', $data_array, TRUE);

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
            $data['image'] = $name;
            }
                   // pr($data, 1);
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
            $data['view'] = 'Admin/404_notfound';
            $this->load->view('Admin/error/404_notfound', $data);
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
            $getDeptStaff = $this->Ticket_model->getDeptStaff($dept_id);
            $update_data = array(
                'dept_id' => $dept_id,
                'staff_id'=>$getDeptStaff
            );
            // pr($update_data,1);
//            echo $dept_id;
            $get_ticket = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
            /*if ($dept_id != $get_ticket->dept_id) {
                $update_data['staff_id'] = NULL;
            }*/
            $get_ticket_title = $this->User_model->getFieldById($record_id, 'title', TBL_TICKETS);
            $depat_name = $this->User_model->getFieldById($dept_id, 'name', TBL_DEPARTMENTS);
            $dept_name = $depat_name->name;
                $ticket_title = $get_ticket_title->title;
                $email_template = get_template_details(3);
                
             $configs = mail_config();
                $this->load->library('email', $configs);
                $this->email->initialize($configs);
            if ($this->session->userdata('admin_logged_in')) {
                $get_ticket_detail = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
                $getDeptStaff = $this->Ticket_model->getDeptStaff($get_ticket_detail->dept_id);
                $getStaffEmail = $this->Ticket_model->getStaffEmail($getDeptStaff);
              
                $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                $this->email->to($getStaffEmail);
                
                $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
                $message =$email_template['email_description'];
                eval("\$message = \"$message\";");
                $mail_body = "<html>\n";
                $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                $mail_body .= $message;
                $mail_body .= "</body>\n";
                $mail_body .= "</html>\n";

                $this->email->subject($email_template['email_subject']);
                $this->email->message($message);
                $this->email->send();

                //exit;
            } elseif ($this->session->userdata('staffed_logged_in')) {
               
                $is_head = $this->session->userdata('staffed_logged_in')['is_head'];
                if ($is_head == 1) {
                    $admin = $this->User_model->getAdmin();
                    $getadminEmail = $admin['email'];
                     $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                    $this->email->to($getadminEmail);
                    //--- set email template
                    $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
                    $message = $email_template['email_description'];
                    eval("\$message = \"$message\";");
                    $mail_body = "<html>\n";
                    $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                    $mail_body .= $message;
                    $mail_body .= "</body>\n";
                    $mail_body .= "</html>\n";

                    $this->email->subject($email_template['email_subject']);
                    $this->email->message($message);
                    $this->email->send();
                     //exit;
                } else {
                    $admin = $this->User_model->getAdmin();
                    $adminemail = $admin['email'];
                    $get_ticket_detail = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
                    $getDeptStaff = $this->Ticket_model->getDeptStaff($get_ticket_detail->dept_id);
                    $staffhead_email = $this->Ticket_model->getStaffEmail($getDeptStaff);
                    $getStaffEmail = array($adminemail, $staffhead_email);

                    $getStaffEmail1 = array(
                        array(
                            'role_id' => 3,
                            'email' => $adminemail
                        ),
                        array(
                            'role_id' => 2,
                            'email' => $staffhead_email
                        ),
                    );
                    $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
                    $get_email = $get_email_admin->value;

//            $this->email->to($getStaffEmail);
                    foreach ($getStaffEmail1 as $key => $value) {
                         $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                        $this->email->to($value['email']);
                        if ($value['role_id'] == 3) {
                            $link = "<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
                        } elseif ($value['role_id'] == 2) {
                            $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
//                        echo $this->email->print_debugger();
                        }
                        $message = $email_template['email_description'];
                        eval("\$message = \"$message\";");
                        $mail_body = "<html>\n";
                        $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                        $mail_body .= $message;
                        $mail_body .= "</body>\n";
                        $mail_body .= "</html>\n";

                        $this->email->subject($email_template['email_subject']);
                        $this->email->message($mail_body);
                        $this->email->send();
                    }
                }
            }
            $get_ticket = $this->User_model->getFieldById($record_id, 'title', TBL_TICKETS);
            //--- send message to the head staff  
            $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
            $get_email = $get_email_admin->value;
             $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $ticket_title = $get_ticket->title;
            $this->email->to($getStaffEmail);
            $link = base_url() . "staff/tickets/view/" . urldecode($id);
            $message = $email_template['email_description'];
            eval("\$message = \"$message\";");
            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body .= $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $this->email->subject($email_template['email_subject']);
            $this->email->message($mail_body);
            $this->email->send();

            $subadmins = send_mails_to_subadmin('5');
             if(!empty($subadmins)){
                foreach ($subadmins as $subadmin) {
                    $this->email->from($email_template['sender_email'], $email_template['sender_name']);

                    $this->email->to($subadmin['email']);

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
            $email_template = get_template_details(9);
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
             $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $this->email->to($email);
            //--- set email template
            $url = base_url() . 'staff/tickets/view/' . urldecode($id);
            $ticket_title = $get_ticket->title;
            $name = $get_staff->fname . ' ' . $get_staff->lname;
            $msg = $email_template['email_description'];
            eval("\$msg = \"$msg\";");
            $this->email->subject($email_template['email_subject']);
            $this->email->message($msg);
            $this->email->send();

            if ($this->session->userdata('admin_logged_in')) {
                $email_template = get_template_details(5);
                $get_ticket_detail = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
                $getDeptStaff = $this->Ticket_model->getDeptStaff($get_ticket_detail->dept_id);
                $getStaffEmail = $this->Ticket_model->getStaffEmail($getDeptStaff);
                $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
                $get_email = $get_email_admin->value;
                 $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                $this->email->to($getStaffEmail);
                $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
                $name = $get_staff->fname . " " . $get_staff->lname;
                $message = $email_template['email_description'];
                eval("\$message = \"$message\";");
                $mail_body = "<html>\n";
                $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                $mail_body .= $message;
                $mail_body .= "</body>\n";
                $mail_body .= "</html>\n";

                $this->email->subject($email_template['email_subject']);
                $this->email->message($mail_body);
                $this->email->send();

                $subadmins = send_mails_to_subadmin('2');

             if(!empty($subadmins)){
                foreach ($subadmins as $subadmin) {
                    $this->email->from($email_template['sender_email'], $email_template['sender_name']);

                    $this->email->to($subadmin['email']);


                    //--- set email template
                    $name = $get_staff->fname . " " . $get_staff->lname;
        //            $msg = $this->load->view('Admin/emails/send_mail', $data_array, TRUE);

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

            } elseif ($this->session->userdata('staffed_logged_in')) {
                $is_head = $this->session->userdata('staffed_logged_in')['is_head'];
                $email_template = get_template_details(5);
                if ($is_head == 1) {
                    $admin = $this->User_model->getAdmin();
                    $getStaffEmail = $admin['email'];
                    $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
                    $get_email = $get_email_admin->value;
                    $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                    $this->email->to($getStaffEmail);
                    $link = "<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
                    $message = $email_template['email_description'];
                    eval("\$message = \"$message\";");
                    $mail_body = "<html>\n";
                    $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                    $mail_body .= $message;
                    $mail_body .= "</body>\n";
                    $mail_body .= "</html>\n";

                    $this->email->subject($email_template['email_subject']);
                    $this->email->message($mail_body);
                    $this->email->send();
                } else {
                    $admin = $this->User_model->getAdmin();
                    $adminemail = $admin['email'];
                    $get_ticket_detail = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
                    $getDeptStaff = $this->Ticket_model->getDeptStaff($get_ticket_detail->dept_id);
                    $staffhead_email = $this->Ticket_model->getStaffEmail($getDeptStaff);
                    $getStaffEmail = array($adminemail, $staffhead_email);

                    $getStaffEmail1 = array(
                        array(
                            'role_id' => 3,
                            'email' => $adminemail
                        ),
                        array(
                            'role_id' => 2,
                            'email' => $staffhead_email
                        ),
                    );
                    $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
                    $get_email = $get_email_admin->value;

//            $this->email->to($getStaffEmail);
                    $email_template = get_template_details(4);
                    foreach ($getStaffEmail1 as $key => $value) {
                         $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                        $this->email->to($value['email']);
                        if ($value['role_id'] == 3) {
                            $link = "<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
                        } elseif ($value['role_id'] == 2) {
                            $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
//                        echo $this->email->print_debugger();
                        }
                        $message = $email_template['email_description'];
                        eval("\$message = \"$message\";");
                        $mail_body = "<html>\n";
                        $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                        $mail_body .= $message;
                        $mail_body .= "</body>\n";
                        $mail_body .= "</html>\n";

                        $this->email->subject($email_template['email_subject']);
                        $this->email->message($mail_body);
                        $this->email->send();
                    }
                }
            }

            //--- send message to the head staff  
//            if ($this->session->userdata('admin_logged_in')) {
//                $message = "Hello,<br/><br/><div>The ticket has been assigned to the <strong>" . $get_staff->fname . " " . $get_staff->lname . "</strong>"
//                        . "<br>Ticket URL is: <a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>"
//                        . "</div><br/>Thank you"
//                        . "<p>Support Ticket</p>";
//            } else if ($this->session->userdata('staffed_logged_in')) {
//                $is_head = $this->session->userdata('staffed_logged_in')['is_head'];
//                if ($is_head == 1) {
//                    $message = "Hello,<br/><br/><div>The ticket has been assigned to the <strong>" . $get_staff->fname . " " . $get_staff->lname . "</strong>"
//                            . "<br>Ticket URL is: <a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>"
//                            . "</div><br/>Thank you"
//                            . "<p>Support Ticket</p>";
//                } else {
//                    $message = "Hello,<br/><br/><div>The ticket has been assigned to the <strong>" . $get_staff->fname . " " . $get_staff->lname . "</strong>"
//                            . "<br>Ticket URL is: ";
//                    $admin = $this->User_model->getAdmin();
//                    if ($admin['role_id'] == 3) {
//                        $message .="<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
//                    } else {
//                        $message .="<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
//                    }
//                    $message .= "</div><br/>Thank you"
//                            . "<p>Support Ticket</p>";
//                }
//            }
//            echo 'here';
//              exit;
            /* ---  Send email to the Tenant */
            $get_ticket_detail1 = $this->User_model->getFieldById($record_id, 'user_id', TBL_TICKETS);
            $user = $this->User_model->getFieldById($get_ticket_detail1->user_id, 'email', TBL_USERS);
            $tenantemail = $user->email;
            $email_template = get_template_details(4);
            $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $this->email->to($tenantemail);
            $ticket_title = $get_ticket->title;
            $link = base_url() . "tickets/view/" . urldecode($id) . "'><b>" . $ticket_title;
            $name = $get_staff->fname . " " . $get_staff->lname;
            $tenant_msg = $email_template['email_description'];
            eval("\$tenant_msg = \"$tenant_msg\";");
            $mail_body1 = "<html>\n";
            $mail_body1 .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body1 .= $tenant_msg;
            $mail_body1 .= "</body>\n";
            $mail_body1 .= "</html>\n";

            $this->email->subject('New Ticket Assigned');
            $this->email->message($mail_body1);
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
            $this->data['user'] = $this->User_model->getUserById($ticket->user_id);
//            pr($this->data['user'],1);

            $sent_from = $this->session->userdata('admin_logged_in')['id'];
            $msg_from = 'admin';
            if(isset($this->session->userdata('admin_logged_in')['subadmin_id'])){
                $sent_from = $this->session->userdata('admin_logged_in')['subadmin_id'];
                $msg_from = 'subadmin';
            }
            if ($segment == 'staff') {
                $msg_from = 'staff';
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
                        send_message_notification($record_id, $msg_from, $msg_data);
                        
                        
                        $this->session->set_flashdata('success_msg', 'Comment sent successfully.');
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
            $this->load->view('Admin/error/404_notfound', $data);
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
            $this->load->view('Admin/error/404_notfound', $data);
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
      $this->load->view('Admin/error/404_notfound', $data);
      }
      }

     */
}
