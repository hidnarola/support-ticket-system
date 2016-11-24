<?php
            $segment = $this->uri->segment(4); 
$seg = ($segment=='tenant') ? 'tenants' : 'staff';
            ?>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/'.$seg); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> <?php echo $page; ?></a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">

    <div class="row">
         <?php $this->load->view('admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            // $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);

            if (isset($user)) {
                if ($edit_segment == 'edit' && $segment == 'tenant') {
                    $action = base_url() . "admin/users/edit/tenant/" . base64_encode($user->uid);
                } else {
                    $action = base_url() . "admin/users/edit/staff/" . base64_encode($user->uid);
                }
            } else {
                if ($segment == 'tenant' && $edit_segment == 'add') {
                    $action = base_url() . "admin/users/add/tenant";
                } else {
                    $action = base_url() . "admin/users/add/staff";
                }
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="user_add" enctype="multipart/form-data" action="<?php echo $action; ?>"  novalidate="novalidate">            

                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-xs-12">
                                    <label>First Name:</label>

                                    <input type="text" name="fname" class="form-control" placeholder="First Name" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->fname);
                                    } else {

                                      echo set_value('fname');
                                    }
                                    ?>">
                                           <?php echo '<label id="fname-error" class="validation-error-label" for="fname">' . form_error('fname') . '</label>'; ?>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Last Name:</label>

                                    <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->lname);
                                    } else {
//                                        if ($this->input->post('lname')) {
//                                            echo $this->input->post('lname');
//                                        } else {
//                                            echo '';
//                                        }
                                        echo set_value('lname');
                                    }
                                    ?>">
                                           <?php echo '<label id="lname-error" class="validation-error-label" for="lname">' . form_error('lname') . '</label>'; ?>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Email:</label>                                    
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->email);
                                    } else {
                                        echo set_value('email');
                                    }
                                    ?>">
                                           <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label>Contact Number:</label>
                                    <input type="text" name="contactno" class="form-control" placeholder="Contact Number" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->contactno);
                                    } else {
//                                        if ($this->input->post('contactno')) {
//                                            echo $this->input->post('contactno');
//                                        } else {
//                                            echo '';
//                                        }
                                        echo set_value('contactno');
                                    }
                                    ?>"> 
                                           <?php echo '<label id="contactno-error" class="validation-error-label" for="contactno">' . form_error('contactno') . '</label>'; ?>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <?php if ($segment == 'staff') { ?>
                                    <div class="form-group col-xs-12">
                                        <label>Department:</label>                                                                    
                                        <select class="form-control" name="dept_id" required="">
                                            <option selected="" value="">Select Department</option> 
                                            <?php
                                            foreach ($departments as $row) {
                                                if ($user->dept_id == $row['id']) {
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo '<label id="dept_id-error" class="validation-error-label" for="dept_id">' . form_error('dept_id') . '</label>'; ?>
                                    </div>
                                <?php } ?>

                                <div class="form-group col-xs-12 user_profile_pic">
                                    <label>Profile Image:</label>                               
                                    <input type="file" name="profile_pic" class="file-styled" onchange="readURL(this)">
                                    
                                    <!--<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>-->                               
                                    <div class="clearfix"></div>
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-5">
                                        <div id="imgpreview" style="margin-top: 10px;">
                                            <?php
                                            if (isset($user)) {
                                                if (trim($user->profile_pic) != '')
                                                    echo "<img src='" . base_url() . USER_PROFILE_IMAGE . '/' . $user->profile_pic . "' height='73px' width='73px'>"; //                                               
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <?php if(isset($profile_validation)){
                                        echo '<label id="profile_pic-error" class="validation-error-label" for="profile_pic">' . $profile_validation . '</label>'; 
                                    } ?>
                                </div>

                                <div class="form-group col-xs-12">
                                    <label>Address:</label>                               
                                    <textarea rows="5" cols="5" name="address" class="form-control" required="required" placeholder="Address" aria-required="true" aria-invalid="true"><?php
                                        if (isset($user)) {
                                            echo trim($user->address);
                                        } else {
//                                            if ($this->input->post('address')) {
//                                                echo $this->input->post('address');
//                                            } else {
//                                                echo '';
//                                            }
                                           echo set_value('address');
                                            
                                        }
                                        ?></textarea>
                                    <?php echo '<label id="address-error" class="validation-error-label" for="address">' . form_error('address') . '</label>'; ?>
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
