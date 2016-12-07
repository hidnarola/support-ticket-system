<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_data() {
        $this->db->select('articles.id,title,slug,description,image,category_id,user_id,is_visible,expiry_date,articles.is_delete,articles.created,articles.modified,c.name as cat_name');
        $this->db->join('categories as c', 'c.id = articles.category_id', 'left');
        $this->db->where('articles.is_delete', 0);
        $this->db->order_by('articles.modified', 'desc');
        $result = $this->db->get(TBL_ARTICLES);
        return $result->result_array();
//        pr($result->result_array(),1);
    }

    /**
     * 
     * @param type $keyword
     * @return type
     */
    function getarticles($keyword) {
        $this->db->select('articles.id,title,slug,description,image,category_id,user_id,is_visible,expiry_date,articles.is_delete,articles.created,articles.modified,c.name as cat_name');
        $this->db->join('categories as c', 'c.id = articles.category_id', 'left');
        $this->db->where('articles.is_delete', 0);
        $this->db->like('title', $keyword);
        $result = $this->db->get(TBL_ARTICLES);
        return $result->result_array();
//        pr($result->result_array(),1);
    }

    function get_data_by_id($id) {
        $this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $result = $this->db->get(TBL_ARTICLES);
        return $result->row_array();
    }

    function get_data_by_slug($slug) {
        $this->db->where('is_delete', 0);
        $this->db->where('slug', $slug);
        $result = $this->db->get(TBL_ARTICLES);
        return $result->row_array();
    }

    /**
     * To display related articles in fronend side
     * @param type $category_id
     * @param type $id
     * @return type
     */
    function get_other_articles($category_id, $id) {
        $this->db->select('articles.id,title,slug,description,image,category_id,user_id,is_visible,expiry_date,articles.is_delete,articles.created,articles.modified,c.name as cat_name');
        $this->db->join('categories as c', 'c.id = articles.category_id', 'left');
        $this->db->where('articles.is_delete', 0);
        $this->db->where('articles.category_id', $category_id);
        $this->db->where_not_in('articles.id', $id);
        $this->db->order_by('articles.id', 'DESC');
        $this->db->limit('4');

//        $this->db->order_by('articles.modified', 'desc');
        $result = $this->db->get(TBL_ARTICLES);
        return $result->result_array();
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
//            echo $this->db->last_query();
//            exit;
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
        $this->db->select('articles.id,title,slug,description,image,category_id,user_id,is_visible,expiry_date,articles.is_delete,articles.created,articles.modified,c.name as cat_name');
        $this->db->join('categories as c', 'articles.category_id = c.id', 'left');
        $this->db->where('articles.id', $id);
        $list = $this->db->get($table);
        return $list->row();
    }

    /**
     * @author : Reema  (Rep)
     * @return type
     */
    public function get_articles($cat=null) {
        $this->db->select('*');
        $this->db->where(TBL_ARTICLES.'.is_delete', 0);
        $this->db->where('c.is_delete', 0);
        if($cat!=null){
            $this->db->like('c.name', $cat);
        }
        $this->db->from(TBL_ARTICLES);
        $this->db->join(TBL_CATEGORIES . ' c', 'c.id = articles.category_id', 'left');
        // $this->db->order_by("articles.created", "desc");
        $this->db->order_by("c.name", "asc");
        $q = $this->db->get();
        $originalArray = $q->result_array();
        $new_arr = array();
        foreach ($originalArray as $key => $part) {
            $new_arr[$part['name']][] = $part;
        }
        return $new_arr;
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
            $query = $this->db->get(TBL_ARTICLES);
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

    /**
     * 
     * @param type $text
     * @param type $type
     * @return type
     */
    public function search_article($text) {
        $this->db->select('articles.id,title,slug,description,image,category_id,user_id,is_visible,expiry_date,articles.is_delete,articles.created,articles.modified,c.name as cat_name');
        $this->db->join(TBL_CATEGORIES . ' c', 'c.id = articles.category_id', 'left');
        $this->db->where('articles.is_delete', 0);

        $this->db->group_start();
        $this->db->like('title', $text);
        $this->db->or_like('description', $text);
        $this->db->group_end();
        $this->db->order_by('modified', 'desc');
        $result = $this->db->get(TBL_ARTICLES);
        return $result->result_array();
    }

    public function get_faq() {
        $this->db->select('*,faq.id fid');
        $this->db->join(TBL_CATEGORIES . ' c', 'c.id = faq.category_id', 'left');
        $this->db->where('faq.is_delete', 0);
        $this->db->order_by('faq.modified', 'desc');
        $result = $this->db->get(TBL_FAQ);

        $originalArray = $result->result_array();
        $new_arr = array();
        foreach ($originalArray as $key => $part) {
            $new_arr[$part['name']][] = $part;
        }
        return $new_arr;
    }

    public function get_category($id){
        $this->db->select('name');
        $this->db->where('is_delete', 0);
        $this->db->where('id', $id);
        $result = $this->db->get(TBL_CATEGORIES);
        $category = $result->row_array();
        return str_replace(" ", "-", strtolower($category['name']));
    }



}
