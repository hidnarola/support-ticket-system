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
                                $class = '';
                            }
                        }else{
                            $class = 'col_last';
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
                            if ($cnt == 2 || $cnt == $total) {
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
             <?php $this->load->view('frontend/rightsidebar');?>
            <!-- .sidebar end -->

        </div>

    </div>

</div>

<!--</div>

</div>-->