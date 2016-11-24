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

            <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>Login to your Account</div>
            <div class="acc_content clearfix login_accordion">
                <form id="login-form" name="login-form" role="form"  class="nobottommargin" action="login" method="post">
                    <div class="col_full">
                        <label for="login-form-username">Email:</label>
                        <input type="text" id="login-form-username" required="true" name="email" value="" data-rule-email="true" class="form-control email required" />
                    </div>

                    <div class="col_full">
                        <label for="login-form-password">Password:</label>
                        <input type="password" id="login-form-password" required="true" name="password" value="" class="form-control required" />
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-black nomargin" type="submit" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                        <a href="home/forgot_password" class="fright">Forgot Password?</a>
                    </div>
                </form>
            </div>

            <div class="acctitle acctitle_register"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
            <div class="acc_content clearfix register_accordion"  id="hiddenFields">
                <form id="register-form" name="register-form" class="nobottommargin" enctype="multipart/form-data" action="login/signup" method="post">
                    <div class="col_full">
                        <label for="register-form-name">First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" required="required" class="form-control required" />
                        <?php echo '<label id="fname-error" class="validation-error-label" for="fname">' . form_error('fname') . '</label>'; ?>
                    </div>

                    <div class="col_full">
                        <label for="register-form-name">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" required="required" class="form-control required" />
                        <?php echo '<label id="lname-error" class="validation-error-label" for="lname">' . form_error('lname') . '</label>'; ?>
                    </div>

                    <div class="col_full">
                        <label for="register-form-email">Email Address:</label>
                        <?php 
                        $error = '';
                        if(form_error('email')!='' ) 
                            $error = 'error'; ?>
                        <input type="text" id="email" name="email"  data-rule-email="true" value="<?php echo set_value('email'); ?>" required="required" class="form-control required <?php echo $error ?>" />
                        <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>
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
                    <div class="col_full">
                        <label for="register-form-phone">Contact Number:</label>
                        <input type="text" id="contactno" name="contactno" required="required" value="<?php echo set_value('contactno'); ?>" class="form-control required" />
                        <?php echo '<label id="contactno-error" class="validation-error-label" for="contactno">' . form_error('contactno') . '</label>'; ?>
                    </div>
                    <div class="col_full">
                        <label for="register-form-phone">Address:</label>
                        <textarea rows="5" cols="5" name="address" class="form-control required" required="required" placeholder="Address" aria-required="true" aria-invalid="true"><?php echo set_value('address'); ?></textarea>
                        <?php echo '<label id="address-error" class="validation-error-label" for="address">' . form_error('address') . '</label>'; ?>
                    </div>
                    <div class="col_full">
                        <label for="register-form-phone">Contract:</label>
                        <input type="file" id="contract" name="contract" value="<?php echo set_value('contract'); ?>" class="form-control" />
                        <span class="help-block">Accepted formats: gif, png, jpg, pdf. Max file size 2Mb</span>
                        <?php // echo '<label id="contract-error" class="validation-error-label" for="contract">' . form_error('contract') . '</label>'; ?>
                    </div>

                    <div class="col_full nobottommargin">
                        <button type="submit" class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$segment = $this->uri->segment(2);
if ($segment == 'signup') {
//    echo 'in';
//    echo $segment;
    ?>
    <style>
        /*        .register_accordion{display: block; !important}
                .login_accordion{display: none; !important}*/
    </style>
<?php } ?>
<script>
    $(function () {
        var segment = '<?php echo $this->uri->segment(2); ?>';
        if (segment == 'signup') {
//            alert('ready');
//            console.log("ready!");
//            $(".acctitle_register").trigger('click');
//            document.getElementById('hiddenFields').style.display = 'block';
//            var $accordionEl = $('.accordion');
//            if ($accordionEl.length > 0) {
//                $accordionEl.each(function () {
//                    var element = $(this),
//                            elementState = element.attr('data-state'),
//                            accordionActive = element.attr('data-active');
////
////                    if (elementState != 'closed') {
////                        element.find('.acctitle:eq(' + Number(accordionActive) + ')').addClass('acctitlec').next().show();
////                    }
////                    element.find('.acc_content').show();
////                    element.find('.acctitle').bind(function () {
//                        if ($('.acctitle').prev().is(':visible')) {
//                            console.log("ready!");
//                            element.find('.acctitle').removeClass('acctitlec').next().slideUp("normal");
//                            $(this).toggleClass('acctitlec').next().slideDown("normal");
////                            $(".register_accordion").css('display', 'block');
//                        }
////                    return false;
////                    });
//                });
//            }

        }
    });

    $("#login-form").validate();
    $("#register-form").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            conpassword: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
            contactno: {
                required: true, digits: true
            }
        },
        messages: {
            password: {
                minlength: "Your password must be at least 8 characters long"
            },
            conpassword: {
                equalTo: "Password does not match with confirm password field",
            },
        },
    });
</script>