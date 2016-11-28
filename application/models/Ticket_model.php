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
    public function updateField($wherekey, $wherevalue, $update_data, $table) {
        $this->db->where($wherekey, $wherevalue);
        
        if ($this->db->update($table, $update_data)) {
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
        $this->db->select('tickets.*, dept.name as dept_name, type.name as type_name, priority.name as priority_name, status.name as status_name, user.fname, user.lname, staff.fname as staff_fname ,staff.lname as staff_lname');
        $this->db->where('tickets.is_delete', 0);
        $this->db->where('dept.is_delete', 0);
        $this->db->where('tickets.id', $id);
        $this->db->where('tickets.title !=', '');
        $this->db->from(TBL_TICKETS);
        $this->db->join(TBL_DEPARTMENTS . ' dept', 'dept.id = tickets.dept_id', 'left');
        $this->db->join(TBL_TICKET_TYPES . ' type', 'type.id = tickets.ticket_type_id', 'left');
        $this->db->join(TBL_TICKET_PRIORITIES . ' priority', 'priority.id = tickets.priority_id', 'left');
        $this->db->join(TBL_TICKET_STATUSES . ' status', 'status.id = tickets.status_id', 'left');
        $this->db->join(TBL_USERS . ' user', 'user.id = tickets.user_id', 'left');
        $this->db->join(TBL_USERS . ' staff', 'staff.id = tickets.staff_id', 'left');


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
        $this->db->order_by("ticket_conversation.created", "asc");
        $q = $this->db->get();
        $originalArray = $q->result_array();
        $new_arr=array();
        foreach ($originalArray as $key => $part) {
//            $date=date('Y-m-d',strtotime($part['created_date']));
            $date=date('l, M d',strtotime($part['created_date']));
            $new_arr[$date][]=$part;
        }
        return $new_arr;
    }

    public function save_ticket_conversation($msg_data){
        if($this->db->insert(TBL_TICKET_CONVERSATION, $msg_data)){
            return 1;
        }else{
            return 0;
        }
    }

    public function getSeriesName($dept_id){
        $this->db->select('series_name');
        $this->db->from(TBL_DEPARTMENTS);
        $this->db->where('id', $dept_id);
        $q = $this->db->get();
        $data = $q->row();
        return $data->series_name;
    }
    
    
    /**
     * To get department head staff id
     * @param type $dept_id
     * @return type
     */
    public function getDeptStaff($dept_id){
        $this->db->select('*');
        $this->db->from(TBL_STAFF);
        $this->db->where('dept_id', $dept_id);
        $this->db->where('is_head', 1);
        $q = $this->db->get();
//        echo $this->db->last_query();
         $data = $q->row();
        return $data->user_id;
    }
    
    /**
     * To get email Id from the id
     * @param type $id
     * @return type
     */
    public function getStaffEmail($id){
        $this->db->select('*');
        $this->db->from(TBL_USERS);
        $this->db->where('id', $id);
        $q = $this->db->get();
//        echo $this->db->last_query();
         $data = $q->row();
        return $data->email;
    }
}
