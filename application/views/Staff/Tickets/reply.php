<!-- Line content divider -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $ticket->title; ?></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <ul class="media-list chat-list content-group">
            <?php foreach ($ticket_coversation as $key => $value) { ?>
                <li class="media date-step content-divider">
                    <span><?php echo $key; ?></span>
                    <!--<span>Monday, Feb 10</span>-->
                </li>
                <?php
                foreach ($value as $val) {
                    if ($val['role_id'] == 1) {
                        ?>

                        <li class="media">
                            <div class="media-left">
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

                                </a>
                            </div>

                            <div class="media-body">
                                <div class="media-content"><?php echo $val['message']; ?></div>
                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?> <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                            </div>
                        </li>
                    <?php } else {
                        ?>

                        <li class="media reversed">
                            <div class="media-body">
                                <div class="media-content"><?php echo $val['message']; ?></div>
                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?> <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
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
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- /line content divider -->