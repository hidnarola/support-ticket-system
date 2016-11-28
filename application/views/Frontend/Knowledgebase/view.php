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
                        } else {
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

                        <!-- <h3>Leave a <span>Comment</span></h3> -->
                        <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm1" class="button tright" id="">Inquiry About Article<i class="icon-circle-arrow-right"></i></a>
                    </div><!-- #respond end -->

                </div><!-- #comments end -->

            </div><!-- .postcontent end -->

            <!-- Sidebar
            ============================================= -->
            <?php $this->load->view('frontend/rightsidebar'); ?>
            <!-- .sidebar end -->

        </div>

    </div>

</div>

<div class="loader">
    <center>
        <img class="loading-image" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
    </center>
</div>

<a href="#" id="succeess_message" class="" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!" style="display: none;" onclick="SEMICOLON.widget.notifications(this); return false;"></a>

<div class="modal fade bs-example-modal-sm1" id="confirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Leave a Comment</h4>
                </div>
                <form class="clearfix" action="" method="post" id="commentform">
                    <input type="hidden" id="type" name="type" value="0"/>
                    <input type="hidden" id="link" name="link" value="<?php echo current_url(); ?>"/>
                    <input type="hidden" id="article_id" name="article_id" value="<?php echo $article['id']; ?>"/>
                    <div class="modal-body">
                        <div class="col_full">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" required="required" value="" size="22" tabindex="2" class="sm-form-control" />
                        </div>
                        <div class="clear"></div>
                        <div class="col_full">
                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment" cols="58" rows="7" required="required" tabindex="4" class="sm-form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="send" class="button button-3d button-rounded button-mini" id="send_comment">Send</button>
                        <button type="button" data-dismiss="modal" class="button button-3d button-mini button-rounded button-white button-light">Cancel</button>
                        <!--<a href="#" class="button button-3d button-mini button-rounded button-white button-light">White</a>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<script>
    $("#commentform").validate({
        rules: {
            subject: "required",
            comment: "required",
        },
        submitHandler: function (form, event) { // for demo
            event.preventDefault();
//            form.submit();
        }

    });
</script>

<script>
    $(document).on('click', '#send_comment', function () {
        var base_url = '<?php echo base_url(); ?>';
        var url_action = base_url + 'home/add_comments';
        var subject = $('#subject').val();
        var comment = $('#comment').val();
        var type = $('#type').val();
        var link = $('#link').val();
        var article_id = $('#article_id').val();

//        var url = window.location.href;
       if($('#commentform').valid()){
        $('.loader').show();
            $.ajax({
                type: 'POST',
                url: url_action,
                dataType: 'JSON',
                data: {subject: subject, comment: comment, type: type, link: link, article_id: article_id},
                success: function (data) {
                    $('.loader').hide();
                    $('#confirm').modal('hide');
//                    window.location.reload();
                    $('#succeess_message').show();
                    $('#commentform')[0].reset();
//                    SEMICOLON.widget.notifications(this);
                    $("#succeess_message").trigger("click");
                    return false;
                },
            });
        }
    });
</script>