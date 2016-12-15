<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Ticket_model');
        $this->load->model('Staff_model');
        $this->table = TBL_TICKETS;
    }

    public function staff_index(){
         $this->data['icon_class'] = 'icon-user';
        $this->data['title'] = $this->data['page_header'] = 'Tickets';
        $this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('staff', 'Staff/Tickets/index', $this->data);
    }

    public function get_staff(){
        $dept = $this->input->post('dept');
        $staff = $this->Admin_model->get_staff($dept);
        $html = '<option value="">Select Staff</option>';
        foreach ($staff as $row) {
            $html .= '<option value="'. $row['user_id'] .'">'. $row['fname'].' '. $row['lname'] .'</option>';
        }
        echo $html;
        exit;
    }
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
//            echo $dept_id;
            $get_ticket = $this->User_model->getFieldById($record_id, 'dept_id', TBL_TICKETS);
            if ($dept_id != $get_ticket->dept_id) {
                $update_data['staff_id'] = NULL;
            }
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
                exit;
            } elseif ($this->session->userdata('staffed_logged_in')) {

                $is_head = $this->session->userdata('staffed_logged_in')['is_head'];
                if ($is_head == 1) {
                    
                    $admin = $this->User_model->getAdmin();
                    $getadminEmail = $admin['email'];
                    $this->email->from($email_template['sender_email'], $email_template['sender_name']);
                    $this->email->to($getadminEmail);
                    //--- set email template
                    $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket_title->title . "</b></a>";
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
                     exit;
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
                            $link = "<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket_title->title . "</b></a>";
                        } elseif ($value['role_id'] == 2) {
                            $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket_title->title . "</b></a>";
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
            $ticket_title = $get_ticket->title;
            //--- send message to the head staff  
            $get_email_admin = $this->User_model->getValueByField('value', 'email-notification', 'key', TBL_SETTINGS);
            $get_email = $get_email_admin->value;
            $this->email->from($get_email, 'Support-Ticket-System');
            $link =  base_url() . "staff/tickets/view/" . urldecode($id);
            $this->email->to($getStaffEmail);
            $message = email_template['email_description'];
            eval("\$message = \"$message\";");
            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body .= $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $this->email->subject($email_template['email_subject']);
            $this->email->message($mail_body);
            $this->email->send();
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
            $ticket_title = $get_ticket->title;
            $email = $get_staff->email;
            $configs = mail_config();
            $this->load->library('email', $configs);
            $this->email->initialize($configs);
            $email_template = get_template_details(9);
            $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $this->email->to($email);
            //--- set email template
            $name = $get_staff->fname . ' ' . $get_staff->lname;
            $ticket_title = $get_ticket->title;
            $link = base_url() . 'staff/tickets/view/' . urldecode($id);
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
                $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $ticket_title . "</b></a>";
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
            } elseif ($this->session->userdata('staffed_logged_in')) {
                $is_head = $this->session->userdata('staffed_logged_in')['is_head'];
                if ($is_head == 1) {
                    $email_template = get_template_details(4);
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
                    $email_template = get_template_details(4);
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
                            $link = "<a href='" . base_url() . "admin/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
                        } elseif ($value['role_id'] == 2) {
                            $link = "<a href='" . base_url() . "staff/tickets/view/" . urldecode($id) . "'><b>" . $get_ticket->title . "</b></a>";
//                        echo $this->email->print_debugger();
                        }
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
            $email_template = get_template_details(10);
            $this->email->from($email_template['sender_email'], $email_template['sender_name']);
            $this->email->to($tenantemail);
            $tenant_msg = $email_template['email_description'];
            eval("\$tenant_msg = \"$tenant_msg\";");
            $mail_body1 = "<html>\n";
            $mail_body1 .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body1 .= $tenant_msg;
            $mail_body1 .= "</body>\n";
            $mail_body1 .= "</html>\n";

            $this->email->subject($email_template['email_subject']);
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
}