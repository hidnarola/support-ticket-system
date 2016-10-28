<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_records($table_name, $id = '') {
        if ($id != '') {
            $this->db->where('id', $id);
        }
        $this->db->where('is_delete', 0);
        $records = $this->db->get($table_name);
        return $records->result_array();
    }

    public function record_exist($table_name, $conditions) {
        if (is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $column_name => $value) {
                $this->db->where($column_name, $value);
            }
        }
        $records = $this->db->get($table_name);
        return count($records->result_array());
    }

    public function manage_record($table_name, $record_array, $primary_id = '') {
        if ($primary_id != '') {
            $this->db->where('id', $primary_id);
            if ($this->db->update($table_name, $record_array)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            if ($this->db->insert($table_name, $record_array)) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    /**
     * Get Last Inserted Id
     * @param type $table
     * @return type
     * @author Reema (rep)
     */
    public function getLastInsertId($table) {
        $insert_id = $this->db->insert_id($table);
        return $insert_id;
    }

    public function get_total($tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('is_delete', 0);
        $result = $this->db->get();
        $data = $result->row();
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {
            return FALSE;
        }
    }

    public function get_total_users($role_id) {
        $this->db->select('*');
        $this->db->from(TBL_USERS);
        if ($role_id == 1) {
            $this->db->where('role_id', $role_id);
        } elseif ($role_id == 2) {
            $this->db->where('role_id', $role_id);
        }
        $this->db->where('is_delete', 0);
        $result = $this->db->get();
        $data = $result->row();
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {
            return FALSE;
        }
    }

    public function delete($table_name, $record_id) {
        $record_array = array('is_delete' => 1);
        $this->db->where('id', $record_id);
        if ($this->db->update($table_name, $record_array)) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Get field by Id
     * @author : Reema  (Rep)
     */
    public function getFieldById($id, $field, $table) {
        $this->db->select($field);
        $this->db->where('id', $id);
        $result = $this->db->get($table);
//        echo $this->db->last_query();
       return $result->row()->password;
    }


    public function get_profile($id){
        $this->db->where('id', $id);
        $this->db->where('is_delete',0);
        $result = $this->db->get(TBL_USERS);
        return $result->row_array();
    }

    /**
     * @author : Reema  (Rep)
     * @return type
     */
     public function get_tickets($limit=null){
    	$this->db->select('tickets.*, dept.name as dept_name, type.name as type_name, priority.name as priority_name, status.name as status_name, user.fname, user.lname, category.name as category_name');
    	$this->db->where('tickets.is_delete',0);
    	if($limit != null){
    		$this->db->limit(10);
    	}
		$this->db->from(TBL_TICKETS);
		$this->db->join(TBL_DEPARTMENTS.' dept', 'dept.id = tickets.dept_id', 'left');
		$this->db->join(TBL_TICKET_TYPES.' type', 'type.id = tickets.ticket_type_id', 'left');
		$this->db->join(TBL_TICKET_PRIORITIES.' priority', 'priority.id = tickets.priority_id', 'left');
		$this->db->join(TBL_TICKET_STATUSES.' status', 'status.id = tickets.status_id', 'left');
        $this->db->join(TBL_USERS.' user', 'user.id = tickets.user_id', 'left');
        $this->db->join(TBL_CATEGORIES.' category', 'category.id = tickets.category_id', 'left');
		$query = $this->db->get();
//                pr($query->result_array());exit;
    	return $query->result_array();
    }

    public function get_company_details(){
        $this->db->from(TBL_SETTINGS);
        $this->db->like('key', 'company');
        return $this->db->get()->result_array();
    }

    public function save_company_details($company_data){
        $data = array();
        foreach ($company_data as $key => $value) {
            $arr = array(
                'key' => $key,
                'value' => $value
                );
            $data[] = $arr;
        }
        if($this->db->update_batch(TBL_SETTINGS, $data, 'key')){
            return true;
        }else{
            return false;
        }
    }
}
