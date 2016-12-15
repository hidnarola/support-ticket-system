<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<!--<section id="content">-->

<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">
                <?php
                if (isset($user)) {
                    if (trim($user['profile_pic']) != '') {
                        ?>  
                        <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $user['profile_pic'] ?>" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" style="max-width: 84px;">
                        <?php
                    } else {
                        ?>
                        <img src="assets/frontend/images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail notopmargin nobottommargin" alt="Avatar" style="max-width: 84px;">
                        <?php
                    }
                }
                ?>
                <div class="heading-block noborder">
                    <h3><?php
                        if ($this->session->userdata('user_logged_in')) {
                            echo $this->session->userdata('user_logged_in')['fname'] . " " . $this->session->userdata('user_logged_in')['lname'];
                        }
                        ?></h3>
                    <span>Your Profile Bio</span>
                </div>

                <div class="clear"></div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <?php
                        if ($this->session->flashdata('success_msg')) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('success_msg'); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if ($this->session->flashdata('error_msg')) {
                            ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('error_msg'); ?>
                            </div>
                            <?php
                        }
                        ?>

                        <!--<div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>Your Details</div>-->
                        <div class="acc_content clearfix">
                            <form id="profile-form" name="profile-form" class="nobottommargin" action="profile" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col_full">
                                            <label for="fname">First Name:</label>
                                            <input type="text" id="fname" name="fname" required="" class="form-control" value="<?php
                                            if (isset($user)) {
                                                echo trim($user['fname']);
                                            } else {
                                                if ($this->input->post('fname')) {
                                                    echo $this->input->post('fname');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>"/>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="col_full">
                                            <label for="lname">Last Name:</label>
                                            <input type="text" id="lname" name="lname" required="" class="form-control" value="<?php
                                            if (isset($user)) {
                                                echo trim($user['lname']);
                                            } else {
                                                if ($this->input->post('lname')) {
                                                    echo $this->input->post('lname');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col_full">
                                            <label for="email">Email Address:</label>
                                            <input type="text" id="email" name="email" required="" class="form-control" value="<?php
                                            if (isset($user)) {
                                                echo trim($user['email']);
                                            } else {
                                                if ($this->input->post('email')) {
                                                    echo $this->input->post('email');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="col_full">
                                            <label for="phone">Contact Number:</label>
                                            <input type="text" id="contactno" name="contactno" required="" class="form-control" value="<?php
                                            if (isset($user)) {
                                                echo trim($user['contactno']);
                                            } else {
                                                if ($this->input->post('contactno')) {
                                                    echo $this->input->post('contactno');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col_full">
                                            <label for="address">Address:</label>
                                            <textarea rows="5" cols="5" name="address" class="form-control" required="required" placeholder="Address" aria-required="true" aria-invalid="true"><?php
                                                if (isset($user)) {
                                                    echo trim($user['address']);
                                                } else {
                                                    if ($this->input->post('address')) {
                                                        echo $this->input->post('address');
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col_full">
                                    <label>Profile Picture:</label>
                                    <!--<input name="profile_pic" id="profile_pic" type="file" accept="image/*" class="file-loading" data-allowed-file-extensions='[]'>-->

                                    <style>.btn-file {cursor: pointer;margin-top: 5px;overflow: hidden;position: relative; text-transform: uppercase;}
                                        .btn-file input[type=file] {background: white;cursor: inherit;display: block;font-size: 100px;  min-height: 100%; min-width: 100%;opacity: 0;outline: medium none;position: absolute;right: 0; text-align: right;top: -16px; z-index: 99;}
                                    </style>
                                    <!--<input type="file" id="profile_pic" name="profile_pic" class="form-control" onchange="readURL(this)">-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-file">
                                                <input type="file" name="profile_pic" id="profile_pic" onchange="ValidateSingleInput(this);readURL(this);">
                                                <span class="custom-file-control"></span>
                                                <button type="submit" class="button button-light nomargin" id="submit" name="save" value="save">Upload</button>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="file-drop-disabled" id="imgpreview">
                                                <?php
                                                if (isset($user)) {
                                                    if (trim($user['profile_pic']) != '') {
                                                        ?>  
                                                        <div class="file-preview-thumbnails">
                                                            <div class="file-preview-frame"  data-fileindex="0">
                                                                <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $user['profile_pic'] ?>" class="file-preview-image" style="width:auto;height:160px;">
                                                                <div class="file-thumbnail-footer">
                                                                    <!--<div class="file-footer-caption" title="person4.jpg">person4.jpg</div>-->

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col_full">
                                    <div class="col-md-5" style="margin-top: 5px;">
                                <?php if($user['contract'] != ''){ ?>
                                    <div class="row">
                                        <a class="button button-light nomargin" href="<?php echo USER_CONTRACT.'/'.$user['contract']; ?>" target="_blank">View Contract</a>
                                    </div>
                                    <?php 
                                        if(!empty($previous_contracts)){ ?>
                                        <div style="margin-top: 5px;" class="row">
                                            <a class="button button-light nomargin" href="#" data-toggle="modal" data-target="#contract_modal">View Previous Contracts</a>
                                        </div>
                                        <div id="contract_modal" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-teal-400">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h6 class="modal-title">Previously Added Contracts</h6>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                    <?php foreach ($previous_contracts as $contract) { ?>
                                                    <div class="row" style="margin-top: 5px;">
                                                        <a class="button button-light nomargin" target="_blank" href="<?php echo USER_CONTRACT.'/'.$contract['contract']; ?>"><?php echo $contract['contract']; ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
                                    
                                    ?>
    
                                    <?php }else{ ?>
                                        <label>Contract:</label>
                                    <?php } ?>
                                    <!--<input name="profile_pic" id="profile_pic" type="file" accept="image/*" class="file-loading" data-allowed-file-extensions='[]'>-->

                                    <style>.btn-file {cursor: pointer;margin-top: 5px;overflow: hidden;position: relative; text-transform: uppercase;}
                                        .btn-file input[type=file] {background: white;cursor: inherit;display: block;font-size: 100px;  min-height: 100%; min-width: 100%;opacity: 0;outline: medium none;position: absolute;right: 0; text-align: right;top: -16px; z-index: 99;}
                                    </style></div>
                                    <!--<input type="file" id="profile_pic" name="profile_pic" class="form-control" onchange="readURL(this)">-->
                                        <div class="col-md-7">
                                            <div class="btn-file">
                                                <input type="file" name="contract" id="contract" onchange="ValidateSingleInput(this,2)">
                                                <span class="custom-file-control"></span>
                                                <button type="submit" class="button button-light nomargin" id="submit" name="save" value="save">Upload<?php echo ($user['contract'] != '') ? ' New' : ''; ?></button>
                                        <span class="help-block">Accepted formats: gif, png, jpg, pdf. Max file size 2Mb</span>
                                            </div>
                                        </div>

                                </div>


                                <!--</div>-->
                                <div class="col_full nobottommargin text-right">
                                    <button type="submit" class="button button-3d button-small button-rounded nomargin blue-button" id="submit" name="save" value="save">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <div class="line visible-xs-block"></div>
            <?php $this->load->view('Frontend/User/rightsidebar'); ?>
        </div>
    </div>
</div>
<div id="validation_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <div class="modal-body validation_alert">
                    <label></label>
                </div>
        </div>
    </div>
</div>
<!--</section>-->
<script>
var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];    
var _validFileExtensionsContract = [".jpg", ".jpeg", ".gif", ".png", ".pdf"];    
function ValidateSingleInput(oInput,type=1) {
   var exts = '';
    if(type==1){
        exts = _validFileExtensions;
    }else{
        exts = _validFileExtensionsContract;
    }
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < exts.length; j++) {

                var sCurExtension = exts[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {

                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
               
                $(".validation_alert label").text("Sorry, invalid file, allowed extensions are: " + exts.join(", "));
            
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
            var reader = new FileReader();

            reader.onload = function (e) {
                var html = '';
                html += '<div class="file-preview-thumbnails"><div class="file-preview-frame"  data-fileindex="0">';
                html += '<img src="' + e.target.result + '" style="height: 160px; width: auto;" alternate="Image" />';
                html += '</div></div>';
                $('#imgpreview').html(html);
                //            $('#imgpreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-form").validate();
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000);
</script>