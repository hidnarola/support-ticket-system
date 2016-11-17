<div class="sidebar nobottommargin col_last clearfix">
            <div class="sidebar-widgets-wrap">
                <div class="widget clearfix">

                    <h4>Recent News</h4>
                    <div id="post-list-footer">
                        <?php foreach($news_announcements as $value){
                           if($value['image'] != ''){ 
                                    $image = NEWS_MEDIUM_IMAGE.'/'.$value['image'];
                                    if($value['is_news'] == 0){
                                        $image = ANNOUNCEMENT_MEDIUM_IMAGE.'/'.$value['image'];
                                    }
                           }                                   
                            ?>
                        <div class="spost clearfix">
                            <?php if($value['image'] != '') { ?>
                            <div class="entry-image">
                                <a class="nobg"><img src="<?php echo $image;?>" alt=""></a>
                            </div>
                            <?php } ?> 
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h4><a href="#"></a><?php echo $value['title'];?></h4>
                                </div>
                                <ul class="entry-meta">
                                    <!--<li>10th July 2014</li>-->
                                    <li><?php echo date('d F Y', strtotime($value['created'])); ?></li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>

<!--                        <div class="spost clearfix">
                            <div class="entry-image">
                                <a href="#" class="nobg"><img src="assets/frontend/images/magazine/small/2.jpg" alt=""></a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                </div>
                                <ul class="entry-meta">
                                    <li>10th July 2014</li>
                                </ul>
                            </div>
                        </div>-->

<!--                        <div class="spost clearfix">
                            <div class="entry-image">
                                <a href="#" class="nobg"><img src="assets/frontend/images/magazine/small/3.jpg" alt=""></a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                </div>
                                <ul class="entry-meta">
                                    <li>10th July 2014</li>
                                </ul>
                            </div>
                        </div>-->

                    </div>

                </div>
            </div>
        </div><!-- .sidebar end -->