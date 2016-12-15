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
$route['404_override'] = 'Login/page_not_found';
$route['admin/access_denied'] = 'Admin/Dashboard/access_denied';
$route['translate_uri_dashes'] = FALSE;

$route['admin/logout'] = "Login/logout";
$route['logout'] = "Login/logout";
$route['support/login'] = "Login";
$route['admin'] = "Admin/Dashboard";
$route['admin/profile'] = "Admin/Dashboard/profile";
$route['admin/manage/roles'] = "Admin/Dashboard/manage/roles";
$route['admin/manage/categories'] = "Admin/Dashboard/manage/categories";
$route['admin/manage/departments'] = "Admin/Dashboard/manage/departments";
$route['admin/manage/ticket_priorities'] = "Admin/Dashboard/manage/ticket_priorities";
$route['admin/manage/ticket_statuses'] = "Admin/Dashboard/manage/ticket_statuses";
$route['admin/manage/ticket_types'] = "Admin/Dashboard/manage/ticket_types";
$route['admin/manage/company'] = "Admin/Dashboard/company";
$route['admin/get_detail'] = "Admin/Dashboard/get_detail";
$route['admin/delete'] = "Admin/Dashboard/delete";
$route['admin/staff'] = "Admin/Users";
$route['admin/tenants'] = "Admin/Users";
$route['admin/news_announcements'] = "Admin/News";
$route['admin/home_slider'] = "Admin/Media/home_slider";
$route['admin/logos'] = "Admin/Media/logos";
$route['admin/social_media'] = "Admin/Social_media/manage/social_media";
$route['admin/subscribers'] = "Admin/Newsletters/subscribers";
$route['admin/subscribers/add'] = "Admin/Newsletters/add_subscriber";
$route['admin/newsletters/add'] = 'Admin/Newsletters/edit';
$route['admin/newsletters/delete/(:any)'] = 'Admin/Newsletters/action/delete/$1';
$route['admin/subscribers/delete/(:any)'] = 'Admin/Newsletters/action/delete/$1/subscriber';

$route['admin/sub_admin/add'] = 'Admin/Sub_admin/manage';
$route['admin/sub_admin/edit/(:any)'] = 'Admin/Sub_admin/manage/$1';

$route['staff'] = "Staff/Dashboard";
$route['staff/logout'] = "Login/logout";
$route['staff/profile'] = "Staff/Dashboard/profile";
$route['staff/tickets/view/(:any)'] = 'Admin/Tickets/view/$1';
$route['staff/tickets'] = "Staff/Tickets/staff_index";
$route['staff/tickets/reply/(:any)'] = "Admin/Tickets/reply/$1";

$route['signup'] = "Login/signup";
$route['login'] = "Login";

$route['profile'] = "Profile";
$route['home'] = "Home";
$route['forgot_password'] = "Home/forgot_password";
$route['reset_password'] = "Home/reset_password";

$route['tickets'] = "Tickets";
$route['knowledgebase/(:any)'] = "Knowledgebase/index/$1";
$route['knowledgebase/(:any)/(:any)'] = "Knowledgebase/view/$2";
$route['news/(:any)'] = "News/view/$1";
$route['announcements/(:any)'] = "Announcements/view/$1";
$route['knowledgebase/add_comments'] = "Knowledgebase/add_comments";
require_once( BASEPATH .'database/DB.php' );
$db =& DB();
// $route['(:any)'] = 'page/index/$1';
$query = $db->get( 'pages' );
    $result = $query->result();
// print_r($result);
    foreach( $result as $row )
    {
      $slug = strtolower(str_replace(' ', '-', $row->navigation_name));
     
      $route[ $slug ] = 'Page/index/'.$slug;
    }
// exit;
