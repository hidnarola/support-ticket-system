 <script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<div class="page-content-wrap login-page-content-wrap">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row clearfix">
                <div class="col-sm-9">
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
                    <form id="change_password-form" method="post" action="<?php echo base_url() . 'profile/changepassword' ?>"  enctype="multipart/form-data" class="form-widget form-validate-jquery">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col_full">
                                        <label for="exampleInputEmail1">Old Password</label>                                                                
                                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password" data-label="Old password" required="required" data-msg="Please enter Your Old Password.">
                                        <div id="msgbox" style="display: none; color: #e74c3c;"></div>
                                    </div>

                                    <div class="col_full">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" data-label="New password" required="required" data-msg="Please enter Your New Password.">
                                    </div>

                                    <div class="col_full">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" data-label="Confirm password" required="required" data-msg="Confirm password should be match with password." data-rule-equalTo="#new_password">
                                    </div>

                                

                            <div class="btn_bottom_sec">
                                <input type="submit" class="button button-small button-3d button-rounded nomargin blue-button" name="save" value="Submit">&nbsp;
                                <input type="button" class="button button-small button-white button-3d button-light nomargin" onclick="window.history.back()" value="Back">
                            </div>
                                    </div>
                            </div>
                        </form>
                </div>
                <div class="line visible-xs-block"></div>
                <?php $this->load->view('Frontend/User/rightsidebar'); ?>
            </div>
        </div>
    </div>
</div>
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000);
    
     $("#change_password-form").validate();
</script>