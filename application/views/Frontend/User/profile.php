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


                        <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>Your Details</div>
                        <div class="acc_content clearfix">
                            <form id="profile-form" name="profile-form" class="nobottommargin" action="profile" method="post" enctype="multipart/form-data">
                                <div class="col_full">
                                    <label for="fname">First Name:</label>
                                    <input type="text" id="fname" name="fname" class="form-control" value="<?php
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
                                <div class="col_full">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" id="lname" name="lname" class="form-control" value="<?php
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

                                <div class="col_full">
                                    <label for="email">Email Address:</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php
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

                                <div class="col_full">
                                    <label for="phone">Contact Number:</label>
                                    <input type="text" id="contactno" name="contactno" class="form-control" value="<?php
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
                                                <input type="file" name="profile_pic" id="profile_pic" onchange="readURL(this);">
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

                                <!--</div>-->
                                <div class="col_full nobottommargin text-right">
                                    <button type="submit" class="button button-3d button-black nomargin blue-button" id="submit" name="save" value="save">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <div class="line visible-xs-block"></div>

            <?php $this->load->view('frontend/User/rightsidebar'); ?>

        </div>

    </div>

</div>

<!--</section>-->
<script type="text/javascript">
    $(document).on('ready', function () {

    });
</script>
<script>
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
</script>