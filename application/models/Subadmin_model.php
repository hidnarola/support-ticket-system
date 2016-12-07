<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_subadmins() {
        $this->db->where('is_delete', 0);
        $this->db->where('role_id', 4);
        $records = $this->db->get(TBL_USERS);
        return $records->result_array();
    }

    public function get_subadmin_detail($id){
    	$this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $records = $this->db->get(TBL_USERS);
        return $records->row_array();
    }

    public function get_subadmin_modules($id){
    	$this->db->where('user_id', $id);
        $records = $this->db->get(TBL_SUBADMIN_MODULES);
        return $records->row_array();
    }

    public function get_modules(){
    	$records = $this->db->get(TBL_MODULES);
        return $records->result_array();
    }

    public function add_subadmin($data){
    	if ($this->db->insert(TBL_USERS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_subadmin($id, $data){
    	$this->db->where('id', $id);
        if ($this->db->update(TBL_USERS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    
	public function add_modules($data){
		if ($this->db->insert(TBL_SUBADMIN_MODULES, $data)) {
            return 1;
        } else {
            return 0;
        }
	}

	public function update_modules($id, $data){
		$this->db->where('user_id', $id);
        if ($this->db->update(TBL_SUBADMIN_MODULES, $data)) {
            return 1;
        } else {
            return 0;
        }
	}
}