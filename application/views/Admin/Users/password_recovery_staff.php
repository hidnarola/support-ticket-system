<!-- Password recovery -->
<form class="form-validate" action="<?php echo base_url() . "home/verifyPassword" ?>" method="post">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
            <h5 class="content-group">Password Setting <small class="display-block"></small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="email" name="email" class="form-control" placeholder="" value="<?php echo $email; ?>" disabled="">
            <input type="hidden" name="email_hidden" class="form-control" placeholder="" value="<?php echo $email; ?>">
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
            <?php echo '<label id="password-error" class="validation-error-label" for="password">' . form_error('password') . '</label>'; ?>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <input type="password" name="repeat_password" id="repeat_password" class="form-control" placeholder="Confirm Password" required="required">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
            <?php echo '<label id="repeat_password-error" class="validation-error-label" for="repeat_password">' . form_error('repeat_password') . '</label>'; ?>
        </div>
        <button type="submit" class="btn bg-blue btn-block">Save password <i class="icon-arrow-right14 position-right"></i></button>
    </div>

</form>
<!-- /password recovery -->