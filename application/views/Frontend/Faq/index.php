<div class="content-wrap">

    <div class="container clearfix">
        <div class="postcontent nobottommargin clearfix">
            <div class="clear"></div>
            <div id="faqs" class="faqs">
                <?php
                if (isset($data)) {
                    foreach ($data as $value) {
                        ?>
                        <div class="toggle faq faq-marketplace faq-authors">
                            <div class="togglet"><i class="toggle-closed icon-question-sign"></i><i class="toggle-open icon-question-sign"></i><?php echo $value['question']; ?></div>
                            <div class="togglec"><?php echo $value['answer']; ?></div>
                        </div>
                    <?php }
                }
                ?>
           </div>
        </div><!-- .postcontent end -->

        <?php $this->load->view('frontend/rightsidebar');?>
    </div>
</div>
