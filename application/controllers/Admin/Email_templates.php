<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_templates extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        
        $this->load->model('Admin_model');
        $this->load->model('Email_templates_model');
        $this->load->model('User_model');
        $this->data['icon_class'] = 'icon-user-plus';
        $this->load->library('push_notification');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Email Templates';
        $this->data['icon_class'] = 'icon-envelope2';
        $templates = $this->Email_templates_model->get_all_templates();
        $this->data['templates'] = $templates;
        $this->template->load('admin', 'Admin/Email_templates/index', $this->data);
    }

    public function add(){
        $this->data['title'] = $this->data['page_header'] = 'Add Email Template';
        $this->data['icon_class'] = 'icon-envelope2';
        $this->data['page'] = $this->data['heading'] = 'Add Email Template';
        $smtp_details = $this->Admin_model->get_smtp_details();
        $keys = array_column($smtp_details, 'key');
        $values = array_column($smtp_details, 'value');
        $smtp = array_combine($keys, $values);
        $this->data['smtp'] = $smtp;
        $this->form_validation->set_rules('template_name', 'Template Name', 'trim|required');
        $this->form_validation->set_rules('email_subject', 'Email Subject', 'trim|required');
        $this->form_validation->set_rules('sender_name', 'Sender Name', 'trim|required');
        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required');
        $this->form_validation->set_rules('email_description', 'Email Description', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

            /*$desc = str_replace("'.","{",$this->input->post('email_description'));
            $email_desc = str_replace(".'","}",$desc);*/
            $email_desc = $this->input->post('email_description');
            $template = array(
                'template_name' => $this->input->post('template_name'),
                'email_subject' => $this->input->post('email_subject'),
                'sender_name' => $this->input->post('sender_name'),
                'sender_email' => $this->input->post('sender_email'),
                'email_description' => $email_desc,
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
            );

            $this->Email_templates_model->add_template($template);

            $this->session->set_flashdata('success_msg', 'Template added succesfully.');
            redirect('admin/email_templates');
        }
        $this->template->load('admin', 'Admin/Email_templates/add', $this->data);
    }

    public function edit($id){
        $this->data['title'] = $this->data['page_header'] = 'Edit Email Template';
        $this->data['icon_class'] = 'icon-envelope2';
        $this->data['page'] = $this->data['heading'] = 'Edit Email Template';
        $this->data['template'] = $this->Email_templates_model->get_template($id);
        $this->form_validation->set_rules('template_name', 'Template Name', 'trim|required');
        $this->form_validation->set_rules('email_subject', 'Email Subject', 'trim|required');
        $this->form_validation->set_rules('sender_name', 'Sender Name', 'trim|required');
        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required');
        $this->form_validation->set_rules('email_description', 'Email Description', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

            $email_desc = $this->input->post('email_description');
            $template = array(
                'template_name' => $this->input->post('template_name'),
                'email_subject' => $this->input->post('email_subject'),
                'sender_name' => $this->input->post('sender_name'),
                'sender_email' => $this->input->post('sender_email'),
                'email_description' => $email_desc,
            );

            $this->Email_templates_model->update_template($id, $template);

            $this->session->set_flashdata('success_msg', 'Template updated succesfully.');
            redirect('admin/email_templates');
        }
        $this->template->load('admin', 'Admin/Email_templates/add', $this->data);
    }
}