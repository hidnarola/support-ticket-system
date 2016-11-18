<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_total_tickets($id) {
        $this->db->where('is_delete', 0);
        $this->db->where('staff_id', $id);
        $result = $this->db->get(TBL_TICKETS);
        return $result->num_rows();
    }

    public function get_total_replies($id) {
        // $this->db->where('is_delete',0);
        $this->db->where('sent_from', $id);
        $result = $this->db->get(TBL_TICKET_CONVERSATION);
        return $result->num_rows();
    }

    public function get_tickets($id, $limit = null) {
        $this->db->select('tickets.*, dept.name as dept_name, type.name as type_name, priority.name as priority_name, status.name as status_name, user.fname, user.lname,staff.fname as staff_fname ,staff.lname as staff_lname');
        $this->db->where('tickets.is_delete', 0);
        $this->db->where('tickets.staff_id', $id);
        $this->db->where('tickets.title !=', '');
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
        //$this->db->join(TBL_CATEGORIES . ' category', 'category.id = tickets.category_id', 'left');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_profile($id) {
        $this->db->select('users.*, dept.id as dept_id, dept.name as dept_name,');
        $this->db->where('users.id', $id);
        $this->db->where('users.is_delete', 0);
        $result = $this->db->from(TBL_USERS);
        $this->db->join(TBL_STAFF . ' staff', 'staff.user_id = users.id');
        $this->db->join(TBL_DEPARTMENTS . ' dept', 'dept.id = staff.dept_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    
    /**
     * @author : Reema  (Rep)
     * @return type
     */
    public function get_ticket_conversation($id) {
        $this->db->select('*,ticket_conversation.id as ticket_conversation_id,ticket_conversation.created as created_date');
        $this->db->from(TBL_TICKET_CONVERSATION);
        $this->db->join(TBL_TICKETS . ' tickets', 'tickets.id = ticket_conversation.ticket_id', 'left');
        $this->db->join(TBL_USERS . ' user', 'user.id = ticket_conversation.sent_from', 'left');
        $this->db->where('tickets.id', $id);
        $this->db->order_by("ticket_conversation.created", "asc");
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
