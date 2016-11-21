<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_home_images(){
    	$this->db->where('is_delete', 0);
    	$this->db->where('is_visible', 1);
    	$this->db->where('home_page', 1);
    	$query = $this->db->get(TBL_MEDIA);
    	$result = $query->result_array();
    	return $result;
    }

    public function add_images($img_array){
    	$this->db->insert(TBL_MEDIA, $img_array);
    }

}