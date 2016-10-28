<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {

    /**
     *  @param type $id
     * @param type $fieldname
     * @param type $value
     * @param type $table
     * @return boolean
     * @author : Reema  (Rep)
     */
    public function updateField($wherekey, $wherevalue, $fieldname, $value, $table) {
        $query = "update " . $table . " set " . $fieldname . "='" . $value . "' where " . $wherekey . "='" . $wherevalue . "'";
//        echo $query;
//        exit;
        if ($this->db->query($query)) {
            return true;
        } else {
            return false;
        }
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

    /**
     * @author : Reema  (Rep)
     * @return type
     */
    public function get_ticket($id) {
        $this->db->select('tickets.*, dept.name as dept_name, type.name as type_name, priority.name as priority_name, status.name as status_name, user.fname, user.lname, category.name as category_name, staff.fname as staff_fname ,staff.lname as staff_lname');
        $this->db->where('tickets.is_delete', 0);
        $this->db->where('tickets.id', $id);
        $this->db->from(TBL_TICKETS);
        $this->db->join(TBL_DEPARTMENTS . ' dept', 'dept.id = tickets.dept_id', 'left');
        $this->db->join(TBL_TICKET_TYPES . ' type', 'type.id = tickets.ticket_type_id', 'left');
        $this->db->join(TBL_TICKET_PRIORITIES . ' priority', 'priority.id = tickets.priority_id', 'left');
        $this->db->join(TBL_TICKET_STATUSES . ' status', 'status.id = tickets.status_id', 'left');
        $this->db->join(TBL_USERS . ' user', 'user.id = tickets.user_id', 'left');
        $this->db->join(TBL_USERS . ' staff', 'staff.id = tickets.staff_id', 'left');
        $this->db->join(TBL_CATEGORIES . ' category', 'category.id = tickets.category_id', 'left');

        $query = $this->db->get();
//        echo $this->db->last_query();
//        echo '<pre>';
//        print_r($query->row());exit;
        return $query->row();
    }

    /**
     * @author : Reema  (Rep)
     * @return type
     */
    public function isTicketRead($id) {
        $this->db->select('is_read');
        $this->db->from(TBL_TICKETS);
        $this->db->where('id', $id);
        $q = $this->db->get();
        $data = $q->row();
        return $data->is_read;
    }

    /**
     * @author : Reema  (Rep)
     * @return type
     */
    public function get_ticket_conversation($id) {
        $this->db->select('*,ticket_conversation.created as created_date');
        $this->db->from(TBL_TICKET_CONVERSATION);
        $this->db->join(TBL_TICKETS . ' tickets', 'tickets.id = ticket_conversation.ticket_id', 'left');
        $this->db->join(TBL_USERS . ' user', 'user.id = ticket_conversation.sent_from', 'left');
        $this->db->where('tickets.id', $id);
        $q = $this->db->get();
        $originalArray = $q->result_array();
//         echo '<pre>';
//        print_r($originalArray);
        $new_arr=array();
        foreach ($originalArray as $key => $part) {
//            $date=date('Y-m-d',strtotime($part['created_date']));
            $date=date('l, M d',strtotime($part['created_date']));
            $new_arr[$date][]=$part;
        }
        return $new_arr;
//         echo '<pre>';
//        print_r($new_arr);
//        exit;
    }

}
