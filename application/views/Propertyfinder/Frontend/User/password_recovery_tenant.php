<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<div class="content-wrap">

    <div class="container clearfix">
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

        <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">
            <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Set Password to your Account</div>
            <div class="acc_content clearfix login_accordion">
                <form id="login-form" name="login-form" role="form"  class="nobottommargin" action="home/verifyPasswordTenant" method="post">
                    <div class="col_full">
                        <label for="login-form-username">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="" value="<?php echo $email; ?>" disabled="">
                        <input type="hidden" name="email_hidden" class="form-control" placeholder="" value="<?php echo $email; ?>">
                            <!--<input type="text" id="login-form-username" required="true" name="email" value="" data-rule-email="true" class="form-control email required" />-->
                    </div>

                    <div class="col_full">
                        <label for="register-form-password">Choose Password:</label>
                        <input type="password" id="password" name="password" value="" required="required" class="form-control required" />
                        <?php echo '<label id="password-error" class="validation-error-label" for="password">' . form_error('password') . '</label>'; ?>
                    </div>

                    <div class="col_full">
                        <label for="register-form-repassword">Confirm Password:</label>
                        <input type="password" id="conpassword" name="conpassword" value="" data-rule-equalTo="#password" required="required" class="form-control required" />
                        <?php echo '<label id="conpassword-error" class="validation-error-label" for="conpassword">' . form_error('conpassword') . '</label>'; ?>
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-black nomargin" type="submit" id="login-form-submit" name="login-form-submit" value="login">Save password</button>

                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
</div>

<script>
    $("#login-form").validate();
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 6000);
</script>