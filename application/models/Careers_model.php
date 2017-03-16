<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Careers_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function add_careers($data) {
        $this->db->insert('careers', $data);
        return $this->db->insert_id();
    }

}