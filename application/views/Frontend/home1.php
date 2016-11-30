<section id="slider" class="slider-parallax swiper_wrapper clearfix">

    <div class="slider-parallax-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <?php foreach ($images as $image) { ?>
                    <div class="swiper-slide dark" style="background-image: url('<?php echo HOME_IMAGE . '/' . $image['image']; ?>');">
                        <div class="container clearfix">
                            <div class="slider-caption slider-caption-center">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
            <div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
            <div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
            <div id="slide-number"><div id="slide-number-current"></div><span>/</span><div id="slide-number-total"></div></div>
        </div>

    </div>

</section>

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">
        <div class="section topmargin-lg">
            <div class="container clearfix">

                <div class="heading-block center">
                    <h2>Our Projects</h2>
                </div>

                <!--<div class="clear bottommargin-sm"></div>-->

                <div class="clear"></div>

                <?php
                $flag = 0;
                $delay = 1;
                foreach ($projects as $value) {
                    $class = '';
                    if ($flag == 2) {
                        $class = 'col_last';
                    }
                    if ($delay == 1) {
                        $data_delay = '';
                    } elseif ($delay == 2) {
                        $data_delay = '';
                    } elseif ($delay == 3) {
                        $data_delay = '';
                    } elseif ($delay == 4) {
                        $data_delay = '600';
                    } elseif ($delay == 5) {
                        $data_delay = '800';
                    } elseif ($delay == 6) {
                        $data_delay = '900';
                    }
                    ?>
                    <div class="col_one_third <?php echo $class; ?>">
                        <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" data-delay="<?php echo $data_delay; ?>">
                            <div class="fbox-icon">
                                <a href="<?php echo base_url() . PROJECTS_IMAGES . '/' . $value['logo_image']; ?>" data-lightbox="image"><img class="image_fade" src="<?php echo base_url() . PROJECTS_IMAGES . '/' . $value['logo_image']; ?>" alt="<?php echo $value['title']; ?>"></a>
                                <!--<a href="<?php echo PROJECTS_IMAGES . '/' . $value['logo_image']; ?>"> <img style="width:100%" src="<?php echo PROJECTS_IMAGES . '/' . $value['logo_image']; ?>"></a>-->
                            </div>
                            <h3><?php echo $value['title']; ?></h3>
                            <p><?php echo $value['short_desc']; ?></p>
                        </div>
                    </div>

                    <?php
                    $flag++;
                    $delay++;
                    if ($flag == 3)
                        $flag = 0;
                }
                ?>


            </div>
        </div>
        <div class="container clearfix">

            <div id="oc-clients" class="owl-carousel owl-carousel-full image-carousel carousel-widget" data-margin="30" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xxs="2" data-items-xs="3" data-items-sm="4" data-items-md="5" data-items-lg="6" style="padding: 20px 0;">
                <?php foreach ($logo_images as $img) { ?>
                    <div class="oc-item"><a href="#"><img src="<?php echo HOME_MEDIUM_IMAGE . '/' . $img['logo_image']; ?>" alt="Clients"></a></div>
                <?php } ?>
            </div>
        </div>
    </div>

</section><!-- #content end -->
<style>
    .feature-box.fbox-plain.fbox-small h3 {
        padding-left: 70px;
    }.feature-box.fbox-plain.fbox-small .fbox-icon {
        width: 100px;
    }
    .feature-box.fbox-plain.fbox-small .fbox-icon img {
        height: 100px;
    }
    .feature-box.fbox-plain.fbox-small p {
        margin-left: 70px;
    }.content-wrap {
        padding: 0;
    }
    .section {
        padding: 0; 
    }.heading-block {
        margin-bottom: 25px;
    }
    .topmargin-lg {
    margin-top: 30px !important;
}
.center .heading-block:after, .heading-block.center:after, .heading-block.title-center:after {
    margin: 15px auto 0;
}
</style>
