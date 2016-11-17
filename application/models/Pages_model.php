<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_pages(){
    	$this->db->where('is_delete', 0);
		$records = $this->db->get(TBL_PAGES);
        return $records->result_array();
    }
}