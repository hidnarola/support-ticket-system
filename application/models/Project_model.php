<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data() {
        $this->db->where('is_delete', 0);
        
        $this->db->order_by('modified', 'desc');
        $result = $this->db->get(TBL_PROJECTS);
        return $result->result_array();
    }

    function get_data_by_id($id) {
        $this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $result = $this->db->get(TBL_PROJECTS);
        return $result->row_array();
    }

    function add($data) {
        if ($this->db->insert(TBL_PROJECTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function edit($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update(TBL_PROJECTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }
}