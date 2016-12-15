<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Beacon_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_beacons() {
        $this->db->where('is_delete', 0);
        $this->db->order_by("beacons.created", "desc");
        $query = $this->db->get(TBL_BEACONS);
        $result = $query->result_array();
        return $result;
    }

    public function get_beacon($id) {
        $this->db->where('id', $id);
        $query = $this->db->get(TBL_BEACONS);
        $result = $query->row();
        return $result;
    }

    public function add_beacons($img_array, $table_name) {
        $this->db->insert($table_name, $img_array);
    }

    public function delete($record_id) {
        $this->db->where('id', $record_id);
        $data = array('is_delete' => 1);
        return $this->db->update(TBL_BEACONS, $data);
    }

    public function checkExists($uuid, $major, $minor) {
        $this->db->where('uuid', $uuid);
        $this->db->where('major', $major);
        $this->db->where('minor', $minor);
        $query = $this->db->get(TBL_BEACONS);
        $result = $query->result_array();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function checkExistsEdit($uuid, $major, $minor,$record_id) {
        $this->db->where('uuid', $uuid);
        $this->db->where('major', $major);
        $this->db->where('minor', $minor);
        $this->db->where('id!=', $record_id);
        $query = $this->db->get(TBL_BEACONS);
        $result = $query->result_array();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
