<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
<style> .fancy-title.title-dotted-border {
        background: url(assets/frontend/images/icons/dotted.png) repeat-x center;
    }
    .title-center {
        text-align: center;
    }
    .fancy-title {
        position: relative;
        margin-bottom: 30px;
    }
    .fancy-title h3 {
        position: relative;
        display: inline-block;
        background-color: #FFF;
        padding-right: 15px;
        margin-bottom: 20px;
    }
    .title-center h3 {
        padding: 0 15px;
    }
</style>
<div class="page_content_wrap">
   <div class="content_wrap">
      <div class="content">
         <section class="post_featured" style="box-shadow: 0px 2px 10px 0px rgb(130, 132, 135)">
            <div class="post_thumb">
               <div class="carousel slide article-slide" id="article-photo-carousel">
                 <!-- Wrapper for slides -->
                  <div class="carousel-inner cont-slider">
                     <?php 
                        $img_arr = explode(',',$property_data->images);
                        for($i=0;$i<count($img_arr);$i++){
                        ?>
                           <div class="item <?php if($i==0){ echo 'active'; } ?>">
                              <a class="fancybox" href="<?php echo PROPERTY_IMAGE . '/' . $img_arr[$i]; ?>" data-fancybox-group="gallery">
                                 <img alt="" src="<?php echo site_url(PROPERTY_IMAGE.'/'.$img_arr[$i]); ?>" class="single_property_slider">
                              </a>
                           </div>      
                        <?php
                        }
                     ?>
                  </div>
                  <!-- Indicators -->
                  <ol class="carousel-indicators hidden-xs" style="margin-bottom:0px">
                     <?php for($i=0;$i<count($img_arr);$i++){ ?>
                        <li class="<?php if($i==0){ echo 'active'; } ?>" data-slide-to="<?php echo $i; ?>" data-target="#article-photo-carousel">
                           <img alt="" src="<?php echo site_url('assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.$img_arr[$i].'&w=250&h=180&q=100&zc=3'); ?>">    
                        </li>
                     <?php } ?>
                 </ol>
                 <a class="left carousel-control" href="#article-photo-carousel" role="button" data-slide="prev">
                   <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                   <span class="sr-only">Previous</span>
                 </a>
                 <a class="right carousel-control" href="#article-photo-carousel" role="button" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
                 </a>
               </div>
               <!-- <a class="hover_icon hover_icon_view" href="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$property_data->images)[0].'&h=659&w=1170&q=100&zc=3' ?>" title="<?php echo $property_data->title ?>">
               <span class="ps_single_status"><?php echo $property_data->category_name; ?></span>
               <img alt="" src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$property_data->images)[0].'&h=659&w=1170&q=100&zc=3' ?>"></a> -->
            </div>
         </section>
         <section class="post_content">
            <div class="post_info">
               <span class="post_info_item">in <a class="property_group_link" href="#">For <?php echo $property_data->category_name ?></a>, 
               <!-- <a class="property_group_link" href="#">Lux Property</a></span> -->
               <span class="post_info_item">Started <a href="javscript:void(0)" class="post_info_date date updated"><?php echo date('F d, Y',strtotime($property_data->created)) ?></a></span>
               <span class="post_info_item post_info_counters">
               <a class="post_counters_item" href="#"><span>0</span> Comments</a>
               </span>
            </div>
            <h3 class="post_title"><?php echo $property_data->title.', '.$property_data->address; ?></h3>
            <div class="ps_single_info">
               <div class="ps_single_info_descr">
                  <b>Property Reference ID :</b> <i><?php echo $property_data->reference_number.', '.$property_data->type_name ?>.</i> 
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <button class="btn btn-default" style="border-radius:2px" type="button" id="btn_save" onclick="add_to_wishlist('<?php echo base64_encode($property_data->id); ?>')">
                        <?php if(isset($is_in_wishlist)){ 
                                 if($is_in_wishlist==0){ ?>
                                    <span class="icon-heart" style="color:red"></span><font style="margin-left:10px;font-weight:bold">Save</font>
                                 <?php }else{ ?>
                                    <span class="icon-check" style="color:green"></span><font style="margin-left:10px;font-weight:bold">Saved</font>
                                 <?php } ?>
                        <?php }else{ ?>
                           <span class="icon-heart" style="color:red"></span><font style="margin-left:10px;font-weight:bold">Save</font>
                        <?php } ?>
                     </button>
                     <button class="btn btn-default" style="border-radius:2px" data-toggle="popover" data-container="body" data-placement="bottom" type="button" data-html="true" href="#" id="share"><span class="icon-share" style="color:red"></span><font style="margin-left:10px;font-weight:bold">Share</font></button>
                     <?php
                           $uri = $_SERVER['REQUEST_URI'];
                           $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
                           $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        ?>
                     <div id="popover-content" class="form-share hide">
                        <div class="post_social">
                           <a href="javascript:void(0)" class="icon-fb" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo $url; ?>')" title="Facebook Share"><img class="social_media_icon" src="assets/propertyfinder/images/social_media/fb.png"/></a>
                             <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo $url; ?>')" title="Google Plus Share"><img class="social_media_icon" src="assets/propertyfinder/images/social_media/gp.png"/></a>
                             <a href="javascript:void(0)" class="icon-tw" onclick="javascript:genericSocialShare('http://twitter.com/share?url=<?php echo $url; ?>')" title="Twitter Share"><img class="social_media_icon" src="assets/propertyfinder/images/social_media/tw.png"/></a>
                             <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>')" title="LinkedIn Share"><img class="social_media_icon" src="assets/propertyfinder/images/social_media/in.png"/></a>
                             <a href="javascript:void(0)" class="icon-linked_in" onclick="javascript:genericSocialShare('mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo $url; ?>.')" title="E-Mail Share"><img class="social_media_icon" src="assets/propertyfinder/images/social_media/mail.png"/></a>
                         </div>
                     </div>
                     <button type="button" class="btn btn-default" style="border-radius:2px" onclick="printContent('printContent')"><span class="icon-print" style="color:red"></span><font style="margin-left:10px;font-weight:bold">Print</font></button>
                  </div>
               </div><br>
               <div class="property_price_box">
                  <span class="property_price_box_sign">AED </span>
                  <span class="property_price_box_price">
                     <?php 
                        if($property_data->is_offer==1 && (strtotime(date('Y-m-d h:i:s'))>=strtotime($property_data->deal_date_from) && strtotime(date('Y-m-d h:i:s'))<=strtotime($property_data->deal_date_to)) ){
                           if($property_data->discount_type=='Percentage'){
                              $price = ceil($property_data->price - (($property_data->price*$property_data->discount_value)/100));
                           }else{
                              $price = ceil($property_data->price - $property_data->discount_value);
                           }
                           echo '<strike style="font-size:13px">'.number_format($property_data->price).'</strike>'.' '.number_format($price);
                        }else{
                           $price = ceil($property_data->price);
                           echo number_format($price);
                        }
                     ?>
                     <?php
                        if($property_data->category_name=='Rent'){
                           echo ' / '.$property_data->rent_type;
                        }
                     ?>
                  </span>

               </div>
               <div class="sc_property_info_list">
                  <?php
                     if($property_data->is_offer==1 && (strtotime(date('Y-m-d h:i:s'))>=strtotime($property_data->deal_date_from) && strtotime(date('Y-m-d h:i:s'))<=strtotime($property_data->deal_date_to)) ){
                        if($property_data->discount_type=='Percentage'){
                           $percentage_value = number_format($property_data->discount_value).'% OFF';
                        }else{
                           $percentage_value = number_format(ceil(($property_data->discount_value*100)/$property_data->price)).'% OFF';
                        }
                        echo '<span class="discount_label"> - '.$percentage_value.'</span>';
                     }
                  ?>
                  <span class="icon-area_2"><?php echo number_format($property_data->area).' sqft' ?></span>
                  <span class="icon-bed"><?php echo $property_data->bedroom_no ?></span>
                  <span class="icon-bath"><?php echo $property_data->bathroom_no ?></span>
               </div>
               <div class="cL"></div>
            </div>
            <div class="sc_section" style="text-align:justify">
               <p>
                  <?php echo $property_data->description; ?>
               </p>
               <div class="sc_line sc_line_position_center_center sc_line_style_solid margin_top_medium margin_bottom_medium"></div>
               <h4 class="sc_title">Features &amp; Amenities</h4>
               <div class="columns_wrap sc_columns">
                  <?php 
                     $amenities = explode(',',$property_data->amenities);
                     $div = 1;
                     foreach($amenities as $k => $v){
                        echo '<div class="column-1_2 sc_column_item">
                                 <ul class="sc_list sc_list_style_iconed color_1" style="margin-bottom:0px !important">
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>'.$v.'</p>
                                    </li>
                                 </ul>
                              </div>';
                     }
                  ?>
               </div>
               <div class="sc_line sc_line_position_center_center sc_line_style_solid margin_top_medium margin_bottom_medium"></div>
               <h4 class="sc_title">Contacts Us</h4>
               <div  class="sc_team_wrap">
                  <div class="sc_team sc_team_style_team-2">
                     <div class="sc_columns columns_wrap">
                        <div class="column-1_2 column_padding_bottom">
                           <div  class="sc_team_item columns_wrap">
                              <div class="sc_team_item_avatar">
                                 <img alt="" src="assets/images/no_photo2.png"> 
                              </div>
                              <div class="sc_team_item_info">
                                 <div class="sc_team_item_title"><a href="single-team.html"><?php echo $property_data->contact_name ?></a></div>
                                 <div class="sc_team_item_position">Agent</div>
                                 <div class="sc_socials sc_socials_type_icons sc_socials_size_tiny">
                                    <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                                    <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-twitter"></span></a></div>
                                    <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-instagramm"></span></a></div>
                                    <div class="sc_socials_item"><a href="#" target="_blank" class="social_icons"><span class="icon-linkedin"></span></a></div>
                                 </div>
                              </div>
                              <div class="cL"></div>
                              <div class="sc_team_item_phone"><span class="icon-mobile29"></span><?php echo $property_data->contact_no ?></div>
                              <div class="sc_team_item_email"><span class="icon-message106"></span><?php echo $property_data->contact_email ?></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sc_line sc_line_position_center_center sc_line_style_solid margin_top_medium margin_bottom_medium"></div>
               <h4 class="sc_title">Property Map</h4>
               <div class="container map_container" style="width:100%;padding-left:0px;padding-right:0px">
                  <ul class="nav nav-tabs map_tab" id="map_tab">
                     <li class="active"><a data-toggle="tab" href="#tab_map">Map</a></li>
                     <li><a data-toggle="tab" href="#tab_street_view">Street View</a></li>
                  </ul>

                  <div class="tab-content">
                     <div id="tab_map" class="tab-pane fade in active">
                        <div id="map"></div>
                     </div>
                     <div id="tab_street_view" class="tab-pane fade">
                        <div id="street_view"></div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <div class="sidebar widget_area scheme_original">
         <div class="sidebar_inner widget_area_inner">
            <aside class="widget widget_property_search scheme_dark">
               <form method="get" action="property-finder/search">
                  <input type="text" name="kw" placeholder="Keyword" value="" autocomplete="off">
                  <select name="ps">
                     <option value="">Property Status</option>
                     <?php foreach($property_status as $k => $v){ ?>
                        <option value="<?php echo $v->id.'-'.$v->name ?>"><?php echo 'For '.$v->name ?></option>   
                     <?php } ?>
                  </select>
                  <select name="loc">
                     <option value="">Property Location</option>
                     <?php foreach($cities_data as $k => $v){ ?>
                        <option value="<?php echo $v->cities; ?>"><?php echo $v->cities.' ('.$v->tot_cities.')'; ?></option>
                     <?php } ?>
                  </select>
                  <select name="pt">
                     <option value="">Property Type</option>
                     <?php foreach($property_type as $k => $v){ ?>
                        <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>   
                     <?php } ?>
                  </select>
                  <select name="rs">
                     <option value="">Rent Slot</option>
                     <option value="Yearly">Yearly</option>
                     <option value="Monthly">Monthly</option>
                     <option value="Weekly">Weekly</option>
                     <option value="Daily">Daily</option>
                  </select>
                  <select name="bd">
                     <option value="">Bedrooms</option>
                     <?php for($bed=1;$bed<=5;$bed++){ ?>
                        <?php if($bed==5){ ?>
                           <option value=<?= $bed ?>> Bedrooms <?= $bed ?> or more</option>";
                        <?php }else{ ?>
                           <option value=<?= $bed ?>> Bedrooms at least <?= $bed ?></option>";
                        <?php } ?>
                     <?php } ?>
                  </select>
                  <select name="bt">
                     <option value="">Bathrooms</option>
                     <?php for($bath=1;$bath<=5;$bath++){ ?>
                        <?php if($bath==5){ ?>
                           <option value=<?= $bath ?>> Bathrooms <?= $bath ?> or more</option>";
                        <?php }else{ ?>
                           <option value=<?= $bath ?>> Bathrooms at least <?= $bath ?></option>";
                        <?php } ?>
                     <?php } ?>
                  </select>
                  <div class="ps_area ps_range_slider">
                     <div class="ps_area_info">
                        <div class="ps_area_info_title">Area</div>
                        <div class="ps_area_info_value"></div>
                        <div class="cL"></div>
                     </div>
                     <div id="slider-range-area"></div>
                     <input type="hidden" class="ps_area_min" name="af" value="<?php echo $min_max_price_area['min_area']; ?>">
                     <input type="hidden" class="ps_area_max" name="at" value="<?php echo $min_max_price_area['max_area']; ?>">
                     <input type="hidden" class="ps_area_big" name="" value="<?php echo $min_max_price_area['max_area']; ?>">
                  </div>
                  <div class="ps_price ps_range_slider">
                     <div class="ps_price_info">
                        <div class="ps_price_info_title">Price</div>
                        <div class="ps_price_info_value"></div>
                        <div class="cL"></div>
                     </div>
                     <div id="slider-range-price"></div>
                     <input type="hidden" class="ps_price_min" name="pr_f" value="<?php echo $min_max_price_area['min_price']; ?>">
                     <input type="hidden" class="ps_price_max" name="pr_t" value="<?php echo $min_max_price_area['max_price']; ?>">
                     <input type="hidden" class="ps_price_big" name="" value="<?php echo $min_max_price_area['max_price']; ?>">
                  </div>
                  <input type="submit" class="sc_button sc_button_box sc_button_style_style2 aligncenter ps" value="Search">
               </form>
            </aside>
         </div>
      </div>
   </div>
</div>
<div id="printContent" style="display:none">
   <div class="container-fluid" style="font-family:monospace;width:100%;margin-top:20px">
      <div style="text-align:center">
         <img src="<?php echo site_url('assets/frontend/images/MS-Logo-(1).png'); ?>">
      </div>
      <hr style="border:1px solid #ccc; ">
      <div class="row">
         <div class="col-md-12"><?php echo $property_data->title; ?></div>
         <div class="col-md-12" style="margin-bottom:20px">
            <?php echo $property_data->category_name.' for '.$property_data->type_name.' in '.$property_data->address; ?><br>
            <b>Reference Number : </b><?php echo $property_data->reference_number; ?>
         </div>
         <div class="col-md-12" style="margin-bottom:40px">
            <img alt="" src="<?php echo site_url('assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$property_data->images)[0].'&h=659&w=1170&q=100&zc=3'); ?>" style="width:90%"></a>
         </div>
         <div class="col-md-12" style="margin-bottom:40px">
            <font style="font-weight:bold;font-size:23px;">DETAILS</font>
            <table border="0" style="width:100%;margin-top:15px">
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Price</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo 'AED '.number_format($property_data->price); ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Type</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->type_name; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Reference No.</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->reference_number; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Bedrooms</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->bedroom_no; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Bathrooms</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->bathroom_no; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Area</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->area.' sqft'; ?></td>
               </tr>
            </table>
         </div>
         <div class="col-md-12" style="margin-bottom:40px">
            <font style="font-weight:bold;font-size:23px;">AMENITIES</font>
            <div class="columns_wrap sc_columns" style="width:100%;margin-top:15px">
               <?php 
                  $amenities = explode(',',$property_data->amenities);
                  $div = 1;
                  foreach($amenities as $k => $v){
                     echo '<div class="column-1_1 sc_column_item">
                              <ul class="sc_list sc_list_style_iconed" style="margin-bottom:-5px !important">
                                 <li class="sc_list_item">
                                    <span class="sc_list_icon icon-check color_2"></span>
                                    <p>'.$v.'</p>
                                 </li>
                              </ul>
                           </div>';
                  }
               ?>
            </div>
         </div>
         <div class="col-md-12" style="margin-bottom:40px">
            <font style="font-weight:bold;font-size:23px;">CONTACT DETAILS</font>
            <table border="0" style="width:100%;margin-top:15px">
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Contact Name</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->contact_name; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Contact No.</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->contact_no; ?></td>
               </tr>
               <tr style="border-bottom: 1px solid #ccc">
                  <td style="width:40%;padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><b>Contact Email</b></td>
                  <td style="padding:8px;border-color:#fff;border-bottom:1px solid #ccc"><?php echo $property_data->contact_email; ?></td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
<style>
   #map { min-height: 300px; }
   #street_view { min-height: 300px; }
</style>
<script>
   var prop_lat = '<?php if(isset($property_data)){ echo $property_data->latitude; } ?>';
   var prop_lng = '<?php if(isset($property_data)){ echo $property_data->longitude; } ?>';
   var prop_address = '<?php if(isset($property_data)){ echo $property_data->address; } ?>';
   var map;
   var panorama;
   var bounceTimer;
   function initMap() {
      var stylez = [
          {
              "featureType": "all",
              "elementType": "labels.text.fill",
              "stylers": [
                  { "saturation": 36 },
                  { "color": "#333333"},
                  { "lightness": 40 }
              ]
          },
          {
              "featureType": "all",
              "elementType": "labels.text.stroke",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#ffffff" },
                  { "lightness": 16 }
              ]
          },
          {
              "featureType": "all",
              "elementType": "labels.icon",
              "stylers": [
                  { "visibility": "on" }
              ]
          },
          {
              "featureType": "administrative",
              "elementType": "geometry.fill",
              "stylers": [
                  { "color": "#fefefe" },
                  { "lightness": 20 }
              ]
          },
          {
              "featureType": "administrative",
              "elementType": "geometry.stroke",
              "stylers": [
                  { "color": "#fefefe" },
                  { "lightness": 17 },
                  { "weight": 1.2 }
              ]
          },
          {
              "featureType": "administrative.country",
              "elementType": "geometry.fill",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#ff0000" }
              ]
          },
          {
              "featureType": "administrative.country",
              "elementType": "geometry.stroke",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#5c5656" }
              ]
          },
          {
              "featureType": "administrative.country",
              "elementType": "labels.text.fill",
              "stylers": [
                  { "color": "#cc0505" },
                  { "visibility": "on" }
              ]
          },
          {
              "featureType": "administrative.country",
              "elementType": "labels.text.stroke",
              "stylers": [
                  { "visibility": "simplified" },
                  { "color": "#ff0505" }
              ]
          },
          {
              "featureType": "administrative.province",
              "elementType": "geometry.fill",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#ad2121" }
              ]
          },
          {
              "featureType": "administrative.province",
              "elementType": "labels.text.fill",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#000110" }
              ]
          },
          {
              "featureType": "administrative.locality",
              "elementType": "geometry.fill",
              "stylers": [
                  { "color": "#ff0000" },
                  { "visibility": "on" }
              ]
          },
          {
              "featureType": "administrative.locality",
              "elementType": "geometry.stroke",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#790b0b" }
              ]
          },
          {
              "featureType": "administrative.locality",
              "elementType": "labels.text.fill",
              "stylers": [
                  { "color": "#590000" },
                  { "visibility": "on" }
              ]
          },
          {
              "featureType": "administrative.neighborhood",
              "elementType": "labels.text.fill",
              "stylers": [
                  { "visibility": "on" },
                  { "color": "#000aff" }
              ]
          },
          {
              "featureType": "landscape",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#f5f5f5" },
                  { "lightness": 20 }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#f5f5f5" },
                  { "lightness": 21 }
              ]
          },
          {
              "featureType": "poi.park",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#dedede" },
                  { "lightness": 21 }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "geometry.fill",
              "stylers": [
                  { "color": "#cccccc" },
                  { "lightness": 17 }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "geometry.stroke",
              "stylers": [
                  { "color": "#cccccc" },
                  { "lightness": 29 },
                  { "weight": 0.2 }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#cccccc" },
                  { "lightness": 18 }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#cccccc" },
                  { "lightness": 16 }
              ]
          },
          {
              "featureType": "transit",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#f2f2f2" },
                  { "lightness": 19 }
              ]
          },
          {
              "featureType": "water",
              "elementType": "geometry",
              "stylers": [
                  { "color": "#5bc0ee" },
                  { "lightness": 17 }
              ]
          }
      ];
      map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)},
         zoom: 13,
         mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
         }
      });
      var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
      map.mapTypes.set('tehgrayz', mapType);
      map.setMapTypeId('tehgrayz');
           
      var contentString = 'Hello';

      var infowindow = new google.maps.InfoWindow({
         content: contentString
      });
      var image = new google.maps.MarkerImage(
         'assets/propertyfinder/images/marker.png',
         null, // size
         null, // origin
         new google.maps.Point( 30, 30 ), // anchor (move to center of marker)
         new google.maps.Size( 40, 40 ) // scaled size (required for Retina display icon)
      );
      var marker = new google.maps.Marker({
         position: {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)},
         map: map,
         icon: image
         //title: 'Uluru (Ayers Rock)'
      });
      google.maps.event.addListener(marker, 'mouseover', function() {
           if (this.getAnimation() == null || typeof this.getAnimation() === 'undefined') {
               clearTimeout(bounceTimer);
               var that = this;
               bounceTimer = setTimeout(function(){
                    that.setAnimation(google.maps.Animation.BOUNCE);
               },
               500);
           }
      });
      panorama = new google.maps.StreetViewPanorama(
         document.getElementById('street_view'), {
            position: {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)},
            pov: {
               heading: 34,
               pitch: 10
            }
         }
      );
   }

   function printContent(el){
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');
      mywindow.document.write('<h1>' + document.title  + '</h1>');
      mywindow.document.write(document.getElementById(el).innerHTML);
      mywindow.document.close();
      mywindow.focus();

      mywindow.print();
      mywindow.close();
   }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgj2beNtgW-haTFepc14aXAce7psjNIYk&callback=initMap"></script>
<script type="text/javascript" async >
   function genericSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
   }
</script>
<script>
    $(function () {
        $('.fancybox').fancybox();
    });
</script>