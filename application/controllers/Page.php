 <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller    {

  public function __construct() {
      parent::__construct();
      $this->load->model('Pages_model');
      $this->load->model('User_model');
  }
  public function index($page_slug) {
        if($page_slug=='property-finder'){
          redirect('property-finder');
        }
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
        	
          //CHANGES BY PAV
          //$this->template->load('frontend/page', 'Frontend/Page/index', $data);
          $this->template->load('propertyfinder/home', 'Frontend/Page/index', $data);
       	} else {
       		show_404();
       	}
  }

  public function contact_us(){
    $full_name = $this->input->post('txt_full_name');
    $email_address = $to = $this->input->post('txt_email');
    $phone_no = $this->input->post('txt_phone_no');
    $mobile_no = $this->input->post('txt_mobile_no');
    $subject = $this->input->post('txt_subject');
    $message = $this->input->post('txt_message');
    
    $msg = 'You have recieved a new message from the enquiries from on your website. Following are the deatils of that person.<br><br>';
    $msg.= '<b>Full Name : </b>'.$full_name.'<br>';
    $msg.= '<b>Email Address : </b><a href=mailto:'.$email_address.'>'.$email_address.'</a><br>';
    $msg.= '<b>Phone No : </b>'.$phone_no.'<br>';
    $msg.= '<b>Mobile No : </b>'.$mobile_no.'<br>';
    $msg.= $message;
    mail($to,$subject,$msg);
    redirect('contact-us');
  }
}