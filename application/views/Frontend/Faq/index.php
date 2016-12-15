<div class="content-wrap">

    <div class="container clearfix">
        <div class="postcontent nobottommargin clearfix">
            <ul id="portfolio-filter" class="portfolio-filter clearfix">

                <li class="activeFilter"><a href="#" data-filter="all">All</a></li>
                <?php foreach ($data as $key => $value) { ?>
                    <li><a href="#" data-filter=<?php echo ".faq-" . $key; ?>><?php echo $key; ?></a></li>

                <?php } ?>
            </ul>
            <div class="clear"></div>
            <div id="faqs" class="faqs">
                <?php
                if (isset($data)) {
                    foreach ($data as $key => $value) {
                        foreach ($value as $val) {
                            ?>
                            <div class="toggle faq faq-<?php echo $key; ?>">
                                <div class="togglet"><i class="toggle-closed icon-question-sign"></i><i class="toggle-open icon-question-sign"></i><?php echo $val['question']; ?></div>
                                <div class="togglec"><?php echo $val['answer']; ?></div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div><!-- .postcontent end -->

        <?php $this->load->view('Frontend/rightsidebar'); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $faqItems = $('#faqs .faq');
        if (window.location.hash != '') {
            var getFaqFilterHash = window.location.hash;
            var hashFaqFilter = getFaqFilterHash.split('#');
            if ($faqItems.hasClass(hashFaqFilter[1])) {
                $('#portfolio-filter li').removeClass('activeFilter');
                $('[data-filter=".' + hashFaqFilter[1] + '"]').parent('li').addClass('activeFilter');
                var hashFaqSelector = '.' + hashFaqFilter[1];
                $faqItems.css('display', 'none');
                if (hashFaqSelector != 'all') {
                    $(hashFaqSelector).fadeIn(500);
                } else {
                    $faqItems.fadeIn(500);
                }
            }
        }

        $('#portfolio-filter a').click(function () {
            $('#portfolio-filter li').removeClass('activeFilter');
            $(this).parent('li').addClass('activeFilter');
            var faqSelector = $(this).attr('data-filter');
            $faqItems.css('display', 'none');
            if (faqSelector != 'all') {
                $(faqSelector).fadeIn(500);
            } else {
                $faqItems.fadeIn(500);
            }
            return false;
        });
    });
</script>
