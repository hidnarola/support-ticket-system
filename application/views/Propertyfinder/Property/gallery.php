<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="assets/propertyfinder/js/custom/jquery.directional-hover.min.js"></script>
<link rel="stylesheet" href="assets/propertyfinder/css/custom/jquery.directional-hover.min.css">
<style>
    .dh-container {
        margin: 15px;
        width: auto;
        height: auto;
        background: black;
        float: left;
        /*background-image: url(https://unsplash.it/400/300?image=180);*/
    }

    .dh-overlay {
        background: rgba(52,73,94,.65);
        width: 100%;
        height: 100%;
        text-align: center;
        line-height: 200px;
        color: #fff;
    }
</style>

<div class="page_content_wrap">
    <div class="content_wrap">
        <div class="content">
            <div class="isotope_wrap ">
                <!-- <div class="container clearfix gallery-container"> -->
                <?php foreach ($images as $image) { ?>
                    <span style="color:#fff"><?php echo $image['image']; ?></span>
                    <div class="isotope_item isotope_item_portfolio isotope_column_3">
                        <article class="post_item post_item_portfolio">
                            <div class="post_content isotope_item_content ih-item colored square effect_more left_to_right">
                                <div class="post_featured img">
                                    <a href="single-post.html"><img alt="" src="<?php echo GALLERY_IMAGE . '/' . $image['image']; ?>"></a>
                                </div>
                                <div class="post_info_wrap info">
                                    <div class="info-back">
                                        <div class="post_descr">
                                            <p class="post_buttons"><a class="fancybox" id="gallerybox" href="<?php echo GALLERY_IMAGE . '/' . $image['image']; ?>" data-fancybox-group="gallery"><i class="fa fa-search" aria-hidden="true"></i></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!--<script type='text/javascript' src='assets/propertyfinder/js/vendor/jquery.js'></script>-->

<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script>
            jQuery(document).ready(function ($) {
    $('.fancybox').fancybox({
            onClosed: function(){
            $(".dh-overlay").css("top", "0");
            }
        });
            $('.dh-container').directionalHover();
            var project = '<?php echo $this->input->get('project'); ?>';
            $('html,body').animate({scrollTop: $("#" + project).offset().top - 50}, 1300);
    });
</script>

<style>
    .gallery-container{width: auto; max-width: 875px;}
    .img-size{height: 350px;width: 470px;}
    .hr_style{ border:1px solid #ccc; }
    .content-margin-bottom{ margin-bottom:30px; }
    .top_panel_over .top_panel_wrap{ position:relative !important;}
    .fancybox-lock .fancybox-overlay{z-index: 11111;}
    #gallerybox {
        font-size: 20px !important;
        color: #fff !important;
    }
    .post_buttons{
        text-align: center !important;
        top: 45% !important;
        position: absolute !important;
        width: 95% !important;
    }
</style>
