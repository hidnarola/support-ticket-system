<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beacons extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Beacon_model');
        $this->load->model('Admin_model');
        $this->data['icon_class'] = 'icon-station';
        $this->table = TBL_BEACONS;
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Beacons';
        $this->data['beacons'] = $this->Beacon_model->get_beacons();
        $this->template->load('admin', 'Admin/Beacons/index', $this->data);
    }

    public function add() {
        $this->form_validation->set_rules('uuid', 'UUID', 'trim|required');
        $this->form_validation->set_rules('beacon_name', 'Beacon Name', 'trim|required');
        $this->form_validation->set_rules('major', 'Major', 'trim|required');
        $this->form_validation->set_rules('minor', 'Minor', 'trim|required');
        $this->form_validation->set_rules('entry_text', 'Entry Text', 'trim|required');

        $this->form_validation->set_rules('is_close_approach', 'Is close approach', 'trim|required');
        $this->form_validation->set_rules('entry_content', 'Entry Content', 'trim|required');
        $this->form_validation->set_rules('range', 'Range', 'trim|required');
        $is_close_approach = $this->input->post('is_close_approach');
        if ($is_close_approach == 1) {
            $this->form_validation->set_rules('exit_text', 'Exit Text', 'trim|required');
            $this->form_validation->set_rules('exit_content', 'Exit Content', 'trim|required');
            $exit_text = $this->input->post('exit_text');
             $exit_content = $this->input->post('exit_content');
//                    $range = NULL;
        } else {
            $exit_text = NULL;
//                    $range = 1;
        }

        $this->data['title'] = $this->data['page_header'] = 'Add Beacons';

        if ($this->form_validation->run() == FALSE) {

            $this->template->load('admin', 'Admin/Beacons/add', $this->data);
        } else {
            $uuid = $this->input->post('uuid');
            $major = $this->input->post('major');
            $minor = $this->input->post('minor');

            $checkExists = $this->Beacon_model->checkExists($uuid, $major, $minor);
            if ($checkExists) {
                $data = array(
                    'beacon_name' => $this->input->post('beacon_name'),
                    'uuid' => $uuid,
                    'major' => $major,
                    'minor' => $minor,
                    'entry_text' => $this->input->post('entry_text'),
                    'exit_text' => $exit_text,
                    'is_close_approach' => $this->input->post('is_close_approach'),
                    'range' => $this->input->post('range'),
                    'entry_content' => $this->input->post('entry_content'),
                    'exit_content' => $exit_content,
                    'is_delete' => 0,
                    'created' => date('Y-m-d H:i:s')
                );
                $this->Admin_model->manage_record($this->table, $data);
                $this->session->set_flashdata('success_msg', 'Beacon added succesfully.');
                redirect('admin/beacons');
            } else {
                $this->session->set_flashdata('error_msg', 'Oops!, UUID, Major and Miror is alredy Exist. Please try something else!');
                redirect('admin/beacons/add');
//                   $this->template->load('admin', 'Admin/Beacons/add', $this->data);
            }
        }
    }

    public function edit($id = NULL) {
        $flag = 1;
        if ($id != '') {
            $record_id = base64_decode($id);
            $this->data['beacon'] = $this->Beacon_model->get_beacon($record_id);
            if (!empty($this->data['beacon'])) {
                $this->form_validation->set_rules('uuid', 'UUID', 'trim|required');
                $this->form_validation->set_rules('beacon_name', 'Beacon Name', 'trim|required');
                $this->form_validation->set_rules('major', 'Major', 'trim|required');
                $this->form_validation->set_rules('minor', 'Minor', 'trim|required');
                $this->form_validation->set_rules('entry_text', 'Entry Text', 'trim|required');
                $this->form_validation->set_rules('range', 'Range', 'trim|required');
//                $this->form_validation->set_rules('exit_text', 'Exit Text', 'trim|required');
                $this->form_validation->set_rules('is_close_approach', 'Is close approach', 'trim|required');
                $this->form_validation->set_rules('entry_content', 'Entry Content', 'trim|required');
//                $this->form_validation->set_rules('exit_content', 'Exit Content', 'trim|required');
                $is_close_approach = $this->input->post('is_close_approach');
                if ($is_close_approach == 1) {
                    $this->form_validation->set_rules('exit_text', 'Exit Text', 'trim|required');
                    $this->form_validation->set_rules('exit_content', 'Exit Content', 'trim|required');
                    $exit_text = $this->input->post('exit_text');
                    $exit_content = $this->input->post('exit_content');
//                    $range = NULL;
                } else {
                    $exit_text = NULL;
//                    $range = 1;
                }
                $this->data['title'] = $this->data['page_header'] = 'Beacons';
                if ($this->form_validation->run() == FALSE) {
                    $this->data['title'] = $this->data['page_header'] = 'Edit Beacon';
                    $this->template->load('admin', 'Admin/Beacons/add', $this->data);
                } else {
                    $uuid = $this->input->post('uuid');
                    $major = $this->input->post('major');
                    $minor = $this->input->post('minor');
                    $checkExists = $this->Beacon_model->checkExistsEdit($uuid, $major, $minor, $record_id);
                    if ($checkExists) {
                        $data = array(
                            'beacon_name' => $this->input->post('beacon_name'),
                            'uuid' => $uuid,
                            'major' => $major,
                            'minor' => $minor,
                            'entry_text' => $this->input->post('entry_text'),
                            'exit_text' => $exit_text,
                            'is_close_approach' => $this->input->post('is_close_approach'),
                            'range' => $this->input->post('range'),
                            'entry_content' => $this->input->post('entry_content'),
                            'exit_content' => $exit_content,
                            'is_delete' => 0,
                            'created' => date('Y-m-d H:i:s')
                        );
                        $this->Admin_model->manage_record($this->table, $data, $record_id);
                        $this->session->set_flashdata('success_msg', 'Beacon updated succesfully.');
                        redirect('admin/beacons');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Oops!, UUID, Major and Miror is alredy Exist. Please try something else!');
//                        redirect('admin/beacons/add');
                        $this->template->load('admin', 'Admin/Beacons/add', $this->data);
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
