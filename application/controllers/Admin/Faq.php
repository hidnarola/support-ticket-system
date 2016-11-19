<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->table = TBL_FAQ;
        $this->perpageSuffix = "";
        $this->filterSuffix = "";

        if ($this->input->get('perpage'))
            $this->perpageSuffix = "?perpage=" . $this->input->get('perpage');

        if ($this->input->get('keyword')) {
            $this->filterSuffix = "?keyword=" . $this->input->get('keyword');
            if ($this->input->get('perpage'))
                $this->perpageSuffix = "&perpage=" . $this->input->get('perpage');
        }

        $this->suffix = $this->filterSuffix . $this->perpageSuffix;
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-question3';
        $query = '';
        $config = init_pagination();

        if ($this->input->get('perpage')) {
            $config['per_page'] = $this->input->get('perpage');
            $config['first_url'] = base_url() . "admin/faq/index" . $this->perpageSuffix;
        }
        if ($this->input->get('keyword'))
            $config['first_url'] = base_url() . "admin/faq/index" . $this->suffix;

        $config['suffix'] = $this->suffix;
        $config['base_url'] = base_url() . "admin/faq/index";
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $query = "select *,f.id as fid from " . $this->table . " f left join categories c on c.id= f.category_id Where f.is_delete =0";
        $keyword = '';
        if ($this->input->get('keyword')) {
            $keyword = $this->input->get('keyword');
            $keyword = str_replace("'", "''", $keyword);
            $query.= " AND (f.question like '%$keyword%'";
            $query.=" OR ";
            $query.= "f.answer like '%$keyword%')";
        }

        $config['total_rows'] = count($this->Admin_model->getFaq($query));
        $this->pagination->initialize($config);
        $num_pages = (int) ceil($this->pagination->total_rows / $this->pagination->per_page);
        $v = $num_pages + $this->pagination->per_page;
        if ($v == $page) {
            $config['next_tag_open'] = '<li class="disabled">';
        } else {
            $config['next_tag_open'] = '<li>';
        }
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['faq'] = $this->Admin_model->getFaq($query . ' Limit ' . $page . ', ' . $config['per_page']);
//        pr($this->data['faq'],1);
        $this->data['keyword'] = $keyword;
        $this->template->load('admin', 'Admin/Faq/index', $this->data);
    }

    public function add() {

        $this->form_validation->set_rules('question', 'Question', 'trim|required');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['title'] = $this->data['page_header'] = 'FAQ';
            $this->data['page'] = 'Add FAQ';
            $this->data['icon_class'] = 'icon-question3';
            $this->data['categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);
            $this->template->load('admin', 'Admin/Faq/add', $this->data);
        } else {
            $data = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer'),
                'category_id' => $this->input->post('category_id'),
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
                $this->data['page'] = 'Edit FAQ';
                $this->data['icon_class'] = 'icon-question3';
                $this->data['categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);
                $this->template->load('admin', 'Admin/Faq/add', $this->data);
            } else {
                $data = array(
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('answer'),
                    'category_id' => $this->input->post('category_id'),
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
