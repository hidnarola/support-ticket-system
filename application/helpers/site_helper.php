<?php

/**
 * 	Print array/string.
 * 	@data  = data that you want to print
 * 	@is_die = if true. Excecution will stop after print. 
 * 	Author = Nv
 */
function pr($data, $is_die = false) {

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
        'transport' => 'Smtp',
        'charset' => 'utf-8',
        'newline' => "\r\n",
        'headerCharset' => 'iso-8859-1',
        'mailtype' => 'html'
    );
    return $configs;
}

function get_role_id($role){
	$CI = & get_instance();
	$data = $CI->user_model->get_role_id($role);
	return $data['id'];
}

