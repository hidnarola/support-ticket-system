
        <div class="page_content_wrap">
            <div class="content-wrap">

                <div class="container clearfix">
                    <?php if($page_data['banner_image']!=''){ 
                        $url = '#'; 
                            if($page_data['ext_url']!=''){
                                $url = $page_data['ext_url'];
                            }
                        ?>
                        <a href="<?php echo $url; ?>"> <img src="<?php echo PAGE_BANNER.'/'.$page_data['banner_image'] ?>" class="hero-image-inner"></a>
                    <?php } ?>

                    <?php echo $page_data['description']; ?>
                </div>

            </div>
        </div>

       <!-- #content end -->
       <style>
           .top_panel_over .top_panel_wrap{
            position:relative !important;
           }
       </style>