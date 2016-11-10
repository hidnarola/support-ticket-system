<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">
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
                <!-- Line content divider -->
                <div class="panel-body">
                    <div class="fancy-title title-dotted-border title-center">
                        <h3><?php echo $ticketname; ?></h3>
                    </div>
                    <ul class="media-list chat-list content-group">
                        <?php foreach ($ticket_coversation as $key => $value) { ?>
                            <li class="media date-step content-divider">
                                <span><?php echo $key; ?></span>
                                <!--<span>Monday, Feb 10</span>-->
                            </li>
                            <?php
                            foreach ($value as $val) {
                                if ($val['sent_from'] != $this->session->userdata('user_logged_in')['id']) {
                                    ?>

                                    <li class="media">
                                        <div class="media-left">
                                            <?php
                                            if ($val['profile_pic'] != '') {
                                                $filename = getimagesize(base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic']);
                                                if ($filename > 0) {
                                                    ?>
                                                    <a href="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>">
                                                        <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>" class="img-circle" alt=""></a>
                                                    <!--<div class="media-left"><img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?> " class="img-circle" alt=""></div>-->
                                                <?php } else { ?>
                                                    <a href="assets/admin/images/placeholder.jpg">
                                                        <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                    </a>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <a href="assets/admin/images/placeholder.jpg">
                                                    <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                </a>
                                            <?php } ?>

                                            </a>
                                        </div>

                                        <div class="media-body">
                                            <?php if ($val['sent_from'] != $val['user_id'] && $val['sent_from'] != $val['staff_id']) { ?>
                                                <div class="media-heading">
                                                    <a href="#" class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></a>
                                                </div>
                                            <?php } ?>
                                            <div class="media-content"><?php echo $val['message']; ?></div>
                                            <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                        </div>
                                    </li>
                                <?php
                                } else {
//                         echo 'in else';
                                    ?>

                                    <li class="media reversed">
                                        <div class="media-body">
                                            <div class="media-content"><?php echo $val['message']; ?></div>
                                            <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                        </div>

                                        <div class="media-right">
                                            <?php
                                            if ($val['profile_pic'] != '') {
                                                $filename = getimagesize(base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic']);
                                                if ($filename > 0) {
                                                    ?>
                                                    <a href="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>">
                                                        <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>" class="img-circle" alt="">
                                                    <!--<div class="media-left"><img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?> " class="img-circle" alt=""></div>-->
                <?php } else { ?>
                                                        <a href="assets/admin/images/placeholder.jpg">
                                                            <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                        </a>

                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <a href="assets/admin/images/placeholder.jpg">
                                                        <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                    </a>
            <?php } ?>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </ul>
                    <form method="post">
                        <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

                        <div class="row">
                            <div class="col-xs-6">
                                <ul class="icons-list icons-list-extended mt-10"> </ul>
                            </div>

                            <div class="col-xs-6 text-right">
                                <button type="submit" class="button button-rounded button-small pull-right blue-button"><b><i class="icon-reply"></i></b> Send</button>
                                <button type="button" class="button button-3d button-small button-rounded button-white button-light pull-right" onclick="window.history.back()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="line visible-xs-block"></div>

<?php $this->load->view('frontend/User/rightsidebar'); ?>
        </div>
    </div>
</div>
<!-- /line content divider -->
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000);
</script>
