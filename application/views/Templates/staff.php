<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support Ticket - Staff</title>
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
        <link href="assets/css/common.css" rel="stylesheet" type="text/css" id="style-primary">
        <link href="assets/admin/css/style.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/login_validation.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/form_layouts.js"></script>
        <!-- /core JS files -->

        <!-- /core JS files -->
<!--        <script>
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 7000);
        </script>-->
    </head>

    <body>

        <div class="navbar navbar-inverse">
            <!--<div class="navbar navbar-default navbar-fixed-top header-highlight">-->
            <div class="navbar-header">
                <a class="navbar-brand" href="staff">
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
                            <img src="assets/admin/images/placeholder.jpg" alt="">
                            <span><?php
                                if ($this->session->userdata('staffed_logged_in')) {
                                    echo $this->session->userdata('staffed_logged_in')['fname'];
                                }
//                                        pr($this->session->userdata('admin_logged_in'),1);
                                ?> !</span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="staff/profile"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                            <li><a href="staff/logout"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <?php
            $current_page = $this->uri->segment(2);
            $settings = array('roles', 'ticket_priorities', 'ticket_statuses', 'ticket_types');
        ?>
        <div class="page-container">
            <div class="page-content">
                <div class="sidebar sidebar-main">
                    <div class="sidebar-content">
                        <div class="sidebar-user">
                            <div class="category-content">
                                <div class="media">
                                    <a href="#" class="media-left"><img src="assets/admin/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                                    <div class="media-body">
                                        <span class="media-heading text-semibold"><?php
                                            if ($this->session->userdata('staffed_logged_in')) {
                                                echo $this->session->userdata('staffed_logged_in')['fname'];
                                            }
//                                        pr($this->session->userdata('admin_logged_in'),1);
                                            ?> !</span>
<!--                                        <div class="text-size-mini text-muted">
                                            <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                                        </div>-->
                                    </div>

<!--                                    <div class="media-right media-middle">
                                        <ul class="icons-list">
                                            <li>
                                                <a href="#"><i class="icon-cog3"></i></a>
                                            </li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-category sidebar-category-visible">
                            <div class="category-content no-padding">
                                <ul class="navigation navigation-main navigation-accordion">
                                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                                    <li class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>"><a href="staff/dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                                    <li class="<?php echo ($current_page == 'tickets') ? 'active' : ''; ?>"><a href="staff/tickets"><i class="icon-ticket"></i> <span>Tickets</span></a></li>
                                </ul>
                            </div>
                        </div>      
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h2><span class="text-semibold"><?php echo $page_header; ?></span></h2>
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
        <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
        <!-- <script type="text/javascript" src="assets/admin/js/plugins/ui/ripple.min.js"></script> -->

        <!-- /theme JS files -->
        
    </body>
</html>
