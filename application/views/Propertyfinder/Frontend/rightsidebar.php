<div class="sidebar nobottommargin col_last clearfix">
    <div class="sidebar-widgets-wrap">
        <div class="widget clearfix rightsidebar">

            <h4>Recent News</h4>
            <div id="post-list-footer">
                <?php
//                pr($news_announcements,1);
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
</div><!-- .sidebar end -->