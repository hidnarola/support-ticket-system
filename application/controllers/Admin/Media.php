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
        check_permissions(12);
        $this->data['title'] = $this->data['page_header'] = 'Home Page Slider';
        $this->data['icon_class'] = 'icon-image3';
        $images = $this->Media_model->get_home_images();
        $this->data['images'] = $images;

        $this->template->load('admin', 'Admin/Media/home_slider', $this->data);
    }

    public function gallery() {
        $this->data['title'] = $this->data['page_header'] = 'Gallery';
        $this->data['icon_class'] = 'icon-images2';
        $images = $this->Media_model->get_gallery_images();
        $this->data['images'] = $images;
        $this->template->load('admin', 'Admin/Media/gallery', $this->data);
    }

    public function file_upload($page) {
        $image = '';
        $section_id = $this->input->post('section_id');
        if ($_FILES['file_data']['name'] != '') {
            $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
            $exts = explode(".", $_FILES['file_data']['name']);
//                $name = $exts[0] . time() . "." . end($exts);
//                $name = $page."-" . date("mdYhHis") . "." . $exts[1];
            $name = $exts[0] . time() . "." . end($exts);
            if ($page == 'home') {
                $config['upload_path'] = HOME_IMAGE;
            } elseif ($page == 'gallery') {
                $config['upload_path'] = GALLERY_IMAGE;
            }
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
                if ($page == 'home') {
                    $src = './' . HOME_IMAGE . '/' . $image;
                    $thumb_dest = './' . HOME_THUMB_IMAGE . '/';
                    $medium_dest = './' . HOME_MEDIUM_IMAGE . '/';
                } elseif ($page == 'gallery') {
                    $src = './' . GALLERY_IMAGE . '/' . $image;
                    $thumb_dest = './' . GALLERY_THUMB_IMAGE . '/';
                    $medium_dest = './' . GALLERY_MEDIUM_IMAGE . '/';
                }
                thumbnail_image($src, $thumb_dest);
                medium_image_user($src, $medium_dest);
            }
        } else {
            $image = '';
        }

        if ($page == 'home' || $page == 'gallery') {
            $home_page = $gallery = 0;
            if ($page == 'home') {
                $home_page = 1;
            } else {
                $gallery = 1;
            }

            $image_data = array(
                'home_page' => $home_page,
                'gallery' => $gallery,
                'section' => $section_id,
                'is_visible' => 1,
                'image' => $image
            );

            $this->Media_model->add_images($image_data, TBL_MEDIA);
        } else {
            $image_data = array(
                'logo_image' => $image,
                'created' => date('Y-m-d H:i:s'),
            );
            $this->Media_model->add_images($image_data, TBL_LOGOS);
        }

        echo json_encode("success");
    }

    public function delete($id) {
        $record_id = base64_decode(urldecode($id));
        if ($this->Media_model->delete($record_id)) {
            $this->session->set_flashdata('success_msg', 'Deleted successfully.');
            redirect('admin/home_slider');
        }
    }
    
    public function delete_gallery_image($id) {
        $record_id = base64_decode(urldecode($id));
        if ($this->Media_model->delete($record_id)) {
            $this->session->set_flashdata('success_msg', 'Deleted successfully.');
            redirect('admin/gallery');
        }
    }

    public function logos() {
        check_permissions(13);
        $this->data['title'] = $this->data['page_header'] = 'Logos';
        $this->data['icon_class'] = 'icon-image3';
        $images = $this->Media_model->get_logo_images();
        $this->data['images'] = $images;

        $this->template->load('admin', 'Admin/Media/logos', $this->data);
    }

    public function delete_logo($id) {
        $record_id = base64_decode(urldecode($id));
        if ($this->Media_model->delete_logo($record_id)) {
            $this->session->set_flashdata('success_msg', 'Deleted successfully.');
            redirect('admin/logos');
        }
    }

}
