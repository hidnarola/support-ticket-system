<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->popular_limit = 5;
        $this->type_table = array(
            'roles' => 'roles',
            'categories' => 'categories',
            'departments' => 'departments',
            'ticket_priorities' => 'ticket_priorities',
            'ticket_statuses' => 'ticket_statuses',
            'ticket_types' => 'ticket_types',
        );
        $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->data['icon_class'] = 'icon-user-plus';
    }

    public function index($type=NULL) {
        $maxDays=date('t');
        $clients_arr = $tickets_arr = array();
        for ($i=0; $i <= $maxDays; $i++) { 
            $clients_arr[$i] = 0;
            $tickets_arr[$i] = 0;
        }
       
        $clients_this_month = $this->Admin_model->get_clients_this_month();
        $tickets_this_month = $this->Admin_model->get_tickets_this_month();

        $clients_array = array_column($clients_this_month, 'clients');
        $tickets_array = array_column($tickets_this_month, 'tickets');
        $this->data['total_clients_this_month'] = array_sum($clients_array);
        $this->data['total_tickets_this_month'] = array_sum($tickets_array);
        

        foreach ($clients_this_month as $client) {
            $clients_arr[$client['day']-1] = (int)$client['clients'];
        }
        foreach ($tickets_this_month as $ticket) {
            $tickets_arr[$ticket['day']-1] = (int)$ticket['tickets'];
        }
        
        $this->data['title'] = $this->data['page_header'] = 'Dashboard';
        $this->data['icon_class'] = 'icon-home4';
        $this->data['total_departments'] = $this->Admin_model->get_total(TBL_DEPARTMENTS);
        $this->data['total_staffs'] = $this->Admin_model->get_total_users(2);
        $this->data['total_tenants'] = $this->Admin_model->get_total_users(1);
        $this->data['total_tickets'] = $this->Admin_model->get_total(TBL_TICKETS);
        $this->data['tickets'] = $this->Admin_model->get_tickets($type,10);
        $this->data['clients_chart'] = $clients_arr;
        $this->data['tickets_chart'] = $tickets_arr;
//        $this->data['tickets'] = $this->Admin_model->get_tickets($this->table, 1);
        $this->data['departments'] = $this->Admin_model->get_records(TBL_DEPARTMENTS);
        $this->data['statuses'] = $this->Admin_model->get_records(TBL_TICKET_STATUSES);
        $this->data['priorities'] = $this->Admin_model->get_records(TBL_TICKET_PRIORITIES);
        $this->template->load('admin', 'Admin/Dashboard/index', $this->data);
    }

    public function manage($type) {
        $type = strtolower($type);

        if ($type != '' && array_key_exists($type, $this->type_table)) {
            $table_name = $this->type_table[$type];
            $title = ucwords(str_replace('_', ' ', $table_name));
            if($title == 'Categories'){
                $this->data['icon_class'] = 'icon-grid2';
            }else if($title == 'Departments'){
                $this->data['icon_class'] = 'icon-grid2';
            }else if($title == 'Roles'){
                $this->data['icon_class'] = 'icon-vcard';
            }else if($title == 'Ticket Priorities'){
                $this->data['icon_class'] = 'icon-list-numbered';
            }else if($title == 'Ticket Statuses'){
                $this->data['icon_class'] = 'icon-stats-bars2';
            }else if($title == 'Ticket Types'){
                $this->data['icon_class'] = 'icon-grid-alt';
            }
            $this->data['title'] = $this->data['page_header'] = $this->data['record_type'] = $title;
            $this->data['records'] = $this->Admin_model->get_records($table_name);
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Enter Name.'));

            if ($this->form_validation->run() == TRUE) {

                $name = $this->input->post('name');
                $record_id = $this->input->post('record_id');
                $record_array = array(
                    'name' => $name,
                    'created' => date('Y-m-d H:i:s')
                );
                if($type == 'departments'){
                    $series_name = $this->get_series_name($name);
                    // var_dump($series_name);
                    $record_array['series_name']= $series_name;
                }
                // pr($record_array,1);
                if ($record_id != '') {
                    $record_exist_condition = array(
                        'id' => $record_id
                    );
                    if ($this->Admin_model->record_exist($table_name, $record_exist_condition)) {
                        if ($this->Admin_model->manage_record($table_name, $record_array, $record_id)) {
                            $this->session->set_flashdata('success_msg', 'Record saved successfully.');
                            redirect('admin/manage/' . $type);
                        } else {
                            $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                            redirect('admin/manage/' . $type);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'No such record found. Please try again..!!');
                        redirect('admin/manage/' . $type);
                    }
                } else {
                    if ($this->Admin_model->manage_record($table_name, $record_array)) {
                        $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                        redirect('admin/manage/' . $type);
                    } else {
                        $this->session->set_flashdata('error_msg', 'Unable to save detail. Please try again..!!');
                        redirect('admin/manage/' . $type);
                    }
                }
            }
            $this->template->load('admin', 'Admin/Dashboard/manage_record', $this->data);
        } else {
            redirect('admin');
        }
    }

    public function get_detail() {
        $type = strtolower($this->input->post('type'));
        $id = $this->input->post('id');
        if ($type != '' && array_key_exists($type, $this->type_table) && $id != '') {
            $table_name = $this->type_table[$type];
            $record_id = base64_decode($id);
            $record = $this->Admin_model->get_records($table_name, $record_id);
            if (count($record) > 0) {
                $return_array = array(
                    'status' => 1,
                    'record' => $record
                );
            } else {
                $return_array = array(
                    'status' => 0
                );
            }
        } else {        
            $return_array = array(
                'status' => 0
            );
        }
        echo json_encode($return_array);
    }

    public function delete() {
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($table_name, $record_id)) {
                 $this->session->set_flashdata('success_msg', 'Record deleted successfully!');
//                $msg = 'Record deleted successfully';
                $status = 1;
            } else {
                 $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
//                $msg = 'Unable to delete the record.';
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
//                'msg' => $msg,
                'id' => $id
            );
            echo json_encode($return_array);
        }
    }

    public function profile() {
        $this->data['title'] = $this->data['page_header'] = 'My Profile';
        $this->data['icon_class'] = 'icon-user-plus';
        
        $id = $this->session->userdata('admin_logged_in')['id'];
        $profile = $this->Admin_model->get_profile($id);
        $this->data['profile'] = $profile;
        $this->template->load('admin', 'Admin/Dashboard/profile', $this->data);
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
                        $data['profile_validation'] = $this->upload->display_errors();
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
                'contactno' => $this->input->post('contact_no'),
                'address' => $this->input->post('address'),
                'profile_pic' => $profile_pic
            );

            if($this->User_model->edit($profile_data, TBL_USERS, 'id', $id)){
                $this->session->set_flashdata('success_msg', 'Profile updated successfully');
            }else{
                $this->session->set_flashdata('error_msg', 'Unable to update the profile');
            }
            redirect('admin/profile');
        }
    }

    public function company(){
        $this->data['title'] = $this->data['page_header'] = 'Company Details';
        $this->data['icon_class'] = 'icon-office';
        
        $company_details = $this->Admin_model->get_company_details();
        $keys = array_column($company_details, 'key');
        $values = array_column($company_details, 'value');
        $combined = array_combine($keys, $values);
        $this->data['company'] = $combined;
        $this->template->load('admin', 'Admin/Dashboard/company', $this->data);
        if($this->input->post()){
            $company_data = $this->input->post();
            if($this->Admin_model->save_company_details($company_data)){
                $this->session->set_flashdata('success_msg', 'Successfully Updated Company Details');
            }else{
                $this->session->set_flashdata('error_msg', 'Unable to update Company Details.');
            }
            redirect('admin/manage/company');
        }
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

    public function change_password(){
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $cnfrm_password = $this->input->post('cnfrm_password');
        $id = $this->session->userdata('admin_logged_in')['id'];
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
        redirect('admin/profile');
    }

    public function get_series_name($name, $i=0){
        $name = urldecode($name);
        $words = explode(" ", $name);
        $word_cnt = sizeof($words);
        $acronym = "";

        
        if($word_cnt > 1){
            if($i==0){
            foreach ($words as $w) {
                
                $acronym .= strtoupper($w[0]);
            }
            }else{
               $j=1;
              foreach ($words as $w) {
                if($j==$i){
                    
                    $acronym .= strtoupper(substr($w, 0, $i));
                    
                }else if($i%$j==0){
                    $acronym .= strtoupper(substr($w, 0, $i));

                }else{
                    $acronym .= strtoupper($w[0]);
                }
                $j++;
            }  
            }
            }else{
                $j=3;
                if($i>0)
                    $acronym = strtoupper(substr(reset($words), 0, $j+$i));
            }
            $turn=$i+1;
              
              $conditions=array('series_name'=>$acronym);
              $check = $this->Admin_model->record_exist(TBL_DEPARTMENTS, $conditions);

            if($check>0){
                return $this->get_series_name($name, $turn);
            }else{
                // echo 'here'; exit;
              return $acronym;
                //exit;
            }
            
    }

    public function series_no(){
        $records = $this->Admin_model->get_tickets_series();
        
        foreach ($records as $record) {
            $series_no = $record['dept_name'].'-T'.$record['id'];
            $this->User_model->updateField('id', $record['id'], 'series_no', $series_no, TBL_TICKETS);
        }
        exit;
    }
    public function get_emails() {
        $keyword = $this->input->post('term');
        echo $keyword;exit;
        $data['response'] = 'false'; //Set default response
        if (!empty($keyword) && isset($keyword)) {
            $query = $this->Newsletter_model->get_emails($keyword);
            if (!empty($query)) {
                $data['response'] = 'true'; //Set response
                $data['message'] = array(); //Create array
                foreach ($query as $row) {
                    $data['message'][] = array('value' => $row['email'], 'id' => $row['id']);
                }
                echo json_encode($data);
                exit;
            }
        }
    }

    public function access_denied(){
        $data['title'] = 'Access Denied';
        $data['view'] = 'admin/access_denied';
        $this->load->view('admin/error/access_denied', $data);
    }
}
