<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Admin_model');
        $this->load->model('Media_model');
    }

    public function home_slider() {
        $this->data['title'] = $this->data['page_header'] = 'Home Page Slider';
        $this->data['icon_class'] = 'icon-image3';
        $images = $this->Media_model->get_home_images();
        $this->data['images'] = $images;

        if($this->input->post()){

        }

        $this->template->load('admin', 'Admin/Media/home_slider', $this->data);
    }

    public function gallery() {
        $this->data['title'] = $this->data['page_header'] = 'FAQ';
        $this->data['icon_class'] = 'icon-images2';
        $this->template->load('admin', 'Admin/Media/gallery', $this->data);
    }

    public function file_upload($page){
        if ($_FILES['file_data']['name'] != '') {
                $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                $exts = explode(".", $_FILES['file_data']['name']);
                $name = $exts[0] . time() . "." . end($exts);
                $name = $page."-" . date("mdYhHis") . "." . $exts[1];

                $config['upload_path'] = HOME_IMAGE;
                $config['allowed_types'] = implode("|", $img_array);
                $config['max_size'] = '2048';
                $config['file_name'] = $name;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('file_data')) {
                    $flag = 1;
                    $data['image_validation'] = $this->upload->display_errors();
                } else {
                    $file_info = $this->upload->data();
                    $image = $file_info['file_name'];

                    $src = './' . HOME_IMAGE . '/' . $image;
                    $thumb_dest = './' . HOME_THUMB_IMAGE . '/';
                    $medium_dest = './' . HOME_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                }
            } else {
                $image = '';
            }
            $home_page = $gallery = 0;
            if($page=='home'){
                $home_page = 1;
            }else{
                $gallery = 1;
            }
            $image_data = array(
                'home_page' => $home_page,
                'gallery' => $gallery,
                'is_visible' => 1,
                'image' => $image
            );

            $this->Media_model->add_images($image_data);

        echo json_encode("success");
    }
}