<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('News_model');
    }

    public function index(){
        $this->data['title'] = $this->data['page_header'] = 'News And Announcements';
        $this->data['icon_class'] = 'icon-newspaper';
        $search_text='';
        $this->data['search_text'] = $search_text;
        $get_data = $this->News_model->get_data();
        
        $this->data['data'] = $get_data;
        // pr($get_data,1);

        $this->template->load('admin', 'Admin/News/index', $this->data);
    }

    public function add(){
        $this->data['title'] = $this->data['page_header'] = 'Add News/Announcement';
        $this->data['icon_class'] = 'icon-newspaper';
        if($this->input->post()){
           $data = array(
            'title' => $this->input->post('title'),
            'description'=>$this->input->post('description'),
            'is_news'=>$this->input->post('is_news'),
            'user_id'=>$this->session->userdata('admin_logged_in')['id']
            );
           if($this->News_model->add($data)){
                $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
           }else{
                $this->session->set_flashdata('error_msg', 'Unable to save detail.');
           }
        }
        $this->template->load('admin', 'Admin/News/add', $this->data);
    }

    public function edit($id){
        $this->data['title'] = $this->data['page_header'] = 'Add News/Announcement';
        $this->data['icon_class'] = 'icon-newspaper';
        $this->data['data'] = $this->News_model->get_data_by_id($id);
        $this->template->load('admin', 'Admin/News/add', $this->data);
    }
}