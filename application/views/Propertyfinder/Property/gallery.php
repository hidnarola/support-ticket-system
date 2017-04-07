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
        <div class="container clearfix gallery-container">
            <?php foreach ($images as $image) { ?>
                <div class="dh-container">
                    <img src="<?php echo GALLERY_MEDIUM_IMAGE . '/' . $image['image']; ?>" alt="" />
                    <div class="dh-overlay fancy-div">
                        <a class="fancybox" id="gallerybox" href="<?php echo GALLERY_IMAGE . '/' . $image['image']; ?>" data-fancybox-group="gallery"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!--                <div class="col-md-3 home_image text-center">
                                    <div class="row ">
                                        <a class="fancybox" href="<?php echo GALLERY_IMAGE . '/' . $image['image']; ?>" data-fancybox-group="gallery"><img src="<?php echo GALLERY_MEDIUM_IMAGE . '/' . $image['image']; ?>" alt="" /></a>
                                    </div>
                                </div>-->

            <?php }
            ?>

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
    font-size: 25px !important;
    color: #fff !important;
}
</style>
