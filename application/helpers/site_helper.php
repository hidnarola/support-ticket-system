<?php

/**
 * 	Print array/string.
 * 	@data  = data that you want to print
 * 	@is_die = if true. Excecution will stop after print. 
 * 	Author = Nv
 */
function pr($data, $is_die = false) {
    if (is_object($data)) {
        $data = (array) $data;
    }
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } else {
        echo $data;
    }

    if ($is_die)
        die;
}

/* To user roled from the database. 
 * @author : Reema  (Rep)
 */

function userRoles() {
    $roles = array();
    $CI = & get_instance();
    $data = $CI->user_model->viewAll(TBL_ROLES, '');
    foreach ($data as $val)
        $roles[$val->name] = $val->id;
    return $roles;
}

/* To check admin is logged in or not. 
 * @author : Reema  (Rep)
 */

function check_isvalidated() {
    $ci = & get_instance();
    if (!$ci->session->userdata('admin_logged_in')) {
        $ci->session->set_flashdata('error_msg', "You are not authorized to access this page. Please login!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
//        redirect('home?redirect=' . base64_encode($redirect_to));
        redirect('support/login');
    }
}

function check_if_staff_validated() {
    $ci = & get_instance();
    if (!$ci->session->userdata('staffed_logged_in')) {
        $ci->session->set_flashdata('error_msg', "You are not authorized to access this page. Please login!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
//        redirect('home?redirect=' . base64_encode($redirect_to));
        redirect('support/login');
    }
}

function check_if_support_login(){
    $ci = & get_instance();
    $url = $ci->uri->uri_string(); 
    $url_array = explode("/", $url);
    $role = reset($url_array); 
    $flag=0;
    if ($ci->session->userdata('staffed_logged_in') && $role!='staff') {
        $flag=1;
    }
    if($ci->session->userdata('admin_logged_in') && $role!='admin'){
        $flag=1;
    }
    /*if($ci->session->userdata('user_logged_in')){
        $flag=1;
    }*/
    
    if($flag==1){
        $ci->session->set_flashdata('error_msg', "You are not authorized to access this page. Please login!");
        redirect('support/login');
    }
}

function check_isvalidated_user() {
    $ci = & get_instance();
    if (!$ci->session->userdata('user_logged_in')['role_id'] == 1) {
        $ci->session->set_flashdata('error', "You are not authorized to access this page. Please login first!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
//        redirect('home?redirect=' . base64_encode($redirect_to));
        redirect('login');
    }
}

/** @method : medium_image_user
 * @uses : Resise the image to medium_image
 * @param type $src
 * @param type $dest
 * @author : Reema  (Rep)
 */
function thumbnail_image($src, $dest) {
    $CI = & get_instance();
    $CI->image_lib->clear();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $src;
    $config['maintain_ratio'] = FALSE;
    $config['width'] = 55;
    $config['height'] = 55;
    $config['new_image'] = $dest;
    $CI->image_lib->initialize($config);
    $CI->image_lib->resize();
}

/* @method : medium_image_user
 * @uses : Resise the image to medium_image
 * @param : src,destination
 * @author : Reema  (Rep)
 * */

function medium_image_user($src, $dest) {

    $CI = & get_instance();
    $CI->image_lib->clear();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $src;
    $config['maintain_ratio'] = FALSE;
    $config['width'] = 180;
    $config['height'] = 180;
    $config['new_image'] = $dest;
    $CI->image_lib->initialize($config);
    $CI->image_lib->resize();
}

/**
 * For mail configuration to send mail
 * @return string
 * @author : Reema  (Rep)
 */
function mail_config() {
    $CI = & get_instance();
    $CI->load->model('Admin_model');
    $smtp_details = $CI->Admin_model->get_smtp_details();
    $keys = array_column($smtp_details, 'key');
    $values = array_column($smtp_details, 'value');
    $smtp_settings = array_combine($keys, $values);
 
    $configs = array(
        'protocol' => 'smtp',
        'smtp_host' => $smtp_settings['smtp_host'],
        'smtp_port' => $smtp_settings['smtp_port'],
//        'smtp_user' => 'demo.narola@gmail.com',
//        'smtp_pass' => 'Ke6g7sE70Orq3Rqaqa',
        'smtp_user' => $smtp_settings['smtp_email'],
        'smtp_pass' => $smtp_settings['smtp_password'],
        'transport' => 'Smtp',
        'charset' => 'utf-8',
        'newline' => "\r\n",
        'headerCharset' => 'iso-8859-1',
        'mailtype' => 'html'
    );
    return $configs;
}

function get_role_id($role) {
    $CI = & get_instance();
    $data = $CI->user_model->get_role_id($role);
    return $data['id'];
}

function p($data, $status = 0) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if ($status == 1) {
        exit;
    }
}

/**
 * For knowlwdge Base slug of title
 * @return boolean
 * @author : Reema  (Rep)
 */
function slug($text) {
//    $a = str_replace(' ', '-', $str);
//    return strtolower($a);

    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w\?&]+~', '', $text);
    return strtolower($text);
}

/**
 * For pagination configuration
 * @return boolean
 * @author : Reema  (Rep)
 */
function init_pagination() {
    $config = array();
    $CI = & get_instance();
    $settings = $CI->session->userdata('settings');
    $per_page = "";
    if(!empty($settings)){
        foreach ($settings as $row) {
            if (trim($row->key) == 'records-per-page') {
                $per_page = $row->value;
                break;
            }
        }
}
    $segment = $CI->uri->segment(4);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 4;
    //config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '←';
    if ($segment == '') {
        $config['prev_tag_open'] = '<li class="prev disabled">';
    } else {
        $config['prev_tag_open'] = '<li class="prev">';
    }
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '→';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a style="background-color:#455a64;color:#ffffff;">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['num_links'] = 2;
    $config['display_prev_link'] = TRUE;
    $config['display_next_link'] = TRUE;
    $config['enable_query_strings'] = TRUE;
    return $config;
}

/**
 * For pagination configuration
 * @return boolean
 * @author : Reema  (Rep)
 */
function init_pagination_tenant() {
    $config = array();
    $CI = & get_instance();
    $settings = $CI->session->userdata('settings');

    $per_page = "";
    foreach ($settings as $row) {
        if (trim($row->key) == 'records-per-page') {
            $per_page = $row->value;
            break;
        }
    }


    $segment = $CI->uri->segment(3);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 3;
    //config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '←';
    if ($segment == '') {
        $config['prev_tag_open'] = '<li class="prev disabled">';
    } else {
        $config['prev_tag_open'] = '<li class="prev">';
    }
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '→';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a style="background-color:#455a64;color:#ffffff;">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['num_links'] = 2;
    $config['display_prev_link'] = TRUE;
    $config['display_next_link'] = TRUE;
    $config['enable_query_strings'] = TRUE;
//    pr($config);
    return $config;
}

/**
 * Safely extracts not more than the first $count characters from html string.
 *
 * UTF-8, tags and entities safe prefix extraction. Entities inside will *NOT*
 * be counted as one character. For example &amp; will be counted as 4, &lt; as
 * 3, etc.
 *
 * @access  public
 * @param string $str String to get the excerpt from.
 * @param integer $count Maximum number of characters to take.
 * @param string The end character. Usually an ellipsis.
 * @return string The excerpt.
 */
function html_excerpt($str, $count = 500, $end_char = '&#8230;') {
    $str = strip_all_tags($str, true);
    $str = mb_substr($str, 0, $count);
    // remove part of an entity at the end
    $str = preg_replace('/&[^;\s]{0,6}$/', '', $str);
    return $str . $end_char;
}

function html_excerpt_article($str, $count = 90, $end_char = '&#8230;') {
    $str = strip_all_tags($str, true);
    $str = mb_substr($str, 0, $count);
    // remove part of an entity at the end
    $str = preg_replace('/&[^;\s]{0,6}$/', '', $str);
    return $str . $end_char;
}

function html_excerpt_title($str, $count = 25, $end_char = '&#8230;') {
    $str = strip_all_tags($str, true);
    $str = mb_substr($str, 0, $count);
    // remove part of an entity at the end
    $str = preg_replace('/&[^;\s]{0,6}$/', '', $str);
    return $str . $end_char;
}

/**
 * Properly strip all HTML tags including script and style
 *
 *
 * @param string $string String containing HTML tags
 * @param bool $remove_breaks optional Whether to remove left over line breaks and white space chars
 * @return string The processed string.
 */
function strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
    $string = strip_tags($string);
    if ($remove_breaks) {
        $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
    }
    return trim($string);
}
function slug_page($text, $table = '', $id = NULL) {
    $ci = & get_instance();
    $ci->load->model('User_model');        

    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    if(!mb_ereg('[\x{0600}-\x{06FF}]', $text)){
        
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w\?&]+~', '', $text);
    }

    if (empty($text)) {
        return 'n-a';
    }
    if ($table != '') {
        //--- when text with table name then check generated slug is already exist or not
        for ($i = 0; $i < 1; $i++) {
            if ($id != NULL) {
                $where = 'url = '.$ci->db->escape($text).' AND id != '.$id;
            } else {
                $where = 'url = '.$ci->db->escape($text);
            }
            $result = $ci->User_model->get_result($table,$where);
            if (sizeof($result) > 0) {
                $explode_slug = explode("-", $text);
                $last_char = $explode_slug[count($explode_slug) - 1];
                if (is_numeric($last_char)) {
                    $last_char++;
                    unset($explode_slug[count($explode_slug) - 1]);
                    $text = implode($explode_slug, "-");
                    $text.="-" . $last_char;
                } else {
                    $text.="-1";
                }
                $i--;
            } else {
                return $text;
            }
        }
    } else {
        return $text;
    }
}

function get_pages($type){
    $CI = & get_instance();
    $CI->load->model('Pages_model');
    if($type == 'header'){
        $result = $CI->Pages_model->get_menu_pages($type);
        if($result){
            $menu_array = array();
            foreach ($result as $key => $value) {
                if($value['parent_id'] == 0 && $value['active'] == 1){
                    $menu_array[$value['id']] = $value;             
                } 
            }
            foreach ($result as $key => $value) {
                if($value['parent_id'] != 0){
                    if(isset($menu_array[$value['parent_id']])){
                        $menu_array[$value['parent_id']]['sub_menus'][] = $value;             
                    }
                } 
            }
            return $menu_array;
        }
    }

    if($type == 'footer'){
        $result = $CI->Pages_model->get_menu_pages($type);
        if($result){
            $menu_array = array();
            foreach ($result as $key => $value) {
                // if($value['parent_id'] == 0){
                    $menu_array[$key] = $value;             
                // } 
            }
            // foreach ($result as $key => $value) {
            //     if($value['parent_id'] != 0){
            //         $menu_array[$value['parent_id']] = $value;             
            //     } 
            // }
            // p($menu_array);
            return $menu_array;
        }
    }
}

function company_details(){
    $CI = & get_instance();
    $CI->load->model('User_model');
    $company_details = $CI->User_model->get_company_details();
    return $company_details;
}

function get_total_count(){
    $CI = & get_instance();
    $CI->load->model('Admin_model');
    $data['total_clients'] = $CI->Admin_model->get_total_users(1);
        $data['total_tickets'] = $CI->Admin_model->get_total(TBL_TICKETS);
     
        return $data;
}

function get_social_media(){
    $CI = & get_instance();
    $CI->load->model('Admin_model');
    $social_media = $CI->Admin_model->get_social_media();
    return $social_media;
}

function get_page($id){
    $CI = & get_instance();
    $CI->load->model('Pages_model');
    $result = $CI->Pages_model->get_page($id);
    $name='#';
    if(!empty($result)){
        $page = $result[0];
        $name = strtolower(str_replace(" ", "-", $page['navigation_name']));
    }
    return $name;
}


function send_message_notification($id, $sent_from=null, $ticket_array=null){
    $CI = & get_instance();
    $CI->load->model('Admin_model');
    $result = $CI->Admin_model->get_detail_for_message_notification($id);
    $sent_to_array = array();
    $admin = $CI->Admin_model->get_admin();

    $sent_to_array = array(
        'admin'=>array(
            'email'=>$admin['email'],
            'name'=>$admin['fname'].' '.$admin['lname']
            ),
        'staff'=>array(
            'email'=>$result['staff_email'],
            'name'=>$result['sfname'].' '.$result['slname']
            ),
        'head_staff'=>array(
            'email'=>$result['head_staff_email'],
            'name'=>$result['hfname'].' '.$result['hlname']
            ),
        'tenant'=>array(
            'email'=>$result['tenant_email'],
            'name'=>$result['tfname'].' '.$result['tlname'],
            )
        );
    if($sent_from == 'subadmin'){
        $CI->load->model('Subadmin_model');
        $subadmin = $CI->Subadmin_model->get_subadmin_detail($ticket_array['sent_from']);
        $sent_to_array['subadmin'] = array(
            'email'=>$subadmin['email'],
            'name'=>$subadmin['fname'].' '.$subadmin['lname'],
            );
    }
    foreach ($sent_to_array as $key => $value) {
        if($key != $sent_from){
            $email_template = get_template_details(11);
            $name = $sent_to_array[$sent_from]['name'];
            $series_no = $result['series_no'];
            $title = $result['title'];
            $ticket_message = $ticket_array['message']; 
            $message = $email_template['email_description'];
            
            eval("\$message = \"$message\";");

            $mail_body = "<html>\n";
            $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
            $mail_body = $message;
            $mail_body .= "</body>\n";
            $mail_body .= "</html>\n";

            $configs = mail_config();
            $CI->load->library('email', $configs);
            $CI->email->initialize($configs);
            $CI->email->from($email_template['sender_email'], $email_template['sender_name']);

            $CI->email->to($value['email']);
            $CI->email->subject($email_template['email_subject']);
            $CI->email->message($mail_body);
            $CI->email->send();

            
            // $CI->email->print_debugger();
            
        }

    }

    $subadmins = send_mails_to_subadmin('3');
    if(!empty($subadmins)){
        foreach ($subadmins as $subadmin) {
            if($subadmin['user_id'] != $ticket_array['sent_from']){
                $email_template = get_template_details(11);
                $name = $subadmin['fname'].' '.$subadmin['lname'];
                $series_no = $result['series_no'];
                $title = $result['title'];
                $ticket_message = $ticket_array['message']; 
                $message = $email_template['email_description'];
                
                eval("\$message = \"$message\";");

                $mail_body = "<html>\n";
                $mail_body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n";
                $mail_body = $message;
                $mail_body .= "</body>\n";
                $mail_body .= "</html>\n";

                $configs = mail_config();
                $CI->load->library('email', $configs);
                $CI->email->initialize($configs);
                $CI->email->from($email_template['sender_email'], $email_template['sender_name']);

                $CI->email->to($subadmin['email']);
                $CI->email->subject($email_template['email_subject']);
                $CI->email->message($mail_body);
                $CI->email->send();
            }
        }
    }
        if($sent_from!='tenant'){
            $CI->load->library('push_notification');
            $messageText = $ticket_array['message'];
            $ticket_conversation = $CI->Admin_model->get_conversation($id);
            

        $pushData = array("notification_type" => "data",
            'notification_for'=>'new message',
            'displaymessagedata' =>array(

            "ticketconversationId"=> $ticket_conversation['id'],
              "message"=> $ticket_conversation['message'],
              "ticketId"=> $id,
              "sent_from"=> $ticket_conversation['sent_from'],
              "status"=> 0,
              "created_date"=> $ticket_conversation['created'],
              "fname"=> $ticket_conversation['fname'],
              "lname"=> $ticket_conversation['lname'],
              "userImages"=> $result['profile_pic']
            ));

            
        
                        
            if(!is_null($result['device_token'])){
                if($result['device_make']==0){
                    $response = $CI->push_notification->sendPushiOS(array('deviceToken' => trim($result['device_token']), 'pushMessage' => 'Ticket New Message'),$pushData);
                }else{
                    $response = $CI->push_notification->sendPushToAndroid(trim($result['device_token']), $pushData, TRUE);
                }
            }
            
            
            // pr($response,1);
            // $response = $CI->push_notification->sendPushToAndroid($result['device_token'], $pushData, TRUE);

        }
}

    function get_permissions(){
        $ci = &get_instance();
        if(isset($ci->session->userdata('admin_logged_in')['subadmin_id'])){
            $ci->load->model('Subadmin_model');
            $permissions = $ci->Subadmin_model->get_subadmin_modules($ci->session->userdata('subadmin_id'));
            if($permissions['module_ids']!=''){
                $ci->session->set_userdata('module_ids', $permissions['module_ids']);
            }
        }
    }

    function check_permissions($module){
        $ci = &get_instance();
        if(isset($ci->session->userdata('admin_logged_in')['subadmin_id'])){
            $module_id = $ci->session->userdata('module_ids');
            $modules = explode(",", $module_id);
            if(!in_array($module, $modules)){
                redirect('admin/access_denied');
            }
        }
    }

    function get_template_details($id){
        $ci = &get_instance();
        $ci->load->model('Email_templates_model');
        $template = $ci->Email_templates_model->get_template($id);
        $desc = str_replace("{","",addslashes($template['email_description']));
        $email_desc = str_replace("}","",$desc);
        $template['email_description'] = $email_desc;
        return $template;
    }
   
    function send_mails_to_subadmin($email_notification){
        $ci = &get_instance();
        $ci->load->model('Subadmin_model');
        $subadmins = $ci->Subadmin_model->get_subadmins_notification_id($email_notification);
        return subadmins;
    }

