<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />
         <base href="<?php echo base_url(); ?>">

        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="assets/frontend/style.css" type="text/css" />
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
        <title>Profile | Canvas</title>

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
                            <a href="index.html" class="standard-logo" data-dark-logo="assets/frontend/images/logo-dark.png"><img src="assets/frontend/images/logo.png" alt="Canvas Logo"></a>
                            <a href="index.html" class="retina-logo" data-dark-logo="assets/frontend/images/logo-dark@2x.png"><img src="assets/frontend/images/logo@2x.png" alt="Canvas Logo"></a>
                        </div><!-- #logo end -->

                        <div id="top-account" class="dropdown">
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="icon-user"></i><i class="icon-angle-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Messages <span class="badge">5</span></a></li>
                                <li><a href="#">Settings</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Logout <i class="icon-signout"></i></a></li>
                            </ul>
                        </div>

                        <!-- Primary Navigation
                        ============================================= -->
                        <nav id="primary-menu">

                            <ul>
                                <li><a href="index.html"><div>Home</div></a>
                                    
                                </li>
                                
                            </ul>

                            <!-- Top Cart
                            ============================================= -->
                            <div id="top-cart">
                                <a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i><span>5</span></a>
                                <div class="top-cart-content">
                                    <div class="top-cart-title">
                                        <h4>Shopping Cart</h4>
                                    </div>
                                    <div class="top-cart-items">
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="#"><img src="assets/frontend/images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="#">Blue Round-Neck Tshirt</a>
                                                <span class="top-cart-item-price">$19.99</span>
                                                <span class="top-cart-item-quantity">x 2</span>
                                            </div>
                                        </div>
                                        <div class="top-cart-item clearfix">
                                            <div class="top-cart-item-image">
                                                <a href="#"><img src="assets/frontend/images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
                                            </div>
                                            <div class="top-cart-item-desc">
                                                <a href="#">Light Blue Denim Dress</a>
                                                <span class="top-cart-item-price">$24.99</span>
                                                <span class="top-cart-item-quantity">x 3</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="top-cart-action clearfix">
                                        <span class="fleft top-checkout-price">$114.95</span>
                                        <button class="button button-3d button-small nomargin fright">View Cart</button>
                                    </div>
                                </div>
                            </div><!-- #top-cart end -->

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

                <div class="content-wrap">

                    <div class="container clearfix">

                        <div class="row clearfix">

                            <div class="col-sm-9">

                                <img src="assets/frontend/images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">

                                <div class="heading-block noborder">
                                    <h3>SemiColonWeb</h3>
                                    <span>Your Profile Bio</span>
                                </div>

                                <div class="clear"></div>

                                <div class="row clearfix">

                                    <div class="col-md-12">

                                        <div class="tabs tabs-alt clearfix" id="tabs-profile">

                                            <ul class="tab-nav clearfix">
                                                <li><a href="#tab-feeds"><i class="icon-rss2"></i> Feeds</a></li>
                                                <li><a href="#tab-posts"><i class="icon-pencil2"></i> Posts</a></li>
                                                <li><a href="#tab-replies"><i class="icon-reply"></i> Replies</a></li>
                                                <li><a href="#tab-connections"><i class="icon-users"></i> Connections</a></li>
                                            </ul>

                                            <div class="tab-container">

                                                <div class="tab-content clearfix" id="tab-feeds">

                                                    <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium harum ea quo! Nulla fugiat earum, sed corporis amet iste non, id facilis dolorum, suscipit, deleniti ea. Nobis, temporibus magnam doloribus. Reprehenderit necessitatibus esse dolor tempora ea unde, itaque odit. Quos.</p>

                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <colgroup>
                                                                <col class="col-xs-1">
                                                                <col class="col-xs-7">
                                                            </colgroup>
                                                            <thead>
                                                                <tr>
                                                                    <th>Time</th>
                                                                    <th>Activity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <code>5/23/2016</code>
                                                                    </td>
                                                                    <td>Payment for VPS2 completed</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <code>5/23/2016</code>
                                                                    </td>
                                                                    <td>Logged in to the Account at 16:33:01</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <code>5/22/2016</code>
                                                                    </td>
                                                                    <td>Logged in to the Account at 09:41:58</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <code>5/21/2016</code>
                                                                    </td>
                                                                    <td>Logged in to the Account at 17:16:32</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <code>5/18/2016</code>
                                                                    </td>
                                                                    <td>Logged in to the Account at 22:53:41</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                                <div class="tab-content clearfix" id="tab-posts">

                                                    <div class="row topmargin-sm clearfix">

                                                        <div class="col-xs-12 bottommargin-sm">
                                                            <div class="ipost clearfix">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="entry-image">
                                                                            <a href="assets/frontend/images/portfolio/full/17.jpg" data-lightbox="image"><img class="image_fade" src="assets/frontend/images/blog/grid/17.jpg" alt="Standard Post with Image"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="entry-title">
                                                                            <h3><a href="blog-single.html">This is a Standard post with a Preview Image</a></h3>
                                                                        </div>
                                                                        <ul class="entry-meta clearfix">
                                                                            <li><i class="icon-calendar3"></i> 10th Feb 2014</li>
                                                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                                                        </ul>
                                                                        <div class="entry-content">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 bottommargin-sm">
                                                            <div class="ipost clearfix">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="entry-image">
                                                                            <iframe src="http://player.vimeo.com/video/87701971" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="entry-title">
                                                                            <h3><a href="blog-single.html">This is a Standard post with a Embed Video</a></h3>
                                                                        </div>
                                                                        <ul class="entry-meta clearfix">
                                                                            <li><i class="icon-calendar3"></i> 10th Feb 2014</li>
                                                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                                                        </ul>
                                                                        <div class="entry-content">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 bottommargin-sm">
                                                            <div class="ipost clearfix">
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-4">
                                                                        <div class="entry-image">
                                                                            <div class="fslider" data-arrows="false">
                                                                                <div class="flexslider">
                                                                                    <div class="slider-wrap">
                                                                                        <div class="slide"><img class="image_fade" src="assets/frontend/images/blog/grid/10.jpg" alt="Standard Post with Gallery"></div>
                                                                                        <div class="slide"><img class="image_fade" src="assets/frontend/images/blog/grid/20.jpg" alt="Standard Post with Gallery"></div>
                                                                                        <div class="slide"><img class="image_fade" src="assets/frontend/images/blog/grid/21.jpg" alt="Standard Post with Gallery"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="entry-title">
                                                                            <h3><a href="blog-single.html">This is a Standard post with a Slider Gallery</a></h3>
                                                                        </div>
                                                                        <ul class="entry-meta clearfix">
                                                                            <li><i class="icon-calendar3"></i> 10th Feb 2014</li>
                                                                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
                                                                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                                                                        </ul>
                                                                        <div class="entry-content">
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in.</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="tab-content clearfix" id="tab-replies">

                                                    <div class="clear topmargin-sm"></div>
                                                    <ol class="commentlist noborder nomargin nopadding clearfix">
                                                        <li class="comment even thread-even depth-1" id="li-comment-1">
                                                            <div id="comment-1" class="comment-wrap clearfix">
                                                                <div class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                        <span class="comment-avatar clearfix">
                                                                            <img alt='' src='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' class='avatar avatar-60 photo avatar-default' height='60' width='60' /></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content clearfix">
                                                                    <div class="comment-author">John Doe<span><a href="#" title="Permalink to this comment">April 24, 2012 at 10:46 am</a></span></div>
                                                                    <p>Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                                                                    <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                            <ul class='children'>
                                                                <li class="comment byuser comment-author-_smcl_admin odd alt depth-2" id="li-comment-3">
                                                                    <div id="comment-3" class="comment-wrap clearfix">
                                                                        <div class="comment-meta">
                                                                            <div class="comment-author vcard">

                                                                                <span class="comment-avatar clearfix">
                                                                                    <img alt='' src='http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=40&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D40&amp;r=G' class='avatar avatar-40 photo' height='40' width='40' /></span>

                                                                            </div>
                                                                        </div>
                                                                        <div class="comment-content clearfix">
                                                                            <div class="comment-author"><a href='#' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                                                                            <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                                                                            <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">
                                                            <div class="comment-wrap clearfix">
                                                                <div class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                        <span class="comment-avatar clearfix">
                                                                            <img alt='' src='http://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' /></span>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content clearfix">
                                                                    <div class="comment-author"><a href='http://themeforest.net/user/semicolonweb' rel='external nofollow' class='url'>SemiColon</a><span><a href="#" title="Permalink to this comment">April 25, 2012 at 1:03 am</a></span></div>

                                                                    <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                                                                    <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </li>

                                                    </ol>

                                                </div>
                                                <div class="tab-content clearfix" id="tab-connections">

                                                    <div class="row topmargin-sm">
                                                        <div class="col-md-3 col-sm-6 bottommargin">

                                                            <div class="team">
                                                                <div class="team-image">
                                                                    <img src="assets/frontend/images/team/3.jpg" alt="John Doe">
                                                                </div>
                                                                <div class="team-desc">
                                                                    <div class="team-title"><h4>John Doe</h4><span>CEO</span></div>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                                                        <i class="icon-facebook"></i>
                                                                        <i class="icon-facebook"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                                                        <i class="icon-twitter"></i>
                                                                        <i class="icon-twitter"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                                                        <i class="icon-gplus"></i>
                                                                        <i class="icon-gplus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-3 col-sm-6 bottommargin">

                                                            <div class="team">
                                                                <div class="team-image">
                                                                    <img src="assets/frontend/images/team/2.jpg" alt="Josh Clark">
                                                                </div>
                                                                <div class="team-desc">
                                                                    <div class="team-title"><h4>Josh Clark</h4><span>Co-Founder</span></div>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                                                        <i class="icon-facebook"></i>
                                                                        <i class="icon-facebook"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                                                        <i class="icon-twitter"></i>
                                                                        <i class="icon-twitter"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                                                        <i class="icon-gplus"></i>
                                                                        <i class="icon-gplus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-3 col-sm-6 bottommargin">

                                                            <div class="team">
                                                                <div class="team-image">
                                                                    <img src="assets/frontend/images/team/8.jpg" alt="Mary Jane">
                                                                </div>
                                                                <div class="team-desc">
                                                                    <div class="team-title"><h4>Mary Jane</h4><span>Sales</span></div>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                                                        <i class="icon-facebook"></i>
                                                                        <i class="icon-facebook"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                                                        <i class="icon-twitter"></i>
                                                                        <i class="icon-twitter"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                                                        <i class="icon-gplus"></i>
                                                                        <i class="icon-gplus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-3 col-sm-6">

                                                            <div class="team">
                                                                <div class="team-image">
                                                                    <img src="assets/frontend/images/team/4.jpg" alt="Nix Maxwell">
                                                                </div>
                                                                <div class="team-desc">
                                                                    <div class="team-title"><h4>Nix Maxwell</h4><span>Support</span></div>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-facebook">
                                                                        <i class="icon-facebook"></i>
                                                                        <i class="icon-facebook"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-twitter">
                                                                        <i class="icon-twitter"></i>
                                                                        <i class="icon-twitter"></i>
                                                                    </a>
                                                                    <a href="#" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                                                        <i class="icon-gplus"></i>
                                                                        <i class="icon-gplus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="line visible-xs-block"></div>

                            <div class="col-sm-3 clearfix">

                                <div class="list-group">
                                    <a href="#" class="list-group-item clearfix">Profile <i class="icon-user pull-right"></i></a>
                                    <a href="#" class="list-group-item clearfix">Servers <i class="icon-laptop2 pull-right"></i></a>
                                    <a href="#" class="list-group-item clearfix">Messages <i class="icon-envelope2 pull-right"></i></a>
                                    <a href="#" class="list-group-item clearfix">Billing <i class="icon-credit-cards pull-right"></i></a>
                                    <a href="#" class="list-group-item clearfix">Settings <i class="icon-cog pull-right"></i></a>
                                    <a href="#" class="list-group-item clearfix">Logout <i class="icon-line2-logout pull-right"></i></a>
                                </div>

                                <div class="fancy-title topmargin title-border">
                                    <h4>About Me</h4>
                                </div>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum laboriosam, dignissimos veniam obcaecati. Quasi eaque, odio assumenda porro explicabo laborum!</p>

                                <div class="fancy-title topmargin title-border">
                                    <h4>Social Profiles</h4>
                                </div>

                                <a href="#" class="social-icon si-facebook si-small si-rounded si-light" title="Facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon si-gplus si-small si-rounded si-light" title="Google+">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#" class="social-icon si-dribbble si-small si-rounded si-light" title="Dribbble">
                                    <i class="icon-dribbble"></i>
                                    <i class="icon-dribbble"></i>
                                </a>

                                <a href="#" class="social-icon si-flickr si-small si-rounded si-light" title="Flickr">
                                    <i class="icon-flickr"></i>
                                    <i class="icon-flickr"></i>
                                </a>

                                <a href="#" class="social-icon si-linkedin si-small si-rounded si-light" title="LinkedIn">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>

                                <a href="#" class="social-icon si-twitter si-small si-rounded si-light" title="Twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

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

                            <div class="widget subscribe-widget customjs subscribe-form clearfix">
                                <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                                <div class="widget-subscribe-form-result"></div>
                                <form action="http://audio-equipmentrental.com/include/subscribe.php" role="form" method="post" class="nobottommargin">
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
        <script type="text/javascript" src="assets/frontend/js/plugins.js"></script>

        <!-- Footer Scripts
        ============================================= -->
        <script type="text/javascript" src="assets/frontend/js/functions.js"></script>

        <script>
            jQuery("#tabs-profile").on("tabsactivate", function (event, ui) {
                jQuery('.flexslider .slide').resize();
            });
        </script>

    </body>
</html>