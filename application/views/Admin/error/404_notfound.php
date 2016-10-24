<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Support Ticket - Back End</title>
        <base href="<?php echo base_url(); ?>">

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/admin/css/colors.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/pace.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/jquery.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/core/libraries/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->


        <!-- Theme JS files -->
        <script type="text/javascript" src="assets/admin/js/core/app.js"></script>
        <!-- /theme JS files -->

    </head>

    <body class="navbar-top">

        <!-- Main navbar -->
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
        <!-- /main navbar -->


        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Content area -->
                    <div class="content">

                        <!-- Error title -->
                        <div class="text-center content-group">
                            <h1 class="error-title">404</h1>
                            <h5>Oops, an error has occurred. Page not found!</h5>
                        </div>
                        <!-- /error title -->


                        <!-- Error content -->
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                                <form action="#" class="main-search">
<!--                                    <div class="input-group content-group">
                                        <input type="text" class="form-control input-lg" placeholder="Search">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn bg-slate-600 btn-icon btn-lg"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>-->

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="admin" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Go to dashboard</a>
                                        </div>

<!--                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-default btn-block content-group"><i class="icon-menu7 position-left"></i> Advanced search</a>
                                        </div>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /error wrapper -->


                        <!-- Footer -->
                        <!--					<div class="footer text-muted text-center">
                                                                        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                                                                </div>-->
                        <!-- /footer -->

                    </div>
                    <!-- /content area -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

    </body>
</html>
