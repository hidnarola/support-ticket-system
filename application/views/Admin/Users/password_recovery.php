<!-- Password recovery -->
<form action="<?php echo base_url() . "home/verify" ?>" method="post">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
            <h5 class="content-group">Password Setting <small class="display-block"></small></h5>
        </div>

        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="" value="<?php echo $email; ?>" disabled="">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
            <div class="form-control-feedback">
                <i class="icon-mail5 text-muted"></i>
            </div>
        </div>

        <button type="submit" class="btn bg-blue btn-block">Save password <i class="icon-arrow-right14 position-right"></i></button>
    </div>
</form>
<!-- /password recovery -->