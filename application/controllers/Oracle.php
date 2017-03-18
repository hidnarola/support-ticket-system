<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Oracle extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
        } else {
            $protocol = 'http://';
        }
        $CUrurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $this->session->set_userdata('force_redirect', $CUrurl);
    }

    public function index() {
//        phpinfo();
        $oracle_user = 'apps';
        $oracle_pass = 'mnZ123';
        $oracle_url = '83.111.41.30';
        $oracle_port = '1536';
        $db= "(DESCRIPTION=(ADDRESS=(PROTOCOL=tcp)(HOST=83.111.41.30)(PORT=1536))(CONNECT_DATA=(SID=TEST)))";
        $connect = oci_connect($oracle_user, $oracle_pass, $db, 'UTF8');
//        echo $connect; exit;
        if (!$connect) {
            die("Could not connect to the database");
        }  else {
            die('connected to oracle');
        }
    }

}
