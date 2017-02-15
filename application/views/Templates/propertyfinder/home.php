<?php 
   $page = $this->uri->segment(1);
   $current_page = $this->uri->segment(2);
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
      <link rel='stylesheet' href='assets/propertyfinder/js/vendor/magnific-popup/magnific-popup.css' type='text/css' media='all' />
      <link rel='stylesheet' href='assets/propertyfinder/css/custom/_messages.css' type='text/css' media='all' />
      <link rel='stylesheet' href='assets/propertyfinder/css/custom_narola.css' type='text/css' media='all' />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   </head>
   <?php 
      $class= 'body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_right'; 
      if($this->uri->segment(2)=='single-property'){
         $class = 'single-post body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
      } else if($this->uri->segment(2)=='search'){
         $class = 'page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
      }
   ?>
   <body class="<?php echo $class ?>">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="<?php echo site_url('property-finder'); ?>">
                                 <img src="assets/frontend/images/MS-Logo-(1).png" class="logo_main" alt="">
                                 <!-- <img src="assets/propertyfinder/images/logo-header1.jpg" class="logo_main" alt=""> -->
                              </a>
                           </div>
                        </div>
                        <div class="top_panel_contacts">
                           <div class="top_panel_contacts_left">
                              <div class="contact_phone">121 King Street, NY, USA</div>
                              <div class="contact_email">contact@yoursite.com</div>
                           </div>
                           <div class="top_panel_contacts_right">call us: <strong><i>800</i> 123 45 67</strong></div>
                           <div class="cL"></div>
                        </div>
                        <div class="top_panel_menu">
                           <a href="#" class="menu_main_responsive_button icon-down">Select menu item</a>
                           <nav class="menu_main_nav_area">
                              <ul id="menu_main" class="menu_main_nav">
                                 <li class="menu-item <?php if($page=='property-finder' && $current_page==''){ echo 'current-menu-parent'; } ?>">
                                    <a href="<?php echo site_url('property-finder'); ?>">Home</a>
                                 </li> 
                                 <li class="menu-item"><a href="#">About Us</a></li>
                                 <li class="menu-item"><a href="#">Service</a></li>
                                 <li class="menu-item"><a href="#">Media</a></li>
                                 <li class="menu-item"><a href="#">Contact Us</a></li>
                              </ul>
                           </nav>
                        </div>
                        <div class="cL"></div>
                     </div>
                  </div>
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
      <script type='text/javascript' src='assets/propertyfinder/js/vendor/essgrid/lightbox.js'></script>
      <script type='text/javascript' src='assets/propertyfinder/js/vendor/essgrid/jquery.themepunch.tools.min.js'></script>
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
      <script type='text/javascript' src='assets/propertyfinder/js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
      <!-- <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script> -->
      <script type='text/javascript' src='assets/propertyfinder/js/custom/_googlemap.js'></script>
      <script src="//storage.googleapis.com/vrview/2.0/build/vrview.min.js"></script>
      <script type='text/javascript' src='assets/propertyfinder/js/custom_narola.js'></script>
   </body>
</html>

<script>
   //window.addEventListener('load', onVrViewLoad)
   
</script>