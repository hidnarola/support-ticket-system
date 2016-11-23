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


    public function rows_of_table($table,$condition = null){
        $this->db->select('*');
        if($condition != null)
            $this->db->where($condition);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

     public function get_pages_result($table, $select = null, $type) {
        $columns = ['id', 'navigation_name', 'title'];
        $this->db->select($select,FALSE);
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('navigation_name LIKE "%'.$this->db->escape_like_str($keyword['value']).'%" OR title LIKE "%'.$this->db->escape_like_str($keyword['value']).'%"',NULL);
        }
        $this->db->join(TBL_PAGES.' p1','p1.id = p.parent_id','LEFT');
        $this->db->order_by($columns[$this->input->get('order')[0]['column']],$this->input->get('order')[0]['dir']);
        $this->db->where('p.active',1);
        if($type == 'count'){
            $query = $this->db->get($table);
            return $query->num_rows();
        } else {
            $query = $this->db->get($table);
            $this->db->limit($this->input->get('length'),$this->input->get('start'));
            return $query->result_array();
        }
    }
    public function get_result_header_footer($table, $condition = null, $select = null, $order_type) {
        if($select == null)
            $this->db->select('*');
        else 
            $this->db->select($select);
        if(!is_null($condition)){
            $this->db->where($condition);                
        }
        if($order_type == 'footer_position'){
            $this->db->having('is_parent = 0');
        }

        $this->db->order_by($order_type,'ASC');
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_menu_pages($type){
        $this->db->select('navigation_name, id, url, parent_id, active, (SELECT count(*) FROM '.TBL_PAGES.' WHERE parent_id = p.id) AS is_parent');
        if($type == 'header'){
            $this->db->where('show_in_header = 1');
            $this->db->order_by('header_position','ASC');
        }
        if($type == 'footer'){
            $this->db->where('show_in_footer = 1');
            $this->db->order_by('footer_position','ASC');
            $this->db->having('is_parent = 0');
        }
        $this->db->where('active', 1);
        $query = $this->db->get(TBL_PAGES.' p');
        return $query->result_array();
    }

    public function get_result($table,$condition = null) {
        $this->db->select('*');
        if(!is_null($condition)){
            $this->db->where($condition);                
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }
}