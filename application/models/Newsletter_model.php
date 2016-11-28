<?php

class Newsletter_model extends CI_Model {

    /**
     * @method : get_result
     * @uses : This function is used get result from the table
     * @param : @table 
     */
    public function get_result($table, $condition = null) {
        $this->db->select('*');
        if (!is_null($condition)) {
            $this->db->where($condition);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /**
     * @method : insert
     * @uses : Insert user record into table
     * @param : @table = table name, @array = array of insert
     * @return : insert_id else 0
     */
    public function insert($table, $array) {
        if ($this->db->insert($table, $array)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function get_newsletters() {
        $this->db->select('nl.*, ns.id as setting_id, ns.content, ns.is_auto');
        $this->db->where('nl.is_delete', 0);
        $this->db->from(TBL_NEWSLETTERS . ' nl');
        $this->db->join(TBL_NEWSLETTER_SETTINGS . ' ns', 'ns.newsletter_id = nl.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_subscribers() {
        $this->db->where('is_delete', 0);
        $query = $this->db->get(TBL_NEWSLETTER_SUBSCRIBERS);
        return $query->result_array();
    }

    public function update_record($table, $condition, $user_array) {
        $this->db->where($condition);
        if ($this->db->update($table, $user_array)) {
            return 1;
        } else {
            return 0;
        }
    }
    public function update_record_rec($table, $condition, $user_array) {
        $query = "update " . $table . " set email_ids= Concat(email_ids , '," . $user_array . "') where " . $condition;
//        echo $query;exit;
//        $this->db->query($query);
        $result = $this->db->query($query);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_newsletter_testing_emails($newseletter_id) {
        $this->db->select('email_ids');
        $this->db->where('newsletter_id', $newseletter_id);
        $query = $this->db->get(TBL_NEWSLETTERS_TEST_EMAILS);
        return $query->result_array();
    }

    public function get_users_for_newsletter($newsletter_id) {
        $this->db->select('email_ids');
        $this->db->where('newsletter_id', $newsletter_id);
        $query = $this->db->get(TBL_NEWSLETTERS_TEST_EMAILS);
        $email_ids_string = $query->row_array();
        $email_ids = explode(",", $email_ids_string['email_ids']);
        return $email_ids;
    }

    function check_email($email) {
        $this->db->select('email');
        $query = $this->db->get_where(TBL_NEWSLETTER_SUBSCRIBERS, array('is_delete !=' => 1, 'email' => $email));
        return $query->row_array();
    }

    /**
     * 
     * @param type $keyword
     * @return type
     */
    function get_emails($keyword) {
        $this->db->select('*');
        $this->db->where('is_delete', 0);
        $this->db->like('email', $keyword);
        $result = $this->db->get(TBL_NEWSLETTER_SUBSCRIBERS);
//        echo $this->db->last_query();
//        pr($result->result_array(),1);
        return $result->result_array();
    }

    function get_emails_subscribers() {
        $this->db->select('*');
        $this->db->where('is_delete', 0);
        $result = $this->db->get(TBL_NEWSLETTER_SUBSCRIBERS);
        return $result->result_array();
    }

}
