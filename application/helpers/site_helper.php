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
    if (!$ci->session->userdata('staffed_logged_in') && !$ci->session->userdata('admin_logged_in')) {
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
        redirect('home');
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
    $configs = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
//        'smtp_user' => 'demo.narola@gmail.com',
//        'smtp_pass' => 'Ke6g7sE70Orq3Rqaqa',
        'smtp_user' => 'demo.narolainfotech@gmail.com',
        'smtp_pass' => 'Narola102',
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
    foreach ($settings as $row) {
        if (trim($row->key) == 'records-per-page') {
            $per_page = $row->value;
            break;
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
     $clients_this_month = $CI->Admin_model->get_clients_this_month();
        $tickets_this_month = $CI->Admin_model->get_tickets_this_month();
        
        $clients_array = array_column($clients_this_month, 'clients');
        $tickets_array = array_column($tickets_this_month, 'tickets');
        $data = array();
        $data['total_clients'] = array_sum($clients_array);
        $data['total_tickets'] = array_sum($tickets_array);
        return $data;
}
