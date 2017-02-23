<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Properties extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
        } else {
            $protocol = 'http://';
        }
        $CUrurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $this->session->set_userdata('force_redirect',$CUrurl);
        $this->load->model('Properties_model');
    	$this->data['property_status'] = $this->Properties_model->get_all_details(TBL_PROP_CAT,array('is_delete'=>0,'status'=>'Active'),array(array('field'=>'name','type'=>'ASC')))->result();
		$this->data['property_type'] = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('is_delete'=>0,'status'=>'Active'),array(array('field'=>'name','type'=>'ASC')))->result();
		$this->data['min_max_price_area'] = $this->Properties_model->get_min_max_price_area()->row_array();
    	$this->data['cities_data'] = $this->Properties_model->get_all_cities()->result();
    }

    /**
	 * This function used to display lading page
	 * @author pav
    */
	public function index(){
		$this->data['title'] = 'PropertyFinder';
		$this->data['landing_banner'] = $landing_banner = $this->Properties_model->get_prop_landing_banner(array('prop_banner.status'=>'Active','prop_list.status'=>'Active'))->result();
		$main_property = $this->Properties_model->get_recent_property(1)->result();
		$this->data['main_property'] = $main_property[0];
		$this->data['recent_property'] = $recent_property = $this->Properties_model->get_recent_property(3)->result();
		$this->data['featured_property'] = $featured_property = $this->Properties_model->get_featured_property(3)->result();
		$this->data['offer_property'] = $offer_property = $this->Properties_model->get_offer_property(3)->result();
		$this->template->load('propertyfinder/home','Propertyfinder/Landing/index',$this->data);
	}

	/**
	 * This function used to display single property by id
	 * @author pav
    */
	public function property_details($seourl='',$id=''){
		$record_id = base64_decode($id);
		$property_data = $this->Properties_model->get_property_details_by_id($record_id)->result();
		if(!empty($this->session->userdata('user_logged_in'))){
			$user_id = $this->session->userdata('user_logged_in')['id'];
			$is_in_wishlist = $this->Properties_model->get_property_wishlist_by_id($property_data[0]->id,$user_id)->num_rows();
			$this->data['is_in_wishlist'] = $is_in_wishlist;
		}
		$this->data['title'] = 'PropertyFinder | '.$property_data[0]->title;
		$this->data['property_data'] = $property_data[0];
		if (isset($_SERVER['HTTPS'])) {
		    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
		} else {
		    $protocol = 'http://';
		}
		$CUrurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$this->session->set_userdata('single_property_redirect',$CUrurl);
		$this->template->load('propertyfinder/home','Propertyfinder/Property/single',$this->data);
	}

	/**
	 * This function used to display property as per searching paramter
	 * @author pav
    */
	public function property_search(){

		$this->data['_per_page_property'] = 20;

        if (!empty($_SESSION['_per_page_property']))
            $this->data['_per_page_property'] = $_SESSION['_per_page_property'];

        if (!empty($this->input->get('per_page_property')))
            $this->data['_per_page_property'] = $_SESSION['_per_page_property'] = $this->input->get('per_page_property');

        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
        } else {
            $protocol = 'http://';
        }
        $CUrurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $curUrl = @explode('&pg=', $CUrurl);
        $__page = $this->input->get('pg');
        if (empty($__page) || $__page <= 1) { $__page = 0; } else { $__page --; }
        if (!empty($__page)) {
            $paginationVal = $__page * $this->data['_per_page_property'];
            $limitPaging = $paginationVal . ',' . $this->data['_per_page_property'];
        } else {
            $limitPaging = ' ' . $this->data['_per_page_property'];
        }
        $newPage = $this->input->get('pg') + 1;
        if (strpos($CUrurl, '?') !== false) {
            $qry_str = $curUrl[0] . '&pg=' . $newPage;
        } else {
            $qry_str = $curUrl[0] . '?pg=' . $newPage;
        }
		$this->data['title'] = 'PropertyFinder |';
		$search_query = '';
		$this->data['ps_status'] = $ps_status = $this->input->get('ps');
		$this->data['ps_type'] = $ps_type = $this->input->get('pt');
		$this->data['ps_rs'] = $ps_rs = $this->input->get('rs');
		$this->data['ps_bedrooms'] = $ps_bedrooms = $this->input->get('bd');
		$this->data['ps_bathrooms'] = $ps_bathrooms = $this->input->get('bt');
		$this->data['ps_keyword'] = $ps_keyword = $this->input->get('kw');
		$this->data['ps_pr_t'] = $ps_pr_t = $this->input->get('pr_t');
		$this->data['ps_pr_f'] = $ps_pr_f = $this->input->get('pr_f');
		$this->data['ps_at'] = $ps_at = $this->input->get('at');
		$this->data['ps_af'] = $ps_af = $this->input->get('af');
		$this->data['ps_loc'] = $ps_loc = $this->input->get('loc');
		$this->data['order'] = $order = $this->input->get('order');
		if($ps_status!=''){
			$ps_status_id = explode('-',$ps_status)[0];
			$search_query.=' and prop_cat.id='.$ps_status_id;
		}
		if($ps_type!=''){
			$ps_type_id = explode('-',$ps_type)[0];
			$search_query.=' and prop_type.id='.$ps_type_id;
		}
		if($ps_status!=''){
			$ps_status_id = explode('-',$ps_status)[0];
			$ps_status_name = explode('-',$ps_status)[1];
			if($ps_status_id==4 && $ps_status_name=='Rent' && $ps_rs!=''){
				$search_query.=' and prop_list.rent_type="'.$ps_rs.'"';
			}
		}
		if($ps_bedrooms!=''){ $search_query.=' and prop_list.bedroom_no>='.$ps_bedrooms; }
		if($ps_bathrooms!=''){ $search_query.=' and prop_list.bathroom_no>='.$ps_bathrooms; }
		if($ps_loc!=''){ $search_query.=' and prop_list.locality="'.$ps_loc.'"'; }

		$search_query.=' and prop_list.price>='.$ps_pr_f.' and prop_list.price<='.$ps_pr_t.' and prop_list.area>='.$ps_af.' and prop_list.area<='.$ps_at;
		if(str_replace(' ','',$ps_keyword)!=''){
			$search_query.=" and (prop_list.title LIKE '%".$ps_keyword."%' or prop_list.description LIKE '%".$ps_keyword."%' or prop_list.short_description LIKE '%".$ps_keyword."%' or prop_list.address LIKE '%".$ps_keyword."%')";
		}
		if($order=='' || $order=='latest'){ $order_query = ' ORDER BY prop_list.created DESC'; $this->data['order']='latest'; }
		else if($order=='price_asc'){ $order_query = ' ORDER BY prop_list.price ASC'; }
		else if($order=='price_desc'){ $order_query = ' ORDER BY prop_list.price DESC'; }
		else if($order=='bed_asc'){ $order_query = ' ORDER BY prop_list.bedroom_no ASC'; }
		else if($order=='bed_desc'){ $order_query = ' ORDER BY prop_list.bedroom_no DESC'; }

		$this->data['property_count'] = $this->Properties_model->get_search_property_details($search_query)->num_rows();
		$this->data['properties_data'] = $this->Properties_model->get_search_property_details($search_query,$order_query,$limitPaging)->result();
			
		$this->template->load('propertyfinder/home','Propertyfinder/Property/search',$this->data);	
	}

	public function saved_property(){
		if(empty($this->session->userdata('user_logged_in'))){
			$returnArr = array(
				'flag' => 0
			);
		}else{
			$id = $this->input->post('id');
			if($id==''){
				//echo $this->session->userdata('single_property_redirect'); die;
				redirect($this->session->userdata('single_property_redirect'));
			}else{
				$record_id = base64_decode($id);
				$user_id = $this->session->userdata('user_logged_in')['id'];
				$prop_data = $this->Properties_model->get_all_details(TBL_PROP_WISHLIST,array('user_id'=>$user_id,'property_id'=>$record_id));
				if($prop_data->num_rows()>0){

				}else{
					$insertArr = array(
						'user_id' => $user_id,
						'property_id' => $record_id
					);
					$this->Properties_model->common_insert_update('insert',TBL_PROP_WISHLIST,$insertArr);
				}

			}
			$returnArr = array(
				'flag' => 1
			);
		}
		echo json_encode($returnArr);
	}

	public function saved_property_list(){
		$this->data['title'] = 'PropertyFinder | Your Wishlist';
		$user_id = $this->session->userdata('user_logged_in')['id'];
		if($user_id==''){
			redirect('property-finder');
		}
		$where = ' and prop_wish.user_id='.$user_id;
		$this->data['wishlist_data'] = $this->Properties_model->get_property_wishlist($where)->result();
		$this->template->load('propertyfinder/home','Propertyfinder/Property/wishlist',$this->data);	
	}

	public function test(){
        $this->load->view('Propertyfinder/test.php');
    }

}

/* End of file Properties.php */
/* Location: ./application/controllers/Properties.php */