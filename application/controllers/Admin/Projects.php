<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Project_model');
        $this->load->helper('text');
        $this->table = TBL_PROJECTS;
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Projects';
        $this->data['icon_class'] = 'icon-design';

        $search_text = '';
        $this->data['search_text'] = $search_text;
        $get_data = $this->Project_model->get_data();
        if ($this->input->get()) {
            $search_text = $this->input->get('search_text');
            $get_data = $this->Project_model->search_article($search_text);
        }

        $this->data['projects'] = $get_data;
        $this->data['search_text'] = $search_text;
//        pr($get_data,1);
        $this->template->load('admin', 'Admin/Projects/index', $this->data);
    }

    public function add() {

        $this->data['title'] = $this->data['page_header'] = 'Add Projects';
        $this->data['page'] = 'Projects';
        $this->data['icon_class'] = 'icon-design';
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('short_desc', 'Description', 'trim|required');
//        $this->form_validation->set_rules('logo_image', 'Logo Image', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['logo_image']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['logo_image']['name']);
                $name = $exts[0] . time() . "." . end($exts);


                $config['upload_path'] = PROJECTS_IMAGES;
                $config['allowed_types'] = implode("|", $img_array);
//                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('logo_image')) {
                    $flag = 1;
                    $this->data['profile_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $project_pic = $file_info['file_name'];
//                    $src = './' . PROJECTS_IMAGES . '/' . $article_pic;
                }
            }
            if ($flag != 1) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'logo_image' => $project_pic,
                    'is_delete' => 0,
                    'created' => date('Y-m-d H:i:s')
                );

                if ($this->Project_model->add($data)) {
                    $this->session->set_flashdata('success_msg', 'Projects saved successfully.');
                    redirect('admin/projects');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to save detail.');
                    redirect('admin/projects/add');
                }
            }
        }
         $this->template->load('admin', 'Admin/Projects/add', $this->data);
    }

    public function edit($id = NULL) {
        if ($id != '') {
            $record_id = base64_decode($id);

            $image = $this->User_model->getFieldById($record_id, 'logo_image', $this->table);
            $project_pic = $image->logo_image;

            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('short_desc', 'Description', 'trim|required');
//            $this->form_validation->set_rules('logo_image', 'Logo Image', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->data['title'] = $this->data['page_header'] = 'Add Projects';
                $this->data['page'] = 'Projects';
                $this->data['icon_class'] = 'icon-design';
                $this->data['data'] = $this->Project_model->get_data_by_id($record_id);
                $this->template->load('admin', 'Admin/Projects/add', $this->data);
            } else {

                if ($_FILES['logo_image']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['logo_image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "projects-" . date("mdYhHis") . "." . $exts[1];
                    $config['upload_path'] = PROJECTS_IMAGES;
                    $config['allowed_types'] = implode("|", $img_array);
//                $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('logo_image')) {
                        $data['profile_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $project_pic = $file_info['file_name'];
                    }
                }

                $data = array(
                    'title' => $this->input->post('title'),
                    'short_desc' => $this->input->post('short_desc'),
                    'logo_image' => $project_pic,
                    'is_delete' => 0,
                );

                if ($this->Project_model->edit($data, $record_id)) {
                    $this->session->set_flashdata('success_msg', 'Project updated successfully.');
                    redirect('admin/projects');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to update detail.');
                    redirect('admin/projects/edit');
                }
            }
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($this->table, $record_id)) {
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
