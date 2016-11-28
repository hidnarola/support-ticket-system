<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('cron_model');
    }

	/**
	 * start_cron function
	 * used to start cron job and send emails
	 * @return void
	 * @author 
	 **/
	public function start_cron($action){
		$array_predefine_actions = array('_2_days','_4_days','_7_days','_30_days');
		if(in_array($action, $array_predefine_actions)){
			if ($action == '_2_days') {
				$duration = 2;
			} elseif ($action == '_4_days') {
				$duration = 4;
			} elseif ($action == '_7_days') {
				$duration = 7;
			} else {
				$duration = 30;
			}
			
			//--- Check any newsletter have selected auto options
			$get_auto_newsletter = $this->cron_model->get_auto_newsletter($duration);
			if($get_auto_newsletter){

				foreach ($get_auto_newsletter as $key => $value) {
					$number_of_latest_spots = $value['no_of_latest_spots'];
					if($number_of_latest_spots > 0){
						$exist_spot_ids = $this->cron_model->get_result(TBL_NEWSLETTER_SPOTS_LOG,'newsletter_id='.$value['id']);
						$log_spts_ids = array();
						if($exist_spot_ids){
							$log_spts_ids =  explode(',',$exist_spot_ids[0]['spot_ids']);
						}
						//--- need to check latest spots are available that is specified in setting
						$latest_spots = $this->cron_model->get_latest_spots_of_current_month($number_of_latest_spots,$log_spts_ids);
						if(count($latest_spots) == $number_of_latest_spots){
							$spot_ids = array_column($latest_spots, 'id');
							// $this->cron_model->spots_log(implode(',',$spot_ids),$value['id']);
							$country_id = $value['country_id'];
							$select_user_for_newsletter = $this->cron_model->get_users_from_selected_country($country_id);
							if($select_user_for_newsletter){
								$this->load->library('My_PHPMailer');
							    $mail = new PHPMailer();
							    $mail->IsSMTP(); // we are going to use SMTP
							    $mail->SMTPAuth = true; // enabled SMTP authentication
							    $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
							    $mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
							    $mail->Port = 465;     // SMTP port to connect to GMail
							    $mail->Username = "demo.narola@gmail.com";  // user email address
							    $mail->Password = "Ke6g7sE70Orq3Rqaqa";     // password in GMail
							    $mail->Transport = 'Smtp';
								$data['latest_spots'] = $latest_spots;
								$from = 'info@spotashoot.com';
						        $subject = 'Spotashoot - Newsletter';
						        $mail->SetFrom($from, 'Spotashoot Team');  //Who is sending the email
							    $mail->IsHTML(true);
							    $mail->Subject = $subject;
							    foreach ($select_user_for_newsletter as $key => $value) {
							    	if($value['allow_newsletter'] == 0){
								    	$data['unsubscribe_link'] = site_url().'unsubscribe_notification/newsletter?code='.urlencode($this->encrypt->encode($value['id']));
										$msg = $this->load->view('email_templates/send_latest_spots_newsletter',$data,true);
								    	$mail->Body = $msg;
								    	p($msg,1);
								    	$mail->ClearAllRecipients();
							        	// $mail->AddAddress($value['email_id']);
							        	// $mail->AddAddress('tony@virtualdusk.com');
							        	$mail->AddAddress('kap@narola.email');
							        	$mail->send();
							        	exit;
							        }
						    	}
						        // send_newsletter($users, $from, $subject, $body);
						    }
						}
					}
				}
			}
		} else {
			echo 'Sorry! invalid action.';
		}
	}
}