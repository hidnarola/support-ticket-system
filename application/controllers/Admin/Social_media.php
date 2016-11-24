<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->popular_limit = 5;
        $this->type_table = array(
            'social_media' => 'social_media',
        );
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->data['icon_class'] = 'icon-user-plus';
    }


    public function manage($type) {
        $type='social_media';
        $type = strtolower($type);
       
        if ($type != '' && array_key_exists($type, $this->type_table)) {
            $table_name = $this->type_table[$type];
            $title = 'Social Media';
            $this->data['title'] = $this->data['page_header'] = $this->data['record_type'] = $title;
            $this->data['records'] = $this->Admin_model->get_records($table_name);
            //$this->form_validation->set_rules('image', 'Image', 'trim|required', array('required' => 'Provide Image.'));
            $this->form_validation->set_rules('url', 'Url', 'trim|required', array('required' => 'Provide Url.'));

            if ($this->form_validation->run() == TRUE) {
               
                $record_array = array();
                if ($_FILES['social_image']['name'] != '') {
              
                $type_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['social_image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];
                $name = "social-" . date("mdYhHis") . "." . $exts[1];

                $config['upload_path'] = SOCIAL_IMAGE;
                $config['allowed_types'] = implode("|", $type_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('social_image')) {
                    $flag = 1;
                    $data['contract_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $image = $file_info['file_name'];

                    
                }
                $record_array['image'] = $name;
            }

                $record_array['url'] = $this->input->post('url');

                $record_id = $this->input->post('record_id');

               $record_array['created'] =  date('Y-m-d H:i:s');
               
                
                // pr($record_array,1);
                if ($record_id != '') {
                    $record_exist_condition = array(
                        'id' => $record_id
                    );
                    if ($this->Admin_model->record_exist($table_name, $record_exist_condition)) {
                        if ($this->Admin_model->manage_record($table_name, $record_array, $record_id)) {
                            $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                            redirect('admin/social_media');
                        } else {
                            $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                            redirect('admin/social_media');
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'No such record found. Please try again..!!');
                        redirect('admin/social_media');
                    }
                } else {
                    if ($this->Admin_model->manage_record($table_name, $record_array)) {
                        $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                        redirect('admin/social_media');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to save detail. Please try again..!!');
                        redirect('admin/social_media');
                    }
                }
            }
            $this->template->load('admin', 'Admin/Social_media/manage', $this->data);
        } else {
            redirect('admin');
        }
    }



     public function get_detail() {

        $type = strtolower($this->input->post('type'));
        $id = $this->input->post('id');
        if ($type != '' && $id != '') {
            $table_name = TBL_SOCIAL_MEDIA;
            $record_id = base64_decode($id);
            $record = $this->Admin_model->get_records($table_name, $record_id);
            if (count($record) > 0) {
                $return_array = array(
                    'status' => 1,
                    'record' => $record
                );
            } else {
                $return_array = array(
                    'status' => 0
                );
            }
        } else {        
            $return_array = array(
                'status' => 0
            );
        }
        echo json_encode($return_array);
    }

    public function delete() {
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete(TBL_SOCIAL_MEDIA, $record_id)) {
                $msg = 'Record deleted successfully';
                $status = 1;
            } else {
                $msg = 'Unable to delete the record.';
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
                'msg' => $msg,
                'id' => $id
            );
            echo json_encode($return_array);
        }
    }
}