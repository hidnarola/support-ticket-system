<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Properties_model extends CI_Model {
	
	/**
     * This function used to get all details by a particular parameters. 
     * @param String $table
     * @param Array $sortArr        	
     * @param Array $condition
     * @param Array $limitArr
     * @return Object        	
     * @author pav
     * */
	public function get_all_details($table = '', $condition = '', $sortArr = '', $limitArr = '') {
        if ($sortArr != '' && is_array($sortArr)) {
            foreach ($sortArr as $sortRow) {
                if (is_array($sortRow)) {
                    $this->db->order_by($sortRow ['field'], $sortRow ['type']);
                }
            }
        }

        if ($limitArr != '') {
            return $this->db->get_where($table, $condition, $limitArr['l1'], $limitArr['l2']);
        } else {
            return $this->db->get_where($table, $condition);
        }
    }

    /**
     * This function used to add or update records in particular table based on condition. 
     * @param String $mode
     * @param String $table
     * @param Array $dataArr        	
     * @param Array $condition
     * @return Integer $affected_row
     * @author pav
     * */
    public function common_insert_update($mode = '', $table = '', $dataArr = '', $condition = '') {
        if ($mode == 'insert') {
            $this->db->insert($table, $dataArr);
        } else if ($mode == 'update') {
            $this->db->where($condition);
            $this->db->update($table, $dataArr);
        }
        $affected_row = $this->db->affected_rows();
        return true;
    }

    /**
     * This function used to get properties details by particular id
     * @param Integer $id
     * @return Object        	
     * @author pav
     * */
    public function get_property_details_by_id($id=''){
    	$this->db->select('prop_list.*,prop_type.name as type_name,prop_cat.name as category_name');
    	$this->db->from(TBL_PROP_LIST.' as prop_list');
    	$this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id');
    	$this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id');
    	$this->db->where('prop_list.is_delete',0);
    	$this->db->where('prop_list.id',$id);
    	return $this->db->get();
    }

    public function get_property_wishlist_by_id($prop_id,$user_id){
        $this->db->select('prop_wish.*');
        $this->db->from(TBL_PROP_WISHLIST.' as prop_wish');
        $this->db->where('prop_wish.property_id',$prop_id);
        $this->db->where('prop_wish.user_id',$user_id);
        return $this->db->get();
    }

    public function get_property_wishlist($where=''){
        $select_qry = "SELECT prop_list.*,prop_wish.id as wish_id,prop_type.name as type_name,prop_cat.name as category_name FROM ". TBL_PROP_LIST ." prop_list JOIN ". TBL_PROP_CAT ." prop_cat ON prop_list.property_category_id=prop_cat.id JOIN ". TBL_PROP_TYPE . " prop_type ON prop_list.property_type_id=prop_type.id LEFT JOIN ". TBL_PROP_WISHLIST . " prop_wish ON prop_list.id=prop_wish.property_id WHERE prop_list.is_delete=0 and prop_list.status='Active'". $where;
        $propertyList = $this->db->query($select_qry);
        return $propertyList;
    }

    /**
     * This function used to get recent property as per limit
     * @param Integer $limit
     * @return Object           
     * @author pav
     * */
    public function get_recent_property($limit=''){
        $this->db->select('prop_list.*,prop_type.name as type_name,prop_cat.name as category_name');
        $this->db->from(TBL_PROP_LIST.' as prop_list');
        $this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id');
        $this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id');
        $this->db->where('prop_list.is_delete',0);
        $this->db->where('prop_list.status','Active');
        $this->db->limit($limit);
        $this->db->order_by('prop_list.created','DESC');
        return $this->db->get();
    }

    /**
     * This function used to get featured property as per limit
     * @param Integer $limit
     * @return Object           
     * @author pav
     * */
    public function get_featured_property($limit=''){
        $this->db->select('prop_list.*,prop_type.name as type_name,prop_cat.name as category_name');
        $this->db->from(TBL_PROP_LIST.' as prop_list');
        $this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id');
        $this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id');
        $this->db->where('prop_list.is_delete',0);
        $this->db->where('prop_list.status','Active');
        $this->db->where('prop_list.is_featured',1);
        $this->db->limit($limit);
        $this->db->order_by('prop_list.created','DESC');
        return $this->db->get();
    }

    public function get_offer_property($limit=''){
        $this->db->select('prop_list.*,prop_type.name as type_name,prop_cat.name as category_name');
        $this->db->from(TBL_PROP_LIST.' as prop_list');
        $this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id');
        $this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id');
        $this->db->where('prop_list.is_delete',0);
        $this->db->where('prop_list.status','Active');
        $this->db->where('prop_list.is_offer',1);
        $this->db->where('prop_list.deal_date_from<=',date('Y-m-d h:i:s'));
        $this->db->where('prop_list.deal_date_to>=',date('Y-m-d h:i:s'));
        $this->db->limit($limit);
        $this->db->order_by('prop_list.created','DESC');
        return $this->db->get();   
    }


    public function get_search_property_details($where='',$order='',$limit=''){
        $select_qry = "SELECT prop_list.*,prop_type.name as type_name,prop_cat.name as category_name FROM ". TBL_PROP_LIST ." prop_list JOIN ". TBL_PROP_CAT ." prop_cat ON prop_list.property_category_id=prop_cat.id JOIN ". TBL_PROP_TYPE . " prop_type ON prop_list.property_type_id=prop_type.id WHERE prop_list.is_delete=0 and prop_list.status='Active'". $where;
        if($order!='')
            $select_qry.=$order;
        if($limit!='')
            $select_qry.=" limit " . $limit;
        $propertyList = $this->db->query($select_qry);
        return $propertyList;
    }

    /**
     * This function used to get min/max of property's price & area 
     * @return Object           
     * @author pav
     * */
    public function get_min_max_price_area(){
        $this->db->select('MIN(prop_list.area) as min_area,MAX(prop_list.area) as max_area,MIN(prop_list.price) as min_price,MAX(prop_list.price) as max_price');
        $this->db->from(TBL_PROP_LIST.' as prop_list');
        return $this->db->get();
    }

    public function get_all_cities(){
        $this->db->distinct();
        $this->db->select('prop_list.locality as cities,COUNT(prop_list.locality) as tot_cities');
        $this->db->from(TBL_PROP_LIST.' as prop_list');
        $this->db->where('prop_list.status','Active');
        $this->db->where('prop_list.locality!=',' ');
        $this->db->group_by('prop_list.locality');
        $this->db->order_by('prop_list.locality','ASC');
        return $this->db->get();
    }
    /**
     * This function used to get landing banner
     * @param array $where
     * @return Object           
     * @author pav
     * */
    public function get_prop_landing_banner($where=''){
        $this->db->select('prop_banner.*,prop_list.price as prop_price,prop_list.reference_number,prop_list.title as prop_title,prop_list.address as prop_address,prop_type.name as type_name,prop_cat.name as category_name,prop_list.id as prop_id,prop_list.rent_type');
        $this->db->from(TBL_PROP_BANNER.' as prop_banner');
        $this->db->join(TBL_PROP_LIST.' as prop_list','prop_banner.property_id=prop_list.id', 'left');
        $this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id', 'left');
        $this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id', 'left');
        $this->db->order_by('prop_banner.position','ASC');
        if($where!=''){
            $this->db->where($where);
        }
        return $this->db->get();
    }

    /**
     * This function used to get landing banner by id
     * @param Integer $id
     * @return Object           
     * @author pav
     * */
    public function get_prop_landing_banner_by_id($id=''){
        $this->db->select('prop_banner.*,prop_list.reference_number,prop_list.title as prop_title,prop_list.area,prop_list.bathroom_no,prop_list.price,prop_list.bedroom_no,prop_type.name as type_name,prop_cat.name as category_name');
        $this->db->from(TBL_PROP_BANNER.' as prop_banner');
        $this->db->join(TBL_PROP_LIST.' as prop_list','prop_banner.property_id=prop_list.id');
        $this->db->join(TBL_PROP_CAT.' as prop_cat','prop_list.property_category_id=prop_cat.id');
        $this->db->join(TBL_PROP_TYPE.' as prop_type','prop_list.property_type_id=prop_type.id');
        $this->db->where('prop_banner.id',$id);
        return $this->db->get();
    }
}

/* End of file Properties_model.php */
/* Location: ./application/models/Properties_model.php */