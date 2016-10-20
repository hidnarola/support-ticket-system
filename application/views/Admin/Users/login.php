<div class="content-wrapper">
    <div class="content pb-20">
        <form method="post" class="form-validate">
            <div class="panel panel-body login-form">
                <div class="text-center">
                    <div class="icon-object login_logo">
                        <img src="assets/img/logo.png">
                    </div>
                    <h4 class="content-group">Login to your account</h4>
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
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="email" class="form-control" placeholder="Email Address" name="email" required="required">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group login-options">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="remember_me" value="1">
                                Remember Me
                            </label>
                        </div>

                        <div class="col-sm-6 text-right">
                            <a href="#">Forgot password?</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn bg-pink-400 btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>