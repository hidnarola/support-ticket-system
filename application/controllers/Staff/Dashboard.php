<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        check_if_staff_validated();
        $this->data = array();
        $this->load->model('Staff_model');
        $this->load->model('User_model');
    }

    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Dashboard';

        $this->data['total_tickets'] = $this->Staff_model->get_total_tickets($this->session->userdata('staffed_logged_in')['id']);
        $this->data['total_replies'] = $this->Staff_model->get_total_replies($this->session->userdata('staffed_logged_in')['id']);
        $this->data['tickets'] = $this->Staff_model->get_tickets($this->session->userdata('staffed_logged_in')['id']);
        // pr($this->data['tickets'],1);
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
            $profile_data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'contactno' => $this->input->post('contactno'),
                'address' => $this->input->post('address'),
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
        
        $decode_db_password = $this->encrypt->decode($db_password);
        if($old_password == $db_password){
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
    
   

}
