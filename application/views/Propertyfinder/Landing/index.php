<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="row about_us_row">
   <div class="col-md-4" style="color: #000;padding-right:0px;">
      <div class="about_us_bg">
         <div class="about_us_bg_li" style="text-align:justify;font-size: 16px;padding-left: 10px;padding-right: 10px;">
            <ul>
               <li class="about_us_bg_heading">About Us</li>
               <li style="margin-bottom:15px">Manazel Specialists is a full service community and property management company that focuses on quality and a unique knowledge of the client's needs. At the heart of the company is a group of service oriented professionals who are dedicated to providing clients with ideas, options and strategies for a variety of market conditions.</li>
               <li style="margin-bottom:15px">At Manazel Specialists, we provide life-cycle and comprehensive administrative services covering Community Management, Property Management, Sales, Re-Sales and Leasing. We are a turnkey real estate partner that can adapt to any owner's portfolio and needs.</li>
               <li style="margin-bottom:15px">Our office and operations are built from a successful real estate service platform that has been in business in the UAE and in the region for many years providing evidence of unwavering dedication to customer services.</li>
               <li style="margin-bottom:15px">Our professional team has established a diversified client base in the UAE and the region as well as relations with master and secondary developers, private and public investors. This positions our company in the forefront with a strong ability to advise and assist clients towards success.</li>
               <li style="">At Manazel specialists, we work hard to enhance the level of our customers’ satisfaction. We have a strong customer service philosophy and we take great pride in our reputation, integrity, and professionalism.</li>
            </ul>
         </div>
      </div>
   </div>
   <div class="col-md-8" style="padding-left:0px;">
     <?php if(count($landing_banner)>0){ ?>
         <section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_revsliderHome1">
            <!-- REVOLUTION SLIDER -->
            <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper custom_revo_slider fullwidthbanner-container">
               <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" data-version="5.1" style="width:100% !important">
                  <ul>
                     <?php 
                        $slider = 11;
                        foreach($landing_banner as $k => $v){ 
                     ?>
                        <li data-index="<?php if($k==0){ echo 'rs-8'; }else{ echo 'rs-'.$slider; } ?>" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1000" data-thumb="images/slider1h1-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="<?php echo site_url(PROPERTY_BANNER.'/'.$v->image); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-<?php echo $slider; ?>-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6" data-interval="7176" data-slides-min-width="250">
                                    <div class="sc_property_item">
                                       <div class="sc_pr_h1">
                                          <div class="sc_pr_h2"><?php echo $v->type_name; ?> for <?php echo $v->category_name; ?></div>
                                       </div>
                                       <div class="sc_pr_t1">
                                          <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->prop_title).'/'.base64_encode($v->prop_id)); ?>"><?php echo substr($v->prop_title,0,30); ?></a> 
                                       </div>
                                       <div class="sc_pr_t2"><?php echo substr($v->prop_address,0,30); ?></div>
                                       <div class="sc_pr_f1">
                                          <div class="sc_pr_f11">
                                             <div class="sc_pr_f111"><span><?php echo $v->type_name; ?> for <?php echo $v->category_name; ?></span></div>
                                          </div>
                                          <div class="sc_pr_f12">
                                             <span>AED </span>
                                             <?php echo number_format($v->prop_price); ?>
                                             <?php
                                                if($v->category_name=='Rent'){
                                                   echo '<font style="font-size:12px"> / '.$v->rent_type.'</font>';
                                                }
                                             ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                     <?php 
                           $slider++;
                        } 
                     ?>
                     <!-- <li data-index="rs-8" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1000" data-thumb="images/slider1h1-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                        <img src="assets/propertyfinder/images/slider/1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption Estate tp-resizeme" id="slide-8-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                           <div class="sc_property_wrap">
                              <div class="sc_property sc_property_style_property-6" data-interval="7176" data-slides-min-width="250">
                                 <div class="sc_property_item">
                                    <div class="sc_pr_h1">
                                       <div class="sc_pr_h2">House for sale</div>
                                    </div>
                                    <div class="sc_pr_t1">
                                       <a href="single-post.html">87 Mishaum Point Rd</a> 
                                    </div>
                                    <div class="sc_pr_t2">Dartmouth, MA 02748</div>
                                    <div class="sc_pr_f1">
                                       <div class="sc_pr_f11">
                                          <div class="sc_pr_f111"><span>House for sale</span></div>
                                       </div>
                                       <div class="sc_pr_f12"><span>$</span>1,249,000</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li data-index="rs-12" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                        <img src="assets/propertyfinder/images/slider/2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption Estate tp-resizeme" id="slide-12-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                           <div class="sc_property_wrap">
                              <div class="sc_property sc_property_style_property-6 " data-interval="7743" data-slides-min-width="250">
                                 <div class="sc_property_item">
                                    <div class="sc_pr_h1">
                                       <div class="sc_pr_h2">Townhouse for sale</div>
                                    </div>
                                    <div class="sc_pr_t1">
                                       <a href="single-post.html">9615 Shore Rd APT BA</a> 
                                    </div>
                                    <div class="sc_pr_t2">Brooklyn, NY 11209</div>
                                    <div class="sc_pr_f1">
                                       <div class="sc_pr_f11">
                                          <div class="sc_pr_f111"><span>Townhouse for sale</span></div>
                                       </div>
                                       <div class="sc_pr_f12"><span>$</span>2,189,000</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li data-index="rs-13" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h3-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                        <img src="assets/propertyfinder/images/slider/3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>                             
                        <div class="tp-caption Estate tp-resizeme" id="slide-13-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                           <div class="sc_property_wrap">
                              <div class="sc_property sc_property_style_property-6 " data-interval="5718" data-slides-min-width="250">
                                 <div class="sc_property_item">
                                    <div class="sc_pr_h1">
                                       <div class="sc_pr_h2">House for rent</div>
                                    </div>
                                    <div class="sc_pr_t1">
                                       <a href="single-post.html">80646 Via Pessaro</a> 
                                    </div>
                                    <div class="sc_pr_t2">La Quinta, CA 32453</div>
                                    <div class="sc_pr_f1">
                                       <div class="sc_pr_f11">
                                          <div class="sc_pr_f111"><span>House for rent</span></div>
                                       </div>
                                       <div class="sc_pr_f12"><span>$</span>3,449<span>/year</span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li> -->
                  </ul>
                  <div class="tp-bannertimer tp-bottom"></div>
               </div>
            </div>
            <!-- END REVOLUTION SLIDER -->
         </section>
      <?php } ?>
   </div>
</div>

<div class="ps_header">
   <div class="content_wrap">
      <div class="sc_section scheme_dark">
         <div class="sc_section_inner">
            <div class="sc_property_search">
               <form method="get" action="property-listing/search">
                  <div class="sc_ps_status">
                     <select name="ps" id="ps">
                        <option value="">Property Contract</option>
                        <?php foreach($property_status as $k => $v){ ?>
                           <option value="<?php echo $v->id.'-'.$v->name ?>"><?php echo 'For '.$v->name ?></option>   
                        <?php } ?>
                     </select>
                  </div>
                  <div class="sc_ps_location">
                     <select name="loc">
                        <option value="">Property Location</option>
                        <?php foreach($cities_data as $k => $v){ ?>
                           <option value="<?php echo $v->cities; ?>"><?php echo $v->cities.' ('.$v->tot_cities.')'; ?></option>
                        <?php } ?>
                        <!-- <option value="Upper East Side">Upper East Side</option>
                        <option value="Upper West Side">Upper West Side</option>
                        <option value="Midtown East">Midtown East</option>
                        <option value="Midtown West">Midtown West</option>
                        <option value="Downtown">Downtown</option>
                        <option value="Upper Manhattan">Upper Manhattan</option>
                        <option value="Brooklyn">Brooklyn</option>
                        <option value="Queens">Queens</option>
                        <option value="Bronx">Bronx</option>
                        <option value="Staten Island">Staten Island</option> -->
                     </select>
                  </div>
                  <div class="sc_ps_type">
                     <select name="pt">
                        <option value="">Property Category</option>
                        <?php foreach($property_type as $k => $v){ ?>
                           <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>   
                        <?php } ?>
                     </select>
                  </div>
                  <div class="sc_ps_style" id="div_rent_slot" style="display:none">
                     <select name="rs">
                        <option value="">Rent Slot</option>
                        <option value="Yearly">Yearly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Daily">Daily</option>
                     </select>
                  </div>
                  <div class="sc_ps_bedrooms">
                     <select name="bd">
                        <option value="">Bedrooms</option>
                        <option value="1">Bedrooms at least 1</option>
                        <option value="2">Bedrooms at least 2</option>
                        <option value="3">Bedrooms at least 3</option>
                        <option value="4">Bedrooms at least 4</option>
                        <option value="5">Bedrooms 5 or more</option>
                     </select>
                  </div>
                  <div class="sc_ps_bedrooms" id="div_bathrooms">
                     <select name="bt">
                        <option value="">Bathrooms</option>
                        <option value="1">Bathrooms at least 1</option>
                        <option value="2">Bathrooms at least 2</option>
                        <option value="3">Bathrooms at least 3</option>
                        <option value="4">Bathrooms at least 4</option>
                        <option value="5">Bathrooms 5 or more</option>
                     </select>
                  </div>
                  <div class="sc_ps_bathrooms" id="div_kw">
                     <input type="text" name="kw" placeholder="Keyword" value="">
                  </div>
                  <div class="sc_ps_area">
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
                  </div>
                  <div class="sc_ps_price">
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
                  </div>
                  <div class="sc_ps_submit">
                     <input type="submit" class="sc_button sc_button_box sc_button_style_style2" value="Search">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page_content_wrap page_paddings_no">
   <div class="sc_section">
      <div class="content_wrap">
         <div class="columns_wrap margin_top_xlarge margin_bottom_xmedium">
            <div class="column-1_2">
               <div class="bgtext1">
                  <p>FEATURED</p>
               </div>
               <h2 class="sc_title sc_title_iconed ind2 margin_top_null margin_bottom_xmedium">
                  <span class="sc_title_icon sc_title_icon_left sc_title_icon_small icon-map-pointer18 sc_left"></span>
                  <span class="sc_title_box">
                  <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$main_property->title).'/'.base64_encode($main_property->id)); ?>"><?php echo $main_property->title; ?>,</a>
                  <span class="sc_title_subtitle"><?php echo $main_property->address; ?></span>
                  </span>
               </h2>
               <div class="sc_section margin_bottom_xmedium section_style_1">
                  <div class="sc_section_inner">
                     <p style="text-align: justify"><?php echo $main_property->short_description; ?></p>
                  </div>
               </div>
               <div class="columns_wrap sc_columns margin_bottom_medium">
                  <?php 
                     $amenities = explode(',',$main_property->amenities);
                     $div = 1;
                     foreach($amenities as $k => $v){
                        if($div==1){
                           echo  '<div class="column-1_2 sc_column_item">
                                    <ul class="sc_list sc_list_style_iconed color_1" style="margin-bottom:0px !important">
                                       <li class="sc_list_item">
                                          <span class="sc_list_icon icon-stop color_2"></span>
                                          <p>'.$v.'</p>
                                       </li>
                                    </ul>
                                 </div>';
                        }
                     }
                  ?>
                  <!-- <div class="column-1_2 sc_column_item">
                     <ul class="sc_list sc_list_style_iconed color_1">
                        <li class="sc_list_item">
                           <span class="sc_list_icon icon-stop color_2"></span>
                           <p>Quiet Neighbourhood</p>
                        </li>
                        <li class="sc_list_item">
                           <span class="sc_list_icon icon-stop color_2"></span>
                           <p>Great Local Community</p>
                        </li>
                     </ul>
                  </div>
                  <div class="column-1_2 sc_column_item">
                     <ul class="sc_list sc_list_style_iconed color_1">
                        <li class="sc_list_item">
                           <span class="sc_list_icon icon-stop color_2"></span>
                           <p>Fabulous Views</p>
                        </li>
                        <li class="sc_list_item">
                           <span class="sc_list_icon icon-stop color_2"></span>
                           <p>Large Play Center In Yard</p>
                        </li>
                     </ul>
                  </div> -->
               </div>
               <div class="sc_property_wrap">
                  <div class="sc_property sc_property_style_property-2">
                     <div class="sc_property_item">
                        <div class="ps_single_info">
                           <div class="property_price_box">
                              <span class="property_price_box_sign">AED </span><span class="property_price_box_price"><?php echo number_format($main_property->price) ?></span>
                           </div>
                           <div class="sc_property_info_list">
                              <span class="icon-area_2"><?php echo number_format($main_property->area).' sqft' ?></span>
                              <span class="icon-bed"><?php echo $main_property->bedroom_no ?></span>
                              <span class="icon-bath"><?php echo $main_property->bathroom_no ?></span>
                              <!-- <span class="icon-warehouse">2</span> -->
                           </div>
                           <div class="cL"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="column-1_2">
               <figure class="sc_image ">
                  <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$main_property->title).'/'.base64_encode($main_property->id)); ?>"><img src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$main_property->images)[0].'&h=414&w=570&q=100'; ?>" alt="" /></a>
               </figure>
            </div>
         </div>
      </div>
   </div>

   <!-- Recent Properties -->
   <div class="sc_section overflow_hidden bg_color_1">
      <div class="content_wrap margin_top_large margin_bottom_medium">
         <h4 class="sc_title margin_top_null margin_bottom_medium">recent properties</h4>
         <div class="sc_property_wrap">
            <div class="sc_property sc_property_style_property-1">
               <div class="sc_columns columns_wrap">
                  <?php foreach($recent_property as $k => $v){ ?>
                     <div class="column-1_3 column_padding_bottom">
                        <?php if($v->availability==0) { ?>
                           <div class="sold-text"></div>
                        <?php } ?>
                        <?php
                           if($v->is_offer==1 && (strtotime(date('Y-m-d h:i:s'))>=strtotime($v->deal_date_from) && strtotime(date('Y-m-d h:i:s'))<=strtotime($v->deal_date_to)) ){
                              if($v->discount_type=='Percentage'){
                                 $percentage_value = number_format($v->discount_value).'%';
                              }else{
                                 $percentage_value = number_format(ceil(($v->discount_value*100)/$v->price)).'%';
                              }
                              echo '<span class="discount_tag" style="z-index:1">'. $percentage_value .' <br> OFF</span>';
                           }
                        ?>
                        <div class="sc_property_item">
                           <div class="sc_property_image">
                              <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>">
                                 <div class="property_price_box">
                                    <span class="property_price_box_sign">AED </span>
                                    <span class="property_price_box_price">
                                       <?php 
                                          if($v->is_offer==1 && (strtotime(date('Y-m-d h:i:s'))>=strtotime($v->deal_date_from) && strtotime(date('Y-m-d h:i:s'))<=strtotime($v->deal_date_to)) ){
                                             if($v->discount_type=='Percentage'){
                                                $price = ceil($v->price - (($v->price*$v->discount_value)/100));
                                             }else{
                                                $price = ceil($v->price - $v->discount_value);
                                             }
                                          }else{
                                             $price = ceil($v->price);
                                          }
                                          echo number_format($price) ;
                                       ?>
                                       <?php
                                          if($v->category_name=='Rent'){
                                             echo ' / '.$v->rent_type;
                                          }
                                       ?>
                                    </span>
                                 </div>
                                 <img alt="<?php echo $v->title ?>" src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$v->images)[0].'&h=460&w=770&q=100' ?>">
                              </a>
                           </div>
                           <div class="sc_property_info">
                              <div class="sc_property_description"><?php echo $v->type_name.' for '.$v->category_name ?></div>
                              <div>
                                 <div class="sc_property_icon">
                                    <span class="icon-location"></span>
                                 </div>
                                 <div class="sc_property_title">
                                    <div class="sc_property_title_address_1">
                                       <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>"><?php echo substr($v->title,0,25); ?></a> 
                                    </div>
                                    <div class="sc_property_title_address_2"><?php echo $v->address; ?></div>
                                 </div>
                                 <div class="cL"></div>
                              </div>
                           </div>
                           <div class="sc_property_info_list">
                              <span class="icon-building113"><?php echo number_format($v->area) ?> sqft</span><span class="icon-bed"><?php echo $v->bedroom_no ?></span><span class="icon-bath"><?php echo $v->bathroom_no ?></span><!-- <span class="icon-warehouse">2</span>-->
                           </div>
                        </div>
                     </div>   
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Featured Properties -->
   <div class="sc_section overflow_hidden bg_color_1">
      <div class="content_wrap margin_bottom_medium">
         <h4 class="sc_title margin_top_null margin_bottom_medium">featured properties</h4>
         <div class="sc_property_wrap">
            <div class="sc_property sc_property_style_property-1">
               <div class="sc_columns columns_wrap">
                  <?php foreach($featured_property as $k => $v){ ?>
                     <div class="column-1_3 column_padding_bottom">
                        <?php if($v->availability==0) { ?>
                           <div class="sold-text"></div>
                        <?php } ?>
                        <?php
                           if($v->is_offer==1 && (strtotime(date('Y-m-d h:i:s'))>=strtotime($v->deal_date_from) && strtotime(date('Y-m-d h:i:s'))<=strtotime($v->deal_date_to)) ){
                              if($v->discount_type=='Percentage'){
                                 $percentage_value = number_format($v->discount_value).'%';
                              }else{
                                 $percentage_value = number_format(ceil(($v->discount_value*100)/$v->price)).'%';
                              }
                              echo '<span class="discount_tag" style="z-index:1">'. $percentage_value .' <br> OFF</span>';
                           }
                        ?>
                        <div class="sc_property_item">
                           <div class="sc_property_image">
                              <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>">
                                 <div class="property_price_box">
                                    <span class="property_price_box_sign">AED </span>
                                    <span class="property_price_box_price">
                                       <?php 
                                          if($v->discount_type=='Percentage'){
                                             $price = ceil($v->price - (($v->price*$v->discount_value)/100));
                                          }else{
                                             $price = ceil($v->price - $v->discount_value);
                                          }
                                          echo number_format($price) ;
                                       ?>
                                       <?php
                                          if($v->category_name=='Rent'){
                                             echo ' / '.$v->rent_type;
                                          }
                                       ?>
                                    </span>
                                 </div>
                                 <img alt="<?php echo $v->title ?>" src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$v->images)[0].'&h=460&w=770&q=100' ?>">
                              </a>
                           </div>
                           <div class="sc_property_info">
                              <div class="sc_property_description"><?php echo $v->type_name.' for '.$v->category_name ?></div>
                              <div>
                                 <div class="sc_property_icon">
                                    <span class="icon-location"></span>
                                 </div>
                                 <div class="sc_property_title">
                                    <div class="sc_property_title_address_1">
                                       <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>"><?php echo substr($v->title,0,25); ?></a> 
                                    </div>
                                    <div class="sc_property_title_address_2"><?php echo $v->address; ?></div>
                                 </div>
                                 <div class="cL"></div>
                              </div>
                           </div>
                           <div class="sc_property_info_list">
                              <span class="icon-building113"><?php echo number_format($v->area) ?> sqft</span><span class="icon-bed"><?php echo $v->bedroom_no ?></span><span class="icon-bath"><?php echo $v->bathroom_no ?></span><!-- <span class="icon-warehouse">2</span>-->
                           </div>
                        </div>
                     </div>   
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Featured Properties -->
   <div class="sc_section overflow_hidden bg_color_1">
      <div class="content_wrap margin_bottom_medium">
         <h4 class="sc_title margin_top_null margin_bottom_medium">offer's properties</h4>
         <div class="sc_property_wrap">
            <div class="sc_property sc_property_style_property-1">
               <div class="sc_columns columns_wrap">
                  <?php foreach($offer_property as $k => $v){ ?>
                     <div class="column-1_3 column_padding_bottom">
                        <?php if($v->availability==0) { ?>
                           <div class="sold-text"></div>
                        <?php } ?>
                        <?php
                           if($v->discount_type=='Percentage'){
                              $percentage_value = number_format($v->discount_value).'%';
                           }else{
                              $percentage_value = number_format(ceil(($v->discount_value*100)/$v->price)).'%';
                           }
                        ?>
                        <span class="discount_tag" style="z-index:1"><?php echo $percentage_value; ?> <br> OFF</span>
                        <div class="sc_property_item">
                           <div class="sc_property_image">
                              <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>">
                                 <div class="property_price_box">
                                    <span class="property_price_box_sign">AED </span>
                                    <span class="property_price_box_price">
                                       <?php 
                                          if($v->discount_type=='Percentage'){
                                             $price = ceil($v->price - (($v->price*$v->discount_value)/100));
                                          }else{
                                             $price = ceil($v->price - $v->discount_value);
                                          }
                                          echo number_format($price) ;
                                       ?>
                                       <?php
                                          if($v->category_name=='Rent'){
                                             echo ' / '.$v->rent_type;
                                          }
                                       ?>
                                    </span>
                                 </div>
                                 <img alt="<?php echo $v->title ?>" src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$v->images)[0].'&h=460&w=770&q=100' ?>">
                              </a>
                           </div>
                           <div class="sc_property_info">
                              <div class="sc_property_description"><?php echo $v->type_name.' for '.$v->category_name ?></div>
                              <div>
                                 <div class="sc_property_icon">
                                    <span class="icon-location"></span>
                                 </div>
                                 <div class="sc_property_title">
                                    <div class="sc_property_title_address_1">
                                       <a href="<?php echo site_url('property-listing/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>"><?php echo substr($v->title,0,25); ?></a> 
                                    </div>
                                    <div class="sc_property_title_address_2"><?php echo $v->address; ?></div>
                                 </div>
                                 <div class="cL"></div>
                              </div>
                           </div>
                           <div class="sc_property_info_list">
                              <span class="icon-building113"><?php echo number_format($v->area) ?> sqft</span><span class="icon-bed"><?php echo $v->bedroom_no ?></span><span class="icon-bath"><?php echo $v->bathroom_no ?></span><!-- <span class="icon-warehouse">2</span>-->
                           </div>
                        </div>
                     </div>   
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Mobile Play Store -->
   <div class="sc_section mobile-box back_image_1">
      <div class="content_wrap">
         <div class="bgtext1">
            <p>MOBILE</p>
         </div>
         <div class="columns_wrap sc_columns">
            <div class="column-1_2 sc_column_item">
               <h1 class="sc_title">Search Best Deals <b>on Go</b></h1>
               <div class="sc_section margin_bottom_medium section_style_1">
                  <div class="sc_section_inner">
                     <p>The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary.</p>
                  </div>
               </div>
               <div class="sc_section">
                  <div class="sc_section_inner">
                     <figure class="sc_image alignleft margin_bottom_small">
                        <a href="#"><img src="assets/propertyfinder/images/img_b1.png" alt="" /></a>
                     </figure>
                     <figure class="sc_image alignleft margin_bottom_large">
                        <a href="#"><img src="assets/propertyfinder/images/img_b2.png" alt="" /></a>
                     </figure>
                  </div>
               </div>
            </div>
            <div class="column-1_2 sc_column_item">
               <figure class="sc_image customImgHome1"><img src="assets/propertyfinder/images/img_mobile.png" alt="" /></figure>
            </div>
         </div>
      </div>
   </div>
</div>