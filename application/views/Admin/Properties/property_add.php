<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/form_tags_input.js"></script>     

<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/properties/property'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> Property </a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
         <?php $this->load->view('Admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);

            if (isset($property)) {
                $action = base_url() . "admin/properties/property/edit/" . base64_encode($property->id);
            } else {
                $action = base_url() . "admin/properties/property/add";
            }
            ?>
            <form class="form-validate-jquery" method="post" id="property_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <legend class="text-bold">Basic Details</legend>
                                <div class="row">
                                    <div class="col-md-6">

                                        <!-- Title -->
                                        <div class="form-group col-xs-12">
                                            <label>Title<font color="red">*</font></label>
                                            <input type="text" name="title" class="form-control" placeholder="Title" required="required" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->title);
                                            } else {
                                                if ($this->input->post('title')) {
                                                    echo $this->input->post('title');
                                                } else {    
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                        </div>

                                        <!-- Property Type -->
                                        <div class="form-group col-xs-12">
                                            <label>Category Type<font color="red">*</font></label>                                                                      
                                            <select class="select" name="property_type_id" required="" id="property_type_id">
                                                <option selected="" value="">Select Category Type</option> 
                                                <?php
                                                foreach ($property_types as $row) {
                                                    if ($property->property_type_id == $row['id']) {
                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="property_type_id-error" class="validation-error-label" for="property_type_id">' . form_error('property_type_id') . '</label>'; ?>
                                        </div>

                                        <!-- Area -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Area<font color="red">*</font></label>                                  
                                            <input type="number" name="area" class="form-control" placeholder="Area in sq.ft" required="required" min="0" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->area);
                                            } else {
                                                if ($this->input->post('area')) {
                                                    echo $this->input->post('area');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="area-error" class="validation-error-label" for="area">' . form_error('area') . '</label>'; ?>
                                        </div>

                                        <!-- Bedrooms -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>No. of Bedrooms<font color="red">*</font></label>                                  
                                            <input type="number" name="bedrooms_no" class="form-control" placeholder="No. of Bedroom" required="required" min="0" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->bedroom_no);
                                            } else {
                                                if ($this->input->post('bedrooms_no')) {
                                                    echo $this->input->post('bedrooms_no');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="bedrooms_no-error" class="validation-error-label" for="bedrooms_no">' . form_error('bedrooms_no') . '</label>'; ?>
                                        </div>

                                        <!-- Bathrooms -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>No. of Bathroom<font color="red">*</font></label>                                  
                                            <input type="number" name="bathrooms_no" class="form-control" placeholder="No. of Bathroom" required="required" min="0" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->bathroom_no);
                                            } else {
                                                if ($this->input->post('bathrooms_no')) {
                                                    echo $this->input->post('bathrooms_no');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="bathrooms_no-error" class="validation-error-label" for="bathrooms_no">' . form_error('bathrooms_no') . '</label>'; ?>
                                        </div>

                                        <!-- Featured -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Featured </label>
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" name="featured" id="featured" data-on-text="Yes" data-off-text="No" class="switch" <?php
                                                    if (isset($property)) {
                                                        if ($property->is_featured == '1') {
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Status </label>
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" name="status" id="status" data-on-text="Active" data-off-text="Inactive" class="switch" <?php
                                                    if (isset($property)) {
                                                        if ($property->status == 'Active') {
                                                            echo 'checked';
                                                        }
                                                    }else{
                                                        echo 'checked';
                                                    }
                                                    ?>>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Availability -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Availability </label>
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" name="availability" id="availability" data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" class="switch" <?php
                                                    if (isset($property)) {
                                                        if ($property->availability == '1') {
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <!-- Category -->
                                        <div class="form-group col-xs-12">
                                            <label>Contract Type<font color="red">*</font></label>                                  
                                            <select class="select" name="category_id" required="" id="category_id">
                                                <option selected="" value="">Select Contract</option> 
                                                <?php
                                                foreach ($property_categories as $row) {
                                                    if ($property->property_category_id == $row['id']) {
                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="category_id-error" class="validation-error-label" for="category_id">' . form_error('category_id') . '</label>'; ?>
                                        </div>
                                        
                                        <!-- Price -->
                                        <div class="form-group col-xs-12 <?php if(isset($property)){ if($property->property_category_id=='4'){ echo 'col-md-6'; }} ?>" id="div_price">
                                            <label>Price<font color="red">*</font></label>                                  
                                            <input type="number" name="price" class="form-control" placeholder="Price" required="required" min="0" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->price);
                                            } else {
                                                if ($this->input->post('price')) {
                                                    echo $this->input->post('price');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="price-error" class="validation-error-label" for="price">' . form_error('price') . '</label>'; ?>
                                        </div>

                                        <!-- Rent Slot-->
                                        <div class="form-group col-xs-12 col-md-6" id="div_rent_type" style="<?php if(isset($property)){ if($property->property_category_id=='4'){ echo 'display:block'; }else{ echo 'display:none'; }}else{ echo 'display:none'; } ?>">
                                            <div>
                                                <label>Rent Type<font color="red">*</font></label>                                                                      
                                                <select class="select" name="rent_type" id="rent_type">
                                                    <option selected="" value="">Select Rent Type</option> 
                                                    <option value="Yearly" <?php if(isset($property)){ if($property->rent_type=='Yearly'){ echo 'selected'; }} ?> >Yearly</option>
                                                    <option value="Monthly" <?php if(isset($property)){ if($property->rent_type=='Monthly'){ echo 'selected'; }}?> >Monthly</option>
                                                    <option value="Weekly" <?php if(isset($property)){ if($property->rent_type=='Weekly'){ echo 'selected'; }} ?> >Weekly</option>
                                                    <option value="Daily" <?php if(isset($property)){ if($property->rent_type=='Daily'){ echo 'selected'; }} ?> >Daily</option>
                                                </select>
                                                <?php echo '<label id="rent_type-error" class="validation-error-label" for="rent_type">' . form_error('rent_type') . '</label>'; ?>
                                            </div>
                                        </div>

                                        <!-- Contact Name -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Contact Name<font color="red">*</font></label>                                  
                                            <input type="text" name="contact_name" class="form-control" placeholder="Contact Name" required="required" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->contact_name);
                                            } else {
                                                if ($this->input->post('contact_name')) {
                                                    echo $this->input->post('contact_name');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="contact_name-error" class="validation-error-label" for="contact_name">' . form_error('contact_name') . '</label>'; ?>
                                        </div>

                                        <!-- Contact No -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Contact No.<font color="red">*</font></label>                                  
                                            <input type="number" name="contact_no" class="form-control" placeholder="Contact No." required="required" min="0" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->contact_no);
                                            } else {
                                                if ($this->input->post('contact_no')) {
                                                    echo $this->input->post('contact_no');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="contact_no-error" class="validation-error-label" for="contact_no">' . form_error('contact_no') . '</label>'; ?>
                                        </div>

                                        <!-- Contact Email -->
                                        <div class="form-group col-xs-12 col-md-4">
                                            <label>Contact Email<font color="red">*</font></label>                                  
                                            <input type="email" name="contact_email" class="form-control" placeholder="Contact Email" required="required" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->contact_email);
                                            } else {
                                                if ($this->input->post('contact_email')) {
                                                    echo $this->input->post('contact_email');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="contact_email-error" class="validation-error-label" for="contact_email">' . form_error('contact_email') . '</label>'; ?>
                                        </div>

                                        <!-- Amenities -->
                                        <div class="form-group col-xs-12">
                                            <label>Amenities<font color="red">*</font></label>
                                            <input type="text" class="form-control tokenfield-primary" name="amenities" required="required" value="<?php
                                            if (isset($property)) {
                                                echo trim($property->amenities);
                                            } else {
                                                if ($this->input->post('amenities')) {
                                                    echo $this->input->post('amenities');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>">
                                            <?php echo '<label id="amenities-error" class="validation-error-label" for="amenities">' . form_error('amenities') . '</label>'; ?>
                                        </div>
                                    </div>
                                </div>
                                <legend class="text-bold">Offer Section</legend>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Offer </label>
                                        <div class="checkbox checkbox-switch" style="margin-top:2px !important">
                                            <label>
                                                <input type="checkbox" name="is_offer" id="is_offer" data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" class="switch"
                                                <?php
                                                    if (isset($property)) {
                                                        if ($property->is_offer == '1') {
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="div_offer <?php if(isset($property)){ if($property->is_offer == '0'){ echo 'hide'; }}else{ echo 'hide'; } ?>" >
                                        <div class="form-group col-md-4">
                                            <label>Offer Date</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control daterange-increments" 
                                                value="
                                                <?php 
                                                    if(isset($property)){ 
                                                        if($property->deal_date_from!='' && $property->deal_date_to!=''){ 
                                                            echo date('m/d/Y g:i A',strtotime($property->deal_date_from)).' - '.date('m/d/Y g:i A',strtotime($property->deal_date_to)); 
                                                        }
                                                    }else{ 
                                                        echo date('m/d/Y g:i A').' - '.date('m/d/Y g:i A'); 
                                                    } 
                                                ?>" name="offer_date">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Discount Type </label>
                                            <div class="checkbox checkbox-switch" style="margin-top:2px !important">
                                                <label>
                                                    <input type="checkbox" name="discount_type" id="discount_type" data-off-color="default" data-on-color="primary" data-on-text="Flat" data-off-text="Percentage" class="switch"
                                                    <?php
                                                        if (isset($property)) {
                                                            if ($property->discount_type == 'Flat') {
                                                                echo 'checked';
                                                            }
                                                        }
                                                    ?>>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Display Value</label>                                  
                                            <input type="number" name="discount_value" class="form-control" placeholder="Discount value" min="0" value="<?php if(isset($property)){ echo $property->discount_value; }else{ echo '0'; } ?>">
                                        </div>
                                    </div>
                                </div>

                                <legend class="text-bold">Description Section</legend>
                                <div class="row">
                                    <!-- Description -->
                                    <div class="form-group col-xs-12">
                                        <label>Short Description<font color="red">*</font></label>
                                        <textarea rows="3" cols="5" name="short_description" class="form-control" required="required" placeholder="Description Here" aria-required="true" aria-invalid="true"><?php
                                            if (isset($property)) {
                                                echo trim($property->short_description);
                                            } else {
                                                if ($this->input->post('short_description')) {
                                                    echo $this->input->post('short_description');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?></textarea>
                                        <?php echo '<label id="short_description-error" class="validation-error-label" for="short_description">' . form_error('short_description') . '</label>'; ?>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <label>Description<font color="red">*</font></label>
                                        <textarea name="description" id="description" rows="2" cols="4">
                                            <?php echo isset($property->description) ? $property->description : set_value('description'); ?>
                                        </textarea>
                                        <?php echo '<label id="description-error" class="validation-error-label" for="description">' . form_error('description') . '</label>'; ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <legend class="text-bold">Image Section</legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Main Image <span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="media no-margin-top">
                                                <?php
                                                $main_image = '';
                                                $image_req = 'required="required"';
                                                if (isset($property)) {
                                                    if ($property->images!= '') {
                                                        $imgArr = explode(",", $property->images);
                                                        $main_image = $imgArr[0];
                                                        $image_req = '';
                                                        ?>
                                                        <div class="media-left">
                                                            <a href="javascript:void(0);"><img src="<?php echo PROPERTY_IMAGE .'/'. $main_image; ?>" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <input type="file" class="file-styled-primary" name="txt_main_image" id="txt_main_image" <?php echo $image_req; ?>>
                                                    <input type="hidden" name="hidden_main_image" id="hidden_main_image" value="<?php echo $main_image; ?>">
                                                    <span class="help-block">Accepted formats: gif, png, jpg.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Other Images </label>
                                        <div class="col-lg-10">
                                            <input type="file" class="file-input" name="txt_other_images[]" id="txt_other_images" multiple="multiple">
                                            <span class="help-block"><code>You can upload here multiple images at a time</code>.</span>
                                            <?php
                                            if (isset($property)) {
                                                if ($property->images != '') {
                                                    $imgArr = explode(",", $property->images);
                                                    if (count($imgArr) > 1) {
                                                        $cnt = 0;
                                                        ?>
                                                        <div class="row">
                                                            <?php
                                                            foreach ($imgArr as $other_img) {
                                                                if ($cnt == 0) {
                                                                    $cnt++;
                                                                } else {
                                                                    ?>
                                                                    <div class="col-lg-2 col-sm-6 div_other_img">
                                                                        <div class="thumbnail">
                                                                            <div class="thumb">
                                                                                <img src="<?php echo PROPERTY_IMAGE .'/'. $other_img; ?>" alt="" style="height:120px;width:150px">
                                                                                <input type="hidden" class="hidden_other_img" name="hidden_other_image[]" id="hidden_other_image<?php echo $cnt; ?>" value="<?php echo $other_img; ?>">
                                                                                <div class="caption-overflow">
                                                                                    <span>
                                                                                            <!-- <a href="assets/images/placeholder.jpg" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a> -->
                                                                                        <a href="javascript:void(0);" class="btn btn-danger btn-xs remove_other_img" style="top-margin:5px !important">REMOVE</a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <legend class="text-bold">Map Section</legend>
                                    <div class="form-group">
                                        <input id="searchInput" name="address" required="required" class="controls" type="text" placeholder="Enter a location">
                                        <div id="map"></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="lat" id="lat" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="lng" id="lng" class="form-control" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="hidden" name="locality" id="locality" class="form-control" value="<?php if(isset($property)){ echo $property->locality; }?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="hidden" name="country" id="country" class="form-control" value="<?php if(isset($property)){ echo $property->country; }?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn bg-teal">Save<i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="padding:5px !important;padding-bottom:5px !important">
                <iframe width="100%" height="500px" src="<?php echo str_replace("watch?v=", "v/", " https://www.youtube.com/watch?v=Ll9l0xKkfgc") ?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    $('.remove_other_img').click(function () {
        $(this).parents('.div_other_img').remove();
        //$(this).siblings('.hidden_other_img').val('');
    });
    $(".switch").bootstrapSwitch();
    $('#category_id').change(function(){
        //alert($(this).val());
        if($("#category_id option:selected").text().toLowerCase()=='rent'){
            $('#div_rent_type').css('display','block');
            $('#rent_type').attr('required','required');
            $('#div_price').addClass('col-md-6');
        }else{
            $('#div_rent_type').css('display','none');
            $('#rent_type').removeAttr('required');
            $('#div_price').removeClass('col-md-6');
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgj2beNtgW-haTFepc14aXAce7psjNIYk&libraries=places&callback=initMap" async defer></script>
<script>
    function initMap() {
        var prop_lat = '<?php if(isset($property)){ echo $property->latitude; } ?>';
        var prop_lng = '<?php if(isset($property)){ echo $property->longitude; } ?>';
        var prop_address = '<?php if(isset($property)){ echo $property->address; } ?>';
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
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 23.4241, lng: 53.8478},
            zoom: 5,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
            }
        });
        
        if(prop_lat!='' && prop_lng!=''){
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)},
                zoom: 13,
                mapTypeControlOptions: {
                    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'tehgrayz']
                 }
            });
        }
        var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
        map.mapTypes.set('tehgrayz', mapType);
        map.setMapTypeId('tehgrayz');
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });

        if(prop_lat!='' && prop_lng!=''){
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true,
                position : {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)}
            });
            $('#searchInput').val(prop_address);
            $('#lat').val(prop_lat);
            $('#lng').val(prop_lng);

        }

        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
          
            //Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'locality'){
                    $('#locality').val(place.address_components[i].long_name);
                }
                // if(place.address_components[i].types[0] == 'postal_code'){
                //     document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                // }
                if(place.address_components[i].types[0] == 'country'){
                    $('#country').val(place.address_components[i].long_name);
                }
            }
            //document.getElementById('location').innerHTML = place.formatted_address;
            $('#lat').val(place.geometry.location.lat());
            $('#lng').val(place.geometry.location.lng());
        });
    }

    function handleEvent(event) {
        $('#lat').val(event.latLng.lat());
        $('#lng').val(event.latLng.lng());
    }
</script>
<script type="text/javascript">
    
    CKEDITOR.replace('description', {
        height: '250px'
    });
    $('document').ready(function () {
        $("#property_add").validate({
            rules: {
                description: {
                    required: true,
                }
            }
        });
    });
    
    $('#is_offer').on('switchChange.bootstrapSwitch', function (event, state) {
        if($("#is_offer").is(':checked')) {
            //$('#myModal').modal('show');
            $('.div_offer').removeClass('hide');
        } else {
            $('.div_offer').addClass('hide');
        }
    });
</script>
<style>
    #map {
        width: 100%;
        height: 400px;
    }
    .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 50%;
    }
    #searchInput:focus {
        border-color: #4d90fe;
    }
    #searchInput-error{
        margin-left: 12%;
        margin-top: 4.5%;
    }
</style>
