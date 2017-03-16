<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
        } else {
            $protocol = 'http://';
        }
        $CUrurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $this->session->set_userdata('force_redirect', $CUrurl);
        $this->load->model('Careers_model');
    }

    public function index() {
        if ($this->input->post()) {
            if (!empty($this->input->post())) {
                if (!empty($_FILES)) {
                    if ($_FILES['cv']['error'] == 0) {
                        $file_name_arr = explode('.', $_FILES['cv']['name']);
                        $upload_config['upload_path'] = 'uploads/career';
                        $upload_config['allowed_types'] = 'pdf|doc|docx';
                        $upload_config['overwrite'] = TRUE;
                        $file_name = date('Ymdhis') . '.' . $file_name_arr[(count($file_name_arr) - 1)];
                        $_FILES['cv']['name'] = $file_name;
                        $this->load->library('upload');
                        $this->upload->initialize($upload_config);
                        if ($this->upload->do_upload('cv')) {
                            $_POST['cv_file'] = $file_name;
                        }else{
                            $this->session->set_flashdata('fail', 'Something went wrong. Your data was not submitted. Please try again.');
                            redirect('career');
                        }
                    }
                } else {
                    $this->session->set_flashdata('fail', 'You did not upload file. Please select file.');
                    redirect('career');
                }

                $res = $this->Careers_model->add_careers($this->input->post());
                if($res <= 0){
                    $this->session->set_flashdata('fail', 'Something went wrong. Your data was not submitted. Please try again.');
                }else{
                    $this->session->set_flashdata('success', 'We have received your biodata.');
                }
                redirect('career');
            }
        }
    }

}
