<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
        <base href="<?php echo base_url(); ?>">
        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="icon" href="assets/frontend/images/favicon (1).ico" />
        <link rel="stylesheet" href="assets/frontend/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/style.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/custom.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css" type="text/css" />
        <!-- Bootstrap File Upload CSS -->
        <!--<link rel="stylesheet" href="assets/frontend/css/components/bs-filestyle.css" type="text/css" />-->
        <link rel="stylesheet" href="assets/frontend/css/responsive.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script type="text/javascript" src="assets/frontend/js/jquery.js"></script>

        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- Document Title
        ============================================= -->
        <title><?php echo $title; ?></title>

    </head>

    <body class="stretched">

        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">

            <!-- Header
            ============================================= -->
            <header id="header" class="full-header">

                <div id="header-wrap">

                    <div class="container clearfix">

                        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                        <!-- Logo
                        ============================================= -->
                        <div id="logo">
                            <a href="home" class="standard-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                            <a href="home" class="retina-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                        </div><!-- #logo end -->


                        <div id="top-account" class="dropdown">
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user"></i><i class="icon-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li><a href="profile">Profile</a></li>
                                <li><a href="profile/changepassword">Change Password</a></li>
                                <!--<li><a href="#">Settings</a></li>-->
                                <li role="separator" class="divider"></li>
                                <li><a href="login/logout">Logout <i class="icon-signout"></i></a></li>
                            </ul>
                        </div>

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">

                            <?php $page = $this->uri->segment(1); ?>
                            <ul>
                                <li class="<?php echo ($page == 'home') ? 'current' : ''; ?>"><a href="home"><div>Home</div></a></li>
                                <?php if ($user['status'] != 0 && $this->session->userdata('user_logged_in')) { ?>
                                    <li class="mega-menu <?php echo ($page == 'tickets') ? 'current' : ''; ?>"><a href="tickets"><div>Tickets</div></a></li>
                                    <li class="<?php echo ($page == 'knowledgebase') ? 'current' : ''; ?>"><a  href="#" class="sf-with-ul"><div>Knowledge Base</div></a>
                                        <ul>
                                            <li><a href="knowledgebase"><div>Articles</div></a></li>                                      
                                            <li><a href="faq"><div>FAQ'S</div></a></li>                                      
                                        </ul>
                                    </li>
                                    <li class="mega-menu <?php echo ($page == 'news') ? 'current' : ''; ?>"><a href="news"><div>News</div></a></li>
                                    <li class="mega-menu <?php echo ($page == 'announcements') ? 'current' : ''; ?>"><a href="announcements"><div>Announcements</div></a></li>
                                <?php } ?>
                                <?php 
                        $header_links = get_pages('header');
                        
                        if(count($header_links) > 0){
                            ?>
                            
                            <?php
                            foreach ($header_links as $key => $value) {
                                if(isset($value['sub_menus'])){
                                        foreach ($value['sub_menus'] as $key1 => $value1) {
                                    ?>
                                        <li class="mega-menu">
                                            <a href="<?php echo site_url($value1['url']); ?>"><?php echo $value1['navigation_name']; ?></a>
                                        </li>
                                <?php
                                        }
                                } else {
                                    ?>
                                        <li class="mega-menu">
                                            <a href="<?php echo site_url($value['url']); ?>"><div><?php echo $value['navigation_name']; ?></div></a>
                                        </li>
                                    <?php
                                }
                            }
                        }
                    ?>
                                <!--<li class="mega-menu"><a href="login"><div>Gallery</div></a></li>-->
                                <?php if ($this->session->userdata('user_logged_in') == '') { ?>
                                    <li class="mega-menu <?php echo ($page == 'login') ? 'current' : ''; ?>"><a href="login"><div>Login/Signup</div></a></li>
                                <?php } ?>
                            </ul>

                            <!-- Top Search
                            ============================================= -->
                            <div id="top-search">
                                <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                                <form action="search.html" method="get">
                                    <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                                </form>
                            </div><!-- #top-search end -->

                        </nav><!-- #primary-menu end -->

                    </div>

                </div>

            </header><!-- #header end -->

            <!-- Content
            ============================================= -->
            <section id="content">

                <?php echo $body; ?>

            </section><!-- #content end -->

            <!-- Footer
            ============================================= -->
            <?php $this->load->view('Templates/frontend/footer'); ?>

        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>

        <!-- External JavaScripts
        ============================================= -->

        <script type="text/javascript" src="assets/frontend/js/plugins.js"></script>

        <!-- Bootstrap File Upload Plugin -->
        <!--<script type="text/javascript" src="assets/frontend/js/components/bs-filestyle.js"></script>-->
        <!-- Footer Scripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/functions.js"></script>

        <script>
//		jQuery( "#tabs-profile" ).on( "tabsactivate", function( event, ui ) {
//			jQuery( '.flexslider .slide' ).resize();
//		});
        </script>

    </body>
    <!--</html>-->