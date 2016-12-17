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

	public function get_all_email_notifications(){
		$records = $this->db->get(TBL_EMAIL_NOTIFICATIONS);
        return $records->result_array();
	}

	public function get_subadmin_email_notifications($id){
		$this->db->where('user_id', $id);
		$records = $this->db->get(TBL_SUBADMIN_MODULES);
        return $records->row_array();
	}

	public function set_notifications($id, $email_notifications){
		$data['email_notifications'] = $email_notifications;
        $this->db->where('user_id', $id);
        $flag = $this->db->update(TBL_SUBADMIN_MODULES, $data);
        if ($flag) {
            return 1;
        } else {
            return 0;
        }
	}

	public function get_subadmins_notification_id($email_notifications){
		$this->db->select('sm.user_id, u.fname, u.lname, u.email');
		$this->db->like('sm.email_notifications',$email_notifications);
		$this->db->from(TBL_SUBADMIN_MODULES." sm");
        $this->db->join(TBL_USERS . ' u', 'u.id = sm.user_id', 'left');
		$records = $this->db->get();
        $result = $records->result_array();	
        return $result;
	}

}