<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $page; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/Newsletters'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $title; ?></a></li>
            <li class="active"><?php echo $page; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <?php $this->load->view('Admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);

            if (isset($faq)) {
                $action = base_url() . "admin/Newsletters/edit_subscriber/" . base64_encode($faq[0]['id']);
            } else {
                $action = base_url() . "admin/Newsletters/add_subscriber";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="subscribers_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading"></div>

                            <div class="panel-body">
                                <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                     <div class="form-group col-xs-12">
                                    <label>Email<font color="red">*</font></label>                                    
                                    <input type="email" class="form-control" placeholder="Email Address" name="email" required="required" value="<?php
                                    if (isset($user)) {
                                        echo trim($user->email);
                                    } else {
                                        echo set_value('email');
                                    }
                                    ?>">
                                           <?php echo '<label id="email-error" class="validation-error-label" for="email">' . form_error('email') . '</label>'; ?>

                                </div>

                                    <div class="text-right">
                                        <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn bg-teal">Save <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>