<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        check_permissions(7);
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('Article_model');
        $this->load->helper('text');
        $this->table = TBL_ARTICLES;
        $this->load->library('push_notification');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Articles';
        $this->data['icon_class'] = 'icon-magazine';
        
         $search_text = '';
        $this->data['search_text'] = $search_text;
        $get_data = $this->Article_model->get_data();
        if ($this->input->get()) {
            $search_text = $this->input->get('search_text');
            $get_data = $this->Article_model->search_article($search_text);
        }

        $this->data['articles'] = $get_data;
        $this->data['search_text'] = $search_text;
//        pr($get_data,1);
        $this->template->load('admin', 'Admin/Articles/index', $this->data);
    }

    public function add() {
        $this->data['title'] = $this->data['page_header'] = 'Add Articles';
        $this->data['page'] = 'Articles';
        $this->data['icon_class'] = 'icon-magazine';
        $this->data['tickets_categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
//        $this->form_validation->set_rules('is_visible', 'Visibility', 'trim|required');

        $is_visible = 1;
        if ($this->input->post('is_visible') == 'yes') {
            $is_visible = 0;
        }
        $expiry_date = '';
        if ($this->input->post('expiry_date')) {
            $date = $this->input->post('expiry_date');
            $expiry_date = date('Y-m-d', strtotime($date));
        }

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin', 'Admin/Articles/add', $this->data);
        } else {
            if ($_FILES['image']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['image']['name']);
                $name = $exts[0] . time() . "." . $exts[1];
                $name = "article-" . date("mdYhHis") . "." . $exts[1];

                $config['upload_path'] = ARTICLE_IMAGE;
                $config['allowed_types'] = implode("|", $img_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $flag = 1;
                    $data['profile_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $article_pic = $file_info['file_name'];

                    $src = './' . ARTICLE_IMAGE . '/' . $article_pic;
                    $thumb_dest = './' . ARTICLE_THUMB_IMAGE . '/';
                    $medium_dest = './' . ARTICLE_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            } else {
                $article_pic = '';
            }

//            $title = $this->input->post('title');
            $title = $this->Article_model->get_unique_title(trim($this->input->post('title')));
            $slug = slug($title);
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'description' => $this->input->post('description'),
                'category_id' => $this->input->post('category_id'),
                'is_visible' => $is_visible,
                'user_id' => $this->session->userdata('admin_logged_in')['id'],
                'image' => $article_pic,
                'expiry_date' => $expiry_date,
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s')
            );
            if ($this->Article_model->add($data)) {
                $id = $this->db->insert_id();
                $article_data = (array) $this->Article_model->viewArticle($id, TBL_ARTICLES);
               
                $pushDataIos = array("notification_type" => "data",
                    'notification_for'=>'article',
                        "Articledata"=> array(
                                "category_id"=> $article_data['category_id'],
                              "categoryName"=> $article_data['cat_name'],
                              "articlesarr"=>array(
                                       "articleImages"=> $article_data['image'] ,
                                      "articleId"=> $article_data['id'],
                                      "title"=> $article_data['title'],
                                      "slug"=> $article_data['slug'],
                                      "descriptions"=> $article_data['description'],
                                      "userId"=> $article_data['user_id'],
                                      "is_visible"=> $article_data['is_visible'],
                                      "expiry_date"=> $article_data['expiry_date'],
                                      "is_delete"=> $article_data['is_delete'],
                                      "created_date"=> $article_data['created'],
                                      "modified_date"=> $article_data['modified']
                                    )
                            )
                        );

                $pushDataAndroid = array("notification_type" => "data",
                    'notification_for'=>'article',
                        "data"=> array(
                                "category_id"=> $article_data['category_id'],
                              "categoryName"=> $article_data['cat_name'],
                              "articlesarr"=>array(
                                       "articleImages"=> $article_data['image'] ,
                                      "articleId"=> $article_data['id'],
                                      "title"=> $article_data['title'],
                                      "slug"=> $article_data['slug'],
                                      "descriptions"=> $article_data['description'],
                                      "userId"=> $article_data['user_id'],
                                      "is_visible"=> $article_data['is_visible'],
                                      "expiry_date"=> $article_data['expiry_date'],
                                      "is_delete"=> $article_data['is_delete'],
                                      "created_date"=> $article_data['created'],
                                      "modified_date"=> $article_data['modified']
                                    )
                            )
                        );
              

                    $tenants = $this->Admin_model->get_tenants();
                    
                    foreach ($tenants as $tenant) {
                        try {
                            if(!is_null($tenant['device_token']) && $tenant['device_token'] != 'Device token not available'){
                            if($tenant['device_make']==0){
                                $response = $this->push_notification->sendPushiOS(array('deviceToken' => trim($tenant['device_token']), 'pushMessage' => 'articles notification'),$pushDataIos);
                            }else{
                                $response = $this->push_notification->sendPushToAndroid(trim($tenant['device_token']), $pushDataAndroid, FALSE);
                            }
                              
                            }
                        }catch(Exception $e){}
                    }

               
                $this->session->set_flashdata('success_msg', 'Article saved successfully.');
                redirect('admin/articles');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to save detail.');
                redirect('admin/articles/add');
            }
        }
    }

    public function edit($id = NULL) {
        if ($id != '') {
            $record_id = base64_decode($id);

            $image = $this->User_model->getFieldById($record_id, 'image', $this->table);
            $article_pic = $image->image;
//        echo 'image:'.$article_pic;
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('category_id', 'Category', 'trim|required');

            $is_visible = 1;
            if ($this->input->post('is_visible') == 'yes') {
                $is_visible = 0;
            }
            $expiry_date = NULL;
            if ($this->input->post('add_expiry_date') == 'yes') {
                $date = $this->input->post('expiry_date');
                $expiry_date = date('Y-m-d', strtotime($date));
            }
            if ($this->form_validation->run() == FALSE) {
                $this->data['title'] = $this->data['page_header'] = 'Edit Articles';
                $this->data['page'] = 'Articles';
                $this->data['icon_class'] = 'icon-magazine';
                $this->data['tickets_categories'] = $this->Admin_model->get_records(TBL_CATEGORIES);
                $this->data['article'] = $this->Article_model->viewArticle($record_id, $this->table);
//                pr($this->data['article']);
                $this->template->load('admin', 'Admin/Articles/add', $this->data);
            } else {

                if ($_FILES['image']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "article-" . date("mdYhHis") . "." . $exts[1];
                    $config['upload_path'] = ARTICLE_IMAGE;
                    $config['allowed_types'] = implode("|", $img_array);
//                $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $data['profile_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $article_pic = $file_info['file_name'];
//                        unlink('./' . ARTICLE_IMAGE . '/' . $image->image);
                        $src = './' . ARTICLE_IMAGE . '/' . $article_pic;
                        $thumb_dest = './' . ARTICLE_THUMB_IMAGE . '/';
                        $medium_dest = './' . ARTICLE_MEDIUM_IMAGE . '/';
                        thumbnail_image($src, $thumb_dest);
                        medium_image_user($src, $medium_dest);
                    }
                }

                $title = $this->Article_model->get_unique_title(trim($this->input->post('title')));
                $slug = slug($title);
                $data = array(
                    'title' => $title,
                    'slug' => $slug,
                    'description' => $this->input->post('description'),
                    'category_id' => $this->input->post('category_id'),
                    'is_visible' => $is_visible,
                    'user_id' => $this->session->userdata('admin_logged_in')['id'],
                    'image' => $article_pic,
                    'expiry_date' => $expiry_date,
                    'is_delete' => 0,
                );
//            pr($data, 1);
                if ($this->Article_model->edit($data, $record_id)) {
//               $this->Admin_model->manage_record($this->table, $data, $id);

                    $this->session->set_flashdata('success_msg', 'Article updated successfully.');
                    redirect('admin/articles');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to update detail.');
                    redirect('admin/articles/edit');
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

    public function view($id = NULL) {
        $this->data['icon_class'] = 'icon-magazine';
        $this->data['page'] = 'Articles';
        $record_id = base64_decode($id);
        $this->data['title'] = $this->data['page_header'] = 'Article';
        $this->data['data'] = $this->Article_model->get_data_by_id($record_id);
        $this->template->load('admin', 'Admin/Articles/view', $this->data);
    }

}
