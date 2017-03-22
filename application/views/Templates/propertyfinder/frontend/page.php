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
        <link rel="stylesheet" href="assets/frontend/css/bootstrap.css" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
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
        <link rel='stylesheet' href='assets/propertyfinder/css/custom/_portfolio.css' type='text/css' media='all' />
        <link rel='stylesheet' href='assets/propertyfinder/css/custom_narola.css' type='text/css' media='all' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/frontend/css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/style.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/custom.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/dark.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/animate.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/components/bs-datatable.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/responsive.css" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="assets/frontend/js/jquery.js"></script>

        <style type="text/css">
            .menu_main_responsive > .login_dropdown ul{
               color: #232a34;
               background-color: rgba(62, 59, 69, 0.9)
            }
            .menu_main_responsive > .login_dropdown ul li{
               padding: 3px 0px;
            }
            border-bottom: 1px solid #fff;
            }
        </style>
   </head>
   <?php 
      $class= 'body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_right'; 
      if($this->uri->segment(2)=='single-property'){
         $class = 'single-post body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
      } else if($this->uri->segment(2)=='search'){
         $class = 'page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right';
      } else if ($this->uri->segment(2)=='portfolio'){
         $class = 'page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above';
      }
   ?>
   <body class="<?php echo $class ?>">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over <?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='home2' || ($this->uri->segment(1)=='property-listing' && $this->uri->segment(2)=='')){ echo 'header_shadow'; }else{ echo 'header_shadow2'; } ?>">
                     <div class="content_wrap clearfix">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="/">
                                 <img src="assets/propertyfinder/images/logo-header.png" class="logo_main" alt="">
                              </a>
                           </div>
                        </div>
                        <div class="top_panel_contacts">
                           <div class="top_panel_contacts_left">
                              <div class="contact_phone">MBZ City, Abu Dhabi,</div>
                              <div class="contact_email">info@manazelspecialists.com</div>
                           </div>
                           <div class="top_panel_contacts_right">call us: <strong><i>800</i> 123 45 67</strong></div>
                           <div class="cL"></div>
                        </div>
                        <div class="top_panel_menu">
                           <a href="#" class="menu_main_responsive_button icon-down visible-xs">Select menu item</a>
                           <nav class="menu_main_nav_area">
                              <ul id="menu_main" class="menu_main_nav property_header">
                                 <li class="menu-item <?php if($page==''){ echo 'current-menu-parent'; } ?>">
                                    <a href="<?php echo base_url(); ?>">Home</a>
                                 </li> 
                                 <?php 
                                    $header_links = get_pages('header');
                                    $header_array = array('property-finder');
                                    if(count($header_links) > 0){
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
                                             <li class="mega-menu <?php if($page==$value['url']){ echo 'current-menu-parent'; } ?>">
                                                <a href="<?php echo site_url($value['url']); ?>" target="<?php if(in_array($value['url'],$header_array)){ echo '_blank'; } ?>">
                                                   <div><?php echo $value['navigation_name']; ?></div>
                                                </a>
                                             </li>
                                          <?php
                                          }
                                       }
                                    }
                                 ?>
                                 <li class="menu-menu <?php if($page=='portfolio'){ echo 'current-menu-parent'; } ?>">
                                    <a href="portfolio">Portfolio</a>
                                 </li>
                                 <li class="menu-item login_dropdown <?php if(!empty($this->session->userdata('user_logged_in'))){ echo 'menu-item-has-children'; } ?>" >
                                    <?php 
                                       if(!empty($this->session->userdata('user_logged_in'))){
                                          echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <img class="acc_preview" src="assets/propertyfinder/images/acc_preview.png">
                                             </a>
                                             <ul class="sub-menu">';
                                                if($this->session->userdata('role_id')==1){
                                                   echo '<li><a href="profile">Profile</a></li>
                                                         <li><a href="profile/changepassword">Change Password</a></li>';
                                                   if($this->session->userdata('user_logged_in')['status']==1){
                                                      echo '<li><a href="tickets">Tickets</a></li>';
                                                   }
                                                }
                                                echo '<li style="padding: 3px 0px"><a href="property-listing/wishlist">Wishlist</a></li>
                                                      <li style="padding: 3px 0px"><a href="login/logout">Logout</a></li>
                                             </ul>';
                                       }else{
                                          echo '<a href="login">Login</a>';
                                       }
                                    ?>
                                 </li>
                              </ul>
                           </nav>
                        </div>
                        <div class="cL"></div>
                     </div>
                  </div>
                  <?php if($this->uri->segment(1)=='about-us' || $this->uri->segment(1)=='contact-us' || $this->uri->segment(1)=='portfolio' || $this->uri->segment(1)=='career'){ ?>
                  <div class="top_panel_title top_panel_style_1  title_present scheme_original breadcrumbs_image">
                     <div class="top_panel_title_inner top_panel_inner_style_1 breadcrumbs_present_inner">
                        <div class="content_wrap">
                           <h1 class="page_title"><?= $title ?></h1>
                           <div class="breadcrumbs"><a class="breadcrumbs_item home" href="/">Home</a><span class="breadcrumbs_delimiter"></span><span class="breadcrumbs_item current"><?= $title ?></span></div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
                  <?php if($this->uri->segment(1)=='login' || $this->uri->segment(1)=='forgot_password' || ($this->uri->segment(1)=='profile' && $this->uri->segment(2)!='') || $this->uri->segment(1)=='tickets' || $this->uri->segment(1)=='announcements'){ ?>
                  <div class="top_panel_title top_panel_style_1  title_present scheme_original breadcrumbs_image">
                     <div class="top_panel_title_inner top_panel_inner_style_1 breadcrumbs_present_inner">
                        <div class="content_wrap">
                           <h1 class="page_title"><?= $header_title ?></h1>
                           <div class="breadcrumbs"><a class="breadcrumbs_item home" href="/">Home</a><span class="breadcrumbs_delimiter"></span><span class="breadcrumbs_item current"><?= $header_title ?></span></div>
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
        <script type='text/javascript' src='assets/propertyfinder/js/custom/_googlemap.js'></script>
        <script src="//storage.googleapis.com/vrview/2.0/build/vrview.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
        <script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
        <script type='text/javascript' src='assets/propertyfinder/js/vendor/isotope.min.js'></script>
        <script type='text/javascript' src='assets/propertyfinder/js/custom_narola.js'></script>
        <?php if($this->uri->segment(1)!='login'){ ?>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <?php } ?>
        <script type="text/javascript" src="assets/frontend/js/plugins.js"></script>
        <script type="text/javascript" src="assets/frontend/js/components/bs-datatable.js"></script>
        <script type="text/javascript" src="assets/frontend/js/functions.js"></script>
        <script type="text/javascript">
            // $("#s").autocomplete({
            //     minLength: 1,
            //     source:
            //             function (req, add) {
            //                 $.ajax({
            //                     url: "<?php echo base_url() . 'home/articles'; ?>",
            //                     dataType: 'json',
            //                     type: 'POST',
            //                     data: req,
            //                     success:
            //                             function (data) {
            //                                 if (data.response === "true") {
            //                                     add(data.message);
            //                                 }
            //                             }
            //                 });
            //             },
            //     select: function (event, ui) {
            //         $("#s").val(ui.item.value);
            //         var id = ui.item.id;
            //         var val = ui.item.value;
            //         $.ajax({
            //             type: 'POST',
            //             url: "<?php echo base_url() . 'home/getArticle'; ?>",
            //             dataType: 'json',
            //             data: {id: id},
            //             success: function (data) {
            //                 if (data != '') {
            //                     console.log(data);
            //                     console.log(data.data.slug);
            //                     var url = window.location.href;
            //                     url= url + '/' +data.data.category +'/'+data.data.slug;
            //                     window.location.href = url;
            //                 }
            //             }
            //         });
            //     }
            // });
        </script>
        <style>
            
            [class^="icon-"]:before, [class*=" icon-"]:before { font-family: inherit !important; }
            .scroll_to_top:before, .icon-down:before{font-family: "fontello" !important;margin:10px !important;}
        </style>
   </body>
</html>