 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller    {

  public function __construct() {
        parent::__construct();
        $this->load->model('Pages_model');
        $this->load->model('User_model');
    }
 public function index($page_slug) {
       	$get_result = $this->Pages_model->get_result(TBL_PAGES,' url ='.$this->db->escape(urldecode($page_slug)));
        $userid = $this->session->userdata('user_logged_in')['id'];
       	if($get_result){
       		$data['title'] = $get_result[0]['title'];
          $data['page_title'] = $get_result[0]['title'];
       		$data['header_title'] = $get_result[0]['title'];
       		$data['page_data'] = $get_result[0];
          $data['icon_class'] = 'icon-question3';
          $data['news_announcements'] = $this->User_model->getlatestnews();
          $data['user'] = $this->User_model->getUserByID($userid);
            
        	$this->template->load('frontend/page', 'Frontend/page/index', $data);
       	} else {
       		show_404();
       	}
    }
  }