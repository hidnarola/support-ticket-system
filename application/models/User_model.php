<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function check($email, $password) {

        /* Get password and decrypt it */
        $this->db->where('email', $email);
        $this->db->where('is_delete', 0);
        $q = $this->db->get(TBL_USERS);
        $data = $q->row_array();
        $passworddecrypted = $this->encrypt->decode($data['password']);

        if ($password == $passworddecrypted) {
            return $data;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $table
     * @param type $limit
     * @param type $select
     * @return type
     */
    public function viewAll($table, $limit, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " " . $limit;
        $list = $this->db->query($query);
        return $list->result();
    }

    public function get_role_id($role){
        $this->db->select('id');
        $this->db->where('name',$role);
        $q = $this->db->get(TBL_USERS_ROLES);
        return $q->row_array();
    }

}
