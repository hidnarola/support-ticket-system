<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletters extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Newsletter_model');
        $this->load->model('Admin_model');
    }

    /**
     * 
     * @uses : Load view of newsletters list
     * @author : Nv
     * */
    public function index() {
        $this->data['title'] = $this->data['page_header'] = 'Newsletters';
        $this->data['icon_class'] = 'icon-image3';

        $newsletters = $this->Newsletter_model->get_newsletters();
        $this->data['newsletters'] = $newsletters;

        $this->template->load('admin', 'Admin/Newsletters/index', $this->data);
    }

    public function edit() {

        $newsletter_id = $this->uri->segment(4);
        if (is_numeric($newsletter_id)) {
            $where = 'id = ' . $this->db->escape($newsletter_id);
            $check_newsletter = $this->Newsletter_model->get_result(TBL_NEWSLETTERS, $where);
            if ($check_newsletter) {
                $data['newsletter_data'] = $check_newsletter[0];
                $data['title'] = 'Edit newsletter';
                $data['heading'] = 'Edit newsletter';
            } else {
                show_404();
            }
        } else {
            $data['heading'] = 'Add newsletter';
            $data['title'] = 'Add newsletter';
        }
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('<div class="alert alert-error alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
        } else {
            if (is_numeric($newsletter_id)) {
                $update_array = $this->input->post(null);
                $this->Newsletter_model->update_record(TBL_NEWSLETTERS, $where, $update_array);
                $this->session->set_flashdata('success', 'Newsletter successfully updated!');
            } else {
                $insert_array = $this->input->post(null);
                $this->Newsletter_model->insert(TBL_NEWSLETTERS, $insert_array);
                $this->session->set_flashdata('success', 'Newsletter successfully added!');
            }
            redirect('admin/newsletters');
        }
        $this->template->load('admin', 'admin/newsletters/manage', $data);
    }

    public function subscribers() {
        $this->data['title'] = $this->data['page_header'] = 'Subscribers';
        $this->data['icon_class'] = 'icon-person';

        $subscribers = $this->Newsletter_model->get_subscribers();
        $this->data['subscribers'] = $subscribers;

        $this->template->load('admin', 'Admin/Newsletters/subscribers', $this->data);
    }

    public function add_subscriber() {
        $this->data['title'] = $this->data['page_header'] = 'Subscribers';
        $this->data['icon_class'] = 'icon-person';
        $this->data['page'] = 'Add Subscribers';
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email[' . $useremail . ']');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'email' => $useremail,
                'is_delete' => 0,
                'created' => date('Y-m-d H:i:s'),
            );

            $this->Admin_model->manage_record(TBL_NEWSLETTER_SUBSCRIBERS, $data);

            $this->session->set_flashdata('success_msg', 'Subscriber added succesfully.');
            redirect('admin/subscribers');
        }
        $this->template->load('admin', 'Admin/Newsletters/add_subscribers', $this->data);
    }

    function check_email($email) {
        $return_value = $this->Newsletter_model->check_email($email);
        if ($return_value) {
            $this->form_validation->set_message('check_email', 'Sorry, This email is already Exists..!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function change_data_status() {
        $condition = ' id = ' . $this->input->post('id');
        $user_array = array('is_auto' => $this->input->post('value'));
        $this->Newsletter_model->update_record(TBL_NEWSLETTERS, $condition, $user_array);
        echo 'success';
        exit;
    }

    public function settings($newsletter_id) {
        if ($newsletter_id == '') {
            $newsletter_id = $this->input->post('newsletter_id_post');
        }
        $where = 'id = ' . $this->db->escape($newsletter_id);
        $check_newsletter = $this->Newsletter_model->get_result(TBL_NEWSLETTERS, $where);
        // pr($check_newsletter,1);
        if ($check_newsletter) {
            $data['heading'] = 'Newsletter settings';

            $data['title'] = 'Admin newsletter Settings';
            $data['newsletter_id'] = $newsletter_id;
            $check_newsletter_setting = $this->Newsletter_model->get_result(TBL_NEWSLETTER_SETTINGS, 'newsletter_id =' . $newsletter_id);

            // pr($check_newsletter_setting,1);
            if ($check_newsletter_setting) {
                $data['newsletter_settings'] = $check_newsletter_setting[0];
            }
            $this->form_validation->set_rules('newsletter_content', 'newsletter content', 'trim|required|min_length[100]', array('min_length' => 'Newsletter content is to short or empty.'));
            if ($this->input->post('is_auto')) {
                // $this->form_validation->set_rules('number_of_spots', 'Number of spots', 'integer|trim|required|greater_than[0]',array('integer' => 'Invalid number of spots.'));
            }
            if ($this->form_validation->run() == FALSE) {
                $this->form_validation->set_error_delimiters('<div class="alert alert-error alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            } else {

                // $country_id = $this->input->post('country_id');
                // $number_of_spots = $this->input->post('number_of_spots');
                $array = array(
                    'content' => $_POST['newsletter_content'],
                        // 'country_id' => $country_id,
                        // 'no_of_latest_spots' => $number_of_spots
                );
                if ($this->input->post('duration')) {
                    $array['duration'] = $this->input->post('duration');
                }
                if ($this->input->post('is_auto')) {
                    $array['is_auto'] = 1;
                } else {
                    $array['is_auto'] = 0;
                }

                if ($check_newsletter_setting) {
                    $condition = ' newsletter_id = ' . $newsletter_id;
                    $this->Newsletter_model->update_record(TBL_NEWSLETTER_SETTINGS, $condition, $array);
                } else {
                    $array['newsletter_id'] = $newsletter_id;
                    $this->Newsletter_model->insert(TBL_NEWSLETTER_SETTINGS, $array);
                }

                $check_testing_emails = $this->Newsletter_model->get_result(TBL_NEWSLETTERS_TEST_EMAILS, 'newsletter_id =' . $newsletter_id);
                $testing_emails_array = array(
                    'email_ids' => $this->input->post('testing_emails')
                );

                $arr = implode(',', $this->input->post('testing_emails'));
                $f = $this->input->post('testing_emails');

                $r = $check_testing_emails[0]['email_ids'];

                $array_email = explode(',', $r);

                $pp = array_diff($f, $array_email);
                $arr11 = implode(',', $pp);


                if ($check_testing_emails) {
                    $condition = ' newsletter_id = ' . $newsletter_id;
                    $testing_emails_array['modified_date'] = 'NOW()';
                    $this->Newsletter_model->update_record_rec(TBL_NEWSLETTERS_TEST_EMAILS, $condition, $arr11);
                } else {
                    $testing_emails_array['newsletter_id'] = $newsletter_id;
                    $this->Newsletter_model->insert(TBL_NEWSLETTERS_TEST_EMAILS, $testing_emails_array);
                }

                $this->session->set_flashdata('success', 'Newsletter settings successfully added!');
                redirect('admin/newsletters');
            }

            $data['testing_emails'] = $this->Newsletter_model->get_newsletter_testing_emails($newsletter_id);
            $a = array();
            foreach ($data['testing_emails'] as $key => $value) {
                $a = $value;
            }
            $p='';
            if(!empty($a)){
                $p = explode(',', $a['email_ids']);
            }
            $data['emails'] = $p;
            $data['subscribers'] = $this->Newsletter_model->get_emails_subscribers();
//        pr($data['subscribers'],1);
            $this->template->load('admin', 'Admin/Newsletters/manage_settings', $data);
        }
    }

    public function action($action, $id, $type = null) {
        $where = 'id = ' . $this->db->escape($id);
        $table = ($type != null) ? TBL_NEWSLETTER_SUBSCRIBERS : TBL_NEWSLETTERS;
        $check_if_exists = $this->Newsletter_model->get_result($table, $where);
        if ($check_if_exists) {
            if ($action == 'delete') {
                $val = 1;
                $this->session->set_flashdata('success', $type . ' successfully deleted!');
            }
            $update_array = array(
                'is_delete' => $val
            );
            $this->Newsletter_model->update_record($table, $where, $update_array);
        } else {
            $this->session->set_flashdata('error', 'Invalid request. Please try again!');
        }
        if ($type != null)
            redirect('admin/subscribers');
        else
            redirect('admin/newsletters');
    }

    public function send($type, $newsletter_id) {
        $where = 'id = ' . $this->db->escape($newsletter_id);
        $check_newsletter = $this->Newsletter_model->get_result(TBL_NEWSLETTERS, $where);
        if ($check_newsletter) {
            $data['newsletter_id'] = $newsletter_id;
            $data['type'] = $type;
            $this->template->load('admin', 'Admin/Newsletters/send_newsletter', $data);
        }
    }

    public function send_newsletter() {
        $newsletter_id = $this->input->post('newsletter_id');
        $type = $this->input->post('type');
        $newsletter_data = $this->Newsletter_model->get_result(TBL_NEWSLETTER_SETTINGS, 'newsletter_id =' . $newsletter_id);

        $users = array();
        if ($type == 'testing') {
            $testing_emails = $this->Newsletter_model->get_result(TBL_NEWSLETTERS_TEST_EMAILS, 'newsletter_id =' . $newsletter_id);
            $testing_emails = explode(',', $testing_emails[0]['email_ids']);
            foreach ($testing_emails as $key => $value) {
                $users[] = array(
                    'email_id' => $value
                );
            }
        } else {
            $users = $this->Newsletter_model->get_users_for_newsletter($newsletter_id);
            // $users[] = array(
            //     'email_id' => 'kap@narola.email'
            // );
            // $users[] = array(
            //     'email_id' => 'kap@narola.email'
            // );
        }

        $configs = mail_config();
        $this->load->library('email', $configs);
        $this->email->initialize($configs);
        $body = $newsletter_data[0]['content'];
        // pr($users,1);
        foreach ($users as $user) {

            $this->email->from('demo.narola@gmail.com', 'dev.supportticket.com');
            $this->email->to($user);
            $this->email->subject('Manazel - Newsletter');
            $this->email->message($body);
            $this->email->send();
        }

        echo 'success';
        exit;
    }

    public function get_emails() {
        $keyword = $this->input->post('term');
//        echo $keyword;exit;
        $data['response'] = 'false'; //Set default response
        if (!empty($keyword) && isset($keyword)) {
            $query = $this->Newsletter_model->get_emails($keyword);
            if (!empty($query)) {
                $data['response'] = 'true'; //Set response
                $data['message'] = array(); //Create array
                foreach ($query as $row) {
                    $data['message'][] = array('value' => $row['email'], 'id' => $row['id']);
                }
                echo json_encode($data);
                exit;
            }
        }
    }

}
