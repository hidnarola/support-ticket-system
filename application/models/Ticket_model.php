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
}