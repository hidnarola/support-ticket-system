<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data($type) {
        $this->db->select('*,c.name as cat_name,articles.created as a_created,articles.id as aid');
         $this->db->join('categories as c', 'c.id = articles.category_id', 'left');
        $this->db->where('articles.is_delete', 0);
      
        $this->db->order_by('articles.modified', 'desc');
        $result = $this->db->get(TBL_ARTICLES);
        return $result->result_array();
    }

    function get_data_by_id($id) {
        $this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $result = $this->db->get(TBL_ARTICLES);
        return $result->row_array();
    }

    function add($data) {
        if ($this->db->insert(TBL_ARTICLES, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function edit($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update(TBL_ARTICLES, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

      /**
     * Common View by Id function
     * @param type $id
     * @param type $table
     * @return type
     * @author : Reema  (Rep)
     */
    public function viewArticle($id, $table) {
        $this->db->select('*');
        $this->db->join('categories as c', 'articles.category_id = c.id', 'left');
        $this->db->where('articles.id', $id);
        $list = $this->db->get($table);
        return $list->row();
    }
}
