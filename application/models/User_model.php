<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function check($email, $password) {

        $roles = userRoles();
        $roleIDs = array($roles['admin'], $roles['staff'], $roles['tenant']);
        /* Get password and decrypt it */
        $this->db->select('password');
        $this->db->where('email', $email);
        $q = $this->db->get(TBL_USERS);
        $data = $q->row_array();
        $passworddecrypted = $this->encrypt->decode($data['password']);

        $this->db->select('*');
        $this->db->where('is_delete', 0);
        $this->db->where_in('role_id', $roleIDs);
        $q_data = $this->db->get(TBL_USERS);
        $data_user = $q_data->row_array();
        if ($password == $passworddecrypted) {
            return $data_user;
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

}
