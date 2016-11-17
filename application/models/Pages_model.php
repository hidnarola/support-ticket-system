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
    function get_page($id){
    	$this->db->where('is_delete', 0);
    	$this->db->where('id', $id);
		$records = $this->db->get(TBL_PAGES);
        return $records->result_array();
    }
    
    public function insert($table,$array){
        if ($this->db->insert($table, $array)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }
    public function update_record($table, $condition, $user_array) {
        $this->db->where($condition);
        if ($this->db->update($table, $user_array)) {
            return 1;
        } else {
            return 0;
        }
    }
}