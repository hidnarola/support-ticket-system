<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support Ticket - Admin</title>
        <base href="<?php echo base_url(); ?>">

        <!-- Global stylesheets -->
        <link rel="icon" href="assets/frontend/images/favicon (1).ico" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/colors.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/style.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
<!--        <script type="text/javascript" src="assets/admin/js/plugins/visualization/d3/d3.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/visualization/d3/d3_tooltip.js"></script>-->
        <script type="text/javascript" src="assets/admin/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/ui/moment/moment.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/pickers/daterangepicker.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/validation/validate.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
        <!--<script type="text/javascript" src="assets/admin/js/pages/dashboard.js"></script>-->
        <script type="text/javascript" src="assets/admin/js/plugins/notifications/bootbox.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/select2.min.js"></script>

        <script type="text/javascript" src="assets/admin/js/pages/form_layouts.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/form_validation.js"></script>
        <!-- /theme JS files -->

    </head>

    <body>
        <?php
        $image = USER_PROFILE_IMAGE . '/' . $this->session->userdata('admin_logged_in')['profile_pic'];
        if ($this->session->userdata('admin_logged_in')['profile_pic'] == '') {
            $image = "assets/admin/images/placeholder.jpg";
        }

        $permissions = array();

        if($this->session->userdata('module_ids')){
            $permissions = explode(',', $this->session->userdata('module_ids'));
        }
       
        ?>
        <!-- Main navbar -->
        <div class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin">
                    <i class="icon-ticket position-left"></i>
                    Support Ticket System
                </a>

                <ul class="nav navbar-nav visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="navbar-mobile">
                <ul class="nav navbar-nav">
                    <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

                </ul>               

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">

                            <img class="img-circle img-sm" src="<?php echo $image; ?>" alt="">
                            <span><?php
                                if ($this->session->userdata('admin_logged_in')) {
                                    echo $this->session->userdata('admin_logged_in')['fname'].'!';
                                }
//                                        pr($this->session->userdata('admin_logged_in'),1);
                                ?> </span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="admin/profile"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li><a href="admin/logout"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navbar -->


        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main sidebar -->
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">

                        <!-- User menu -->
                        <div class="sidebar-user">
                            <div class="category-content">
                                <div class="media">
                                    <a href="admin" class="media-left"><img src="<?php echo $image; ?>" class="img-circle img-sm" alt=""></a>
                                    <div class="media-body">
                                        <span class="media-heading text-semibold"><?php
                                            if ($this->session->userdata('admin_logged_in')) {
                                                echo $this->session->userdata('admin_logged_in')['fname'] . " " . $this->session->userdata('admin_logged_in')['lname'].'!';
                                            }
//                                        pr($this->session->userdata('admin_logged_in'),1);
                                            ?> </span>

                                            <div class="text-size-mini text-muted">
                                            <i class="icon-user-tie text-size-small"></i>
                                            <?php  echo (isset($this->session->userdata('admin_logged_in')['subadmin_id'])) ? "Sub Admin" : 'Admin'; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /user menu -->


                        <?php
                        $current_page = $this->uri->segment(3);
                        $page = $this->uri->segment(2);
                        $settings = array('roles', 'ticket_priorities', 'ticket_statuses', 'ticket_types', 'smtp_settings');
                        $knowledgebase = array('faq', 'articles');
                        $email_templates = array('email_templates', 'add');
                        $newsletters = array('newsletters', 'subscribers');
                        ?>
                        <!-- Main navigation -->
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">

                                    <!-- Main -->
                                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                    <li class="<?php echo ($page == '') ? 'active' : ''; ?>"><a href="admin"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                    
                                    <?php if(empty($permissions)){ ?>
                            
                                    <li class="<?php echo ($page == 'sub_admin') ? 'active' : ''; ?>"><a href="admin/sub_admin"><i class="icon-user-tie"></i> <span>Sub Admins</span></a></li> 
                                    <?php } ?>

                                    <?php if(in_array('1', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'tenants') ? 'active' : ''; ?>"><a href="admin/tenants"><i class="icon-users"></i> <span>Tenants</span></a></li>
                                    <?php } ?>

                                    <?php if(in_array('2', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'staff') ? 'active' : ''; ?>"><a href="admin/staff"><i class="icon-people"></i> <span>Staff</span></a></li>

                                    <?php } ?>
                                    <?php if(in_array('3', $permissions) || empty($permissions)){ ?>

                                    <li class="<?php echo ($page == 'tickets') ? 'active' : ''; ?>"><a href="admin/tickets"><i class="icon-ticket"></i> <span>Tickets</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('4', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'pages') ? 'active' : ''; ?>"><a href="admin/pages"><i class="icon-magazine"></i> <span>Manage Pages</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('5', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'header_footer_control') ? 'active' : ''; ?>"><a href="admin/header_footer_control"><i class="icon-cogs"></i> <span>Header/Footer Settings</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('6', $permissions) || empty($permissions)){ ?>
                                     <li class="<?php echo (in_array($page, $newsletters)) ? 'active' : ''; ?>">
                                        <a href="#"><i class="icon-book"></i><span>Manage Newsletters</span></a>
                                        <ul>
                                            <li class="<?php echo ($page == 'newsletters') ? 'active' : ''; ?>"><a href="admin/newsletters"><i class="icon-envelop4"></i> <span>Newsletters</span></a></li>
                                            <li class="<?php echo ($page == 'subscribers') ? 'active' : ''; ?>"><a href="admin/subscribers"><i class="icon-person"></i> <span>Subscribers</span></a></li>

                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('7', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo (in_array($page, $knowledgebase)) ? 'active' : ''; ?>">
                                        <a href="#"><i class="icon-book"></i><span>Knowledge Base</span></a>
                                        <ul>
                                            <li class="<?php echo ($page == 'faq') ? 'active' : ''; ?>"><a href="admin/faq"><i class="icon-question3"></i> <span>FAQ'S</span></a></li>
                                            <li class="<?php echo ($page == 'articles') ? 'active' : ''; ?>"><a href="admin/articles"><i class="icon-magazine"></i> <span>Articles</span></a></li>

                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('8', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo (in_array($current_page, $settings)) ? 'active' : ''; ?>">
                                        <a href="#"><i class="icon-gear"></i><span>Settings</span></a>
                                        <ul>
                                            <!-- <li class="<?php //echo ($current_page == 'roles') ? 'active' : '';    ?>"><a href="admin/manage/roles"><i class="icon-vcard"></i> <span>Roles</span></a></li> -->
                                            <li class="<?php echo ($current_page == 'smtp_settings') ? 'active' : '';    ?>"><a href="admin/manage/smtp_settings"><i class="icon-envelop2"></i> <span>SMTP Settings</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_priorities') ? 'active' : ''; ?>"><a href="admin/manage/ticket_priorities"><i class="icon-list-numbered"></i> <span>Ticket Priorities</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_statuses') ? 'active' : ''; ?>"><a href="admin/manage/ticket_statuses"><i class="icon-stats-bars2"></i> <span>Ticket Statuses</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_types') ? 'active' : ''; ?>"><a href="admin/manage/ticket_types"><i class="icon-grid-alt"></i> <span>Ticket Types</span></a></li>
                                            <li class="<?php echo ($current_page == 'company') ? 'active' : ''; ?>"><a href="admin/manage/company"><i class="icon-office"></i> <span>Company Details</span></a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('9', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($current_page == 'categories') ? 'active' : ''; ?>"><a href="admin/manage/categories"><i class="icon-grid2"></i> <span>Categories</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('10', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($current_page == 'departments') ? 'active' : ''; ?>"><a href="admin/manage/departments"><i class="icon-collaboration"></i> <span>Departments</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('11', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php
                                            if ($page == 'news_announcements') {
                                                echo 'active';
                                            } elseif ($page == 'news') {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                        ?>">
                                        <a href="admin/news_announcements"><i class="icon-newspaper"></i> <span>News and Announcements</span></a>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('16', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo (in_array($page, $email_templates)) ? 'active' : ''; ?>">
                                        <a href="#"><i class="icon-book"></i><span>Manage Email Templates</span></a>
                                        <ul>
                                            <li class="<?php echo ($page == 'email_templates') ? 'active' : ''; ?>"><a href="admin/email_templates"><i class="icon-question3"></i> <span>Email Templates List</span></a></li>
                                            <li class="<?php echo ($current_page == 'add' && $page == 'email_templates') ? 'active' : ''; ?>"><a href="admin/email_templates/add"><i class="icon-magazine"></i> <span>Add New Template</span></a></li>

                                        </ul>
                                    </li>
                                    <?php } ?>

                                   <?php if(in_array('12', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'home_slider') ? 'active' : ''; ?>"><a href="admin/home_slider"><i class="icon-images3"></i> <span>Home Page Slider</span></a>
                                    </li>
                                    <?php } ?> 
                                    <?php if(in_array('13', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'logos') ? 'active' : ''; ?>"><a href="admin/logos"><i class="icon-images2"></i> <span>Logos</span></a>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('14', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'social_media') ? 'active' : ''; ?>"><a href="admin/social_media"><i class="icon-facebook"></i> <span>Social Media</span></a></li>
                                    <?php } ?>
                                    <?php if(in_array('15', $permissions) || empty($permissions)){ ?>
                                    <li class="<?php echo ($page == 'projects') ? 'active' : ''; ?>"><a href="admin/projects"><i class="icon-calendar2"></i> <span>Projects</span></a></li>
                                    <?php } ?>


                                    <!-- /page kits -->

                                </ul>
                            </div>
                        </div>
                        <!-- /main navigation -->

                    </div>
                </div>
                <!-- /main sidebar -->


                <!-- Main content -->
                <div class="content-wrapper">                    

                    <!--                    <div class="alert alert-dismissible div_alert_error" role="alert" style="display: none;">
                                            <button type="button" class="close alert_close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <div id="error_msg_div">
                                                <p class="alert_error_msg"></p>
                                            </div>
                                        </div>-->

                    <!-- Page header -->
                    <?php echo $body; ?>
                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

    </body>
</html>




