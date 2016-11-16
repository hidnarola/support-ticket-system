<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledgebase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated_user();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
    }

    public function index() {
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'Knowledge Base | Support-Ticket-System';
        $data['header_title'] = 'Knowledge Base';
        $data['data'] = $this->Article_model->get_articles();
//        pr($data['data'],1);
        $this->template->load('frontend/page', 'Frontend/Knowledgebase/index', $data);
    }

    public function view($slug) {
        $flag = 1;
        if ($slug != '') {
            $data['article'] = $this->Article_model->get_data_by_slug($slug);

            if ($data['article'] != '') {
                $data['other_articles'] = $this->Article_model->get_other_articles($data['article']['category_id'],$data['article']['id']);
//                pr($data['other_articles'],1);
                $data['title'] = 'Knowledge Base | Support-Ticket-System';
                $data['header_title'] = 'Knowledge Base';
                $userid = $this->session->userdata('user_logged_in')['id'];
                $data['user'] = $this->User_model->getUserByID($userid);
//                pr($data['article'],1);exit;
                $this->template->load('frontend/page', 'Frontend/Knowledgebase/view', $data);
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
    
    public function articles() {
        
        $keyword = $this->input->post('term');
        echo $keyword;exit;
        $data['response'] = 'false'; //Set default response
//        if (!empty($keyword) && isset($keyword)) {           
//            $query = $this->Article_model->getarticles($keyword);
//            if (!empty($query)) {
//                $data['response'] = 'true'; //Set response
//                $data['message'] = array(); //Create array
//                foreach ($query as $row) {
//                    $data['message'][] = array('value' => $row->title);
//                }
//                echo json_encode($data);exit;
//            }
//        }
    }

}
