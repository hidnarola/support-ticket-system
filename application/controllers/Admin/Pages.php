<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('Pages_model');
    }

    public function index() {
    	$pages = $this->Pages_model->get_pages();
    	$data['pages'] = $pages;
    	$data['title'] = 'Manage Pages';
    	$this->template->load('admin', 'Admin/Pages/index', $data);
    }

    public function manage(){
    	 $id = $this->uri->segment(4);
        if($id != ''){
            $data['title'] = 'Edit page';
            $data['heading'] = 'Edit page';
            $result = $this->Pages_model->get_page($id);
            if(isset($result)){
                $data['page_data'] = $result[0];
            } else {
                show_404();
            }
        } else {
            $data['title'] = 'Add page';
            $data['heading'] = 'Add page';
        }
        $data['pages'] = $this->Pages_model->get_pages(TBL_PAGES);
        $this->form_validation->set_rules('navigation_name', 'navigation name', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('meta_title', 'SEO meta title', 'trim|required');
        $this->form_validation->set_rules('meta_keyword', 'SEO meta keyword', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'SEO meta description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="alert alert-error alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        } else {
            $update_array = $this->input->post(null);
            if(!empty($_FILES['banner_image']['name'])){
            	
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['banner_image']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "profile-" . date("mdYhHis") . "." . $exts[1];

                    $config['upload_path'] = USER_PROFILE_IMAGE;
                    $config['allowed_types'] = implode("|", $img_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('banner_image')) {
                        $flag = 1;
                        $data['profile_validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $banner_image = $file_info['file_name'];

                        $src = './' . USER_PROFILE_IMAGE . '/' . $banner_image;
                        $thumb_dest = './' . PROFILE_THUMB_IMAGE . '/';
                        $medium_dest = './' . PROFILE_MEDIUM_IMAGE . '/';
                        thumbnail_image($src, $thumb_dest);
                        medium_image_user($src, $medium_dest);
                    }
                } else {
                    $banner_image = '';
                
               
            }
                $update_array['banner_image'] = $banner_image;
            if(!isset($data['error'])){
                if($id != ''){
                    if($data['page_data']['banner_image'] != '' && isset($update_array['banner_image'])){
                        unlink(PAGE_BANNER.'/'.$data['page_data']['banner_image']);
                    }
                    // $update_array['url'] = slug_page($update_array['navigation_name'],TBL_PAGES,$id);
                    $update_array['url'] = base_url().'/admin/pages'.$id;
                    $update_array['modified'] = date('Y-m-d H:i:s');
                    $update_array['description'] = $_POST['description'];
                    $this->session->set_flashdata('success', 'Page successfully updated!');
                    $this->Pages_model->update_record(TBL_PAGES, 'id = '.$id,$update_array);
                    $this->Pages_model->update_record(TBL_PAGES, 'id = '.$update_array['parent_id'],array('footer_position' => 0));
                } else {
                    $update_array['url'] = base_url.'/admin/pages';
                    $update_array['description'] = $_POST['description'];
                    $this->session->set_flashdata('success', 'Page successfully added!');
                    $this->Pages_model->insert(TBL_PAGES, $update_array);
                    $this->Pages_model->update_record(TBL_PAGES, 'id = '.$update_array['parent_id'],array('footer_position' => 0));
                }
                redirect(site_url('admin/pages'));
            }
        }
        $this->template->load('admin','admin/pages/manage', $data);
    }
}