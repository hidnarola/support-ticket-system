<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }

	public function get_records( $table_name, $id = '' ) {
        if($id != ''){
            $this->db->where('id', $id);
        }
        $this->db->where('is_delete', 0);
        $records = $this->db->get($table_name);
        return $records->result_array();
    }

    public function record_exist( $table_name, $conditions ){
        if(is_array($conditions) && count($conditions) > 0){
            foreach ($conditions as $column_name => $value) {
                $this->db->where($column_name, $value);
            }
        }
        $records = $this->db->get($table_name);
        return count($records->result_array());
    }
    
    public function manage_record( $table_name, $record_array, $primary_id = '' ){
        if($primary_id != ''){
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

    public function delete($table_name, $record_id){
    	$record_array = array('is_delete'=>1);
    	$this->db->where('id', $record_id);
    	if($this->db->update($table_name, $record_array)) {
            return 1;
        } else {
            return 0;
        }
    }
}