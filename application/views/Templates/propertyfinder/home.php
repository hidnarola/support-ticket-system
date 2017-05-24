<?php
$page = $this->uri->segment(1);
$current_page = $this->uri->segment(2);
$page_url = $this->uri->segment(3);
?>
<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="format-detection" content="telephone=no">
        <link rel="icon" type="image/x-icon" href="images/favicon.png" />
        <title><?= $title ?></title>
        <link rel="icon" href="assets/frontend/images/favicon (1).ico" />
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif%3A400%2C700%7CRaleway%3A100%2C200%2C300%2C400%2C500%2C600%2C700%2C800%2C900%7COpen+Sans%3A300%2C400%2C600%2C700%2C800%7CMontserrat%3A700%2C400&amp;subset=cyrillic%2Ccyrillic-ext%2Clatin%2Cgreek-ext%2Cgreek%2Clatin-ext%2Cvietnamese&amp;ver=1.6.11" type="text/css" media="all">
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/booked/font-awesome.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/essgrid/tooltipster.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/essgrid/tooltipster-light.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/booked/styles.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/revslider/settings.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/fontello/css/fontello.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/style.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/_animation.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/shortcodes.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/booked/booked.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/instagram-widget.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/skin.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/custom-style.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/colors.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/responsive.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/skin.responsive.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/js/vendor/swiper/swiper.css' type='text/css' media='all' />
        <!--<link rel='stylesheet' href='assets/propertyfinder/js/vendor/magnific-popup/magnific-popup.css' type='text/css' media='all' />-->
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/_messages.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/_portfolio.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom_narola.css' type='text/css' media='all' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <style type="text/css">
            .menu_main_responsive > .login_dropdown ul{
                color: #232a34;
                background-color: rgba(62, 59, 69, 0.9)
            }
            .menu_main_responsive > .login_dropdown ul li{
                padding: 3px 0px;
            }
            ul.sub-menu.dropdown-menu.animated {
                left: -221px;
            }
            li.menu-menu > ul.sub-menu {
                left: -180px !important;

            }

            .media-mobile-view{display:none;}
            @media(max-width:991px){
                li.menu-menu > ul.sub-menu {
                    left: -100px !important;
                }
            } 
            @media(max-width:640px){
                li.menu-menu > ul.sub-menu {
                    left: 0px !important;
                }
                li.menu-menu  ul.sub-menu{	    display: none !important;
                                               position: unset !important;
                                               width: 100%;
                                               margin-left: 0px;
                                               margin-top: 0px;
                                               box-shadow: none;
                                               border: transparent;
                }
                li.menu-menu ul.sub-menu a {

                    padding-left: 25px;
                    font-size: 13px;
                    border: none;
                }
                .media-desktop-view{display:none;}
                .media-mobile-view{display:block;}
                body .media-mobile-view ul.sub-menu {
                    width: 100% !important;
                    margin-left: 0px;
                }
            }
        </style>
    </head>
    <?php
    $class = 'body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_right';
    if ($this->uri->segment(2) == 'single-property') {
        $class = 'single-post body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
    } else if ($this->uri->segment(2) == 'search') {
        $class = 'page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
    } else if ($this->uri->segment(2) == 'portfolio' || $this->uri->segment(2) == 'gallery') {
        $class = 'page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above';
    }
    ?>
    <body class="<?php echo $class ?>">
        <div class="body_wrap">
            <div class="page_wrap">
                <header class="top_panel_wrap top_panel_style_1 scheme_original">
                    <div class="header-bg">
                        <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over <?php
                        if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home2' || ($this->uri->segment(1) == 'property-listing' && $this->uri->segment(2) == '')) {
                            echo 'header_shadow';
                        } else {
                            echo 'header_shadow2';
                        }
                        ?>">
                            <div class="content_wrap clearfix">
                                <div class="top_panel_logo">
                                    <div class="logo">
                                        <a href="/">
                                           <!-- <img src="assets/propertyfinder/images/MS-Logo-(1).png" class="logo_main" alt=""> -->
                                            <!--<img src="<?php echo 'assets/timthumb.php?src=' . base_url() . 'assets/propertyfinder/images/new-logo.png&w=209&h=104&s=100&q=100&zc=2'; ?>" class="logo_main" alt="">-->
                                            <img src="assets/propertyfinder/images/new-logo-header.png" class="logo_main" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="top_panel_contacts">
                                    <div class="top_panel_contacts_left">
                                        <div class="contact_phone">MBZ City, Abu Dhabi,</div>
                                        <div class="contact_email">info@manazelspecialists.ae</div>
                                    </div>
                                    <div class="top_panel_contacts_right">
                                        <div class="contact_phone"> 
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <span style="font-size:0.800em !important">+97124445050 (SUN - THUR : 8am to 4pm) </span>
                                        </div>
                                    </div>
                                    <div class="cL"></div>
                                </div>
                                <div class="top_panel_menu">
                                    <a href="#" class="menu_main_responsive_button icon-down">Select menu item</a>
                                    <nav class="menu_main_nav_area">
                                        <ul id="menu_main" class="menu_main_nav property_header">
                                            <!--                                 <li class="menu-item <?php
                                            if ($page == 'home') {
                                                echo 'current-menu-parent';
                                            }
                                            ?>">
                                                                                <a href="<?php echo base_url() . 'home'; ?>">Home</a>
                                                                             </li> -->
                                            <li class="menu-item <?php
                                            if ($page == '') {
                                                echo 'current-menu-parent';
                                            }
                                            ?>">
                                                <a href="<?php echo base_url(); ?>">Home</a>
                                            </li> 
                                            <?php
                                            $header_links = get_pages('header');
                                            $header_array = array('property-finder');
                                            if (count($header_links) > 0) {
                                                foreach ($header_links as $key => $value) {
                                                    if ($value['navigation_name'] == "Gallery") {
                                                        ?>
                                                        <li class="menu-menu dropdown media-desktop-view <?php
                                                        if ($page == 'gallery') {
                                                            echo 'current-menu-parent';
                                                        }
                                                        ?>">
                                                            <a href="#">Gallery</a>
                                                            <ul class="sub-menu dropdown-menu">
                                                                <li><a href="gallery/Al-Reef-Community">Al Reef Community</a></li>
                                                                <li><a href="#">Al Reef 2</a>
                                                                    <ul class="sub-menu dropdown-menu">
                                                                        <li><a href="gallery/Al-Reef-2-Villa-Mockup">Al Reef 2 Villa Mockup</a></li>
                                                                        <li><a href="http://www.virtualdusk.com/VR/MANAZEL/Manazel%20VR/3/">Virtual Reality – VR</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </li>


                                                        <li class="menu-item login_dropdown menu-item-has-children media-mobile-view"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery</a>
                                                            <ul class="sub-menu">
                                                                <li><a href="#">Al Reef Community</a></li>
                                                                <li class="menu-item login_dropdown menu-item-has-children"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Al Reef 2</a>
                                                                    <ul class="sub-menu">
                                                                        <li><a href="#">Al Reef 2 Villa Mockup</a></li>
                                                                        <li><a href="http://www.virtualdusk.com/VR/MANAZEL/Manazel%20VR/3/">Virtual Reality – VR</a></li>
                                                                    </ul>
                                                                </li>
                                                            </ul></li>
                                                        <?php
                                                    } elseif (isset($value['sub_menus'])) {
                                                        foreach ($value['sub_menus'] as $key1 => $value1) {
                                                            ?>
                                                            <li class="mega-menu">
                                                                <a href="<?php echo site_url($value1['url']); ?>"><?php echo $value1['navigation_name']; ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <li class="mega-menu <?php
                                                        if ($page == $value['url']) {
                                                            echo 'current-menu-parent';
                                                        }
                                                        ?>">
                                                            <?php if($value['navigation_name'] == "Payment") { ?>
                                                            <a href="javascript:void(0);" target="<?php
                                                            if (in_array($value['url'], $header_array)) {
                                                                echo '_blank';
                                                            }
                                                            ?>">
                                                                <div><?php echo $value['navigation_name']; ?></div>
                                                            </a>
                                                                <?php } else {?>
                                                            <a href="<?php echo site_url($value['url']); ?>" target="<?php
                                                            if (in_array($value['url'], $header_array)) {
                                                                echo '_blank';
                                                            }
                                                            ?>">
                                                                <div><?php echo $value['navigation_name']; ?></div>
                                                            </a>
                                                                <?php } ?>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
<!--                                            <li class="menu-menu <?php
                                            if ($page == 'portfolio') {
                                                echo 'current-menu-parent';
                                            }
                                            ?>">
                                                <a href="portfolio">Portfolio</a>
                                            </li>-->

<!--                                            <li class="menu-menu">
                                                <a href="javascript:void(0);">Payment</a>
                                            </li>-->


<!--                                            <li class="menu-menu dropdown media-desktop-view <?php
                                            if ($page == 'gallery') {
                                                echo 'current-menu-parent';
                                            }
                                            ?>">
                                                <a href="#">Gallery</a>
                                                <ul class="sub-menu dropdown-menu">
                                                    <li><a href="gallery/Al-Reef-Community">Al Reef Community</a></li>
                                                    <li><a href="#">Al Reef 2</a>
                                                        <ul class="sub-menu dropdown-menu">
                                                            <li><a href="gallery/Al-Reef-2-Villa-Mockup">Al Reef 2 Villa Mockup</a></li>
                                                            <li><a href="http://www.virtualdusk.com/VR/MANAZEL/Manazel%20VR/3/">Virtual Reality – VR</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>


                                            <li class="menu-item login_dropdown menu-item-has-children media-mobile-view"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery</a>
                                                <ul class="sub-menu">
                                                    <li><a href="#">Al Reef Community</a></li>
                                                    <li class="menu-item login_dropdown menu-item-has-children"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Al Reef 2</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="#">Al Reef 2 Villa Mockup</a></li>
                                                            <li><a href="http://www.virtualdusk.com/VR/MANAZEL/Manazel%20VR/3/">Virtual Reality – VR</a></li>
                                                        </ul>
                                                    </li>
                                                </ul></li>-->


                                            <!-- <li class="menu-item <?php
                                            if ($current_page == 'pages' && $page_url == 'about-us') {
                                                echo 'current-menu-parent';
                                            }
                                            ?>"><a href="property-finder/pages/about-us">About Us</a></li>
                                            <li class="menu-item"><a href="#">Service</a></li>
                                            <li class="menu-item"><a href="#">Media</a></li>
                                            <li class="menu-item"><a href="#">Contact Us</a></li> -->
                                            <li class="menu-item login_dropdown <?php
                                            if (!empty($this->session->userdata('user_logged_in'))) {
                                                echo 'menu-item-has-children';
                                            }
                                            ?>" >
                                                    <?php
                                                    if (!empty($this->session->userdata('user_logged_in'))) {
                                                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <img class="acc_preview" src="assets/propertyfinder/images/acc_preview.png">
                                             </a>
                                             <ul class="sub-menu">';
                                                        if ($this->session->userdata('role_id') == 1) {
                                                            echo '<li><a href="profile">Profile</a></li>
                                                         <li><a href="profile/changepassword">Change Password</a></li>';
                                                            if ($this->session->userdata('user_logged_in')['status'] == 1) {
                                                                echo '<li><a href="tickets">Tickets</a></li>';
                                                            }
                                                        }
                                                        echo '<li style="padding: 3px 0px"><a href="property-listing/wishlist">Wishlist</a></li>
                                                      <li style="padding: 3px 0px"><a href="login/logout">Logout</a></li>
                                             </ul>';
                                                    } else {
                                                        echo '<a href="login">Login</a>';
                                                    }
                                                    ?>
                                            </li>
                                            <!-- <li class="menu-item login_dropdown">
                                            <?php
                                            if (!empty($this->session->userdata('user_logged_in'))) {
                                                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <img class="acc_preview" src="assets/propertyfinder/images/acc_preview.png">
                                             </a>
                                             <ul class="dropdown-menu login_dropdown">
                                                <li style="padding: 3px 0px;border-bottom: 1px solid #fff;"><a href="property-finder/wishlist">Wishlist</a></li>
                                                <li style="padding: 3px 0px;border-bottom: 1px solid #fff;"><a href="login/logout">Logout</a></li>
                                             </ul>';
                                            } else {
                                                echo '<a href="login">Login</a>';
                                            }
                                            ?>
                                            </li> -->
                                        </ul>
                                    </nav>
                                </div>
                                <div class="cL"></div>
                            </div>
                        </div>
                        <?php if ($this->uri->segment(1) == 'about-us' || $this->uri->segment(1) == 'contact-us' || $this->uri->segment(1) == 'portfolio' || $this->uri->segment(1) == 'gallery' || $this->uri->segment(1) == 'career') { ?>
                            <div class="top_panel_title top_panel_style_1  title_present scheme_original breadcrumbs_image">
                                <div class="top_panel_title_inner top_panel_inner_style_1 breadcrumbs_present_inner">
                                    <div class="content_wrap">
                                        <h1 class="page_title"><?= $title ?></h1>
                                        <div class="breadcrumbs"><a class="breadcrumbs_item home" href="/">Home</a><span class="breadcrumbs_delimiter"></span><span class="breadcrumbs_item current"><?= $title ?></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </header>
                <?php echo $body; ?>
                <?php $this->load->view('Templates/propertyfinder/footer'); ?>

                <div class="copyright_wrap copyright_style_menu scheme_original">
                    <div class="copyright_wrap_inner">
                        <div class="content_wrap">
                            <ul class="menu_footer_nav">
                                <li class="menu-item"><a href="#">Disclaimer</a></li>
                                <li class="menu-item"><a href="#">Privacy</a></li>
                                <li class="menu-item"><a href="#">Advertisement</a></li>
                                <li class="menu-item"><a href="contacts.html">Contact us</a></li>
                            </ul>
                            <div class="copyright_text">ESTATE © 2016 All Rights Reserved</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="scroll_to_top icon-up"></a>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/jquery.js'></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom/plugins.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom/messages.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/jquery-migrate.min.js'></script>
        <link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
        <script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/essgrid/lightbox.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/essgrid/jquery.themepunch.tools.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/essgrid/jquery.themepunch.essential.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/revslider/jquery.themepunch.revolution.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/modernizr.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/ui/jquery-ui.min.js'></script>
        <script type="text/javascript" src="assets/propertyfinder/js/vendor/revslider/revolution.extension.slideanims.min.js"></script>
        <script type="text/javascript" src="assets/propertyfinder/js/vendor/revslider/revolution.extension.layeranimation.min.js"></script>
        <script type="text/javascript" src="assets/propertyfinder/js/vendor/revslider/revolution.extension.navigation.min.js"></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/superfish.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom/_utils.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom/_init.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom/_shortcodes.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/parallax.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/skrollr.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/swiper/swiper.min.js'></script>
        <!--<script type='text/javascript' src='assets/propertyfinder/js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>-->
        <!-- <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script> -->
        <script type='text/javascript' src='assets/propertyfinder/js/custom/_googlemap.js'></script>
        <script src="//storage.googleapis.com/vrview/2.0/build/vrview.min.js"></script>

        <script type='text/javascript' src='assets/propertyfinder/js/vendor/isotope.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom_narola.js'></script>
        <script>

            $(document).ready(function () {
                //    $('.menu_main_responsive > .login_dropdown').click(function(){
                //       var t_this = $(this);
                //       if(t_this.find('ul').css('display') == 'none'){
                //          t_this.find('ul').css({'display':'block','left':'0'});
                //       }else{
                //          t_this.find('ul').css('display','none');
                //       }
                //    });
                // });
                // $(document).click(function(){
                //   $(".dropdown-menu.login_dropdown").hide();
                $(".menu-menu").click(function () {
                    $(".sub-menu").addClass("open");
                });
            });
        </script>
    </body>
</html>

<script>
    $('#rev_slider_4_1').revolution({
        delay: 9000,
        startwidth: 1170,
        startheight: 700,
        hideThumbs: 10,
        fullWidth: "off",
        fullScreen: "on",
        fullScreenOffsetContainer: "",
        navigation: {
            keyboardNavigation: "on",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "on",
            touch: {
                touchenabled: "off",
                swipe_treshold: 75,
                swipe_min_touches: 1,
                drag_block_vertical: !1,
                swipe_direction: "horizontal"
            },
            arrows: {
                style: "",
                enable: !1,
                hide_onmobile: !1,
                hide_onleave: !0,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                hide_under: 0,
                hide_over: 9999,
                tmp: "",
                left: {
                    h_align: "left",
                    v_align: "center",
                    h_offset: 20,
                    v_offset: 0
                },
                right: {
                    h_align: "right",
                    v_align: "center",
                    h_offset: 20,
                    v_offset: 0
                }
            },
            bullets: {
                style: "",
                enable: !1,
                hide_onmobile: !1,
                hide_onleave: !0,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                hide_under: 0,
                hide_over: 9999,
                direction: "horizontal",
                h_align: "left",
                v_align: "center",
                space: 0,
                h_offset: 20,
                v_offset: 0,
                tmp: '<span class="tp-bullet-image"></span><span class="tp-bullet-title"></span>'
            }
        }
    });
    $('.slider_wrap').addClass('forcefullwidth_wrapper_tp_banner');
</script>
<style>
    .rev_slider.fullwidthabanner.revslider-initialised.tp-simpleresponsive,
    .forcefullwidth_wrapper_tp_banner{ height:700px !important; }
    .tp-rightarrow.tparrows.uranus.noSwipe{ display: block !important; }
</style>