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

    public function get_users_records($table_name,$role_id) {
        $this->db->where('role_id!=', 3);
        if ($role_id == 1) {
            $this->db->where('role_id', $role_id);
        } elseif ($role_id == 2) {
            $this->db->where('role_id', $role_id);
        }
        $this->db->where('is_delete', 0);
        $records = $this->db->get($table_name);
        $rec =  $records->result_array();
        $users = array(); 
        foreach ($rec as $key => $value) {
            $users[$key]=$value;
            $passworddecrypted = $this->encrypt->decode($value['password']);
            $users[$key]['password'] =  $passworddecrypted;
        }
        return $users;
    }
    
    /**
     *  Check if the value is unique
     */
    public function isUnique($field, $value, $table, $cnd = "", $id = '') {
        if ($id != '')
            $condition = "AND id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;
        $result = $this->db->query($query);
        return $result->row();
    }

}
