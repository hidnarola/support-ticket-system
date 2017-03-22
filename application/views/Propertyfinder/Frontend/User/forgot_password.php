<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<div class="page-content-wrap login-page-content-wrap">
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
                    <form id="forgot-form" name="forgot-form" role="form"  class="nobottommargin" action="home/forgot_password" method="post">
                        <div class="col_full">
                            <label for="forgot-form-username">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="" value="" required="">
                            <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>

                        </div>
                        <div class="col_full nobottommargin">
                            <button class="button button-3d button-black nomargin" type="submit" id="forgot-form-submit" name="forgot-form-submit" value="login">Send Reset Link</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $("#forgot-form").validate();
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 6000);
</script>