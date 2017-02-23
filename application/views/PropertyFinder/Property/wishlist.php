<div class="page_content_wrap property_wishlist_page">
   <div class="content_wrap">
      <div class="content">
         <div class="sc_property sc_property_style_property-1">
            <div class="columns_wrap">
               <?php foreach($wishlist_data as $k => $v){ ?>
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
                           <a href="<?php echo site_url('property-finder/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>">
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
                              <img alt="" src="<?php echo 'assets/timthumb.php?src='.PROPERTY_IMAGE.'/'.explode(',',$v->images)[0].'&h=460&w=770&q=100' ?>">
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
                                    <a href="<?php echo site_url('property-finder/single-property/'.str_replace(' ','-',$v->title).'/'.base64_encode($v->id)); ?>"><?php echo substr($v->title,0,25); ?></a> 
                                 </div>
                                 <div class="sc_property_title_address_2"><?php echo $v->address; ?></div>
                              </div>
                              <div class="cL"></div>
                           </div>
                        </div>
                        <div class="sc_property_info_list">
                           <span class="icon-building113"><?php echo number_format($v->area).' sqft' ?></span>
                           <span class="icon-bed"><?php echo $v->bedroom_no ?></span>
                           <span class="icon-bath"><?php echo $v->bathroom_no ?></span>
                           <!-- <span class="icon-warehouse">2</span> -->
                        </div>
                     </div>
                  </div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
            