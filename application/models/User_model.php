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
        if ($data['email'] != '' && $data['password'] == '') {
            return $data;
        } else {
            if ($password == $passworddecrypted) {

                return $data;
            } else {
                return FALSE;
            }
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
        $this->db->select('*,users.id as uid');
        $this->db->where('users.role_id!=', 3);
        if ($role_id == 1) {
            $this->db->where('users.role_id', $role_id);
        } elseif ($role_id == 2) {
            $this->db->where('users.role_id', $role_id);
        }
        $this->db->join('staff as s', 's.user_id = users.id', 'left');
        $this->db->join('departments as d', 'd.id = s.dept_id', 'left');
        $this->db->where('users.is_delete', 0);
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
//        $this->db->where('password', '');
        $result = $this->db->get(TBL_USERS);
        $data = $result->row_array();
        return $data;
//        if ($data['password'] == '') {
//            return 0;
//        } else {
//            return 1;
//        }
    }

    /**
     * Common View by Id function
     * @param type $id
     * @param type $table
     * @return type
     * @author : Reema  (Rep)
     */
    public function viewUser($id, $table, $select = '*') {
        $this->db->select('*,users.id as uid');
        $this->db->join('staff as s', 's.user_id = users.id', 'left');
        $this->db->where('users.id', $id);
        $list = $this->db->get($table);
        return $list->row();
    }

    public function get_password($id) {
        $this->db->select('password');
        $this->db->where('id', $id);
        $list = $this->db->get(TBL_USERS);
        return $list->row_array();
    }

    /**
     * Get field by Id
     * @author : Reema  (Rep)
     */
    public function getFieldById($id, $field, $table) {
        $this->db->select($field);
        $this->db->where('id', $id);
        $result = $this->db->get($table);
//        echo $this->db->last_query();
        return $result->row();
    }

    /**
     * Get field by Id
     * @author : Reema  (Rep)
     */
    public function getUserById($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $q = $this->db->get(TBL_USERS);
        return $q->row_array();
    }

    public function getUserTickets($id,$type=NULL, $limit = null) {
        $this->db->select('tickets.*, dept.name as dept_name, type.name as type_name, priority.name as priority_name, status.name as status_name, user.fname, user.lname, category.name as category_name,staff.fname as staff_fname ,staff.lname as staff_lname');
        $this->db->where('tickets.is_delete', 0);
        $this->db->where('tickets.user_id', $id);
        if ($type != null) {
            $this->db->where('tickets.status_id', $type);
        }
        if ($limit != null) {
            $this->db->limit(10);
        }
        $this->db->from(TBL_TICKETS);
        $this->db->join(TBL_DEPARTMENTS . ' dept', 'dept.id = tickets.dept_id', 'left');
        $this->db->join(TBL_TICKET_TYPES . ' type', 'type.id = tickets.ticket_type_id', 'left');
        $this->db->join(TBL_TICKET_PRIORITIES . ' priority', 'priority.id = tickets.priority_id', 'left');
        $this->db->join(TBL_TICKET_STATUSES . ' status', 'status.id = tickets.status_id', 'left');
        $this->db->join(TBL_USERS . ' user', 'user.id = tickets.user_id', 'left');
        $this->db->join(TBL_USERS . ' staff', 'staff.id = tickets.staff_id', 'left');
        $this->db->join(TBL_CATEGORIES . ' category', 'category.id = tickets.category_id', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }

}
