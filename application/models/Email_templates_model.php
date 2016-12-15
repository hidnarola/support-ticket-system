<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_templates_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_templates(){
    	$this->db->where('is_delete', 0);
    	$result = $this->db->get(TBL_EMAIL_TEMPLATES);
        return $result->result_array();
    }

    public function add_template($template){
    	$this->db->insert(TBL_EMAIL_TEMPLATES, $template);
    	return true;
    }

    public function update_template($id, $template){
    	$this->db->where('id', $id);
    	$this->db->update(TBL_EMAIL_TEMPLATES, $template);
    	return true;
    }

    public function get_template($id){
    	$this->db->where('is_delete', 0);
    	$this->db->where('id', $id);
    	$result = $this->db->get(TBL_EMAIL_TEMPLATES);
        return $result->row_array();
    }
}