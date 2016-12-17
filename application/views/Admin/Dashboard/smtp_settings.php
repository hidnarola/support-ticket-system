<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class;?> position-left"></i> <span class="text-semibold"><?php echo $title;?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row profile_page">
<?php $this->load->view('Admin/message_view');?>
        <div class="col-md-12">

            <!-- Basic layout-->
            <form class="profile_frm" method="post">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                    <h5>SMTP Settings</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>SMTP Host:</label>
                            <input type="text" name="smtp_host" class="form-control" placeholder="Enter SMTP Host" value="<?php echo $smtp_settings['smtp_host']; ?>">
                        </div>
                        <div class="form-group">
                            <label>SMTP Port:</label>
                            <input type="text" name="smtp_port" class="form-control" placeholder="Enter SMTP Port" value="<?php echo $smtp_settings['smtp_port']; ?>">
                        </div>

                        <div class="form-group">
                            <label>SMTP Email:</label>
                            <input type="text" name="smtp_email" class="form-control" placeholder="Enter SMTP Email" value="<?php echo $smtp_settings['smtp_email']; ?>">
                        </div>

                        <div class="form-group">
                            <label>SMTP Password:</label>
                            <input type="password" name="smtp_password" class="form-control" placeholder="Enter SMTP Password" value="<?php echo $smtp_settings['smtp_password']; ?>">
                        </div>


                        <div class="text-right">
                            <button type="submit" class="btn btn-primary legitRipple">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>
    </div>
</div>
