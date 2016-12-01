<div class="content-wrap">

    <div class="container clearfix">

        <div class="single-post nobottommargin">

            <!-- Entry Image
            ============================================= -->
            <?php
            if (isset($news)) {
                if ($news['image'] != ''  && file_exists(NEWS_IMAGE . '/' . $news['image'])) {
                    ?>
                    <div class="entry-image bottommargin">
                        <a href="<?php echo base_url() . NEWS_IMAGE . '/' . $news['image'] ?>" data-lightbox="image"><img class="image_fade" src="<?php echo base_url() . NEWS_IMAGE . '/' . $news['image'] ?>" alt="Standard Post with Image"></a>
                    </div><!-- .entry-image end -->
                    <?php
                }
            } else if (isset($announcements)) {
                if ($announcements['image'] != '' && file_exists(ANNOUNCEMENT_IMAGE . '/' . $announcements['image'])) {
                    ?>
                    <div class="entry-image bottommargin">
                        <a href="<?php echo base_url() . ANNOUNCEMENT_IMAGE . '/' . $announcements['image'] ?>" data-lightbox="image"><img class="image_fade" src="<?php echo base_url() . ANNOUNCEMENT_IMAGE . '/' . $announcements['image'] ?>" alt="Standard Post with Image"></a>
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
                        <h2><?php
                            if (isset($news)) {
                                echo $news['title'];
                            } else if (isset($announcements)) {
                                echo $announcements['title'];
                            }
                            ?></h2>
                    </div><!-- .entry-title end -->

                    <!-- Entry Meta
                    ============================================= -->
                    <ul class="entry-meta clearfix">
                        <li><i class="icon-calendar3"></i><?php
                            if (isset($news)) {
                                echo date('d F Y', strtotime($news['modified']));
                            } else if (isset($announcements)) {
                                echo date('d F Y', strtotime($announcements['modified']));
                            }
                            ?></li>
                        <li><a href="#"><i class="icon-user"></i> admin</a></li>
<!--                        <li><i class="icon-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li>
                        <li><a href="#"><i class="icon-comments"></i> 43 Comments</a></li>-->
                        <li><a href="#"><i class="icon-camera-retro"></i></a></li>
                    </ul><!-- .entry-meta end -->

                    <!-- Entry Content
                    ============================================= -->
                    <div class="entry-content notopmargin">
                        <?php
                        if (isset($news)) {
                            echo $news['description'];
                        } else if (isset($announcements)) {
                            echo $announcements['description'];
                        }
                        ?>
                    </div>
                </div><!-- .entry end -->

                <!-- Comments
                ============================================= -->
                <div id="comments" class="">
                    <!--<h3 id="comments-title"><span>3</span> Comments</h3>-->

                    <div class="clear"></div>

                    <!-- Comment Form
                    ============================================= -->
                    <div id="respond" class="clearfix">

                        <a href="#" data-toggle="modal" data-target=".bs-example-modal-sm1" class="button tright" id="">Inquiry About News<i class="icon-circle-arrow-right"></i></a>
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

<a href="#" id="succeess_message" class="" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!" style="display: none;" onclick="SEMICOLON.widget.notifications(this);
        return false;"></a>

<div class="modal fade bs-example-modal-sm1" id="confirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Leave a Comment</h4>
                </div>
                <form class="clearfix" action="" method="post" id="commentform">
                    <input type="hidden" id="type" name="type" value="<?php
                    if (isset($news)) {
                        echo 1;
                    } elseif (isset($announcements)) {
                        echo 2;
                    }
                    ?>"/>
                    <input type="hidden" id="link" name="link" value="<?php echo current_url(); ?>"/>
                    <input type="hidden" id="article_id" name="article_id" value="<?php
                    if (isset($news)) {
                        echo $news['id'];
                    } elseif (isset($announcements)) {
                        echo $announcements['id'];
                    }
                    ?>"/>
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
<!--<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>-->
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
        if ($('#commentform').valid()) {
            $('.loader').show();
            $.ajax({
                type: 'POST',
                url: url_action,
                dataType: 'JSON',
                data: {subject: subject, comment: comment, type: type, link: link, article_id: article_id},
                success: function (data) {
//                    return false;
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