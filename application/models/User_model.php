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
     * @author : Reema  (Rep)
     */
    public function viewAll($table, $limit, $select = '*') {
        $query = "SELECT " . $select . " FROM " . $table . " " . $limit;
        $list = $this->db->query($query);
        return $list->result();
    }

    /**
     * 
     * @param type $table_name
     * @param type $role_id
     * @return type
     * @author : Reema  (Rep)
     */
    public function get_users_records($table_name, $role_id) {
        $this->db->where('role_id!=', 3);
        if ($role_id == 1) {
            $this->db->where('role_id', $role_id);
        } elseif ($role_id == 2) {
            $this->db->where('role_id', $role_id);
        }
        $this->db->where('is_delete', 0);
        $records = $this->db->get($table_name);
        $rec = $records->result_array();
        $users = array();
        foreach ($rec as $key => $value) {
            $users[$key] = $value;
            $passworddecrypted = $this->encrypt->decode($value['password']);
            $users[$key]['password'] = $passworddecrypted;
        }
        return $users;
    }

    /**
     * Check if the value is unique
     * @param type $field
     * @param type $value
     * @param type $table
     * @param type $cnd
     * @param type $id
     * @return type
     * @author : Reema  (Rep)
     */
    public function isUnique($field, $value, $table, $id = '', $cnd = "") {
        if ($id != '')
            $condition = " AND id!= $id";
        else
            $condition = $cnd;
        $query = "SELECT * FROM " . $table . " WHERE " . $field . "='" . $value . "'" . $condition;       
        $result = $this->db->query($query);
        return $result->row();
    }

    function check_email($email) {
        $this->db->select('email');
        $query = $this->db->get_where('users', array('is_delete !=' => 1, 'email' => $email));
        return $query->row_array();
    }

    public function get_role_id($role) {
        $this->db->select('id');
        $this->db->where('name', $role);
        $q = $this->db->get(TBL_ROLES);
        return $q->row_array();
    }

    /**
     * 
     * @param type $id
     * @param type $fieldname
     * @param type $value
     * @param type $table
     * @return boolean
     * @author : Reema  (Rep)
     */
    public function updateField($wherekey, $wherevalue, $fieldname, $value, $table) {
        $query = "update " . $table . " set " . $fieldname . "='" . $value . "' where " . $wherekey . "='" . $wherevalue . "'";
        if ($this->db->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($data, $table, $wherekey, $wherevalue) {
        $this->db->where($wherekey, $wherevalue);
        if ($this->db->update($table, $data)) {
//            echo $this->db->last_query();
//            exit;
            return true;
        } else {
            return false;
        }
    }

    public function passwordExist($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', '');
        $result = $this->db->get(TBL_USERS);
        $data = $result->row_array();
        if ($data['password'] == '') {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * Common View by Id function
     * @param type $id
     * @param type $table
     * @return type
     * @author : Reema  (Rep)
     */
    public function view($id, $table, $select = '*') {
        $this->db->select($select);
        $this->db->where('id', $id);
        $list = $this->db->get($table);
        return $list->row();
    }

}
