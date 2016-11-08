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
                <!--                <form id="login-form" name="login-form" role="form"  class="nobottommargin" action="login" method="post">
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
                                </form>-->
                <!--<div class="postcontent nobottommargin">-->



                <div class="contact-widget">

                    <div class="contact-form-result"></div>

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
                    <!--</div>-->

                </div>
            </div>

            <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>New Signup? Register for an Account</div>
            <div class="acc_content clearfix">
                <div class="contact-widget">

                    <div class="contact-form-result"></div>
                    <form id="register-form" name="register-form" class="nobottommargin" action="login/signup" method="post">
                        <div class="col_full">
                            <label for="register-form-name">First Name:</label>
                            <input type="text" id="fname" name="fname" value="" required="required" class="form-control required" />
                        </div>

                        <div class="col_full">
                            <label for="register-form-name">Last Name:</label>
                            <input type="text" id="lname" name="lname" value="" required="required" class="form-control required" />
                        </div>

                        <div class="col_full">
                            <label for="register-form-email">Email Address:</label>
                            <input type="text" id="email" name="email" value="" required="required" class="form-control required" />
                        </div>                   

                        <div class="col_full">
                            <label for="register-form-password">Choose Password:</label>
                            <input type="password" id="password" name="password" value="" required="required" class="form-control required" />
                        </div>

                        <div class="col_full">
                            <label for="register-form-repassword">Re-enter Password:</label>
                            <input type="password" id="repassword" name="repassword" value="" required="required" class="form-control required" />
                        </div>
                        <div class="col_full">
                            <label for="register-form-phone">Contact Number:</label>
                            <input type="text" id="register-form-phone" name="register-form-phone" required="required" value="" class="form-control required" />
                        </div>
                        <div class="col_full">
                            <label for="register-form-phone">Address:</label>
                            <textarea rows="5" cols="5" name="address" class="form-control required" required="required" placeholder="Address" aria-required="true" aria-invalid="true"></textarea>
                        </div>

                        <div class="col_full nobottommargin">
                            <button type="submit" class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
