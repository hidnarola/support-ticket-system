<div class="content-wrap">

    <div class="container clearfix">

        <div class="single-post nobottommargin">

            <!-- Entry Image
            ============================================= -->
            <?php
            if (isset($article)) {
                if ($article['image'] != '') {
                    ?>
                    <div class="entry-image bottommargin">
                        <a href="#"> <img src="<?php echo base_url() . ARTICLE_IMAGE . '/' . $article['image'] ?>" alt="Blog Single"></a>
                    </div><!-- .entry-image end -->
                    <?php
                }
            }
            ?>

            <!-- Post Content
            ============================================= -->
            <div class="postcontent nobottommargin clearfix">

                <!-- Single Post
                ============================================= -->
                <div class="entry clearfix">

                    <!-- Entry Title
                    ============================================= -->
                    <div class="entry-title">
                        <h2><?php echo $article['title']; ?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i><?php echo date('d F Y', strtotime($article['created'])); ?></li>
                        <li><a href="#"><i class="icon-user"></i> admin</a></li>
<!--                        <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li>
                        <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>-->
                        <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">

                        <?php echo $article['description']; ?>

                    </div>
                </div><!-- .entry end -->
                <?php if ($other_articles == NULL) {
                   
                    ?>
                    <style> .entry {border-bottom: 0 none!important;padding: 0!important;}#comments {margin-top: 0;}</style>
                <?php } ?>
                <?php if ($other_articles != '' && sizeof($other_articles) > 0) { ?>
                    <h4>Related Articles:</h4>
                <?php } ?>
                <div class="related-posts clearfix">
                    <?php
                    $cnt = 0;
                    $flag = 1;
                    $class = '';
                    $total = sizeof($other_articles);
                    foreach ($other_articles as $value) {
                        if ($cnt == 0) {
                            if ($flag == 1) {
                                $class = '';
                            } else {
                                $class = 'col_last';
                            }
                        }
                        ?>
                        <div class="col_half nobottommargin <?php echo $class; ?>">
                            <div class="mpost clearfix">
                                <?php if ($value['image'] != '') { ?>
                                    <div class="entry-image">
                                        <a href="#"><img src="<?php echo base_url() . ARTICLE_IMAGE . '/' . $value['image'] ?>" alt="Blog Single"></a>
                                    </div>
                                <?php } ?>
                                <div class="entry-c">
                                    <div class="entry-title">
                                        <h4><a href="<?php echo base_url() . 'knowledgebase/' . $value['slug'] ?>"><?php echo html_excerpt_title($value['title']); ?></a></h4>
                                    </div>
                                    <ul class="entry-meta clearfix">
                                        <li><i class="icon-calendar3"></i> <?php echo date('d F Y', strtotime($value['created'])); ?></li>
                                        <!--<li><a href="#"><i class="icon-comments"></i> 12</a></li>-->
                                    </ul>
                                    <div class="entry-content"><?php echo html_excerpt_article($value['description']); ?></div>
                                </div>
                            </div>
                            <?php
                            $cnt++;
                            if ($cnt == 1 || $cnt == $total) {
                                $cnt = 0;
                                $flag = 2;
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>


                <!-- Comments
                ============================================= -->
                <div id="comments" class="">

                    <!--<h3 id="comments-title"><span>3</span> Comments</h3>-->

                    <div class="clear"></div>

                    <!-- Comment Form
                    ============================================= -->
                    <div id="respond" class="clearfix">

                        <h3>Leave a <span>Comment</span></h3>

                        <form class="clearfix" action="knowledgebase/add_comments" method="post" id="commentform">

                            <div class="col_one_third">
                                <label for="author">Name</label>
                                <input type="text" name="author" id="author" value="" size="22" tabindex="1" class="sm-form-control" />
                            </div>

                            <div class="col_one_third">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" value="" size="22" tabindex="2" class="sm-form-control" />
                            </div>

                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="comment">Comment</label>
                                <textarea name="comment" cols="58" rows="7" tabindex="4" class="sm-form-control"></textarea>
                            </div>

                            <div class="col_full nobottommargin">
                                <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d nomargin">Submit Comment</button>
                            </div>

                        </form>

                    </div><!-- #respond end -->

                </div><!-- #comments end -->

            </div><!-- .postcontent end -->

            <!-- Sidebar
            ============================================= -->
            <div class="sidebar nobottommargin col_last clearfix">
                <div class="sidebar-widgets-wrap">

                    <div class="widget widget-twitter-feed clearfix">

                        <h4>Twitter Feed</h4>
                        <ul class="iconlist twitter-feed" data-username="envato" data-count="2"><li><i class="icon-twitter"></i><a href="http://twitter.com/envato" class="twitter-avatar" target="_blank"><img src="http://pbs.twimg.com/profile_images/655904741617086464/nwevoHSQ_normal.png" alt="Envato" title="Envato"></a><span>What motion graphics trends should you be keeping an eye on for 2017? Find out at <a href="https://t.co/jcnzYj0Lug" target="_blank">https://t.co/jcnzYj0Lug</a>. <a href="https://t.co/GWd9FK2udV" target="_blank">https://t.co/GWd9FK2udV</a></span><small><a href="http://twitter.com/envato/statuses/798444214950461440" target="_blank">about an hour ago</a></small></li><li><i class="icon-twitter"></i><a href="http://twitter.com/envato" class="twitter-avatar" target="_blank"><img src="http://pbs.twimg.com/profile_images/655904741617086464/nwevoHSQ_normal.png" alt="Envato" title="Envato"></a><span>Turning still images into engaging video content's easier than you might think. <a href="https://t.co/UwHptcu1SR" target="_blank">https://t.co/UwHptcu1SR</a></span><small><a href="http://twitter.com/envato/statuses/798390170294906880" target="_blank">about 5 hours ago</a></small></li></ul>

                        <a href="#" class="btn btn-default btn-sm fright">Follow Us on Twitter</a>

                    </div>
                    <div class="widget clearfix">

                        <h4>Flickr Photostream</h4>
                        <div id="flickr-widget" class="flickr-feed masonry-thumbs" data-id="613394@N22" data-count="16" data-type="group" data-lightbox="gallery"></div>

                    </div>



                </div>

            </div>
            <!-- .sidebar end -->

        </div>

    </div>

</div>

<!--</div>

</div>-->