<div class="content-wrap">

    <div class="container clearfix">
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
                                            <span class="count"><?php echo $count; ?> Articles</span>
                                            <a href="http://demo.herothemes.com/supportdesk/section/account/" title="View all posts in Account"><?php echo $key; ?> <span>→</span></a>
                                        </h3>
                                        <ul class="kb-article-list">
                                            <?php  foreach ($value as $key => $rec) { ?>
                                            <li>
                                                <a href="<?php echo base_url().'knowledgebase/'.$rec['slug'] ?>" rel="bookmark"><?php echo $rec['title']; ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php 
                            }
                            ?>
                          
<!--                            <div class="column col-half">
                                <h3>
                                    <span class="count">7 Articles</span>
                                    <a href="http://demo.herothemes.com/supportdesk/section/account/" title="View all posts in Account">Account <span>→</span></a>
                                </h3>
                                <ul class="kb-article-list">
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/how-to-change-timezone/" rel="bookmark">How to change timezone</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/can-i-change-my-username/" rel="bookmark">Can I change my username?</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/how-to-update-my-password/" rel="bookmark">How to update my password</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/changing-details-in-account/" rel="bookmark">Changing details in account</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/how-do-i-cancel/" rel="bookmark">How do I cancel?</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="column col-half">
                                <h3>
                                    <span class="count">4 Articles</span>
                                    <a href="http://demo.herothemes.com/supportdesk/section/copyright-legal/" title="View all posts in Copyright &amp; Legal">Copyright &amp; Legal <span>→</span></a>
                                </h3>
                                <ul class="kb-article-list">
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/where-are-your-offices-located/" rel="bookmark">Where are your offices located?</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/our-content-policy/" rel="bookmark">Our content policy</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/how-do-i-contact-legal/" rel="bookmark">How do I contact legal?</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/how-do-i-file-a-dmca/" rel="bookmark">How do I file a DMCA</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="column col-half">
                                <h3>
                                    <span class="count">19 Articles</span>
                                    <a href="http://demo.herothemes.com/supportdesk/section/customization/" title="View all posts in Customization">Customization <span>→</span></a>
                                </h3>
                                <ul class="kb-article-list">
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/adding-custom-classes-to-posts/" rel="bookmark">Adding custom classes to posts</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/identify-pages-using-body-classes/" rel="bookmark">Identify pages using body classes</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/using-firebug-to-identify-css-selectors/" rel="bookmark">Using Firebug to identify CSS selectors</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/child-theme-basics/" rel="bookmark">Child theme basics</a>
                                    </li>
                                    <li>
                                        <a href="http://demo.herothemes.com/supportdesk/knowledgebase/changing-the-theme-color/" rel="bookmark">Changing the theme color</a>
                                    </li>
                                </ul>
                            </div>-->
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