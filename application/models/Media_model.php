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

    public function get_logo_images(){
        $this->db->where('is_delete', 0);
        $query = $this->db->get(TBL_LOGOS);
        $result = $query->result_array();
        return $result;
    }

    public function add_images($img_array, $table_name){
        $this->db->insert($table_name, $img_array);
    }

    public function delete($record_id){
    	$this->db->where('id', $record_id);
        $data = array('is_delete'=>1);
        return $this->db->update(TBL_MEDIA, $data);
    }

}