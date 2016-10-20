<?php

/**
*	Print array/string.
*	@data  = data that you want to print
*	@is_die = if true. Excecution will stop after print. 
* 	Author = Nv
*/
function pr($data, $is_die = false){

	if(is_array($data)){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}else{
		echo $data;
	}

	if($is_die)
	die;
}

function userRoles() {
    $roles = array();
    $CI = & get_instance();
    $data = $CI->user_model->viewAll(TBL_USERS_ROLES, '');
//    echo '<pre>';
//    print_r($data);
//    exit;
    foreach ($data as $val)
        $roles[$val->name] = $val->id;
    return $roles;
}