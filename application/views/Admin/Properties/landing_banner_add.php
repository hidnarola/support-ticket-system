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
            <li><a href="<?php echo site_url('admin/properties/landing_banner'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> Property </a></li>
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

            if (isset($banner)) {
                $action = base_url() . "admin/properties/landing_banner/edit/" . base64_encode($banner->id);
            } else {
                $action = base_url() . "admin/properties/landing_banner/add";
            }
            ?>
            <form class="form-validate-jquery" method="post" id="landing_banner_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Property -->
                                        <div class="form-group col-xs-12">
                                            <label class="col-lg-2 control-label">Property List<font color="red">*</font></label>
                                            <div class="col-lg-10">
                                                <select class="select" name="property_id" required="" id="property_id">
                                                    <option selected="" value="">Select Property</option> 
                                                    <?php
                                                    foreach ($prop_list as $row) {
                                                        if ($banner->property_id == $row['id']) {
                                                            echo "<option value='" . $row['id'] . "' selected>" . "(<b>Reference No. : </b>". $row['reference_number'] . ") - " . $row['title'] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $row['id'] . "' >" . "(<b>Reference No. : </b>". $row['reference_number'] . ") - " . $row['title'] . "</option>"; //                                                
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php echo '<label id="property_id-error" class="validation-error-label" for="property_id">' . form_error('property_id') . '</label>'; ?>
                                            </div>
                                        </div>

                                        <!-- Image -->
                                        <div class="form-group col-xs-12">
                                            <label class="col-lg-2 control-label">Image <span class="text-danger">*</span></label>
                                            <div class="col-lg-10">
                                                <div class="media no-margin-top">
                                                    <?php
                                                        $image = '';
                                                        $image_req = 'required="required"';
                                                        if (isset($banner)) {
                                                            if ($banner->image!= '') {
                                                                $image = $banner->image;
                                                                $image_req = '';
                                                            ?>
                                                            <div class="media-left">
                                                                <a href="javascript:void(0);"><img src="<?php echo PROPERTY_BANNER .'/'. $image; ?>" style="width: 58px; height: 58px;" class="img-rounded" alt=""></a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <div class="media-body">
                                                        <input type="file" class="file-styled-primary" name="txt_image" id="txt_image" <?php echo $image_req; ?>>
                                                        <input type="hidden" name="hidden_image" id="hidden_image" value="<?php echo $image; ?>">
                                                        <code>Accepted formats: gif, png, jpg.</code>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Position -->
                                        <div class="form-group col-xs-12" id="div_position">
                                            <label class="col-lg-2">Position<font color="red">*</font></label>                                  
                                            <div class="col-lg-10">
                                                <input type="number" name="position" class="form-control" placeholder="position" required="required" min="0" value="<?php
                                                if (isset($banner)) {
                                                    echo trim($banner->position);
                                                } else {
                                                    if ($this->input->post('position')) {
                                                        echo $this->input->post('position');
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                ?>">
                                                <?php echo '<label id="position-error" class="validation-error-label" for="position">' . form_error('price') . '</label>'; ?>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group col-xs-12">
                                            <label class="col-lg-2">Status </label>
                                            <div class="col-lg-10">
                                                <div class="checkbox checkbox-switch">
                                                    <label>
                                                        <input type="checkbox" name="status" id="status" data-on-text="Active" data-off-text="Inactive" class="switch" <?php
                                                        if (isset($banner)) {
                                                            if ($banner->status == 'Active') {
                                                                echo 'checked';
                                                            }
                                                        }else{
                                                            echo 'checked';
                                                        }
                                                        ?>>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
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
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 23.4241, lng: 53.8478},
          zoom: 5
        });
        
        if(prop_lat!='' && prop_lng!=''){
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: parseFloat(prop_lat), lng: parseFloat(prop_lng)},
              zoom: 13
            });
        }

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
                // if(place.address_components[i].types[0] == 'postal_code'){
                //     document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                // }
                // if(place.address_components[i].types[0] == 'country'){
                //     document.getElementById('country').innerHTML = place.address_components[i].long_name;
                // }
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
</script>
