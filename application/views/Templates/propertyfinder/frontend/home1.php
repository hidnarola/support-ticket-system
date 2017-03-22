<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
        <title><?php echo $title; ?></title>
        <base href="<?php echo base_url(); ?>">

        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/style.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/swiper.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css" type="text/css" />

        <link rel="stylesheet" href="assets/frontend/css/responsive.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- Document Title
        ============================================= -->

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
                            <a href="<?php echo base_url(); ?>" class="standard-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                            <a href="<?php echo base_url(); ?>" class="retina-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                        </div><!-- #logo end -->

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">
                            <?php $page = $this->uri->segment(1); ?>
                            <ul>
                                <li class="<?php echo ($page == 'home') ? 'current' : ''; ?>"><a href="<?php echo base_url(); ?>"><div>Home</div></a></li>
                                <?php if ($user['status'] != 0 && $this->session->userdata('user_logged_in')) { ?>
                                    <li class="mega-menu <?php echo ($page == 'tickets') ? 'current' : ''; ?>"><a href="tickets"><div>Tickets</div></a></li>
                                    <li class="<?php echo ($page == 'knowledgebase') ? 'current' : ''; ?>">
                                        <a href="#" class="sf-with-ul"><div>Knowledge Base</div></a>                                        <ul>
                                            <li><a href="knowledgebase"><div>Articles</div></a></li>                                      
                                            <li><a href="faq"><div>FAQ'S</div></a></li>                                      
                                        </ul>
                                    </li>
                                    <li class="mega-menu <?php echo ($page == 'news') ? 'current' : ''; ?>"><a href="news"><div>News</div></a></li>
                                    <li class="mega-menu <?php echo ($page == 'announcements') ? 'current' : ''; ?>"><a href="announcements"><div>Announcements</div></a></li>
                                    </li>
                                <?php } ?>
                                <?php
                                $header_links = get_pages('header');
                                if (count($header_links) > 0) {
                                    foreach ($header_links as $key => $value) {
                                        if (isset($value['sub_menus'])) {
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
                        </nav><!-- #primary-menu end -->

                    </div>

                </div>

            </header><!-- #header end -->
<?php echo $body; ?>
            
 <!-- External JavaScripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/jquery.js"></script>
        <script type="text/javascript" src="assets/frontend/js/plugins.js"></script>

        <!-- Footer Scripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/functions.js"></script>
        <script type="text/javascript" src="assets/frontend/js/plugins/jquery.swiper.js"></script>
            <?php $this->load->view('Templates/frontend/footer'); ?>

        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>

       <script>
    var swiper = new Swiper('.swiper-container', {
        paginationClickable: true,
//        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false
    });
    </script>

    </body>
</html>