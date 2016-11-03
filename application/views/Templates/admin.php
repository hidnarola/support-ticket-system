<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support Ticket - Admin</title>
        <base href="<?php echo base_url(); ?>">

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <!--<link href="assets/admin/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">-->
        <link href="assets/admin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/colors.css" rel="stylesheet" type="text/css">
        <!--<link href="assets/css/common.css" rel="stylesheet" type="text/css" id="style-primary">-->
        <link href="assets/admin/css/style.css" rel="stylesheet" type="text/css">
        <!--<link href="assets/admin/css/common.css" rel="stylesheet" type="text/css" id="style-primary">-->

        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/blockui.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/login_validation.js"></script>

        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/form_layouts.js"></script>
        <!-- /core JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/notifications/bootbox.min.js"></script>

        <!-- /core JS files -->
<!--        <script>
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 7000);
        </script>-->
        <style>
            .page-title {
                color: #333;
                height: 50px;
                line-height: 50px;
                padding: 5px 20px;
            }
            .page-header-content {
                background-color: inherit;
                padding: 0;
                position: relative;
            }

            .navbar-nav {
                margin-left: 5px;
                width: 50px;
            }
        </style>
    </head>

    <body class="navbar-top">

        <div class="navbar navbar-inverse bg-teal navbar-fixed-top header-highlight">
            <!--<div class="navbar navbar-default navbar-fixed-top header-highlight">-->
            <div class="navbar-header">
                <a class="navbar-brand" href="admin">
                    <!-- <img src="assets/img/logo.png" alt=""> -->
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

                <div class="navbar-right">
                    <p class="navbar-text">Hello <?php
                        if ($this->session->userdata('admin_logged_in')) {
                            echo $this->session->userdata('admin_logged_in')['fname'];
                        }
                        ?>!</p>
                </div>
            </div>
        </div>
        <?php
        $current_page = $this->uri->segment(3);
        $page = $this->uri->segment(2);
        $users = $page . '/' . $current_page;
        $settings = array('roles', 'ticket_priorities', 'ticket_statuses', 'ticket_types');
        ?>
        <div class="page-container">
            <div class="page-content">
                <div class="sidebar sidebar-main sidebar-fixed">
                    <div class="sidebar-content">
                        <div class="sidebar-user-material">
                            <div class="category-content">
                                <div class="sidebar-user-material-content">
                                    <a href="admin" class="legitRipple">
                                        <img src="assets/images/no_photo.png" class="img-circle img-responsive" alt=""></a>
                                    <h6>Hello <?php
                                        if ($this->session->userdata('admin_logged_in')) {
                                            echo $this->session->userdata('admin_logged_in')['fname'];
                                        }
//                                        pr($this->session->userdata('admin_logged_in'),1);
                                        ?> !</h6>
                                </div>

                                <div class="sidebar-user-material-menu">
                                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                                </div>
                            </div>

                            <div class="navigation-wrapper collapse" id="user-nav">
                                <ul class="navigation">
                                    <li><a href="admin/profile"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                                    <li><a href="admin/logout"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">
                                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>


                                    <li class="<?php echo ($page == '') ? 'active' : ''; ?>"><a href="admin"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                    <li class="<?php echo ($users == 'users/tenants') ? 'active' : ''; ?>"><a href="admin/users/tenants"><i class="icon-users"></i> <span>Tenants</span></a></li>
                                    <li class="<?php echo ($users == 'users/staffs') ? 'active' : ''; ?>"><a href="admin/users/staffs"><i class="icon-people"></i> <span>Staff</span></a></li>
                                    <li class="<?php echo ($page == 'tickets') ? 'active' : ''; ?>"><a href="admin/tickets"><i class="icon-ticket"></i> <span>Tickets</span></a></li>
                                    <li class="<?php echo ($current_page == 'categories') ? 'active' : ''; ?>"><a href="admin/manage/categories"><i class="icon-grid2"></i> <span>Categories</span></a></li>
                                    <li class="<?php echo ($current_page == 'departments') ? 'active' : ''; ?>"><a href="admin/manage/departments"><i class="icon-collaboration"></i> <span>Departments</span></a></li>
                                    <li class="<?php echo ($current_page == 'news_announcements') ? 'active' : ''; ?>"><a href="admin/news_announcements"><i class="icon-newspaper"></i> <span>News and Announcements</span></a></li>
                                    <li class="<?php echo ($current_page == 'faq') ? 'active' : ''; ?>"><a href="admin/faq"><i class="icon-question3"></i> <span>FAQ'S</span></a></li>


                                    <li class="<?php echo (in_array($current_page, $settings)) ? 'active' : ''; ?>">
                                        <a href="#"><i class="icon-gear"></i><span>Settings</span></a>
                                        <ul>
                                            <li class="<?php echo ($current_page == 'roles') ? 'active' : ''; ?>"><a href="admin/manage/roles"><i class="icon-vcard"></i> <span>Roles</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_priorities') ? 'active' : ''; ?>"><a href="admin/manage/ticket_priorities"><i class="icon-list-numbered"></i> <span>Ticket Priorities</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_statuses') ? 'active' : ''; ?>"><a href="admin/manage/ticket_statuses"><i class="icon-stats-bars2"></i> <span>Ticket Statuses</span></a></li>
                                            <li class="<?php echo ($current_page == 'ticket_types') ? 'active' : ''; ?>"><a href="admin/manage/ticket_types"><i class="icon-grid-alt"></i> <span>Ticket Types</span></a></li>
                                            <li class="<?php echo ($current_page == 'company') ? 'active' : ''; ?>"><a href="admin/manage/company"><i class="icon-office"></i> <span>Company Details</span></a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h2 style="line-height: 40px;">
                                    <i class="<?php echo $icon_class; ?>" style="padding-right: 15px;"></i>
                                    <span class="text-semibold" style="border-left: 1px solid #333;padding-left: 15px;"><?php echo $page_header; ?></span></h2>
                            </div>
                            <?php
                            if ($this->session->flashdata('success_msg')) {
                                ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $this->session->flashdata('success_msg'); ?>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if ($this->session->flashdata('error_msg')) {
                                ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $this->session->flashdata('error_msg'); ?>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="alert alert-dismissible div_alert_error" role="alert" style="display: none;">
                                <button type="button" class="close alert_close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div id="error_msg_div">
                                    <p class="alert_error_msg"></p>
                                </div>
                            </div>
                        </div>

                    </div>                                       
                    <div class="content">
                        <?php echo $body; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Theme JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/ui/nicescroll.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/bootstrap_select.min.js"></script>

        <script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>

        <script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>

        <script type="text/javascript" src="assets/admin/js/plugins/ui/ripple.min.js"></script>

        <!-- /theme JS files -->

    </body>
</html>
