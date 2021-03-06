<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('TBL_ARTICLES','articles');
define('TBL_CATEGORIES','categories');
define('TBL_DEPARTMENTS','departments');
define('TBL_FAQ','faq');
define('TBL_MEDIA','media');
define('TBL_NEWS_ANNOUNCEMENTS','news_announcements');
define('TBL_PAGES','pages');
define('TBL_ROLES','roles');
define('TBL_STAFF','staff');
define('TBL_TICKET_CONVERSATION','ticket_conversation');
define('TBL_TICKET_PRIORITIES','ticket_priorities');
define('TBL_TICKET_STATUSES','ticket_statuses');
define('TBL_TICKET_TYPES','ticket_types');
define('TBL_TICKETS','tickets');
define('TBL_USERS','users');
define('TBL_SETTINGS','settings');
define('TBL_SOCIAL_MEDIA','social_media');
define('TBL_ARTICLE_COMMENTS','article_comments');
define('TBL_PROJECTS','projects');
define('TBL_LOGOS','logos');
define('TBL_NEWSLETTERS','newsletters');
define('TBL_NEWSLETTER_SUBSCRIBERS','newsletter_subscribers');
define('TBL_NEWSLETTER_SETTINGS','newsletter_settings');
define('TBL_NEWSLETTERS_TEST_EMAILS','newsletters_test_emails');
define('TBL_TENANT_CONTRACTS','tenant_contracts');
define('TBL_SUBADMIN_MODULES','subadmin_modules');
define('TBL_MODULES','modules');
define('TBL_EMAIL_TEMPLATES','email_templates');
define('TBL_EMAIL_NOTIFICATIONS','email_notifications');
define('TBL_BEACONS','beacons');
define('TBL_PROP_CAT','property_category');
define('TBL_PROP_TYPE','property_type');
define('TBL_PROP_LIST','property_listing');
define('TBL_PROP_BANNER','property_landing_banner');
define('TBL_PROP_WISHLIST','property_wishlist');



/*  |	set upload folder constants */

define('USER_PROFILE_IMAGE', 'uploads/user_profile_image/original');
define('PROFILE_THUMB_IMAGE', 'uploads/user_profile_image/thumb');
define('PROFILE_MEDIUM_IMAGE', 'uploads/user_profile_image/medium');

define('USER_CONTRACT', 'uploads/contracts');
define('PROJECTS_IMAGES', 'uploads/projects');

define('NEWS_IMAGE', 'uploads/news/original');
define('NEWS_THUMB_IMAGE', 'uploads/news/thumb');
define('NEWS_MEDIUM_IMAGE', 'uploads/news/medium');

define('ANNOUNCEMENT_IMAGE', 'uploads/news/original');
define('ANNOUNCEMENT_THUMB_IMAGE', 'uploads/news/thumb');
define('ANNOUNCEMENT_MEDIUM_IMAGE', 'uploads/news/medium');

define('ARTICLE_IMAGE', 'uploads/articles');
define('ARTICLE_THUMB_IMAGE', 'uploads/articles/thumb');
define('ARTICLE_MEDIUM_IMAGE', 'uploads/articles/medium');

define('HOME_IMAGE', 'uploads/media/home_page/original');
define('HOME_THUMB_IMAGE', 'uploads/media/home_page/thumb');
define('HOME_MEDIUM_IMAGE', 'uploads/media/home_page/medium');

define('GALLERY_IMAGE', 'uploads/media/gallery/original');
define('GALLERY_THUMB_IMAGE', 'uploads/media/gallery/thumb');
define('GALLERY_MEDIUM_IMAGE', 'uploads/media/gallery/medium');

define('TICKET_IMAGE', 'uploads/tickets/original');
define('TICKET_THUMB_IMAGE', 'uploads/tickets/thumb');
define('TICKET_MEDIUM_IMAGE', 'uploads/tickets/medium');

define('PAGE_BANNER', 'uploads/pages/original');
define('PAGE_THUMB_IMAGE', 'uploads/pages/thumb');
define('PAGE_MEDIUM_IMAGE', 'uploads/pages/medium');

define('SOCIAL_IMAGE', 'uploads/social_media');

define('PROPERTY_IMAGE', 'uploads/properties/original');
define('PROPERTY_THUMB_IMAGE', 'uploads/properties/thumb');
define('PROPERTY_MEDIUM_IMAGE', 'uploads/properties/medium');

define('PROPERTY_BANNER', 'uploads/properties/slider');

define("FIREBASE_API_KEY", "AAAARwszyOU:APA91bHAPbdDqYKx9thiT8Bya4MglDcqMKiPVWm-kyRhaQIPjQWbEwsHKs3t434jJvTzDP2b6vclzw4X0i_E3KBv1ScGikxL5mTzm25gjAFK9dQsX2LuHwRPoDWpG89ztQOyqbGM51oAe2BgDvme6z0N9--Lbvaiuw");
define("FIREBASE_FCM_URL", "https://fcm.googleapis.com/fcm/send");
define("SUCCESS", "success");
define("FAILED", "failed");


define('TEMPLATE_ID',2);