<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->table = TBL_FAQ;
        check_isvalidated_user();
        $this->load->model('User_model');
        $this->load->model('News_model');

    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Announcements';
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);
        $data['title'] = 'Announcements | Support-Ticket-System';
        $data['header_title'] = 'Announcements';
        $data['news_announcements'] = $this->User_model->getlatestnews();
        $data['data'] = $this->News_model->get_news_announcements($type = 0);
        
        $data['num_rows'] = $this->News_model->get_news_announcements_num($type = 0);
        
//        pr($data['num_rows'],1);
        if(TEMPLATE_ID==1){
            $this->template->load('frontend/page', 'Frontend/News/index', $data);
        }else if(TEMPLATE_ID==2){
            $this->template->load('propertyfinder/frontend/page', 'PropertyFinder/Frontend/News/index', $data);
        }
        
    }

    public function view($slug) {
        $flag = 1;
        if ($slug != '') {
            $data['announcements'] = $this->News_model->get_data_by_slug($slug, $type = 0);

            if ($data['announcements'] != '') {
//                $data['other_articles'] = $this->Article_model->get_other_articles($data['article']['category_id'], $data['article']['id']);
//                pr($data['other_articles'],1);
                $data['title'] = 'Announcements | Support-Ticket-System';
                $data['header_title'] = 'Announcements';
                $userid = $this->session->userdata('user_logged_in')['id'];
                $data['user'] = $this->User_model->getUserByID($userid);
                $data['news_announcements'] = $this->User_model->getlatestnews();
//                pr($data['article'],1);exit;
                if(TEMPLATE_ID==1){
                    $this->template->load('frontend/page', 'Frontend/News/view', $data);
                }else if(TEMPLATE_ID==2){
                    $this->template->load('propertyfinder/frontend/page', 'PropertyFinder/Frontend/News/view', $data);
                }
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

}
