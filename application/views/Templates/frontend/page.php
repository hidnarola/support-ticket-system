<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
        <base href="<?php echo base_url(); ?>">
        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <!-- Favicons -->
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
        <!-- Bootstrap Data Table Plugin -->
        <link rel="stylesheet" href="assets/frontend/css/components/bs-datatable.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/responsive.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script type="text/javascript" src="assets/frontend/js/jquery.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- Document Title
        ============================================= -->
        <title><?php echo $title;   ?></title>

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
                            <a href="index.html" class="standard-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                            <a href="index.html" class="retina-logo" data-dark-logo="assets/frontend/images/MS-Logo-(1).png"><img src="assets/frontend/images/MS-Logo-(1).png" alt="Canvas Logo"></a>
                        </div><!-- #logo end -->
                        <?php
                        if ($this->session->userdata('user_logged_in')) {
//                                                echo $this->session->userdata('admin_logged_in')['fname'] . " " . $this->session->userdata('admin_logged_in')['lname'];
                            ?>
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
                        <?php } ?>
                        <!-- Primary Navigation
                        ============================================= -->
                        <?php
                        $page = $this->uri->segment(1);
                        $sec_segment = $this->uri->segment(2);

                        $user = $this->User_model->getUserByID($this->session->userdata('user_logged_in')['id']);
                        ?>
                        <nav id="primary-menu">
                            <ul>
<!--                                <li><a href="index.html"><div>Home</div></a>
                                    <ul>
                                        <li><a href="index-corporate.html"><div>Home - Corporate</div></a>
                                        </li>                                      
                                    </ul>
                                </li>-->
                                <li <?php echo ($page == 'home') ? 'current' : ''; ?>><a href="home"><div>Home</div></a></li>
                                <?php if ($user['status'] != 0 && $this->session->userdata('user_logged_in')) { ?>
                                    <li class="mega-menu <?php echo ($page == 'tickets') ? 'current' : ''; ?>"><a href="tickets"><div>Tickets</div></a></li>
<!--                                    <li class="mega-menu <?php // echo ($page == 'knowledgebase') ? 'current' : ''; ?>"><a href="knowledgebase"><div>Knowledge Base</div></a>
                                    </li>-->
                                     <li class="<?php echo ($page == 'knowledgebase') ? 'current' : ''; ?>"><a href="knowledgebase"><div>Knowledge Base</div></a>
                                    <ul>
                                        <li><a href="faq"><div>FAQ'S</div></a>
                                        </li>                                      
                                    </ul>
                                </li>
                                <?php } ?>
                                <li class="mega-menu"><a href="login"><div>About us</div></a></li>
                                <li class="mega-menu"><a href="login"><div>Contact us</div></a></li>
                                <li class="mega-menu"><a href="login"><div>Services</div></a></li>
                                <li class="mega-menu"><a href="login"><div>Communities</div></a></li>
                                <li class="mega-menu"><a href="login"><div>Gallery</div></a></li>
                                <?php if ($this->session->userdata('user_logged_in') == '') { ?>
                                    <li class="mega-menu <?php echo ($page == 'login') ? 'current' : ''; ?>"><a href="login"><div>Login</div></a></li>
                                <?php } ?>
                            </ul>

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

            <!-- Page Title
            ============================================= -->
            <section id="page-title">

                <div class="container clearfix">
                    <h1><?php echo $header_title; ?></h1>
                    <?php if ($page == 'knowledgebase') { ?>
                        <div id="live-search">
                            <form role="search" method="post" id="searchform" class="clearfix" action="knowledgebase" autocomplete="off"> 
                                <input type="text" onfocus="if (this.value == 'Search the knowledge base...') {
                                            this.value = '';
                                        }" onblur="if (this.value == '') {
                                                    this.value = 'Search the knowledge base...';
                                                }" value="Search the knowledge base..." name="s" id="s" autocomplete="off">
                                <!--<input type="hidden" name="post_type[]" value="st_kb">-->
                            </form>
                        </div>
                        <style>
                            #page-title {
                                padding: 35px 0;
                            }
                        </style>
                    <?php }
                    ?>
                    <ol class="breadcrumb">
                        <li><a href="home">Home</a></li>
                        <?php
                        if ($page != '' && $sec_segment == '') {
                            if ($page == 'knowledgebase') {
                                ?>
                                <li class="active"><?php echo 'Knowledge Base'; ?></li>
                            <?php } else { ?>

                                <li class="active"><?php echo $page; ?></li>
                                <?php
                            }
                        } else if ($page != '' && $sec_segment != '') {
                            ?>
                            <li><a href="<?php echo $page; ?>"><?php echo $page; ?></a></li>
                        <?php } ?>
                        <?php if ($sec_segment != '') { ?>
                            <li class="active"><?php echo $sec_segment; ?></li>
                        <?php } ?>
                    </ol>
                </div>

            </section><!-- #page-title end -->

            <!-- Content
            ============================================= -->
            <section id="content">

                <?php echo $body; ?>

            </section><!-- #content end -->

            <!-- Footer
            ============================================= -->
            <footer id="footer" class="dark">

                <div class="container">

                    <!-- Footer Widgets
                    ============================================= -->
                    <div class="footer-widgets-wrap clearfix">

                        <div class="col_two_third">

                            <div class="col_one_third">

                                <div class="widget clearfix">

                                    <img src="assets/frontend/images/footer-widget-logo.png" alt="" class="footer-logo">

                                    <p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards.</p>

                                    <div style="background: url('assets/frontend/images/world-map.png') no-repeat center center; background-size: 100%;">
                                        <address>
                                            <strong>Headquarters:</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                        </address>
                                        <abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
                                        <abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
                                        <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
                                    </div>

                                </div>

                            </div>

                            <div class="col_one_third">

                                <div class="widget widget_links clearfix">

                                    <h4>Blogroll</h4>

                                    <ul>
                                        <li><a href="http://codex.wordpress.org/">Documentation</a></li>
                                        <li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
                                        <li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
                                        <li><a href="http://wordpress.org/support/">Support Forums</a></li>
                                        <li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
                                        <li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
                                        <li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
                                    </ul>

                                </div>

                            </div>

                            <div class="col_one_third col_last">

                                <div class="widget clearfix">
                                    <h4>Recent Posts</h4>

                                    <div id="post-list-footer">
                                        <div class="spost clearfix">
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="spost clearfix">
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="spost clearfix">
                                            <div class="entry-c">
                                                <div class="entry-title">
                                                    <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                </div>
                                                <ul class="entry-meta">
                                                    <li>10th July 2014</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col_one_third col_last">

                            <div class="widget clearfix" style="margin-bottom: -20px;">

                                <div class="row">

                                    <div class="col-md-6 bottommargin-sm">
                                        <div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
                                        <h5 class="nobottommargin">Total Downloads</h5>
                                    </div>

                                    <div class="col-md-6 bottommargin-sm">
                                        <div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
                                        <h5 class="nobottommargin">Clients</h5>
                                    </div>

                                </div>

                            </div>

                            <div class="widget subscribe-widget clearfix">
                                <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                                <div class="widget-subscribe-form-result"></div>
                                <form id="widget-subscribe-form" action="include/subscribe.php" role="form" method="post" class="nobottommargin">
                                    <div class="input-group divcenter">
                                        <span class="input-group-addon"><i class="icon-email2"></i></span>
                                        <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Subscribe</button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <div class="widget clearfix" style="margin-bottom: -20px;">

                                <div class="row">

                                    <div class="col-md-6 clearfix bottommargin-sm">
                                        <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                    </div>
                                    <div class="col-md-6 clearfix">
                                        <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                                            <i class="icon-rss"></i>
                                            <i class="icon-rss"></i>
                                        </a>
                                        <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div><!-- .footer-widgets-wrap end -->

                </div>

                <!-- Copyrights
                ============================================= -->
                <div id="copyrights">

                    <div class="container clearfix">

                        <div class="col_half">
                            Copyrights &copy; 2014 All Rights Reserved by Canvas Inc.<br>
                            <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
                        </div>

                        <div class="col_half col_last tright">
                            <div class="fright clearfix">
                                <a href="#" class="social-icon si-small si-borderless si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-pinterest">
                                    <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-vimeo">
                                    <i class="icon-vimeo"></i>
                                    <i class="icon-vimeo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-github">
                                    <i class="icon-github"></i>
                                    <i class="icon-github"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-yahoo">
                                    <i class="icon-yahoo"></i>
                                    <i class="icon-yahoo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>
                            </div>

                            <div class="clear"></div>

                            <i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +91-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
                        </div>

                    </div>

                </div><!-- #copyrights end -->

            </footer><!-- #footer end -->

        </div><!-- #wrapper end -->

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>

        <!-- External JavaScripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/jquery.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/frontend/js/plugins.js"></script>
        <!-- Bootstrap Data Table Plugin -->
        <script type="text/javascript" src="assets/frontend/js/components/bs-datatable.js"></script>
        <!-- Bootstrap File Upload Plugin -->
        <!--<script type="text/javascript" src="assets/frontend/js/components/bs-filestyle.js"></script>-->
        <!-- Footer Scripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/functions.js"></script>

        <script type="text/javascript">
$("#s").autocomplete({
    minLength: 1,
    source:
            function (req, add) {
                $.ajax({
                    url: "<?php echo base_url() . 'home/articles'; ?>",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:
                            function (data) {
                                if (data.response === "true") {
                                    add(data.message);
                                }
                            }
                });
            },
    select: function (event, ui) {
        $("#s").val(ui.item.value);
        var id = ui.item.id;
        var val = ui.item.value;
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url() . 'home/getArticle'; ?>",
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                if (data != '') {
                    console.log(data.data.slug);
                    var url = window.location.href;
                    url= url+'/'+data.data.slug;
                    window.location.href = url;
                }
            }
        });

    }
});
        </script>
    </body>
</html>