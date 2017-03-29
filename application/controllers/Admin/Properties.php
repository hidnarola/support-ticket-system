<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Properties extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->data = array();
        check_isvalidated();
        $this->load->model('Properties_model');
        $this->load->model('Admin_model');
    }

    /**
	 * This function is used to DISPLAY, ADD, EDIT property_category details
	 * @author : pav
    */
	public function category_display(){
		$segment = $this->uri->segment(3);
        check_permissions(1);
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = $this->data['record_type'] = 'Property Contract';
        $this->data['icon_class'] = 'icon-grid2';
        $this->data['categories'] = $this->Admin_model->get_records(TBL_PROP_CAT);
        $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Enter Name.'));

        if ($this->form_validation->run() == TRUE) {
            $name = $this->input->post('name');
            $record_id = $this->input->post('record_id');
            $record_array = array(
                'name' => $name,
                'created' => date('Y-m-d H:i:s')
            );
            if ($record_id != '') {
                $record_exist_condition = array(
                    'id' => $record_id
                );
                if ($this->Admin_model->record_exist(TBL_PROP_CAT, $record_exist_condition)) {
                    if ($this->Admin_model->manage_record(TBL_PROP_CAT, $record_array, $record_id)) {
                        $this->session->set_flashdata('success_msg', 'Record saved successfully.');
                        redirect('admin/properties/category');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                        redirect('admin/properties/category');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'No such record found. Please try again..!!');
                    redirect('admin/properties/category');
                }
            } else {
                if ($this->Admin_model->manage_record(TBL_PROP_CAT, $record_array)) {
                    $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                    redirect('admin/properties/category');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to save detail. Please try again..!!');
                    redirect('admin/properties/category');
                }
            }
        }
        $this->template->load('admin', 'Admin/Properties/cat_display', $this->data);
	}

	/**
	 * This function is used to DISPLAY, ADD, EDIT property_type details
	 * @author : pav
    */
	public function type_display(){
		$segment = $this->uri->segment(3);
        check_permissions(1);
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = $this->data['record_type'] = 'Property Category';
        $this->data['icon_class'] = 'icon-list';
        $this->data['types'] = $this->Admin_model->get_records(TBL_PROP_TYPE);
        $this->form_validation->set_rules('name', 'Name', 'trim|required', array('required' => 'Enter Name.'));

        if ($this->form_validation->run() == TRUE) {
            $name = $this->input->post('name');
            $record_id = $this->input->post('record_id');
            $record_array = array(
                'name' => $name
            );
            if ($record_id != '') {
                $record_exist_condition = array(
                    'id' => $record_id
                );
                $record_array['modified'] = date('Y-m-d h:i:s');
                if ($this->Admin_model->record_exist(TBL_PROP_TYPE, $record_exist_condition)) {
                    if ($this->Admin_model->manage_record(TBL_PROP_TYPE, $record_array, $record_id)) {
                        $this->session->set_flashdata('success_msg', 'Record saved successfully.');
                        redirect('admin/properties/type');
                    } else {
                        $this->session->set_flashdata('error_msg', 'Issue to save detail. Please try again..!!');
                        redirect('admin/properties/type');
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'No such record found. Please try again..!!');
                    redirect('admin/properties/type');
                }
            } else {
                if ($this->Admin_model->manage_record(TBL_PROP_TYPE, $record_array)) {
                    $this->session->set_flashdata('success_msg', 'Detail saved successfully.');
                    redirect('admin/properties/type');
                } else {
                    $this->session->set_flashdata('error_msg', 'Unable to save detail. Please try again..!!');
                    redirect('admin/properties/type');
                }
            }
        }
        $this->template->load('admin', 'Admin/Properties/type_display', $this->data);
	}

	/**
	 * This function is get details by id
	 * @author : pav
    */
	public function get_detail(){
		$table_name = $this->input->post('type');
		$prop_id = base64_decode($this->input->post('id'));
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where(array('id'=>$prop_id));
		$prop_cat_data = $this->db->get()->row_array();
		echo json_encode($prop_cat_data);
	}

	/**
	 * This function is used to delete particular records by id
	 * @author : pav
    */
	public function delete() {
        $id = $this->input->post('id');
        $table_name = $this->input->post('type');
        if ($id != '') {
            $record_id = base64_decode($id);
            if ($this->Admin_model->delete($table_name, $record_id)) {
                $this->session->set_flashdata('success_msg', 'Record deleted successfully!');
                $status = 1;
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to delete the record.');
                $status = 0;
            }
            $return_array = array(
                'status' => $status,
                'id' => $id
            );
            echo json_encode($return_array);
        }
    }

    /**
	 * This function is used to DISPLAY properties list
	 * @author : pav
    */
    public function property_listing(){
    	$this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = $this->data['record_type'] = 'Property';
    	$this->data['icon_class'] = 'icon-office';
    	$this->data['property_list'] = $this->Properties_model->get_all_details(TBL_PROP_LIST,array())->result_array();
    	$this->template->load('admin', 'Admin/Properties/property_display', $this->data);
    }

    /**
     * This function is used to ADD new property
     * @author : pav
    */
    public function property_add(){
        $this->data['property_categories'] = $this->Properties_model->get_all_details(TBL_PROP_CAT,array('status'=>'Active','is_delete'=>0),array(array('field'=>'name','type'=>'ASC')))->result_array();
    	$this->data['property_types'] = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('status'=>'Active','is_delete'=>0),array(array('field'=>'name','type'=>'ASC')))->result_array();

    	$this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Property Category', 'trim|required');
        $this->form_validation->set_rules('property_type_id', 'Property Type', 'trim|required');
        $this->form_validation->set_rules('area', 'Area', 'trim|required');
        $this->form_validation->set_rules('bedrooms_no', 'Bedrooms No.', 'trim|required');
        $this->form_validation->set_rules('bathrooms_no', 'Bathrooms No.', 'trim|required');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if($this->input->post('category_id')==4){
            $this->form_validation->set_rules('rent_type', 'Rent Type', 'trim|required');
        }
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'trim|required');
        $this->form_validation->set_rules('contact_no', 'Contact No.', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('amenities', 'Amenities', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
	    	$this->data['icon_class'] = 'icon-office';
	        $this->data['title'] = $this->data['page_header'] = 'Add property';
	        $this->template->load('admin', 'Admin/Properties/property_add', $this->data);
	    } else {
	    	$images = '';
	    	$upload_path = PROPERTY_IMAGE;
            $upload_medium = PROPERTY_MEDIUM_IMAGE;
            $upload_thumb = PROPERTY_THUMB_IMAGE;
            if ($_FILES['txt_main_image']['name'] != '') {
            	$exts = explode(".", $_FILES['txt_main_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_main_image')) {
                    $prop_img = $this->upload->data();
                    $main_image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $main_image;
                    $thumb_dest = './' . $upload_thumb . '/';
                    $medium_dest = './' . $upload_medium . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                } else {
                    $prop_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $prop_img);
                    redirect('admin/properties/property/add');
                }
            } else {
                $main_image = $this->input->post('hidden_main_image');
            }

            $other_images = '';
            $post_other_images = $this->input->post('hidden_other_image');
            if (!empty($post_other_images)) {
                $other_images = $other_images . ',' . implode(',', $post_other_images);
            }
            if (!empty($_FILES['txt_other_images']['name'])) {
                $filesCount = count($_FILES['txt_other_images']['name']);
                for ($i = 0; $i < $filesCount; $i++) {

                	$exts = explode(".", $_FILES['txt_other_images']['name'][$i]);
                	$name = time().".".end($exts);

                    $_FILES['supp_file']['name'] = $_FILES['txt_other_images']['name'][$i];
                    $_FILES['supp_file']['type'] = $_FILES['txt_other_images']['type'][$i];
                    $_FILES['supp_file']['tmp_name'] = $_FILES['txt_other_images']['tmp_name'][$i];
                    $_FILES['supp_file']['error'] = $_FILES['txt_other_images']['error'][$i];
                    $_FILES['supp_file']['size'] = $_FILES['txt_other_images']['size'][$i];

                    $config['overwrite'] = FALSE;
                    $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                    $config['max_size'] = 10000;
                    $config['upload_path'] = './'.$upload_path;
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('supp_file')) {
                        $other_image_arr = $this->upload->data();
                        $other_img = $other_image_arr['file_name'];
	                    $src = './' . $upload_path . '/' . $other_img;
	                    $thumb_dest = './' . $upload_thumb . '/';
	                    $medium_dest = './' . $upload_medium . '/';
	                    thumbnail_image($src, $thumb_dest);
	                    medium_image_user($src, $medium_dest);
                        $other_images = $other_images . ',' . $other_img;
                    }
                }
            }
            $images.=$main_image;
            if ($other_images != '') {
                $images.=$other_images;
            }
	    	$prop_type = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('id'=>$this->input->post('property_type_id')))->row_array();
	    	$cstrong = '';
            $random_string = bin2hex( openssl_random_pseudo_bytes(4, $cstrong));
	    	$reference_no = strtoupper(substr($prop_type['name'],0,2)).'-'.strtoupper($random_string);
	    	if($this->input->post('featured')=='on')
	    		$is_featured = 1;
	    	else
	    		$is_featured = 0;

	    	if($this->input->post('status')=='on')
	    		$status = 'Active';
	    	else
	    		$status = 'Inctive';

            if($this->input->post('availability')=='on')
                $availability = 1;
            else
                $availability = 0;

            if($this->input->post('is_offer')=='on')
                $is_offer = 1;
            else
                $is_offer = 0;

            if($this->input->post('discount_type')=='on')
                $discount_type = 'Flat';
            else
                $discount_type = 'Percentage';

	    	$data = array(
	    		'reference_number' => $reference_no,
                'title' => $this->input->post('title'),
                'property_category_id' => $this->input->post('category_id'),
                'property_type_id' => $this->input->post('property_type_id'),
                'area' => $this->input->post('area'),
                'bedroom_no' => $this->input->post('bedrooms_no'),
                'bathroom_no' => $this->input->post('bathrooms_no'),
                'short_description' => $this->input->post('short_description'),
                'description' => $this->input->post('description'),
                'address' => $this->input->post('address'),
                'locality' => $this->input->post('locality'),
                'country' => $this->input->post('country'),
                'latitude' => $this->input->post('lat'), 
                'longitude' => $this->input->post('lng'),
                'price' => $this->input->post('price'),
                'rent_type' => $this->input->post('rent_type'),
                'contact_name' => $this->input->post('contact_name'),
                'contact_no' => $this->input->post('contact_no'),
                'contact_email' => $this->input->post('contact_email'),
                'images' => $images,
                'amenities' => $this->input->post('amenities'),
                'is_featured' => $is_featured,
                'availability' => $availability,
                'is_offer' => $is_offer,
                'status' => $status,
                'is_delete' => 0
            );
            if($is_offer==1){
                $offer_data = array(
                    'deal_date_from' => date('Y-m-d h:i:s',strtotime(explode('-',$this->input->post('offer_date'))[0])),
                    'deal_date_to' => date('Y-m-d h:i:s',strtotime(explode('-',$this->input->post('offer_date'))[1])),
                    'discount_type' => $discount_type,
                    'discount_value' => $this->input->post('discount_value')
                );
                $data = array_merge($data,$offer_data);
            }
            $this->Admin_model->manage_record(TBL_PROP_LIST, $data);
            $this->session->set_flashdata('success_msg', 'Property added succesfully.');
            redirect('admin/properties/property');
	    }
    }

    public function property_bulk_add(){
        //header('Content-Type: text/html; charset=UTF-8');
        $file = $this->input->post('upload_csv');
        $fileDirectory = './uploads/csv';
        if (!is_dir($fileDirectory)) {
            mkdir($fileDirectory, 0777);
        }
        $saved_file_name = time();
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['upload_path'] = $fileDirectory;
        $config['allowed_types'] = 'csv';
        $config['file_name'] = $saved_file_name;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('upload_csv')) {
            $fileDetails = $this->upload->data();
            $row = 1;
            $handle = fopen($fileDirectory . "/" . $fileDetails['file_name'], "r");
            if (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $csv_format = array('title' ,'short_description' ,'long_description','contract_type','rent_type','price','category_type','area','no_of_bedrooms','no_of_bathrooms','featured','status','availability','amenities','offer','deal_start_time','deal_end_time','discount_type','discount_value','main_image','other_images','contact_name','contact_no','contact_email','property_address','property_locality','property_country','latitude','longitude');
                if ($data == $csv_format) {
                    fclose($handle);
                    $handle = fopen($fileDirectory . "/" . $fileDetails['file_name'], "r");
                    while (($csv_data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                        if ($row == 1) {
                            $row++;
                            continue;
                        }

                        $title              = $csv_data[0];
                        $short_description  = $csv_data[1];
                        $long_description   = $csv_data[2];
                        $contract_type      = strtolower($csv_data[3]);
                        $rent_type          = ucfirst($csv_data[4]);
                        $price              = $csv_data[5];
                        $category_type      = $csv_data[6];
                        $area               = $csv_data[7];
                        $no_of_bedrooms     = $csv_data[8];
                        $no_of_bathrooms    = $csv_data[9];
                        $featured           = strtolower($csv_data[10]);
                        $status             = strtolower($csv_data[11]);
                        $availability       = $csv_data[12];
                        $amenities          = $csv_data[13];
                        $offer              = $csv_data[14];
                        $deal_start_time    = $csv_data[15];
                        $deal_end_time      = $csv_data[16];
                        $discount_type      = $csv_data[17];
                        $discount_value     = $csv_data[18];
                        $main_image         = $csv_data[19];
                        $other_images       = $csv_data[20];
                        $contact_name       = $csv_data[21];
                        $contact_no         = $csv_data[22];
                        $contact_email      = $csv_data[23];
                        $property_address   = $csv_data[24];
                        $property_locality  = $csv_data[25];
                        $property_country   = $csv_data[26];
                        $latitude           = $csv_data[27];
                        $longitude          = $csv_data[28];

                        if($title=='' || $short_description=='' || $long_description=='' || $contract_type=='' || $price=='' || $area=='' || $no_of_bedrooms=='' || $no_of_bathrooms=='' || $amenities=='' || $main_image=='' || $contact_name=='' || $contact_no=='' || $contact_email=='' || $property_address=='' || $property_locality=='' || $property_country==''){
                            fclose($handle);
                            $this->session->set_flashdata('error_msg', 'Some required fields are missing.');
                            redirect('admin/properties/property');
                        }else{
                            $error_msg = '<ul>';
                            $error_cnt = 0;

                            // Main Image Upload
                            $main_image_url = $main_image;
                            $main_img = @getimagesize($main_image_url);
                            $main_img_data = file_get_contents($main_image_url);
                            $main_image_url = urldecode($main_image_url);
                            $main_img_full_name = substr($main_image_url, strrpos($main_image_url, '/') + 1);
                            $main_img_name_arr = explode('.', $main_img_full_name);
                            $main_img_name = $main_img_name_arr[0];
                            $ext = end($main_img_name_arr);
                            $ext_arr = explode('?', $ext);
                            $ext = $ext_arr[0];
                            if (!$ext)
                                $ext = 'jpg';
                            $new_name =  time() . '.' . $ext;
                            $new_img = './uploads/properties/temp_img/' . $new_name;
                            file_put_contents($new_img, $main_img_data);
                            $main_image_name = $new_name;
                            @copy('./uploads/properties/temp_img/' . $main_image_name, './uploads/properties/original/' . $main_image_name);
                            $src = './uploads/properties/original/' . $main_image_name;
                            $thumb_dest = './uploads/properties/thumb/';
                            $medium_dest = './uploads/properties/medium/';
                            thumbnail_image($src, $thumb_dest);
                            medium_image_user($src, $medium_dest);

                            // Other Images Upload
                            $other_images = rtrim($other_images, ",");
                            $imageurlArr = @explode(',', $other_images);
                            $other_images_str = '';
                            foreach ($imageurlArr as $image_url) {
                            
                                $img = @getimagesize($image_url);
                             
                                if ($img) {
                                    $other_image_url = $image_url;
                                    $img_data = file_get_contents($image_url);
                                    $image_url = urldecode($image_url);
                                    $img_full_name = substr($image_url, strrpos($image_url, '/') + 1);
                                    $img_name_arr = explode('.', $img_full_name);
                                    $img_name = $img_name_arr[0];
                                    $ext = end($img_name_arr);
                                    if (!$ext)
                                        $ext = 'jpg';
                                    $new_name = time() . '.' . $ext;
                                    $new_img = './uploads/properties/temp_img/' . $new_name;
                                    file_put_contents($new_img, $img_data);
                                    $image_name = $new_name;
                                    @copy('./uploads/properties/temp_img/' . $image_name, './uploads/properties/original/' . $image_name);
                                    $src = './uploads/properties/original/' . $image_name;
                                    $thumb_dest = './uploads/properties/thumb/';
                                    $medium_dest = './uploads/properties/medium/';
                                    thumbnail_image($src, $thumb_dest);
                                    medium_image_user($src, $medium_dest);
                                    $other_images_str = $other_images_str .','.$image_name;
                                }
                            }

                            // Contract Type validation
                            $contract_type_result = $this->Properties_model->get_all_details(TBL_PROP_CAT,array())->result_array();
                            $contract_typeArr = array();
                            foreach($contract_type_result as $k => $v){
                                $contract_typeArr[] = strtolower($v['name']);
                            }
                            if(in_array(strtolower($contract_type), $contract_typeArr)){ 
                                $properties_cat = $this->Properties_model->get_all_details(TBL_PROP_CAT,array('name'=>$contract_type))->row_array();
                                $property_category_id = $properties_cat['id'];
                                if($contract_type=='sale'){
                                    $rent_type == '';
                                }else if($contract_type=='rent' && $rent_type==''){ 
                                    //fclose($handle);
                                    $error_msg.="<li>RENT_TYPE field is required.</li>";
                                    $error_cnt = 1;
                                    //$this->session->set_flashdata('error_msg', 'RENT_TYPE field is required.');
                                    //redirect('admin/properties/property');
                                }
                            }else{
                                //fclose($handle);
                                $error_msg.="<li>Please enter correct value for RENT_TYPE.</li>";
                                $error_cnt = 1;
                                //$this->session->set_flashdata('error_msg', 'Please enter correct value for RENT_TYPE.');
                            }

                            // Property Type validation
                            $property_type_result = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array())->result_array();
                            $property_typeArr = array();
                            foreach($property_type_result as $k => $v){
                                $property_typeArr[] = strtolower($v['name']);
                            }

                            if(in_array(strtolower($category_type), $property_typeArr)){ 
                                $property_type_result = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('name'=>$category_type))->row_array();
                                $property_type_id = $property_type_result['id'];
                            }else{
                                $this->Properties_model->common_insert_update('insert',TBL_PROP_TYPE,array('name'=>ucfirst($category_type),'status'=>'Active'));
                                $property_type_id = $this->db->insert_id();
                            }

                            // Price Validation
                            if(!is_numeric($price) || $price<=0){
                                $error_msg.="<li>Please enter correct value for PRICE.</li>";
                                $error_cnt = 1;
                                //fclose($handle);
                                //$this->session->set_flashdata('error_msg', 'Please enter correct value for PRICE.');
                                //redirect('admin/properties/property');
                            }

                            // Price Validation
                            if(!is_numeric($area) || $area<=0){
                                $error_msg.="<li>Please enter correct value for AREA(Sq. ft).</li>";
                                $error_cnt = 1;
                                // fclose($handle);
                                // $this->session->set_flashdata('error_msg', 'Please enter correct value for AREA(Sq. ft).');
                                // redirect('admin/properties/property');
                            }  

                            // Bedroom Validation
                            if(!is_numeric($no_of_bedrooms) || $no_of_bedrooms<=0){
                                $error_msg.="<li>Please enter correct value for NO_OF_BEDROOMS.</li>";
                                $error_cnt = 1;
                                // fclose($handle);
                                // $this->session->set_flashdata('error_msg', 'Please enter correct value for NO_OF_BEDROOMS.');
                                // redirect('admin/properties/property');
                            }  

                            // Bathroom Validation
                            if(!is_numeric($no_of_bathrooms) || $no_of_bathrooms<=0){
                                $error_msg.="<li>Please enter correct value for NO_OF_BATHROOMS.</li>";
                                $error_cnt = 1;
                                // fclose($handle);
                                // $this->session->set_flashdata('error_msg', 'Please enter correct value for NO_OF_BATHROOMS.');
                                // redirect('admin/properties/property');
                            }      

                            // Featured Validation
                            if($featured == 'yes'){
                                $featured=1;
                            } else if($featured == 'no' || $featured == ''){
                                $featured=0;
                            }

                            // Status Validation
                            if($status == 'active'){
                                $status='Active';
                            } else if($status == 'inactive' || $status == ''){
                                $status='Inactive';
                            }

                            // Availability Validation
                            if($availability == 'yes'){
                                $availability=1;
                            } else if($availability == 'no' || $availability == ''){
                                $availability=0;
                            }

                            // Amenities Validation
                            $amenities = str_replace(':-:', ',', $amenities);
                            
                            //Offer Validation
                            if($offer == 'yes'){   
                                $offer = 1;
                                if($deal_start_time=='' || $deal_end_time==''){
                                    $error_msg.="<li>Please enter correct value for OFFER_DURATION.</li>";
                                    $error_cnt = 1;
                                    // fclose($handle);
                                    // $this->session->set_flashdata('error_msg', 'Please enter correct value for OFFER_DURATION.');
                                    // redirect('admin/properties/property');
                                }
                                if(!is_numeric($discount_value) || $discount_value<=0){
                                    $error_msg.="<li>Please enter correct value for DISCOUNT_VALUE.</li>";
                                    $error_cnt = 1;
                                    // fclose($handle);
                                    // $this->session->set_flashdata('error_msg', 'Please enter correct value for DISCOUNT_VALUE.');
                                    // redirect('admin/properties/property');
                                }
                                if(strtolower($discount_type)!='percentage' && strtolower($discount_type)!='flat'){
                                    $error_msg.="<li>Please enter correct value for DISCOUNT_TYPE.</li>";
                                    $error_cnt = 1;
                                    // fclose($handle);
                                    // $this->session->set_flashdata('error_msg', 'Please enter correct value for DISCOUNT_TYPE.');
                                    // redirect('admin/properties/property');
                                }
                            }else if($offer == 'no' || $offer==''){
                                $offer = 0;
                                $deal_start_time = '';
                                $deal_end_time   = '';
                                $discount_type   = '';
                                $discount_value  = '';
                            }

                            // Lat - Long Validation
                            if($latitude!='' || $longitude!=''){
                                if(!is_numeric($latitude)){
                                    $error_msg.="<li>Please enter correct value for LATITUDE.</li>";
                                    $error_cnt = 1;
                                    // fclose($handle);
                                    // $this->session->set_flashdata('error_msg', 'Please enter correct value for LATITUDE.');
                                    // redirect('admin/properties/property');
                                }
                                
                                if(!is_numeric($longitude)){
                                    $error_msg.="<li>Please enter correct value for LONGITUDE.</li>";
                                    $error_cnt = 1;
                                    // fclose($handle);
                                    // $this->session->set_flashdata('error_msg', 'Please enter correct value for LONGITUDE.');
                                    // redirect('admin/properties/property');
                                }
                            }else{
                                $latitude = $longitude = '';
                            }

                            $random_string = bin2hex( openssl_random_pseudo_bytes(4, $cstrong));
                            $reference_no = strtoupper(substr($contract_type,0,2)).'-'.strtoupper($random_string);

                            $insertArr[] = array(
                                'status'            => $status,
                                'reference_number'  => $reference_no,
                                'title'             => $title,
                                'images'            => rtrim($main_image_name.$other_images_str,','),
                                'short_description' => $short_description,
                                'description'       => $long_description,
                                'address'           => $property_address,
                                'locality'          => $property_locality,
                                'country'           => $property_country,
                                'latitude'          => $latitude,
                                'longitude'         => $longitude,
                                'amenities'         => $amenities,
                                'is_featured'       => $featured,
                                'is_delete'         => 0,
                                'contact_no'        => $contact_no,
                                'contact_name'      => $contact_name,
                                'contact_email'     => $contact_email,
                                'price'             => $price,
                                'bedroom_no'        => $no_of_bedrooms,
                                'bathroom_no'       => $no_of_bathrooms,
                                'area'              => $area,
                                'availability'      => $availability,
                                'is_offer'          => $offer,
                                'deal_date_from'    => $deal_start_time,
                                'deal_date_to'      => $deal_end_time,
                                'discount_type'     => $discount_type,
                                'discount_value'    => $discount_value,
                                'property_category_id' => $property_category_id,
                                'rent_type'         => $rent_type,
                                'property_type_id'  => $property_type_id
                            );
                        }
                    }
                    if($error_cnt==1){
                        $error_msg.="</ul>";
                        fclose($handle);
                        $this->session->set_flashdata('error_msg', $error_msg);
                        redirect('admin/properties/property');
                    }else{
                        $this->db->insert_batch(TBL_PROP_LIST,$insertArr);    
                    }
                    
                }else{
                    fclose($handle);
                    $this->session->set_flashdata('error_msg', 'The columns in this csv file does not match to the database');
                }
                redirect('admin/properties/property');
            }
        }else{
            $this->session->set_flashdata('error_msg', $this->upload->display_errors());
            redirect('admin/properties/property');
        }
    }

    /**
     * This function is used to EDIT property
     * @param : $id Integer
     * @author : pav
    */
    public function property_edit($id=''){
    	if ($id != '') {
            $record_id = base64_decode($id);
        }
    	$this->data['property_categories'] = $this->Properties_model->get_all_details(TBL_PROP_CAT,array('status'=>'Active','is_delete'=>0),array(array('field'=>'name','type'=>'ASC')))->result_array();
    	$this->data['property_types'] = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('status'=>'Active','is_delete'=>0),array(array('field'=>'name','type'=>'ASC')))->result_array();
    	$property_data = $this->Properties_model->get_all_details(TBL_PROP_LIST,array('id'=>$record_id))->result();
    	$this->data['property'] = $property_data[0];
    	$this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Property Category', 'trim|required');
        $this->form_validation->set_rules('property_type_id', 'Property Type', 'trim|required');
        $this->form_validation->set_rules('area', 'Area', 'trim|required');
        $this->form_validation->set_rules('bedrooms_no', 'Bedrooms No.', 'trim|required');
        $this->form_validation->set_rules('bathrooms_no', 'Bathrooms No.', 'trim|required');
        $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if($this->input->post('category_id')==4){
            $this->form_validation->set_rules('rent_type', 'Rent Type', 'trim|required');
        }
        $this->form_validation->set_rules('contact_name', 'Contact Name', 'trim|required');
        $this->form_validation->set_rules('contact_no', 'Contact No.', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('amenities', 'Amenities', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
	    	$this->data['icon_class'] = 'icon-office';
	        $this->data['title'] = $this->data['page_header'] = 'Edit property';
	        $this->template->load('admin', 'Admin/Properties/property_add', $this->data);
	    } else {
	    	$images = '';
	    	$upload_path = PROPERTY_IMAGE;
            $upload_medium = PROPERTY_MEDIUM_IMAGE;
            $upload_thumb = PROPERTY_THUMB_IMAGE;
            if ($_FILES['txt_main_image']['name'] != '') {
            	$exts = explode(".", $_FILES['txt_main_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_main_image')) {
                    $prop_img = $this->upload->data();
                    $main_image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $main_image;
                    $thumb_dest = './' . $upload_thumb . '/';
                    $medium_dest = './' . $upload_medium . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                } else {
                    $prop_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $prop_img);
                    redirect('admin/properties/property/add');
                }
            } else {
                $main_image = $this->input->post('hidden_main_image');
            }

            $other_images = '';
            $post_other_images = $this->input->post('hidden_other_image');
            if (!empty($post_other_images)) {
                $other_images = $other_images . ',' . implode(',', $post_other_images);
            }
            if (!empty($_FILES['txt_other_images']['name'])) {
                $filesCount = count($_FILES['txt_other_images']['name']);
                for ($i = 0; $i < $filesCount; $i++) {

                	$exts = explode(".", $_FILES['txt_other_images']['name'][$i]);
                	$name = time().".".end($exts);
                	
                    $_FILES['supp_file']['name'] = $_FILES['txt_other_images']['name'][$i];
                    $_FILES['supp_file']['type'] = $_FILES['txt_other_images']['type'][$i];
                    $_FILES['supp_file']['tmp_name'] = $_FILES['txt_other_images']['tmp_name'][$i];
                    $_FILES['supp_file']['error'] = $_FILES['txt_other_images']['error'][$i];
                    $_FILES['supp_file']['size'] = $_FILES['txt_other_images']['size'][$i];

                    $config['overwrite'] = FALSE;
                    $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                    $config['max_size'] = 10000;
                    $config['upload_path'] = './'.$upload_path;
                    $config['file_name'] = $name;

                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('supp_file')) {
                        $other_image_arr = $this->upload->data();
                        $other_img = $other_image_arr['file_name'];
	                    $src = './' . $upload_path . '/' . $other_img;
	                    $thumb_dest = './' . $upload_thumb . '/';
	                    $medium_dest = './' . $upload_medium . '/';
	                    thumbnail_image($src, $thumb_dest);
	                    medium_image_user($src, $medium_dest);
                        $other_images = $other_images . ',' . $other_img;
                    }
                }
            }
            $images.=$main_image;
            if ($other_images != '') {
                $images.=$other_images;
            }
	    	$prop_type = $this->Properties_model->get_all_details(TBL_PROP_TYPE,array('id'=>$this->input->post('property_type_id')))->row_array();
	    	if($this->input->post('featured')=='on')
	    		$is_featured = 1;
	    	else
	    		$is_featured = 0;

	    	if($this->input->post('status')=='on')
	    		$status = 'Active';
	    	else
	    		$status = 'Inactive';

            if($this->input->post('availability')=='on')
                $availability = 1;
            else
                $availability = 0;
            
            if($this->input->post('is_offer')=='on')
                $is_offer = 1;
            else
                $is_offer = 0;

            if($this->input->post('discount_type')=='on')
                $discount_type = 'Flat';
            else
                $discount_type = 'Percentage';
            
	    	$data = array(
                'title' => $this->input->post('title'),
                'property_category_id' => $this->input->post('category_id'),
                'property_type_id' => $this->input->post('property_type_id'),
                'area' => $this->input->post('area'),
                'bedroom_no' => $this->input->post('bedrooms_no'),
                'bathroom_no' => $this->input->post('bathrooms_no'),
                'short_description' => $this->input->post('short_description'),
                'description' => $this->input->post('description'),
                'address' => $this->input->post('address'),
                'locality' => $this->input->post('locality'),
                'country' => $this->input->post('country'),
                'latitude' => $this->input->post('lat'), 
                'longitude' => $this->input->post('lng'),
                'price' => $this->input->post('price'),
                'rent_type' => $this->input->post('rent_type'),
                'contact_name' => $this->input->post('contact_name'),
                'contact_no' => $this->input->post('contact_no'),
                'contact_email' => $this->input->post('contact_email'),
                'images' => $images,
                'amenities' => $this->input->post('amenities'),
                'is_featured' => $is_featured,
                'availability' => $availability,
                'is_offer' => $is_offer,
                'status' => $status,
                'is_delete' => 0
            );
            if($is_offer==1){
                $offer_data = array(
                    'deal_date_from' => date('Y-m-d h:i:s',strtotime(explode('-',$this->input->post('offer_date'))[0])),
                    'deal_date_to' => date('Y-m-d h:i:s',strtotime(explode('-',$this->input->post('offer_date'))[1])),
                    'discount_type' => $discount_type,
                    'discount_value' => $this->input->post('discount_value')
                );
                $data = array_merge($data,$offer_data);
            }
            if($this->Properties_model->common_insert_update('update',TBL_PROP_LIST, $data,array('id'=>$record_id))){
                $this->session->set_flashdata('success_msg', 'Property updated successfully.');
                redirect('admin/properties/property');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to update property.');
                redirect('admin/properties/property/edit/'.base64_encode($record_id));
            }
	    }
    }

    /**
     * This function is used to VIEW property
     * @param : $id Integer
     * @author : pav
    */
    public function property_view($id = null) {
        $flag = 1;
        if ($id != '') {
            $segment = $this->uri->segment(1);
            $record_id = base64_decode($id);
            $property = $this->Properties_model->get_property_details_by_id($record_id)->result();
            if (!empty($property)) {
                $this->data['property'] = $property[0];
                $this->data['title'] = $this->data['page_header'] = 'Property / View Property';
                $this->data['icon_class'] = 'icon-office';
                if ($segment == 'admin')
                    $this->template->load('admin', 'Admin/Properties/property_view', $this->data);
                else
                    $this->template->load('staff', 'Staff/Tickets/view', $this->data);
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('Admin/error/404_notfound', $data);
        }
    }

    /**
     * This function is used to DISPLAY banner list
     * @author : pav
    */
    public function landing_banner_display(){
        $this->data['title'] = $this->data['page_header'] = $this->data['user_type'] = $this->data['record_type'] = 'Landing Banner';
        $this->data['icon_class'] = 'icon-image3';
        $this->data['landing_banner_list'] = $this->Properties_model->get_prop_landing_banner()->result_array();
        $this->template->load('admin', 'Admin/Properties/landing_banner_display', $this->data);
    }

    /**
     * This function is used to ADD new banner
     * @author : pav
    */
    public function landing_banner_add(){
        $this->data['prop_list'] = $this->Properties_model->get_all_details(TBL_PROP_LIST,array('status'=>'Active','is_delete'=>0))->result_array();
        $this->form_validation->set_rules('property_id', 'Property', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['icon_class'] = 'icon-image3';
            $this->data['title'] = $this->data['page_header'] = 'Add Banner';
            $this->template->load('admin', 'Admin/Properties/landing_banner_add', $this->data);
        } else {
            $images = '';
            $slider_image = '';
            $upload_path = PROPERTY_BANNER;
            if ($_FILES['txt_image']['name'] != '') {
                $exts = explode(".", $_FILES['txt_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_image')) {
                    $prop_img = $this->upload->data();
                    $image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $image;
                } else {
                    $banner_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $banner_img);
                    redirect('admin/properties/lamding_banner/add');
                }
            } else {
                $image = $this->input->post('hidden_image');
            }

            $upload_path = HOME_IMAGE;
            if ($_FILES['txt_slider_image']['name'] != '') {
                $exts = explode(".", $_FILES['txt_slider_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_slider_image')) {
                    $prop_img = $this->upload->data();
                    $slider_image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $image;
                    $thumb_dest = './' . HOME_THUMB_IMAGE . '/';
                    $medium_dest = './' . HOME_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                } else {
                    $banner_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $banner_img);
                    redirect('admin/properties/lamding_banner/add');
                }
            } else {
                $slider_image = $this->input->post('hidden_image');
            }

            if($this->input->post('status')=='on')
                $status = 'Active';
            else
                $status = 'Inctive';

            $data = array(
                'property_id' => $this->input->post('property_id'),
                'image' => $image,
                'slider_image' => $slider_image,
                'status' => $status,
                'position' => $this->input->post('position'),
            );
            $this->Admin_model->manage_record(TBL_PROP_BANNER, $data);
            $this->session->set_flashdata('success_msg', 'Banner added succesfully.');
            redirect('admin/properties/landing_banner');
        }
    }

    /**
     * This function is used to EDIT property
     * @param : $id Integer
     * @author : pav
    */
    public function landing_banner_edit($id=''){
        if ($id != '') {
            $record_id = base64_decode($id);
        }
        $this->data['prop_list'] = $this->Properties_model->get_all_details(TBL_PROP_LIST,array('status'=>'Active','is_delete'=>0))->result_array();
        $banner_data = $this->Properties_model->get_all_details(TBL_PROP_BANNER,array('id'=>$record_id))->result();
        $this->data['banner'] = $banner_data[0];
        $this->form_validation->set_rules('property_id', 'Property', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->data['icon_class'] = 'icon-image3';
            $this->data['title'] = $this->data['page_header'] = 'Edit Banner';
            $this->template->load('admin', 'Admin/Properties/landing_banner_add', $this->data);
        } else {
            $images = '';
            $slider_image = '';
            $upload_path = PROPERTY_BANNER;
            if ($_FILES['txt_image']['name'] != '') {
                $exts = explode(".", $_FILES['txt_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_image')) {
                    $prop_img = $this->upload->data();
                    $image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $image;
                } else {
                    $banner_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $banner_img);
                    redirect('admin/properties/landing_banner/add');
                }
            } else {
                $image = $this->input->post('hidden_image');
            }

            $upload_path = HOME_IMAGE;
            if ($_FILES['txt_slider_image']['name'] != '') {
                $exts = explode(".", $_FILES['txt_slider_image']['name']);
                $name = time().".".end($exts);
                $config['overwrite'] = FALSE;
                $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
                $config['max_size'] = 10000;
                $config['upload_path'] = './'.$upload_path;
                $config['file_name'] = $name;

                $this->upload->initialize($config);
                if ($this->upload->do_upload('txt_slider_image')) {
                    $prop_img = $this->upload->data();
                    $slider_image = $prop_img['file_name'];
                    $src = './' . $upload_path . '/' . $image;
                    $thumb_dest = './' . HOME_THUMB_IMAGE . '/';
                    $medium_dest = './' . HOME_MEDIUM_IMAGE . '/';
                    thumbnail_image($src, $thumb_dest);
                    medium_image_user($src, $medium_dest);
                } else {
                    $banner_img = $this->upload->display_errors();
                    $this->session->set_flashdata('error_msg', $banner_img);
                    redirect('admin/properties/landing_banner/add');
                }
            } else {
                $slider_image = $this->input->post('hidden_slider_image');
            }

            if($this->input->post('status')=='on')
                $status = 'Active';
            else
                $status = 'Inactive';

           $data = array(
                'property_id' => $this->input->post('property_id'),
                'image' => $image,
                'slider_image' => $slider_image,
                'status' => $status,
                'position' => $this->input->post('position'),
            );

            if($this->Properties_model->common_insert_update('update',TBL_PROP_BANNER, $data,array('id'=>$record_id))){
                $this->session->set_flashdata('success_msg', 'Banner updated successfully.');
                redirect('admin/properties/landing_banner');
            } else {
                $this->session->set_flashdata('error_msg', 'Unable to update banner.');
                redirect('admin/properties/landing_banner/edit/'.base64_encode($record_id));
            }
        }
    }

    public function update_banner_position(){
        $record_id = $this->input->post('id');
        $position = $this->input->post('position');
        $this->Properties_model->common_insert_update('update',TBL_PROP_BANNER,array('position'=>$position),array('id'=>$record_id));
        exit;
    }
    /**
     * This function is used to VIEW property
     * @param : $id Integer
     * @author : pav
    */
    public function landing_banner_view($id = null) {
        $flag = 1;
        if ($id != '') {
            $segment = $this->uri->segment(1);
            $record_id = base64_decode($id);
            $banner = $this->Properties_model->get_prop_landing_banner_by_id($record_id)->result();
            if (!empty($banner)) {
                $this->data['banner'] = $banner[0];
                $this->data['title'] = $this->data['page_header'] = 'Property / View Banner';
                $this->data['icon_class'] = 'icon-image3';
                $this->template->load('admin', 'Admin/Properties/landing_banner_view', $this->data);
            } else {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag == 0) {
            $data['view'] = 'admin/404_notfound';
            $this->load->view('Admin/error/404_notfound', $data);
        }
    }
}

/* End of file Property_category.php */
/* Location: ./application/controllers/Admin/Property_category.php */