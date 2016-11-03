<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data(){
    	$this->db->where('is_delete', 0);
    	$this->db->order_by('modified', 'desc');
    	$result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
    	return $result->result_array();
    }
}