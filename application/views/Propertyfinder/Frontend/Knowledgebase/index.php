<div class="content-wrap">
    <div class="container clearfix article-listing">
        <div class="row clearfix">
            <div id="primary" class="sidebar-off clearfix">
                <div class="ht-container">
                    <section id="content" role="main">
                        <div class="kb-category-list row stacked">
                            <div class="kb-category-list row stacked">
                                <?php
                                foreach ($data as $key => $value) {
                                    $count = count($value);
                                    ?>
                                    <div class="column col-half">
                                        <h3>
                                            <span class="count"><?php echo $count; ?> <?php echo ($count > 1) ? 'Articles' : 'Article'; ?></span>
                                            <!--<a href="http://demo.herothemes.com/supportdesk/section/account/" title="View all posts in Account"><?php echo $key; ?> <span>→</span></a>-->
                                            <?php $cat_slug = str_replace(" ", "-", strtolower($key)); ?>
                                           <a href="knowledgebase/<?php echo $cat_slug; ?>"><?php echo $key; ?> <span>→</span></a>
                                        </h3>
                                        <ul class="kb-article-list">
                                            <?php foreach ($value as $key => $rec) { ?>
                                                <li>
                                                    <a href="<?php echo base_url() . 'knowledgebase/' . $cat_slug.'/'.$rec['slug'] ?>" rel="bookmark"><?php echo $rec['title']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .row.stacked .col-half:nth-child(2n+3), .row-fixed.stacked .col-half:nth-child(2n+3), .row-adaptive.stacked .col-half:nth-child(2n+3), .row-delaybreak.stacked .col-half:nth-child(2n+3) {
        margin-left: 0;
        clear: left;
    }
</style>
