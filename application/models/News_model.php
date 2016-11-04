<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data($type){
    	$this->db->where('is_delete', 0);
    	if($type!=null){
    		$this->db->where('is_news', $type);
    	}
    	$this->db->order_by('modified', 'desc');
    	$result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
    	return $result->result_array();
    }

    function get_data_by_id($id){
    	$this->db->where('is_delete', 0);
    	$this->db->where('id', $id);
    	$result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
    	return $result->row_array();
    }

    function add($data){
    	if ($this->db->insert(TBL_NEWS_ANNOUNCEMENTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function edit($data, $id){
	 	$this->db->where('id', $id);
        if ($this->db->update(TBL_NEWS_ANNOUNCEMENTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function search_news($text, $type){
    	$this->db->where('is_delete', 0);
    	if($type!=null){
    		$this->db->where('is_news', $type);
    	}
    	$this->db->group_start();
        $this->db->like('title', $text);
        $this->db->or_like('description', $text);
        $this->db->group_end();
    	$this->db->order_by('modified', 'desc');
    	$result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
    	return $result->result_array();
    }

}