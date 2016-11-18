<div class="content-wrap">

    <div class="container clearfix">

        <div class="postcontent nobottommargin clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts" class="post-timeline clearfix">

                <div class="timeline-border"></div>

                <?php foreach ($data as $value) {
                    ?>
                    <div class="entry clearfix">
                        <div class="entry-timeline">
                            <?php echo date('d', strtotime($value['modified'])); ?><span><?php echo date('M', strtotime($value['modified'])); ?></span>
                            <div class="timeline-divider"></div>
                        </div>
                        <?php
                        if ($value['image'] != '') {
                            $image = NEWS_IMAGE . '/' . $value['image'];
                            if ($value['is_news'] == 0) {
                                $image = ANNOUNCEMENT_MEDIUM_IMAGE . '/' . $value['image'];
                            }
                            ?>


                            <div class="entry-image">
                                <a href="<?php echo $image; ?>" data-lightbox="image"><img class="image_fade" src="<?php echo $image; ?>" alt="Standard Post with Image"></a>
                            </div>
                        <?php } ?>
                        <div class="entry-title">
                            <?php if ($value['is_news'] == 0) { ?> 
                            <h2><a href="<?php echo base_url() . 'announcements/' . $value['slug'] ?>"><?php echo $value['title']; ?></a></h2>
                            <?php } else { ?>
                            <h2><a href="<?php echo base_url() . 'news/' . $value['slug'] ?>"><?php echo $value['title']; ?></a></h2>
                             <?php } ?>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><a href="#"><i class="icon-user"></i> admin</a></li>
    <!--                            <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li>
                            <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13 Comments</a></li>
                            <li><a href="#"><i class="icon-camera-retro"></i></a></li>-->
                        </ul>
                        <div class="entry-content">
                            <p><?php echo $value['description']; ?></p>
                            <?php if ($value['is_news'] == 0) { ?> 
                                <a href="<?php echo base_url() . 'announcements/' . $value['slug'] ?>"class="more-link">Read More</a>
                            <?php } else { ?>
                                <a href="<?php echo base_url() . 'news/' . $value['slug'] ?>"class="more-link">Read More</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>



            </div><!-- #posts end -->

        </div><!-- .postcontent end -->

        <!-- Sidebar
                                        ============================================= -->
        <div class="sidebar nobottommargin col_last clearfix">
            <div class="sidebar-widgets-wrap">

                <div class="widget widget-twitter-feed clearfix">

                    <h4>Twitter Feed</h4>
                    <ul class="iconlist twitter-feed" data-username="envato" data-count="2"><li><i class="icon-twitter"></i><a href="http://twitter.com/envato" class="twitter-avatar" target="_blank"><img src="http://pbs.twimg.com/profile_images/655904741617086464/nwevoHSQ_normal.png" alt="Envato" title="Envato"></a><span>.@<a href="http://twitter.com/basecamp" target="_blank">basecamp</a>'s Jonas Downey on designing meaningful software that helps people. <a href="https://t.co/NgHF6TL31Q" target="_blank">https://t.co/NgHF6TL31Q</a></span><small><a href="http://twitter.com/envato/statuses/799465981739433984" target="_blank">about 6 hours ago</a></small></li><li><i class="icon-twitter"></i><a href="http://twitter.com/envato" class="twitter-avatar" target="_blank"><img src="http://pbs.twimg.com/profile_images/655904741617086464/nwevoHSQ_normal.png" alt="Envato" title="Envato"></a><span>You know him as AudioJungle's @<a href="http://twitter.com/studiomonkey13" target="_blank">studiomonkey13</a>, but outside @<a href="http://twitter.com/envatomarket" target="_blank">envatomarket</a> he's Latin Grammy winner Gen Rubin. <a href="https://t.co/cupzyOUIz2" target="_blank">https://t.co/cupzyOUIz2</a></span><small><a href="http://twitter.com/envato/statuses/799349061887332353" target="_blank">about 14 hours ago</a></small></li></ul>

                    <a href="#" class="btn btn-default btn-sm fright">Follow Us on Twitter</a>

                </div>

                <div class="widget clearfix">

                    <h4>Flickr Photostream</h4>
                    <div id="flickr-widget" class="flickr-feed masonry-thumbs" data-id="613394@N22" data-count="16" data-type="group" data-lightbox="gallery"></div>

                </div>



                <div class="widget clearfix">

                    <h4>Portfolio Carousel</h4>
                    <div id="oc-portfolio-sidebar" class="owl-carousel carousel-widget" data-items="1" data-margin="10" data-loop="true" data-nav="false" data-autoplay="5000">

                        <div class="oc-item">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="#">
                                        <img src="assets/frontend/images/portfolio/4/3.jpg" alt="Mac Sunglasses">
                                    </a>
                                    <div class="portfolio-overlay">
                                        <a href="http://vimeo.com/89396394" class="center-icon" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                    </div>
                                </div>
                                <div class="portfolio-desc center nobottompadding">
                                    <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>
                                    <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="oc-item">
                            <div class="iportfolio">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img src="assets/frontend/images/portfolio/4/1.jpg" alt="Open Imagination">
                                    </a>
                                    <div class="portfolio-overlay">
                                        <a href="assets/frontend/images/blog/full/1.jpg" class="center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                    </div>
                                </div>
                                <div class="portfolio-desc center nobottompadding">
                                    <h3><a href="portfolio-single.html">Open Imagination</a></h3>
                                    <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="widget clearfix">

                    <h4>Tag Cloud</h4>
                    <div class="tagcloud">
                        <a href="#">general</a>
                        <a href="#">videos</a>
                        <a href="#">music</a>
                        <a href="#">media</a>
                        <a href="#">photography</a>
                        <a href="#">parallax</a>
                        <a href="#">ecommerce</a>
                        <a href="#">terms</a>
                        <a href="#">coupons</a>
                        <a href="#">modern</a>
                    </div>

                </div>

            </div>

        </div><!-- .sidebar end -->



    </div>

</div>