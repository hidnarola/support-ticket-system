<!-- Default stacked layout -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $ticket->title; ?></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <ul class="media-list chat-stacked content-group">
            <?php foreach ($ticket_coversation as $key => $value) { ?>
                <li class="media date-step  content-divider text-muted">
                    <span><?php echo $key; ?></span>
                    <!--<span>Saturday, Feb 12</span>-->
                </li>
                <?php foreach ($value as $val) { ?>
                    <li class="media">
                        <?php
                        if ($val['profile_pic'] != '') {
                            $filename = getimagesize(base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic']);
                            if ($filename > 0) {
                                ?>
                                <div class="media-left"><img src="<?php echo  base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?> " class="img-circle" alt=""></div>
                            <?php } else { ?>
                                <div class="media-left"><img src="assets/admin/images/placeholder.jpg" class="img-circle" alt=""></div>

                                <?php
                            }
                        } else {
                            ?>
                            <div class="media-left"><img src="assets/admin/images/placeholder.jpg" class="img-circle" alt=""></div>
                        <?php } ?>
                        <div class="media-body">
                            <div class="media-heading">
                                <a href="#" class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></a>
                                <span class="media-annotation pull-right"> 
                                    <?php echo $date=date('g:i a',strtotime($val['created_date']));?>
                                    <a href="javascript:void(0)"><i class="icon-pin-alt position-right text-muted"></i></a></span>
                            </div>
                            <?php echo $val['message']; ?>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <form method="post">
        <textarea name="enter-message" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>
        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6 text-right">
                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- /default stacked layout -->