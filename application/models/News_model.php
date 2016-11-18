<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data($type) {
        $this->db->where('is_delete', 0);
        if ($type != null) {
            $this->db->where('is_news', $type);
        }
        $this->db->order_by('modified', 'desc');
        $result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
        return $result->result_array();
    }

    function get_data_by_id($id) {
        $this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
        return $result->row_array();
    }

    function add($data) {
        if ($this->db->insert(TBL_NEWS_ANNOUNCEMENTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function edit($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update(TBL_NEWS_ANNOUNCEMENTS, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    function search_news($text, $type) {
        $this->db->where('is_delete', 0);
        if ($type != null) {
            $this->db->where('is_news', $type);
        }
        $this->db->group_start();
        $this->db->like('title', $text);
        $this->db->or_like('description', $text);
        $this->db->group_end();
        $this->db->order_by('modified', 'desc');
        $result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
        return $result->result_array();
    }

    function get_news_announcements($type) {
        $this->db->where('is_delete', 0);

        $this->db->where('is_news', $type);
        $this->db->order_by('modified', 'desc');
        $result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
        return $result->result_array();
    }
    
    function get_data_by_slug($slug) {
        $this->db->where('is_delete', 0);
        $this->db->where('slug', $slug);
        $result = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
        return $result->row_array();
    }
    
    /**
     * To check unique title for aricle and if it is, will append -1 to the title
     * @param type $title
     * @param type $id
     * @return string
     */
    public function get_unique_title($title, $id = NULL) {

        for ($i = 0; $i < 1; $i++) {
            if ($id != NULL) {
                $this->db->where('id!=', $id);
            }
            $this->db->where('is_delete', 0);
            $this->db->where('title', $title);
            $query = $this->db->get(TBL_NEWS_ANNOUNCEMENTS);
            $result = $query->row_array();

            if ($result) {
                $explode_slug = explode("-", $title);
                $last_char = $explode_slug[count($explode_slug) - 1];
                if (is_numeric($last_char)) {
                    $last_char++;
                    unset($explode_slug[count($explode_slug) - 1]);
                    $title = implode($explode_slug, "-");
                    $title.="-" . $last_char;
                } else {
                    $title.="-1";
                }
//                $text = $text . time();
                $i--;
            } else {
                return $title;
            }
        }
    }

}
