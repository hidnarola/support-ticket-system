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
        <?php
        $key = '';
        $action = base_url() . "home/reset_password";

        if (isset($_GET['key'])) {
            $key = rawurlencode($_GET['key']);
//            $key = urldecode($raw);
        }
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
//            $key = urldecode($raw);
        }
        if ($key != '') {
            $action = base_url() . "home/reset_password?key=" . $key.'&token='.$token;
        }
        ?>
        <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">
            <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Set Password to your Account</div>
            <div class="acc_content clearfix login_accordion">
                <form id="reset-form" name="reset-form" role="form"  class="nobottommargin" action="<?php echo $action; ?>" method="post">
                    <div class="col_full">
                        <label for="register-form-password">Choose Password:</label>
                        <input type="password" id="password" name="password" value="" required="required" class="form-control required" />
                        <?php echo '<label id="password-error" class="validation-error-label" for="password">' . form_error('password') . '</label>'; ?>
                    </div>

                    <div class="col_full">
                        <label for="register-form-repassword">Confirm Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" value="" data-rule-equalTo="#password" required="required" class="form-control required" />
                        <?php echo '<label id="confirm_password-error" class="validation-error-label" for="conpassword">' . form_error('confirm_password') . '</label>'; ?>
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-black nomargin" type="submit" id="reset-form-submit" name="reset-form-submit" value="login">Save password</button>

                    <a href="<?php echo base_url(); ?>home/forgot_password" class="mlm pull-right">Back to Forgot Password</a>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
</div>

<script>
    $("#reset-form").validate();
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 6000);
</script>