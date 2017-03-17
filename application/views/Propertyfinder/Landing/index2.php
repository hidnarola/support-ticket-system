<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="row about_us_row">
   
   <div class="col-md-8 pull-right">
     <?php if(count($landing_banner)>0){ ?>
         <section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_revsliderHome1">
            <!-- REVOLUTION SLIDER -->
            <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper custom_revo_slider fullwidthbanner-container">
               <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" data-version="5.1" style="width:100% !important">
                  <ul>
                     <?php
                     $small_imgs = array('Slider6.jpg', 'Slider5.jpg', 'Slider4.jpg', 'Slider3.jpg', 'slider2.jpg', 'slider1.jpg');
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
                                           <div class="small-img">
                                               <!--<img src="<?php echo site_url(PROPERTY_BANNER.'/'.$v->image); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>-->
                                               <img src="<?php echo site_url(PROPERTY_BANNER.'/'.$small_imgs[$k]); ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                           </div>
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
    <div class="col-md-4 pull-left">
         <div class="about_us_bg_li">
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
      <div class="project_div">
         <div class="columns_wrap margin_top_xlarge margin_bottom_xmedium">
            <div class="row">
               <h1 class="text-center" style="margin-bottom:20px">Residential Projects</h1>
            </div>
            <div class="row">
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/manazelamman.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/Alreefcommunity.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/dunes-village.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/al-reef-2-villas.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/DARI.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/manazel-malls.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/banner-1.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/al-reef-retail.jpg'?>"></a></div>
               <div class="col-md-4"><a href="portfolio"><img src="<?php echo base_url().'uploads/properties/projects/capital-mall.jpg'?>"></a></div>
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
<style>
    #exTab1 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}

/* remove border radius for the tab */
#exTab1 .nav-pills > li > a {
  border-radius: 0;
}

/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
}

#exTab3 .tab-content {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
.sc_property.sc_property_style_property-1 .sc_property_info .sc_property_title .sc_property_title_address_1, .content > .sc_property_item .sc_property_info .sc_property_title .sc_property_title_address_1{font-size: 1.514em;margin-bottom: 5px;}
.sc_property.sc_property_style_property-1 .sc_property_info .sc_property_icon, .content > .sc_property_item .sc_property_info .sc_property_icon{margin-top:-5px;}
.sc_property.sc_property_style_property-1 .sc_property_info .sc_property_description, .content > .sc_property_item .sc_property_info .sc_property_description{margin-bottom: 10px;}
.sc_property.sc_property_style_property-1 .sc_property_info .sc_property_title{ min-height: 63px; }
.carousel { width: 100%; }
/* Indicators list style */
.article-slide .carousel-indicators {
    bottom: 0;
    left: 0;
    margin-left: 5px;
    width: 100%;
}
/* Indicators list style */
.article-slide .carousel-indicators li {
    border: medium none;
    border-radius: 0;
    float: left;
    height: 40px;
    margin-bottom: 5px;
    margin-left: 0;
    margin-right: 5px !important;
    margin-top: 0;
    width: 50px;
}
/* Indicators images style */
.article-slide .carousel-indicators img {
    border: 2px solid #FFFFFF;
    float: left;
    height: 40px;
    left: 0;
    width: 50px;
}
/* Indicators active image style */
.article-slide .carousel-indicators .active img { border: 2px solid #428BCA; opacity: 0.7; }
.single_property_slider{max-height:420px;}
.social_media_icon{ height:30px; } 
.map_container{width:100%;padding-left:0px;padding-right:0px;border: 1px solid #ccc;}
.map_container ul{border-bottom: 1px solid #ddd;}
.map_container ul li{border-right: 1px solid #ccc;}
.map_container ul li.active{border-bottom: 4px solid #ff3355;}
.map_container ul li a{border:0px solid !important;border-radius: 0px;}
.error-title{
  color: #fff;
  font-size: 40px;
  line-height: 1;
  margin-top: 20px;
  margin-bottom: 25px;
  font-weight: 300;
  display: block;
  text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0, 0, 0, 0.1), 0 0 5px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.3), 0 3px 5px rgba(0, 0, 0, 0.2), 0 5px 10px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.2), 0 20px 20px rgba(0, 0, 0, 0.15);
}
.error-title-div{
    border: 3px solid #37353d;
    border-radius: 5px;
    box-shadow: 4px 2px 10px 2px #ccc;
    background-color: #4e4a59;
}
.header_shadow {
  background: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(237,237,237,0) 100%);
}
.header_shadow2{ 
    background-image:url('../images/header_banner.jpg') !important;
    background-repeat: no-repeat;
    background-position: 0% -10%;
    background-attachment: fixed;
}
.breadcrumbs_image{
  background-image: url(../images/header_banner.jpg) !important;
    background-repeat: no-repeat;
    background-position: 0% -10%;
    background-attachment: fixed;
}
.header_shadow2::before{ 
  
  top:0;
  bottom:0;
  right:0;
  left:0;
  content:'';
  background:rgba(0, 0, 0, 0.83) !important;
  position:absolute;
}
.sold-text{
   -webkit-transform: rotate(270deg);
   -moz-transform: rotate(270deg);
   -ms-transform: rotate(270deg);
   -o-transform: rotate(270deg);
   transform: rotate(270deg);
   position: absolute;
   left: -4px;
   top: -4px;
   background: url(../images/sold.png) no-repeat;
   width: 75px;
   height: 75px;
   z-index: 99;
}
.discount_tag {
    width: 98px;
    height: 44px;
    background: url(../images/discount_tag.png) no-repeat center center;
    color: #fff;
    line-height: normal;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 0;
    font-family: 'Arial Narrow', Arial, sans-serif;
    padding-left: 5px;
    padding-top: 2px;
}
.discount_label{
    width: auto;
    padding: 8px 20px;
    background-color: rgb(54, 55, 58);
    color: #fff;
    box-shadow: 1px 1px 3px 1px #8a8181;
}
.acc_preview{    
  width: 26px;
  margin-top: -3px;
}
.property_header li a{
  text-decoration: none;
  line-height: 24px;
}
.property_wishlist_page{ padding-top:10.000em; }
.property_header .login_dropdown ul{
  left:0px;
  width:150px !important;
}
.menu_main_nav > li > ul { top: 4em; }
.menu_main_responsive > .login_dropdown ul{ background-color: rgb(55,53,61) !important; }
.slider_wrap .custom_revo_slider{
    z-index: 0;
    width: 100% !important;
    left: 0 !important;
}

.about_us_bg > ul > li{
  color:#fff;
}
.about_us_bg_heading{margin:0 0 15px;text-align:left;list-style:none;font-weight:bold;font-size:20px !important;padding:0;text-transform:uppercase;}
.about_us_row{ margin-bottom: -10px;}
.about_us_bg_li > ul{padding:0;margin:0;}
.about_us_bg_li > ul > li{margin:0 0 20px !important;z-index: 999;color: #fff;position:relative;font-size:15px;line-height:18px; }
.about_us_bg_li > ul > li:last-child{margin-bottom:0 !important; }
.about_us_row > .col-md-4{background:rgba(0, 0, 0, 0.8);color:#000;display:block;left:50px;padding:25px 30px;position: absolute;top:146px;width:34%;z-index:100;max-height:572px;}
.about_us_row > .col-md-8{width:100%;}
.about_us_bg_li{text-align:justify;font-size:16px;}
.sc_property.sc_property_style_property-6{width:456px;float:right;padding:0 !important;}
.small-img{position:absolute;top:0;left:-10px;z-index:-1; }
.small-img img {height:264px !important;width:436px !important;}
.sc_property.sc_property_style_property-6 .sc_pr_h1{display:block;position:relative;}
.sc_property.sc_property_style_property-6 .sc_pr_f1{display:block;}
.sc_property.sc_property_style_property-6 .sc_pr_t1 a {text-transform:uppercase;}
.sc_property.sc_property_style_property-6 .sc_pr_f12 {color: #9e9c9c;font-size:36px !important;line-height:40px !important;padding:20px 10px !important; }

.sc_property.sc_property_style_property-6 .sc_pr_t1{overflow:hidden;width:436px;padding:25px 0 0 !important;}
.tp-mask-wrap{position:relative !important; }
.sc_property.sc_property_style_property-6 .sc_property_item{padding:0 !important;}
.sc_property.sc_property_style_property-6 .sc_pr_h2{padding:50px 45px 10px !important;}
.tp-leftarrow{left: 38% !important;}
.project_div .col-md-4{ padding:0px !important; }

@media(min-width:992px){
.tp-parallax-wrap {left: 35% !important;padding: 0 0 0 35%;top:31.5% !important;transform: translate(-50%, -50%);width:436px !important;}
}
@media(min-width:1200px) and (max-width:1540px){
.about_us_bg_li > ul > li {font-size: 14px;line-height: 16px;margin: 0 0 15px !important;}
}
@media(min-width:1025px) and (max-width:1199px){
.about_us_row > .col-md-4 {left:20px;padding:20px;width:40%;}
.about_us_bg_li > ul > li{font-size:15px;line-height:17px;margin:0 0 10px !important;}
.tp-leftarrow{transform: matrix(1, 0, 0, 1, 50, -25) !important;}
}
@media(min-width:992px) and (max-width:1024px){
.about_us_row > .col-md-4 {left: 15px;  max-height: 540px; overflow: scroll;padding:20px;width: 38%;}
}
@media(max-width:991px){
.about_us_row {margin-bottom:0;}
.about_us_row > .col-md-4 {bottom: 0;left: 0;margin: 0;padding: 30px 40px;position: relative;top: auto;width: 100%;}
.tp-leftarrow {left:0 !important;}
.tparrows{display:none !important}
}

@media(max-width:768px) and (max-width:991px){
.tp-parallax-wrap{top:30% !important;}
}

@media(max-width:767px){
.about_us_row > .col-md-4{max-height:initial;}
.sc_property.sc_property_style_property-6 {float: none !important;padding: 0 !important;width: 100%;}
.small-img img {height: 264px !important;width: 103% !important;}

}
</style>