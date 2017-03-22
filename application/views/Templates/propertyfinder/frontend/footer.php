<footer id="footer" class="dark">

    <div class="container">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap clearfix">

            <div class="col_two_third">

                <div class="col_one_third">

                    <div class="widget clearfix">

                        <!-- <img src="assets/frontend/images/MS-Logo-(1).png" alt="" class="footer-logo"> -->
                        <?php
                        $company_details = company_details();
                        $keys = array_column($company_details, 'key');
                        $values = array_column($company_details, 'value');
                        $combined = array_combine($keys, $values);
                        $company = $combined;
                        ?>
                        <p><?php echo $company['company_name']; ?></p>
                        <p><?php echo html_excerpt($company['company_description'], 100); ?><a href="about-us">Read More</a></p>

                        <div style="background: url('assets/frontend/images/world-map.png') no-repeat center center; background-size: 100%;">
                            <address>
                                <strong>Address:</strong><br>
                                <?php echo $company['company_address'] ?><br>
                                <?php echo $company['company_zipcode']; ?><br>
                            </address>
                            <abbr title="Phone Number"><strong>Phone:</strong></abbr> <?php echo $company['company_contact_no']; ?><br>
                            <abbr title="Email Address"><strong>Email:</strong></abbr> <?php echo $company['company_email']; ?>
                        </div>

                    </div>

                </div>

                <div class="col_one_third">

                    <div class="widget widget_links clearfix">

                        <!-- <h4>Blogroll</h4> -->

                        <ul>
                            <?php
                            $header_links = get_pages('footer');

                            if (count($header_links) > 0) {
                                ?>

                                <?php foreach ($header_links as $key => $value) { ?>
                                    <li><a href="<?php echo site_url($value['url']); ?>"><?php echo $value['navigation_name']; ?></a></li>

                                    <?php
                                }
                            }
                            ?>

                        </ul>

                    </div>

                </div>

                <div class="col_one_third col_last">
                    <?php //$this->load->view('frontend/User/rightsidebar');  ?>
                    <div class="widget clearfix">
                        <h4>Recent News</h4>

                        <div id="post-list-footer">
                            <?php
                            foreach ($news_announcements as $value) {
                                if ($value['image'] != '') {
                                    $image = NEWS_MEDIUM_IMAGE . '/' . $value['image'];
                                    if ($value['is_news'] == 0) {
                                        $image = ANNOUNCEMENT_MEDIUM_IMAGE . '/' . $value['image'];
                                    }
                                }
                                ?>
                                <div class="spost clearfix">
                                    <?php if ($value['image'] != '') { ?>
                                        <div class="entry-image">
                                            <a class="nobg"><img src="<?php echo $image; ?>" alt=""></a>
                                        </div>
                                    <?php } ?> 
                                    <div class="entry-c">
                                        <div class="entry-title">
                                            <?php if ($value['is_news'] == 0) { ?> 
                                                <h4><a href="<?php echo base_url() . 'announcements/' . $value['slug']; ?>"><?php echo $value['title']; ?></a></h4>
                                            <?php } else { ?>
                                                <h4><a href="<?php echo base_url() . 'news/' . $value['slug']; ?>"><?php echo $value['title']; ?></a></h4>
                                            <?php } ?>
                                        </div>
                                        <ul class="entry-meta">
                                            <!--<li>10th July 2014</li>-->
                                            <li><?php echo date('d F Y', strtotime($value['created'])); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col_one_third col_last">

                <div class="widget clearfix" style="margin-bottom: -20px;">

                    <div class="row">
                        <?php $total_counts = get_total_count();
                        ?>
                        <div class="col-md-6 bottommargin-sm">
                            <div class="counter counter-small"><span data-from="2" data-to="<?php echo $total_counts['total_tickets'] ?>" data-refresh-interval="20" data-speed="3000" data-comma="true"></span></div>
                            <h5 class="nobottommargin">Now serving Tickets</h5>
                        </div>

                        <div class="col-md-6 bottommargin-sm">
                            <div class="counter counter-small"><span data-from="2" data-to="<?php echo $total_counts['total_clients'] ?>" data-refresh-interval="20" data-speed="2000" data-comma="true"></span></div>
                            <h5 class="nobottommargin">Tenants</h5>
                        </div>

                    </div>

                </div>

                <div class="widget subscribe-widget clearfix" >
                    <h5><strong>Subscribe</strong> to Our Newsletter:</h5>
                    <div class="widget-subscribe-form-result"></div>
                    <form id="widget-subscribe-form" action="home/subscribe" role="form" method="post" class="nobottommargin">
                        <div class="input-group divcenter">
                            <span class="input-group-addon"><i class="icon-email2"></i></span>
                            <input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
                            <span class="input-group-btn">
                                <button class="btn btn-success" id="subscribe_btn" type="submit">Subscribe</button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="widget clearfix" style="margin-bottom: -20px;">


                    <div class="clearfix">
                        <?php
                        $social_medias = get_social_media();
// pr($social_medias);
                        ?>
                        <?php foreach ($social_medias as $social_media) { ?>

                            <a href="<?php echo $social_media['url']; ?>" class="social-icon si-small si-borderless" style="margin-right: 10px;">
                                <img style="width:30px;" src="<?php echo SOCIAL_IMAGE . '/' . $social_media['image']; ?>">
                            </a>


                        <?php } ?>

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
                Copyrights &copy; 2014 All Rights Reserved by Manazel Specialists.<br>
                <div class="copyright-links"><a href="<?php echo get_page(2); ?>">Terms of Use</a> / <a href="<?php echo get_page(3); ?>">Privacy Policy</a></div>
            </div>

            <div class="col_half col_last tright">
                <!-- <div class="fright clearfix">
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
                </div> -->

                <div class="clear"></div>

                <i class="icon-envelope2"></i> <?php echo $company['company_email']; ?> <span class="middot">&middot;</span> <i class="icon-headphones"></i> <?php echo $company['company_contact_no']; ?> <span class="middot">&middot;</span>
            </div>

        </div>

    </div><!-- #copyrights end -->

</footer><!-- #footer end -->
<script>
    $(function () {
        $('a[href="#"]').on( "click", function (event) {
            event.preventDefault();
        });
        
        $( "#forgot-form" ).submit(function() {
         $("#forgot-form-submit").click(function(){
             $(this).prop('disabled', true);
        });
        });
        $( "#widget-subscribe-form" ).submit(function() {
                        // $(this).prop('disabled', false);
            $("#subscribe_btn").click(function(){
                $( "#widget-subscribe-form" ).submit();
                if($("#widget-subscribe-form-email").val()!=''){
                         $(this).prop('disabled', true);
                }
            });
        });
    });
</script>

