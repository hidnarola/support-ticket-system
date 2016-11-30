<div class="content-wrap">

    <div class="container clearfix">

        <div class="postcontent nobottommargin clearfix">

            <!-- Posts
            ============================================= -->
            <div id="posts" class="post-timeline clearfix">

                <div class="timeline-border"></div>

                <?php
//                 $record_id = 0;
                foreach ($data as $value) {
                    $record_id = $value['id'];
                    ?>
                    <div class="entry clearfix">
                        <div class="entry-timeline">
                            <?php echo date('d', strtotime($value['created'])); ?><span><?php echo date('M', strtotime($value['created'])); ?></span>
                            <div class="timeline-divider"></div>
                        </div>
                        <?php
                        if ($value['image'] != '') {
                            $image = base_url(). NEWS_IMAGE . '/' . $value['image'];
                            if ($value['is_news'] == 0) {
                                $image = base_url().ANNOUNCEMENT_MEDIUM_IMAGE . '/' . $value['image'];
                            }
                            if(file_exists($image)){
                            ?>
                            
                            
                            <div class="entry-image">
                                <a href="<?php echo $image; ?>" data-lightbox="image"><img class="image_fade" src="<?php echo $image; ?>" alt="Standard Post with Image"></a>
                            </div>
                        <?php }
                        } ?>
                        <div class="entry-title">
                            <?php if ($value['is_news'] == 0) { ?> 
                                <h2><a href="<?php echo base_url() . 'announcements/' . $value['slug'] ?>"><?php echo $value['title']; ?></a></h2>
                            <?php } else { ?>
                                <h2><a href="<?php echo base_url() . 'news/' . $value['slug'] ?>"><?php echo $value['title']; ?></a></h2>
                            <?php } ?>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><a href="#"><i class="icon-user"></i> admin</a></li>
                        </ul>
                        <div class="entry-content">
                            <p><?php echo $value['description']; ?></p>
                            <?php if ($value['is_news'] == 0) { ?> 
                                <a href="<?php echo base_url() . 'announcements/' . $value['slug'] ?>" class="more-link">Read More</a>
                            <?php } else { ?>
                                <a href="<?php echo base_url() . 'news/' . $value['slug'] ?>" class="more-link">Read More</a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
//                $record_id--;
                }
                ?>

            </div><!-- #posts end -->
            <?php
            
            if ($num_rows >= 2) { ?>
                <!-- Pagination ============================================= -->
                <div id="load-next-posts" class="center">
                    <?php if ($value['is_news'] == 1) { ?>
                        <a href="home/loadmore" id="load_more" data-id="<?php echo $record_id ?>" type="1" class="button button-3d button-dark button-large button-rounded">Load more..</a>
                    <?php } else { ?>
                        <a href="home/loadmore1" id="load_more" type="0" data-id="<?php echo $record_id ?>" class="button button-3d button-dark button-large button-rounded">Load more..</a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div><!-- .postcontent end -->

    </div>
</div>

<div class="loader">
    <center>
        <img class="loading-image" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
    </center>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#load_more', function (e) {
            e.preventDefault();
            var base_url = '<?php echo base_url(); ?>';
            var href = $(this).attr('href');
            var id = $(this).attr('data-id');
            var type = $(this).attr('type');

            var url = base_url + href;
            $('.loader').show();
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: {type: type, id: id},
                success: function (data) {
                    str = '';
                    str += get_result(data.rec);
                    if (data.rec == '') {
//                        str += 'No Recent Activity found...'
                        $('#load_more').css('display', 'none');
                         $('.loader').hide();
                    } else {
                        var rec_id = '';
                            $.each(data.rec, function (i, item) {
                                rec_id = item.id;
                            });
                        console.log(data.num_rows);
                        if (data.num_rows > 2) {
                            $('.loader').hide();
                            $('#load-next-posts').css('display', 'block');
                            $('#load_more').attr('data-id', rec_id);
                        } else {   
                            $('.loader').hide();
                            
                            $('#load-next-posts').css('display', 'none');
                            $('#load_more').attr('data-id', rec_id);
                        }
                    }
                    $('#posts').append(str);
                }
            });
        });
    });

    function get_result(data) {
        var url = "<?php echo base_url(); ?>";
        str = '';
        $.each(data, function (i, item) {
            var rec_id = item.id;
            str += '<div class="entry clearfix"><div class="entry-timeline">';
            str += item.d + '<span>' + item.m + '</span>';
            str += '<div class="timeline-divider"></div>';
            str += '</div>';
            if (item.image != '') {
                var image = url + '<?php echo NEWS_IMAGE . '/' ?>' + item.image;
                if (item.is_news == 0) {
                    var image = url + '<?php echo NEWS_IMAGE . '/' ?>' + item.image;
                }
                str += '<div class="entry-image">';
                str += '<a href="' + image + '" data-lightbox="image"><img class="image_fade" src="' + image + '"</a>';
                str += '</div>';
            }

            str += '<div class="entry-title">';
            if (item.is_news == 0) {
                str += '<h2><a href="' + url + 'announcements/' + item.slug + '">' + item.title + '</a></h2>';
            } else {
                str += '<h2><a href="' + url + 'news/' + item.slug + '">' + item.title + '</a></h2>';
            }
            str += '</div>';
            str += '<ul class="entry-meta clearfix">';
            str += '<li><a href="#"><i class="icon-user"></i> admin</a></li>'
            str += '</ul>';
            str += '<div class="entry-content">';
            str += '<p>' + item.description + '</p>';
            if (item.is_news == 0) {
                str += '<a href="' + url + 'announcements/' + item.slug +  '" class="more-link">Read More</a>';
            } else {
                str += '<a href="' + url + 'news/' + item.slug +  '" class="more-link">Read More</a>';
            }
            str += '</div></div>';
        });

        return str;
    }
</script>
