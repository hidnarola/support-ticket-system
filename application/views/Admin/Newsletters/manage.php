
<!-- <script type="text/javascript" src="assets/admin/js/plugins/forms/selects/bootstrap_select.min.js"></script> -->
<!-- <script type="text/javascript" src="assets/admin/js/pages/form_bootstrap_select.js"></script> -->
<!--<script type="text/javascript" src="assets/js/jquery.validate.js"></script>-->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-newspaper2"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/newsletters'); ?>"><i class="icon-newspaper2 position-left"></i> Newsletters</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row">
    <?php $this->load->view('Admin/message_view'); 
     echo validation_errors();
    ?>
        <div class="col-md-12">
            <form class="form-horizontal form-validate-jquery" action="" id="newsletter_info" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Newsletter title<font color="red">*</font></label>
                            <div class="col-lg-4">
                                <input type="text" name="title" id="title" required="" value="<?php echo isset($newsletter_data['title']) ? $newsletter_data['title'] : set_value('title'); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php //$this->load->view('Templates/admin_footer'); ?>
</div>
<script type="text/javascript">
    $('document').ready(function () {
        
        $("#newsletter_info").validate({
            rules: {
                title: {
                    required: true,
                    userval: /^[A-Za-z0-9 '.-]+$/, 
                    maxlength: 255
                },
            },
            messages: {          
                title : { 
                    userval: 'Invalid newsletter title'             
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
        });
    });
</script>