<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->table = TBL_FAQ;
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-question3';
        $faqs = $this->Admin_model->get_records(TBL_FAQ);
        $search_text = '';
        if($this->input->post()){
            $search_text = $this->input->post('search_text');
            $faqs = $this->Admin_model->search_faq($search_text);
        }
        
        $this->data['faq'] = $faqs;
        $this->data['search_text'] = $search_text;
        $this->template->load('admin', 'Admin/Faq/index', $this->data);
    }

    public function add() {

        $this->form_validation->set_rules('question', 'Question', 'trim|required');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['title'] = $this->data['page_header'] = 'FAQ';
            $this->data['icon_class'] = 'icon-question3';
            $this->template->load('admin', 'Admin/Faq/add', $this->data);
        } else {
            $data = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer'),
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s')
            );
            $this->Admin_model->manage_record($this->table, $data);
            $this->session->set_flashdata('success_msg', 'Faq added succesfully.');
            redirect('admin/faq');
        }
    }

    public function edit($id = NULL) {
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['faq'] = $this->Admin_model->get_records(TBL_FAQ, $record_id);
            $this->form_validation->set_rules('question', 'Question', 'trim|required');
            $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->data['title'] = $this->data['page_header'] = 'FAQ';
                $this->data['icon_class'] = 'icon-question3';
                $this->template->load('admin', 'Admin/Faq/add', $this->data);
            } else {
                $data = array(
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('answer'),
                );
                $this->Admin_model->manage_record($this->table, $data, $record_id);
                $this->session->set_flashdata('success_msg', 'Faq added succesfully.');
                redirect('admin/faq');
            }
        } else {
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

   

}
