<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>

            <li><a href="<?php echo site_url('admin/beacons'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i>Beacons</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <?php $this->load->view('admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            if (isset($beacon)) {
                $action = base_url() . "admin/beacons/edit/" . base64_encode($beacon->id);
            } else {
                $action = base_url() . "admin/beacons/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="user_add" enctype="multipart/form-data" action="<?php echo $action; ?>"  novalidate="novalidate">            
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-xs-12">
                                    <label>Beacon Name<font color="red">*</font></label>
                                    <input type="text" name="beacon_name" class="form-control" placeholder="Beacon Name" required="required" value="<?php
                                    if (isset($beacon)) {
                                        echo trim($beacon->beacon_name);
                                    } else {
                                        echo set_value('beacon_name');
                                    }
                                    ?>">
                                           <?php echo '<label id="beacon_name-error" class="validation-error-label" for="beacon_name">' . form_error('beacon_name') . '</label>'; ?>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Major<font color="red">*</font></label>                                    
                                    <input type="text" class="form-control" placeholder="Major" name="major" required="required" value="<?php
                                    if (isset($beacon)) {
                                        echo trim($beacon->major);
                                    } else {
                                        echo set_value('major');
                                    }
                                    ?>">
                                           <?php echo '<label id="major-error" class="validation-error-label" for="major">' . form_error('major') . '</label>'; ?>
                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Text</label>                               
                                    <textarea rows="5" cols="5" name="text" class="form-control" placeholder="Address" aria-required="true" aria-invalid="true"><?php
                                        if (isset($beacon)) {
                                            echo trim($beacon->text);
                                        } else {
                                            echo set_value('text');
                                        }
                                        ?></textarea>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Push Notification<font color="red">*</font></label>                               
                                    <textarea rows="5" cols="5" name="push_notification_text" class="form-control" placeholder="Address" aria-required="true" aria-invalid="true"><?php
                                        if (isset($beacon)) {
                                            echo trim($beacon->push_notification_text);
                                        } else {
                                            echo set_value('push_notification_text');
                                        }
                                        ?></textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-xs-12">
                                    <label>UUID<font color="red">*</font></label>
                                    <input type="text" name="uuid" class="form-control" placeholder="UUID" required="required" value="<?php
                                    if (isset($beacon)) {
                                        echo trim($beacon->uuid);
                                    } else {
                                        echo set_value('uuid');
                                    }
                                    ?>">
                                           <?php echo '<label id="uuid-error" class="validation-error-label" for="uuid">' . form_error('uuid') . '</label>'; ?>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Minor<font color="red">*</font></label>
                                    <input type="text" name="minor" class="form-control" placeholder="Minor" required="required" value="<?php
                                    if (isset($beacon)) {
                                        echo trim($beacon->minor);
                                    } else {
                                        echo set_value('minor');
                                    }
                                    ?>"> 
                                           <?php echo '<label id="minor-error" class="validation-error-label" for="minor">' . form_error('minor') . '</label>'; ?>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Details</label>                               
                                    <textarea rows="5" cols="5" name="details" class="form-control" required="required" placeholder="Details" aria-required="true" aria-invalid="true"><?php
                                        if (isset($beacon)) {
                                            echo trim($beacon->details);
                                        } else {
                                            echo set_value('details');
                                        }
                                        ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">                                
                                    <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                    <button type="submit" name="save" class="btn bg-teal">Save<i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<div id="validation_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <div class="modal-body panel-body validation_alert">
                <label></label>
            </div>
        </div>
    </div>
</div>
<script>
    var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    $(".validation_alert label").text("Sorry, invalid file, allowed extensions are: " + _validFileExtensions.join(", "));
                    $("#validation_modal").modal();
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
    function readURL(input) {

        if (input.files && input.files[0]) {
            var arr = ['image/png', 'image/jpeg', 'image/gif'];
            if ($.inArray(input.files[0].type, arr) != -1) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = '<img src="' + e.target.result + '" height="73px" width="73px" alternate="Image" />';
                    $('#imgpreview').html(html);
                };
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            if (typeof input == 'string') {
                var html = '<img src="' + input + '" height="73px" width="73px" alternate="Image" />';
                $('#imgpreview').html(html);
            }
        }
    }
</script>
