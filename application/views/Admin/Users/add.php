<div class="row">
    <div class="col-md-12">
        <?php
        $segment = $this->uri->segment(4);
        $edit_segment = $this->uri->segment(3);

        if (isset($user)) {
            if ($edit_segment == 'edit' && $segment == 'tenant') {
                $action = base_url() . "admin/users/edit/tenatnt/" . base64_encode($user->id);
            } else {
                $action = base_url() . "admin/users/edit/staff/" . base64_encode($user->id);
            }
        } else {
            if ($segment == 'tenant' && $edit_segment == 'add') {
                $action = base_url() . "admin/users/add/tenant";
            } else {
                $action = base_url() . "admin/users/add/staff";
            }
        }
        ?>
        <form class="form-horizontal form-validate" method="post" id="user_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <?php
                            if ($segment == 'tenant') {
                                ?>
                                <h5 class="panel-title"><?php echo (isset($user)) ? 'Edit Tenant' : 'Add Tenant' ?></h5>
                            <?php } else { ?>
                                <h5 class="panel-title"><?php echo (isset($user)) ? 'Edit Staff' : 'Add Staff' ?></h5>
                            <?php } ?>
<!--                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>-->
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">First Name:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="fname" class="form-control" placeholder="First Name" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->fname);
                                    } else {
                                        if ($this->input->post('fname')) {
                                            echo $this->input->post('fname');
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>">
                                           <?php echo '<label id="fname-error" class="validation-error-label" for="fname">' . form_error('fname') . '</label>'; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Last Name:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->lname);
                                    } else {
                                        if ($this->input->post('lname')) {
                                            echo $this->input->post('lname');
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>">
                                           <?php echo '<label id="lname-error" class="validation-error-label" for="lname">' . form_error('lname') . '</label>'; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Email:</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->email);
                                    } else {
                                        if ($this->input->post('email')) {
                                            echo $this->input->post('email');
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>">
                                           <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Contact Number:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="contactno" class="form-control" placeholder="Contact Number" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->contactno);
                                    } else {
                                        if ($this->input->post('contactno')) {
                                            echo $this->input->post('contactno');
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?>">
                                </div>
                            </div>                            

                            <div class="form-group user_profile_pic">
                                <label class="col-lg-3 control-label">User Profile:</label>
                                <div class="col-lg-9">
                                    <input type="file" name="profile_pic" class="file-styled" onchange="readURL(this)">
                                    <!--<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>-->
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <div id="imgpreview" style="margin-top: 10px;">
                                        <?php
                                        if (isset($user)) {
                                            if (trim($user->profile_pic) != '')
                                                echo "<img src='" . base_url() . USER_PROFILE_IMAGE . '/' . $user->profile_pic . "' height='73px' width='73px'>"; //                                               
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Address:</label>
                                <div class="col-lg-9">
                                    <textarea rows="5" cols="5" name="address" class="form-control" required="required" placeholder="Address" aria-required="true" aria-invalid="true"><?php
                                        if (isset($user)) {
                                            echo trim($user->address);
                                        } else {
                                            if ($this->input->post('address')) {
                                                echo $this->input->post('address');
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?></textarea>
                                    <?php echo '<label id="address-error" class="validation-error-label" for="address">' . form_error('address') . '</label>'; ?>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn bg-teal">Save <?php echo $segment; ?>  <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var html = '<img src="' + e.target.result + '" height="73px" width="73px" alternate="Image" />';
                $('#imgpreview').html(html);
//            $('#imgpreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
