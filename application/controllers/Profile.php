<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated_user();
        $this->load->model('User_model');
        $this->load->helper('text');
    }

    public function index() {
//                echo "<pre>";
//print_r($this->session->all_userdata());
//echo "</pre>";exit;
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'User Profile | Support-Ticket-System';
        $this->template->load('frontend/profile', 'Frontend/User/profile', $data);
        if ($this->input->post('save')) {

            $update_data['fname'] = trim($this->input->post('fname'));
            $update_data['lname'] = trim($this->input->post('lname'));
            $update_data['email'] = trim($this->input->post('email'));
            $update_data['contactno'] = trim($this->input->post('contactno'));
            $update_data['address'] = trim($this->input->post('address'));

            $this->User_model->edit($update_data, TBL_USERS, 'id', $userid);

            //--- upload profile picture
            if ($_FILES['profile_pic']['name'] != '') {
//               p($_FILES,1);
                //--- check user directory is exist or not

                $exts = explode(".", $_FILES['profile_pic']['name']);
                $name = $exts[0] . time() . "." . $exts[1];
                $config['upload_path'] = './' . USER_PROFILE_IMAGE . '/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '1000000000';
                $config['file_name'] = $name;
                $error_count = 0;
                $this->upload->initialize($config);

                //--- check file is successfully uploaded or not
                if (!$this->upload->do_upload('profile_pic')) {

                    //--- if somthing wrong then display error
                    $file_upload_error = strip_tags($this->upload->display_errors(), '');
                    $error = array('error' => $this->upload->display_errors(), '');

                    $this->session->set_flashdata('error_msg', $file_upload_error);
                    redirect('profile');
                } else {
                    //--- file uploaded successfully
                    $data = array('upload_data' => $this->upload->data());
                    $profile_pic = $data['upload_data']['file_name'];

                    $src = './' . USER_PROFILE_IMAGE . '/' . $profile_pic;
                    $thumb_dest = './' . PROFILE_THUMB_IMAGE . '/';
                    $medium_dest = './' . PROFILE_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);

                    //--- update image path
                    $update_pic = array('profile_pic' => $profile_pic);
                    $this->User_model->edit($update_pic, TBL_USERS, 'id', $userid);


                    if ($this->session->userdata('user_logged_in')['profile_pic'] != '') {
                        unlink('./' . USER_PROFILE_IMAGE . '/' . $this->session->userdata('user_logged_in')['profile_pic']); /* Remove image from */
                        unlink('./' . PROFILE_THUMB_IMAGE . '/' . $this->session->userdata('user_logged_in')['profile_pic']); /* Remove image from server */
                        unlink('./' . PROFILE_MEDIUM_IMAGE . '/' . $this->session->userdata('user_logged_in')['profile_pic']); /* Remove image from server */
                    }
                }
            }
            $this->session->set_flashdata('success_msg', 'Your profile is updated successfully!');
            redirect('profile');
        }
    }

    public function changepassword() {
        $userid = $this->session->userdata('user_logged_in')['id'];
        $data['user'] = $this->User_model->getUserByID($userid);

        $data['title'] = 'Profile | Support-Ticket-System';
         $data['header_title'] = 'Change Password';
        $this->template->load('frontend/page', 'Frontend/User/change_password', $data);
        if ($this->input->post('save')) {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $cnfrm_password = $this->input->post('confirm_password');
            $id = $this->session->userdata('user_logged_in')['id'];
            $db_password = $this->User_model->get_password($id);

            $decode_db_password = $this->encrypt->decode($db_password['password']);
            if ($old_password == $decode_db_password) {
                if ($new_password == $cnfrm_password) {
                    $password = $this->encrypt->encode($new_password);
                    $profile_data = array('password' => $password);
                    if ($this->User_model->edit($profile_data, TBL_USERS, 'id', $id)) {
                        $this->session->set_flashdata('success_msg', 'Password updated successfully');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to update the password');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'Password Mismatch');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Incorrect Old Password');
            }
            redirect('profile/changepassword');
        }
    }

}
