<!--<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>-->
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/loaders/progressbar.min.js"></script>

<?php
$segment = $this->uri->segment(3);

?>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="admin/sub_admin"><i class="icon-user-tie position-left"></i> Sub Admins</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('Admin/message_view'); ?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <form method="post" action="">
        <div class="panel-heading">
           <h5>Personal Details</h5>

        </div>
       
        <div class="panel-body">
            <div class="row">
            <div class="col-md-6">
           <div class="form-group col-md-6">
                <label>First Name<font color="red">*</font></label>

                <input type="text" name="fname" class="form-control" placeholder="First Name" required="required" value="<?php
                if (isset($subadmin_detail) && !empty($subadmin_detail)) {
                    echo trim($subadmin_detail['fname']);
                } else {
                    echo set_value('fname');
                }
                ?>">
                       <?php echo '<label id="fname-error" class="validation-error-label" for="fname">' . form_error('fname') . '</label>'; ?>

            </div>
            <div class="form-group col-md-6">
                <label>Last Name<font color="red">*</font></label>

                <input type="text" name="lname" class="form-control" placeholder="Last Name" required="required" value="<?php
                if (isset($subadmin_detail) && !empty($subadmin_detail)) {
                    echo trim($subadmin_detail['lname']);
                } else {
                    echo set_value('lname');
                }
                ?>">
                       <?php echo '<label id="lname-error" class="validation-error-label" for="lname">' . form_error('lname') . '</label>'; ?>

            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group col-xs-12">
                <label>Email<font color="red">*</font></label>                                    
                <input type="email" class="form-control" placeholder="Email Address" name="email" required="required" value="<?php
                if (isset($subadmin_detail) && !empty($subadmin_detail)) {
                    echo trim($subadmin_detail['email']);
                } else {
                    echo set_value('email');
                }
                ?>">
                       <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>

            </div>
            </div>
            </div>
        </div>
    <hr>
        <div class="panel-heading">
           <h5>Module Permissions</h5>
        </div>
       
        <div class="panel-body">
            <div class="row">
               <?php foreach ($modules as $module) { ?>
                <div class="col-md-4">
                   <div class="checkbox">
                        <label>
                            <input type="checkbox" <?php echo (in_array($module['id'], $subadmin_modules)) ? 'checked' : '' ; ?> value="<?php echo $module['id']; ?>" name="modules[]">
                            <?php echo $module['name']; ?>
                        </label>
                    </div>
                </div>
               <?php } ?>
            </div>
            <hr>
        <div class="col-md-12">
            <div class="text-center">                                
                <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                <button type="submit" name="save" class="btn bg-teal">Save<i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
        </div>
        </form>
    </div>
</div>
<!-- /table header styling -->

<style>
    .loading-image {background: #fff none repeat scroll 0 0;border-radius: 5px;left: 50%;padding: 10px;position: absolute;top: 50%;z-index: 10;}
    .loader{display: none;background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;bottom: 0;left:0;overflow: auto;position: fixed;right: 0;text-align: center;top: 0;z-index: 9999;}
    .table > tbody > tr > td {padding: 12px 18px;}
    .dataTables_wrapper {margin-top: 20px;}
</style>
<div class="loader">
    <center>
        <img class="loading-image" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
    </center>
</div>

<script type="text/javascript">
  
</script>
