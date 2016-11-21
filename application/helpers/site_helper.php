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
        $ci->session->set_flashdata('error_msg', "You are not authorized to access this page. Please login first!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
//        redirect('home?redirect=' . base64_encode($redirect_to));
        redirect('admin/login');
    }
}

function check_if_staff_validated() {
    $ci = & get_instance();
    if (!$ci->session->userdata('staffed_logged_in')) {
        $ci->session->set_flashdata('error_msg', "You are not authorized to access this page. Please login first!");
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_to = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
        } else {
            $redirect_to = $ci->uri->uri_string();
        }
//        redirect('home?redirect=' . base64_encode($redirect_to));
        redirect('staff/login');
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
        'smtp_user' => 'demo.narola@gmail.com',
        'smtp_pass' => 'Ke6g7sE70Orq3Rqaqa',
//        'smtp_user' => 'demo.narolainfotech@gmail.com',
//        'smtp_pass' => 'Narola102',
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
    $segment = $CI->uri->segment(2);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 2;
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
