<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_if_staff_validated();
        $this->data = array();
        $this->load->model('Staff_model');
        $this->load->model('User_model');
        $this->load->model('Admin_model');
    }

    public function index() {
        $this->data['icon_class'] = 'icon-home4';
        
        $this->data['title'] = $this->data['page_header'] = 'Dashboard';

        $this->data['total_tickets'] = $this->Staff_model->get_total_tickets($this->session->userdata('staffed_logged_in')['id']);
        $this->data['total_replies'] = $this->Staff_model->get_total_replies($this->session->userdata('staffed_logged_in')['id']);
        $this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
        // pr($this->data['tickets'],1);
         $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('staff', 'Staff/Dashboard/index', $this->data);       
    }

    public function profile(){
        $this->data['title'] = $this->data['page_header'] = 'My Profile';
        $id = $this->session->userdata('staffed_logged_in')['id'];
        $profile = $this->Staff_model->get_profile($id);
       // pr($profile,1);
        $this->data['profile'] = $profile;
        $this->template->load('staff', 'Staff/Dashboard/profile', $this->data);

        if($this->input->post()){

            if ($_FILES['profile_pic']['name'] != '') {
                    $img_array = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                    $exts = explode(".", $_FILES['profile_pic']['name']);
                    $name = $exts[0] . time() . "." . $exts[1];
                    $name = "profile-" . date("mdYhHis") . "." . $exts[1];

                    $config['upload_path'] = USER_PROFILE_IMAGE;
                    $config['allowed_types'] = implode("|", $img_array);
                    $config['max_size'] = '2048';
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profile_pic')) {
                        $flag = 1;
                        $data['profile_ validation'] = $this->upload->display_errors();
                    } else {
                        $file_info = $this->upload->data();
                        $profile_pic = $file_info['file_name'];

                        $src = './' . USER_PROFILE_IMAGE . '/' . $profile_pic;
                        $thumb_dest = './' . PROFILE_THUMB_IMAGE . '/';
                        $medium_dest = './' . PROFILE_MEDIUM_IMAGE . '/';
                        thumbnail_image($src, $thumb_dest);
                        medium_image_user($src, $medium_dest);
                    }
                } else {
                    $profile_pic = '';
                }

            $profile_data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'contactno' => $this->input->post('contactno'),
                'address' => $this->input->post('address'),
                'profile_pic' => $profile_pic
            );
            if($this->User_model->edit($profile_data, TBL_USERS, 'id', $id)){
                $this->session->set_flashdata('success_msg', 'Profile updated successfully');
            }else{
                $this->session->set_flashdata('error_msg', 'Unable to update the profile');
            }
            redirect('staff/profile');
        }
    }

    public function change_password(){
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $cnfrm_password = $this->input->post('cnfrm_password');
        $id = $this->session->userdata('staffed_logged_in')['id'];
        $db_password = $this->User_model->get_password($id);
        
        $decode_db_password = $this->encrypt->decode($db_password['password']);
        if($old_password == $decode_db_password){
            if($new_password==$cnfrm_password){
                $password = $this->encrypt->encode($new_password);
                $profile_data = array('password'=>$password);
                if($this->User_model->edit($profile_data, TBL_USERS, 'id', $id)){
                    $this->session->set_flashdata('success_msg', 'Password updated successfully');
                }else{
                    $this->session->set_flashdata('error_msg', 'Unable to update the password');
                }
            }else{
                $this->session->set_flashdata('error_msg', 'Password Mismatch');
            }
        }else{
            $this->session->set_flashdata('error_msg', 'Incorrect Old Password');
        }
        redirect('staff/profile');
    }

     public function get_staff(){
        $dept = $this->input->post('dept');
        $staff = $this->Admin_model->get_staff($dept);
        $html = '';
        foreach ($staff as $row) {
            $html .= '<option value="'. $row['user_id'] .'">'. $row['fname'].' '. $row['lname'] .'</option>';
        }
        echo $html;
        exit;
    }
    
   

}
