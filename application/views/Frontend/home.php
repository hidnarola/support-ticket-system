<section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">

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


        <div class="container clearfix">
            <?php
                $flag = 0;
            foreach ($projects as $value) {
                
                $class = '';
                if ($flag == 2) {
                    $class = 'col_last';
                    
                }
                ?>
                <div class="col_one_third <?php echo $class;?>">
                    <div class="feature-box fbox-effect">
                        <div class="fbox-icon">
                            <a href="<?php echo base_url() . PROJECTS_IMAGES . '/' . $value['logo_image']; ?>" data-lightbox="image"><img class="image_fade" src="<?php echo base_url() . PROJECTS_IMAGES . '/' . $value['logo_image']; ?>" alt="Standard Post with Image"></a>
                            <!--<a href="<?php echo PROJECTS_IMAGES . '/' . $value['logo_image']; ?>"> <img style="width:100%" src="<?php echo PROJECTS_IMAGES . '/' . $value['logo_image']; ?>"></a>-->
                        </div>
                        <h3><?php echo $value['title']; ?></h3>
                        <p><?php echo $value['short_desc']; ?></p>
                    </div>
                </div>

                <?php
               
                $flag++;
                if($flag == 3)
                    $flag = 0;
            }
            ?>



            <div class="clear"></div><div class="line"></div>

            <div id="oc-clients-full" class="owl-carousel image-carousel carousel-widget" data-margin="30" data-nav="false" data-loop="true" data-autoplay="5000" data-pagi="false" data-items-xxs="2" data-items-xs="3" data-items-sm="4" data-items-md="5" data-items-lg="6">

                <a href="#"><img src="assets/frontend/images/clients/1.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/2.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/3.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/4.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/5.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/6.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/7.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/8.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/9.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/10.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/11.png" alt="Clients"></a>
                <a href="#"><img src="assets/frontend/images/clients/12.png" alt="Clients"></a>

            </div>


        </div>

    </div>

</section><!-- #content end -->
