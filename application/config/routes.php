<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'Home';
$route['404_override'] = 'login/page_not_found';
$route['translate_uri_dashes'] = FALSE;

$route['admin/logout'] = "login/logout";
$route['logout'] = "login/logout";
$route['support/login'] = "login";
$route['admin'] = "admin/dashboard";
$route['admin/profile'] = "admin/dashboard/profile";
$route['admin/manage/roles'] = "admin/dashboard/manage/roles";
$route['admin/manage/categories'] = "admin/dashboard/manage/categories";
$route['admin/manage/departments'] = "admin/dashboard/manage/departments";
$route['admin/manage/ticket_priorities'] = "admin/dashboard/manage/ticket_priorities";
$route['admin/manage/ticket_statuses'] = "admin/dashboard/manage/ticket_statuses";
$route['admin/manage/ticket_types'] = "admin/dashboard/manage/ticket_types";
$route['admin/manage/company'] = "admin/dashboard/company";
$route['admin/get_detail'] = "admin/dashboard/get_detail";
$route['admin/delete'] = "admin/dashboard/delete";
$route['admin/staff'] = "admin/users";
$route['admin/tenants'] = "admin/users";
$route['admin/news_announcements'] = "admin/news";
$route['admin/home_slider'] = "admin/media/home_slider";
$route['admin/logos'] = "admin/media/logos";
$route['admin/social_media'] = "admin/social_media/manage/social_media";
$route['admin/subscribers'] = "admin/newsletters/subscribers";
$route['admin/subscribers/add'] = "admin/newsletters/add_subscriber";
$route['admin/newsletters/add'] = 'admin/newsletters/edit';
$route['admin/newsletters/delete/(:any)'] = 'admin/newsletters/action/delete/$1';
$route['admin/subscribers/delete/(:any)'] = 'admin/newsletters/action/delete/$1/subscriber';

$route['staff'] = "staff/dashboard";
$route['staff/logout'] = "login/logout";
$route['staff/profile'] = "staff/dashboard/profile";
$route['staff/tickets/view/(:any)'] = 'admin/tickets/view/$1';
$route['staff/tickets'] = "staff/tickets/staff_index";
$route['staff/tickets/reply/(:any)'] = "admin/tickets/reply/$1";

$route['signup'] = "login/signup";
$route['login'] = "login";

$route['profile'] = "profile";
$route['home'] = "home";
$route['forgot_password'] = "home/forgot_password";

$route['tickets'] = "tickets";
$route['knowledgebase/(:any)'] = "knowledgebase/view/$1";
$route['news/(:any)'] = "news/view/$1";
$route['announcements/(:any)'] = "announcements/view/$1";
$route['knowledgebase/add_comments'] = "knowledgebase/add_comments";
require_once( BASEPATH .'database/DB.php' );
$db =& DB();
// $route['(:any)'] = 'page/index/$1';
$query = $db->get( 'pages' );
    $result = $query->result();
// print_r($result);
    foreach( $result as $row )
    {
      $slug = strtolower(str_replace(' ', '-', $row->navigation_name));
     
      $route[ $slug ] = 'page/index/'.$slug;
    }
// exit;
