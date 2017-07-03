<footer class="contacts_wrap">
   <div class="contacts_wrap_inner">
      <div class="content_wrap">
         <div class="columns_wrap">
            <div class="column-1_4 show_logo_footer">
               <div class="logo" style="width:80%">
                  <img src="assets/propertyfinder/images/new-logo.png" class="logo_main" alt="">
                  <!-- <a href="index.html"><img src="assets/propertyfinder/images/logo-footer.jpg" alt=""></a> -->
               </div>
            </div>
            <div class="column-2_4" style="text-align: justify">
               <h5>about us</h5>
               We are the leading real estate and rental marketplace dedicated to empowering consumers with data, inspiration and knowledge around the place they call home, and connecting them with the best local professionals who can help.
            </div>
            <div class="column-1_4">
               <h5>follow us</h5>
               <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                  <!-- <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                  <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-twitter"></span></a></div>
                  <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-instagramm"></span></a></div>
                  <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-plus-1"></span></a></div>
                  <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-linkedin"></span></a></div>
                  <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-youtube-play"></span></a></div> -->
                  <?php $social_medias = get_social_media(); ?>
                  <div class="sc_socials_item">
                  <?php foreach ($social_medias as $social_media) { ?>
                      <a href="<?php echo $social_media['url']; ?>" class="social-icon si-small si-borderless" style="margin-right: 10px;border-radius:0px">
                          <img style="width:30px;" src="<?php echo SOCIAL_IMAGE . '/' . $social_media['image']; ?>">
                      </a>
                  <?php } ?>
                  </div>
               </div>
            </div>
            <div class="cL"></div>
         </div>
      </div>
   </div>
</footer>