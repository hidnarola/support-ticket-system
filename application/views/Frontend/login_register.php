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
            <div class="acc_content clearfix">
                <form id="login-form" name="login-form" role="form"  class="nobottommargin" action="login" method="post">
                    <div class="col_full">
                        <label for="login-form-username">Username:</label>
                        <input type="text" id="login-form-username" required="true" name="email" value="" class="form-control email required" />
                    </div>

                    <div class="col_full">
                        <label for="login-form-password">Password:</label>
                        <input type="password" id="login-form-password" required="true" name="password" value="" class="form-control required" />
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-black nomargin" type="submit" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                        <a href="#" class="fright">Forgot Password?</a>
                    </div>
                </form>
            </div>

            <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
            <div class="acc_content clearfix">
                <form id="register-form" name="register-form" class="nobottommargin" action="#" method="post">
                    <div class="col_full">
                        <label for="register-form-name">Name:</label>
                        <input type="text" id="register-form-name" name="register-form-name" value="" class="form-control" />
                    </div>

                    <div class="col_full">
                        <label for="register-form-email">Email Address:</label>
                        <input type="text" id="register-form-email" name="register-form-email" value="" class="form-control" />
                    </div>

                    <div class="col_full">
                        <label for="register-form-username">Choose a Username:</label>
                        <input type="text" id="register-form-username" name="register-form-username" value="" class="form-control" />
                    </div>

                    <div class="col_full">
                        <label for="register-form-phone">Phone:</label>
                        <input type="text" id="register-form-phone" name="register-form-phone" value="" class="form-control" />
                    </div>

                    <div class="col_full">
                        <label for="register-form-password">Choose Password:</label>
                        <input type="password" id="register-form-password" name="register-form-password" value="" class="form-control" />
                    </div>

                    <div class="col_full">
                        <label for="register-form-repassword">Re-enter Password:</label>
                        <input type="password" id="register-form-repassword" name="register-form-repassword" value="" class="form-control" />
                    </div>

                    <div class="col_full nobottommargin">
                        <button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>