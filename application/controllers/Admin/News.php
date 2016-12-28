<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        check_permissions(11);
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('News_model');
        $this->load->helper('text');
        $this->table = TBL_NEWS_ANNOUNCEMENTS;
        $this->load->library('push_notification');
    }

    public function index($type = null) {
        
        $this->data['title'] = $this->data['page_header'] = 'News And Announcements';
        $this->data['icon_class'] = 'icon-newspaper';
        $search_text = '';
        $this->data['search_text'] = $search_text;
        $get_data = $this->News_model->get_data($type);
        $search_text = '';
        if ($this->input->get()) {
            $search_text = $this->input->get('search_text');
            $get_data = $this->News_model->search_news($search_text, $type);
        }
        $this->data['data'] = $get_data;
        $this->data['search_text'] = $search_text;
        // pr($get_data,1);

        $this->template->load('admin', 'Admin/News/index', $this->data);
    }

    public function add() {
        $this->data['title'] = $this->data['page_header'] = 'Add News/Announcement';
        $this->data['page'] = 'News/Announcement';
        $this->data['icon_class'] = 'icon-newspaper';
        $flag = 0;
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $is_news = $this->input->post('is_news');
            $type = 'news';
            $upload_path = NEWS_IMAGE;
            $upload_medium = NEWS_MEDIUM_IMAGE;
            $upload_thumb = NEWS_THUMB_IMAGE;
            if ($is_news == 0) {
                $type = 'announcement';
                $upload_path = ANNOUNCEMENT_IMAGE;
                $upload_medium = ANNOUNCEMENT_MEDIUM_IMAGE;
                $upload_thumb = ANNOUNCEMENT_THUMB_IMAGE;
            }
            if ($_FILES['userfile']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['userfile']['name']);
                $name = $exts[0] . time() . "." . end($exts);

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = implode("|", $img_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('userfile')) {
                    $flag = 1;
                    $this->data['profile_validation'] = $this->upload->display_errors();
                } else {

                    $file_info = $this->upload->data();
                    $image = $file_info['file_name'];

                    $src = './' . $upload_path . '/' . $image;
                    $thumb_dest = './' . $upload_thumb . '/';
                    $medium_dest = './' . $upload_medium . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            }
            if ($flag != 1) {
                $title = $this->News_model->get_unique_title(trim($this->input->post('title')));
                $slug = slug($title);
                $data = array(
                    'title' => $this->input->post('title'),
                    'slug' => $slug,
                    'description' => $this->input->post('description'),
                    'is_news' => $this->input->post('is_news'),
                    'user_id' => $this->session->userdata('admin_logged_in')['id'],
                    'image' => $image,
                    'created' => date('Y-m-d H:i:s')
                );
                if ($this->News_model->add($data)) {
                    $id = $this->db->insert_id();
                    $news_data = $this->News_model->get_data_by_id($id);
                   
                    $pushData = array("notification_type" => "data",
                        'notification_for'=>'news_announcement',
                        "Newsdata"=> array(
                        "newsannouncementsImages"=> $news_data['image'],
                          "newsannouncementsId"=> $news_data['id'],
                          "title"=> $news_data['title'],
                          "slug"=> $news_data['slug'],
                          "descriptions"=> $news_data['description'],
                          "userId"=> $news_data['user_id'],
                          "is_news"=> $news_data['is_news'],
                          "is_delete"=> 0,
                          "created_date"=> $news_data['created'],
                          "modified_date"=> $news_data['modified']
                        
                    ));

                    $tenants = $this->Admin_model->get_tenants();
                    
                    foreach ($tenants as $tenant) {
                        
                        if(!is_null($tenant['device_token']) && $tenant['device_token'] != 'Device token not available'){
                                if($tenant['device_make']==0){
                                    try {

                                            $response = $this->push_notification->sendPushiOS(array('deviceToken' => trim($tenant['device_token']), 'pushMessage' => 'news notification'),$pushData);
                                    }catch(Exception $e){}
                                    
                                }else{
                                    try {

                                            $response = $this->push_notification->sendPushToAndroid(trim($tenant['device_token']), $pushData, TRUE);
                                    }catch(Exception $e){}
                                }
                              
                            
                            

                          
                        }
                    }
                    
                   
                    $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                    redirect('admin/news');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to save detail.');
                    redirect('admin/news/add');
                }
            }
        }
        $this->template->load('admin', 'Admin/News/add', $this->data);
    }

    public function edit($id) {
        if ($id != '') {
            $record_id = base64_decode($id);
        }
        $this->data['title'] = $this->data['page_header'] = 'Edit News/Announcement';
        $this->data['page'] = 'News/Announcement';
        $this->data['icon_class'] = 'icon-newspaper';
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == TRUE) {

            $image = $this->User_model->getFieldById($record_id, 'image', $this->table);
            $news_pic = $image->image;
            $is_news = $this->input->post('is_news');
            $type = 'news';
            $upload_path = NEWS_IMAGE;
            $upload_medium = NEWS_MEDIUM_IMAGE;
            $upload_thumb = NEWS_THUMB_IMAGE;
            if ($is_news == 0) {
                $type = 'announcement';
                $upload_path = ANNOUNCEMENT_IMAGE;
                $upload_medium = ANNOUNCEMENT_MEDIUM_IMAGE;
                $upload_thumb = ANNOUNCEMENT_THUMB_IMAGE;
            }
            if ($_FILES['userfile']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['userfile']['name']);
//                $name = $exts[0] . time() . "." . $exts[1];
//                $name = $type . "-" . date("mdYhHis") . "." . $exts[1];
                $name = $exts[0] . time() . "." . end($exts);

                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = implode("|", $img_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('userfile')) {
                    $flag = 1;
                    $data['profile_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $news_pic = $file_info['file_name'];

                    $src = './' . $upload_path . '/' . $news_pic;
                    $thumb_dest = './' . $upload_thumb . '/';
                    $medium_dest = './' . $upload_medium . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            }
            $title = $this->News_model->get_unique_title(trim($this->input->post('title')));
            $slug = slug($title);
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'description' => $this->input->post('description'),
                'is_news' => $this->input->post('is_news'),
                'image' => $news_pic
            );
            if ($this->News_model->edit($data, $record_id)) {
                $this->session->set_flashdata('success_msg', 'Detail updated successfully.');
                redirect('admin/news');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to update detail.');
                redirect('admin/news/edit');
            }
        }
        $this->data['data'] = $this->News_model->get_data_by_id($record_id);
        $this->template->load('admin', 'Admin/News/add', $this->data);
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete(TBL_NEWS_ANNOUNCEMENTS, $record_id)) {
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

    public function view($type, $id) {
        $this->data['icon_class'] = 'icon-newspaper';
        $record_id = base64_decode($id);
        $this->data['page'] = ($type == 0) ? 'Announcement' : 'News';
        $this->data['title'] = $this->data['page_header'] = 'News/Announcement';
        $this->data['data'] = $this->News_model->get_data_by_id($record_id);
        $this->template->load('admin', 'Admin/News/view', $this->data);
    }

}
