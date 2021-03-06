<!--<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>-->
<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">

                <div class="fancy-title title-dotted-border title-center">
                    <h3>Tickets Details</h3>
                </div>

                <table class="table newTickets" data-alert="" data-all="189">
                    <tbody>
                        <tr class="">
                            <th>Series No.</th>
                            <td><?php echo $ticket->series_no ?></td>
                        </tr>
                        <tr class="">
                            <th>Assign To</th>
                            <td><?php if ($ticket->staff_fname == '' && $ticket->staff_lname == '') { ?>
                                <span class="label label-success">Free</span>
                                    <?php
                                } else {
                                    echo $ticket->staff_fname . ' ' . $ticket->staff_lname;
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th>Tenant</th>
                            <td><?php echo $ticket->fname . ' ' . $ticket->lname; ?></td>
                        </tr>
                        <tr class="">
                            <th>Title</th>
                            <td><?php echo $ticket->title ?></td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td><?php echo $ticket->dept_name ?></td>
                        </tr>
                        <tr class="">
                            <th>Ticket Type</th>
                            <td><?php echo $ticket->type_name ?></td>
                        </tr>
                        <tr>
                            <th>Ticket Priority</th>
                            <td><?php echo $ticket->priority_name ?></td>
                        </tr>                                
                        <tr class="">
                            <th>Ticket Status</th>
                            <td><?php echo $ticket->status_name ?></td>
                        </tr>                                

                        <tr class="">
                            <th>Added On</th>
                            <td><?php echo date('d-M-Y', strtotime($ticket->created)) ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td style="width: 70%;"><?php echo $ticket->description ?></td>
                        </tr>
                        
                         
                        <?php if ($ticket->image != '') { ?>
                            <tr>
                                <th>Ticket Image</th>
                                <td> 
                                    <!--<div class="entry-image">-->
									<a href="<?php echo TICKET_IMAGE . '/' . $ticket->image; ?>" data-lightbox="image"><img class="image_fade" src="<?php echo TICKET_THUMB_IMAGE . '/' .  $ticket->image; ?>" height="90px" width="90px" alt="" style="opacity: 1;"></a>
								<!--</div>-->
                                    <!--<a class="fancybox" href="<?php echo USER_CONTRACT . '/' . $user['contract']; ?>" data-fancybox-group="gallery"><img src="<?php echo USER_CONTRACT . '/' . $user['contract']; ?>" alt="" height="90px" width="90px" /></a>-->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <div class="panel-body">
                    <div class="fancy-title title-dotted-border title-center">
                        <!--<h3><?php echo $ticketname; ?></h3>-->
                        <h3>Comments </h3>
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


                                        </div>

                                        <div class="media-body">
                                            <?php if ($val['sent_from'] != $val['user_id'] && $val['sent_from'] != $val['staff_id']) { ?>
                                                <div class="media-heading">
                                                    <label class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></label>
                                                    <span><strong><br><?php
                                                            if ($val['role_id'] == 1) {
                                                                echo 'Tenant';
                                                            } elseif ($val['role_id'] == 2) {
                                                                echo 'staff';
                                                            } elseif ($val['role_id'] == 3) {
                                                                echo 'Admin';
                                                            }elseif ($val['role_id'] == 4) {
                                                                echo 'Sub Admin';
                                                            }
                                                            ?></strong></span>
                                                </div>
                                            <?php } elseif ($val['sent_from'] == $val['staff_id']) { ?>
                                                <div class="media-heading">
                                                    <label class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></label>
                                                    <span><strong><br><?php
                                                            if ($val['role_id'] == 1) {
                                                                echo 'Tenant';
                                                            } elseif ($val['role_id'] == 2) {
                                                                echo 'staff';
                                                            } elseif ($val['role_id'] == 3) {
                                                                echo 'Admin';
                                                            }elseif ($val['role_id'] == 4) {
                                                                echo 'Sub Admin';
                                                            }
                                                            ?></strong></span>
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

                                    <!--<li class="media ">-->
                                    <li class="media reversed">
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <label class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></label>
                                                <span><strong><br><?php
                                                        if ($val['role_id'] == 1) {
                                                            echo 'Tenant';
                                                        } elseif ($val['role_id'] == 2) {
                                                            echo 'staff';
                                                        } elseif ($val['role_id'] == 3) {
                                                            echo 'Admin';
                                                        }
                                                        ?></strong></span>
                                            </div>
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
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </ul>
                    <div class="clearfix"></div>
                    <form method="post" id="reply-form-user">
                        <textarea name="enter-message" required="" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>

                        <div class="row">
                            <div class="col-xs-6">
                                <ul class="icons-list icons-list-extended mt-10"> </ul>
                            </div>

                            <div class="col-xs-6 text-right">
                                <button type="submit" class="button button-rounded button-small pull-right blue-button"><b><i class="icon-reply"></i></b> Comment</button>
                                <button type="button" class="button button-3d button-small button-rounded button-white button-light pull-right" onclick="window.history.back()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="line visible-xs-block"></div>

            <?php $this->load->view('Frontend/User/rightsidebar'); ?>
        </div>
    </div>
</div>
<style>
    .ticket_details > .panel-heading {
        background-color: #333;
        border-color: #ddd;
        color: #fff;
    }
    .alpha-teal{
        background-color: #e0f2f1 !important;
    }
</style>
<script>
    $(function () {
//        $('.fancybox').fancybox();
    });
</script>