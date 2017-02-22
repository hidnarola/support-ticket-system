<?php
   if($this->input->get('ps')!=''){ $ps_parameter = 'ps='.$this->input->get('ps'); }else{ $ps_parameter=''; }
   if($this->input->get('pt')!=''){ $pt_parameter = '&pt='.$this->input->get('pt'); }else{ $pt_parameter=''; }
   if($this->input->get('rs')!=''){ $rs_parameter = '&rs='.$this->input->get('rs'); }else{ $rs_parameter=''; }
   if($this->input->get('bd')!=''){ $bd_parameter = '&bd='.$this->input->get('bd'); }else{ $bd_parameter=''; }
   if($this->input->get('bt')!=''){ $bt_parameter = '&bt='.$this->input->get('bt'); }else{ $bt_parameter=''; }
   if($this->input->get('kw')!=''){ $kw_parameter = '&kw='.$this->input->get('kw'); }else{ $kw_parameter=''; }
   if($this->input->get('pr_t')!=''){ $pr_t_parameter = '&pr_t='.$this->input->get('pr_t'); }else{ $pr_t_parameter=''; }
   if($this->input->get('pr_f')!=''){ $pr_f_parameter = '&pr_f='.$this->input->get('pr_f'); }else{ $pr_f_parameter=''; }
   if($this->input->get('at')!=''){ $at_parameter = '&at='.$this->input->get('at'); }else{ $at_parameter=''; }
   if($this->input->get('af')!=''){ $af_parameter = '&af='.$this->input->get('af'); }else{ $af_parameter=''; }
   if($this->input->get('loc')!=''){ $loc_parameter = '&loc='.$this->input->get('loc'); }else{ $loc_parameter=''; }
   if($this->input->get('order')!=''){ $order_parameter = '&order='.$this->input->get('order'); }else{ $order_parameter=''; }
   $c_pg = 1;
   if ($this->input->get('pg') != '')
      $c_pg = $this->input->get('pg');
?>
<div class="page_content_wrap">
   <div class="content_wrap">
      <?php if($property_count>0){ ?>
         <div class="row">
            <div class="col-md-2">
               <div class="form-group scheme_dark">
                  <label for="sel1" style="color:#000">Sort By : </label>
                  <select class="form-control" id="sort_by" name="sort_by" onchange="sortingproduct(this.value)">
                     <option value='price_asc' <?php if($order=='price_asc'){ echo 'selected'; } ?>>Lowest Price</option>
                     <option value='price_desc' <?php if($order=='price_desc'){ echo 'selected'; } ?>>Highest Price</option>
                     <option value='latest' <?php if($order=='latest'){ echo 'selected'; } ?>>Newest</option>
                     <option value='bed_asc' <?php if($order=='bed_asc'){ echo 'selected'; } ?>>Lowest Beds</option>
                     <option value='bed_desc' <?php if($order=='bed_desc'){ echo 'selected'; } ?>>Highest Beds</option>
                  </select>
               </div>
            </div>
         </div>
      <?php } ?>
      <div class="content">
         <?php if($property_count==0){ ?>
            <!-- <div class="text-center content-group error-title-div">
               <h1 class="error-title">No Data Found...</h1>
            </div> -->
         <?php } else { ?>
            <div class="sc_property sc_property_style_property-1">
               <div class="columns_wrap">
                  <?php foreach($properties_data as $k => $v){ ?>
                     <div class="column-1_2 column_padding_bottom">
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
            <?php if($property_count>20){ ?>
               <nav id="pagination" class="pagination_wrap pagination_pages">
                  <?php if ($c_pg != 1) { ?>
                     <a href="<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $order_parameter . '&pg=1' ?>" class="pager_first"></a>
                  <?php } ?>
                  <?php if ($c_pg > 3) { ?>
                     <a href="<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $order_parameter . '&pg=' . ($c_pg - 1) ?>" class="pager_prev"></a>
                  <?php } ?>
                  <?php
                     $display_num = $total_page = ceil($property_count / $_per_page_property);
                     if ($display_num > 7) { $display_num = 7; }
                     $startPage = $c_pg - 3;
                     if ($startPage <= 0) $startPage = 1;
                     for ($i = 1; $i <= $display_num; $i++) {
                        if ($startPage > $total_page) { break; }
                        if ($startPage == $c_pg){
                        ?>
                           <span class="pager_current active"><?= $startPage ?></span>
                        <?php } else { ?>
                           <a href="<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $order_parameter . '&pg=' . $startPage ?>" class=""><?= $startPage ?></a>
                        <?php } ?>
                        <?php
                        $startPage++;
                     }
                  ?>
                  <?php if ($c_pg + 1 < $total_page) { ?>
                     <a href="<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $order_parameter . '&pg=' . ($c_pg + 1) ?>" class="pager_next"></a>
                  <?php } ?>
                  <?php if ($c_pg != $total_page) { ?>
                     <a href="<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $order_parameter . '&pg=' . $total_page ?>" class="pager_last"></a>
                  <?php } ?>
               </nav>
            <?php } ?>
         <?php } ?>
      </div>
      <div class="sidebar widget_area scheme_original">
         <div class="sidebar_inner widget_area_inner">
            <aside class="widget widget_property_search scheme_dark">
               <form method="get" action="property-finder/search">
                  <input type="text" name="kw" autocomplete="off" placeholder="Keyword" value="<?php echo ($ps_keyword!='') ? $ps_keyword : '' ;?>">
                  <select name="ps">
                     <option value="">Property Status</option>
                     <?php foreach($property_status as $k => $v){ ?>
                        <option value="<?php echo $v->id.'-'.$v->name ?>" <?php if($ps_status!=''){ if(explode("-",$ps_status)[0]==$v->id){ echo 'selected'; }} ?>><?php echo 'For '.$v->name ?></option>   
                     <?php } ?>
                  </select>
                  <select name="loc">
                     <option value="">Property Location</option>
                     <?php foreach($cities_data as $k => $v){ ?>
                        <option value="<?php echo $v->cities; ?>" <?php if($ps_loc!=''){ if($ps_loc==$v->cities){ echo 'selected'; }} ?>><?php echo $v->cities.' ('.$v->tot_cities.')'; ?></option>
                     <?php } ?>
                  </select>
                  <select name="pt">
                     <option value="">Property Type</option>
                     <?php foreach($property_type as $k => $v){ ?>
                        <option value="<?php echo $v->id ?>" <?php if($ps_type!=''){ if($ps_type==$v->id){ echo 'selected'; }} ?>><?php echo $v->name ?></option>   
                     <?php } ?>
                  </select>
                  <select name="rs">
                     <option value="">Rent Slot</option>
                     <option value="Yearly" <?php if($ps_rs!=''){ if($ps_rs=='Yearly'){ echo 'selected'; }} ?>>Yearly</option>
                     <option value="Monthly" <?php if($ps_rs!=''){ if($ps_rs=='Monthly'){ echo 'selected'; }} ?>>Monthly</option>
                     <option value="Weekly" <?php if($ps_rs!=''){ if($ps_rs=='Weekly'){ echo 'selected'; }} ?>>Weekly</option>
                     <option value="Daily" <?php if($ps_rs!=''){ if($ps_rs=='Daily'){ echo 'selected'; }} ?>>Daily</option>
                  </select>
                  <!-- <select name="ps_rooms">
                     <option value="">Total Rooms</option>
                     <option value="1">Rooms at least 1</option>
                     <option value="2">Rooms at least 2</option>
                     <option value="3">Rooms at least 3</option>
                     <option value="4">Rooms at least 4</option>
                     <option value="5">Rooms 5 or more</option>
                  </select> -->
                  <select name="bd">
                     <option value="">Bedrooms</option>
                     <?php for($bed=1;$bed<=5;$bed++){ ?>
                        <?php if($bed==5){ ?>
                           <option value=<?= $bed ?> <?php if($ps_bedrooms==$bed){ echo 'selected'; }?>>Bedrooms <?= $bed ?> or more</option>";
                        <?php }else{ ?>
                           <option value=<?= $bed ?> <?php if($ps_bedrooms==$bed){ echo 'selected'; }?>>Bedrooms at least <?= $bed ?></option>";
                        <?php } ?>
                     <?php } ?>
                  </select>
                  <select name="bt">
                     <option value="">Bathrooms</option>
                     <?php for($bath=1;$bath<=5;$bath++){ ?>
                        <?php if($bath==5){ ?>
                           <option value=<?= $bath ?> <?php if($ps_bathrooms==$bath){ echo 'selected'; }?>>Bathrooms <?= $bath ?> or more</option>";
                        <?php }else{ ?>
                           <option value=<?= $bath ?> <?php if($ps_bathrooms==$bath){ echo 'selected'; }?>>Bathrooms at least <?= $bath ?></option>";
                        <?php } ?>
                     <?php } ?>
                  </select>
                  <!-- <select name="ps_garages">
                     <option value="-1">Car Parking</option>
                     <option value="1">Car Parking at least 1</option>
                     <option value="2">Car Parking at least 2</option>
                     <option value="3">Car Parking at least 3</option>
                     <option value="4">Car Parking at least 4</option>
                     <option value="5">Car Parking 5 or more</option>
                  </select> -->
                  <div class="ps_area ps_range_slider">
                     <div class="ps_area_info">
                        <div class="ps_area_info_title">Area</div>
                        <div class="ps_area_info_value"></div>
                        <div class="cL"></div>
                     </div>
                     <div id="slider-range-area"></div>
                     <input type="hidden" class="ps_area_min" name="af" value="<?php echo $min_max_price_area['min_area']; ?>">
                     <input type="hidden" class="ps_area_max" name="at" value="<?php echo $ps_at; ?>">
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
                     <input type="hidden" class="ps_price_max" name="pr_t" value="<?php echo $ps_pr_t; ?>">
                     <input type="hidden" class="ps_price_big" name="" value="<?php echo $min_max_price_area['max_price']; ?>">
                  </div>
                  <!-- <div class="ps_amenities">
                     <div class="accent1h">Amenities</div>
                     <label class="estateLabelCheckBox">
                     <input  class="estateCheckBox" type="checkbox" name="ps_amenities[Attended Lobby]" value="1">Attended Lobby</label>
                     <label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Concierge]" value="1">Concierge</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Fireplace]" value="1">Fireplace</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Gym]" value="1">Gym</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Outdoor Space]" value="1">Outdoor Space</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Parking]" value="1">Parking</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Pet Friendly]" value="1">Pet Friendly</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Pool]" value="1">Pool</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Views]" value="1">Views</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_amenities[Washer / Drye]" value="1">Washer / Drye</label>
                  </div>
                  <div class="ps_options">
                     <div class="accent1h">Options</div>
                     <label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_options[New Listings Only]" value="1">New Listings Only</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_options[Open Houses]" value="1">Open Houses</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_options[Sponsor Units]" value="1">Sponsor Units</label><label class="estateLabelCheckBox"><input  class="estateCheckBox" type="checkbox" name="ps_options[Show Listings In Contract]" value="1">Show Listings In Contract</label>
                  </div> -->
                  <input type="submit" class="sc_button sc_button_box sc_button_style_style2 aligncenter ps" value="Search">
               </form>
            </aside>
         </div>
      </div>
   </div>
</div>
<script>
   function sortingproduct(val) {
        var sortingcondition = val;
        window.location.href = '<?php echo current_url() . '?' . $ps_parameter . $pt_parameter . $rs_parameter . $bd_parameter . $bt_parameter . $kw_parameter . $pr_t_parameter . $pr_f_parameter . $at_parameter . $af_parameter . $loc_parameter . '&order='; ?>' + sortingcondition;
    }
</script>
            