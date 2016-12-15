<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
<style> .fancy-title.title-dotted-border {
        background: url(assets/frontend/images/icons/dotted.png) repeat-x center;
    }
    .title-center {
        text-align: center;
    }
    .fancy-title {
        position: relative;
        margin-bottom: 30px;
    }
    .fancy-title h3 {
        position: relative;
        display: inline-block;
        background-color: #FFF;
        padding-right: 15px;
        margin-bottom: 20px;
    }
    .title-center h3 {
        padding: 0 15px;
    }
</style>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('admin/message_view'); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel-group ticket-view-panel" id="accordion1" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default ticket_details">
                    <div class="panel-heading " role="tab" id="heading1">
                        <h4 class="panel-title">

                            <?php echo $ticket->title; ?>
                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="pull-right">
                                <i class="solsoCollapseIcon fa fa-chevron-up"></i>	
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body ticket-view">
                                <table class="table table-striped table-bordered newTickets" data-alert="" data-all="189">
                                    <tbody>
                                        <tr class="alpha-teal">
                                            <th>Series No.</th>
                                            <td><?php echo $ticket->series_no ?></td>
                                        </tr>
                                        <tr>
                                            <th>Assign To</th>
                                            <td><?php
                                                if ($ticket->staff_fname != '' && $ticket->staff_lname != '') {

                                                    echo $ticket->staff_fname . ' ' . $ticket->staff_lname;
                                                } else {
                                                    ?>
                                                    <span class="label label-success">Free</span>
                                                <?php }
                                                ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Tenant</th>
                                            <td><a href="#" data-toggle="modal" data-target="#modal_theme_success"><?php echo $ticket->fname . ' ' . $ticket->lname; ?></a></td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td><?php echo $ticket->title ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Department</th>
                                            <td><?php echo $ticket->dept_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ticket Type</th>
                                            <td><?php echo $ticket->type_name ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Ticket Priority</th>
                                            <td><?php echo $ticket->priority_name ?></td>
                                        </tr>                                
                                        <tr>
                                            <th>Ticket Status</th>
                                            <td><?php echo $ticket->status_name ?></td>
                                        </tr>                                

                                        <tr class="alpha-teal">
                                            <th>Added On</th>
                                            <td><?php echo date('d-M-Y', strtotime($ticket->created)) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><?php echo $ticket->description ?></td>
                                        </tr>
                                        <?php if($ticket->image != '' && file_exists(TICKET_IMAGE . '/' . $ticket->image)){ ?>
                                        <tr>
                                            <th>Tenant Contract</th>
                                            <td> 
                                                    <a class="fancybox" href="<?php echo TICKET_IMAGE . '/' . $ticket->image; ?>" data-fancybox-group="gallery"><img src="<?php echo TICKET_THUMB_IMAGE . '/' . $ticket->image; ?>" alt="" height="90px" width="90px" /></a>
                                                
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>					


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
                                    // / pr($val);
                                    if ($val['sent_from'] != $this->session->userdata('admin_logged_in')['id']) {
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
                                                        </a>
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
                                                            <div class="media-content"><?php echo $val['message']; ?></div>
                                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                                    
                                                </div>
                                                
                                            
                                        </li>
                                    <?php } else {
                                        ?>

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
                                                            }elseif ($val['role_id'] == 4) {
                                                                echo 'Sub Admin';
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
                                                            <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>" class="img-circle" alt="">
                                                        </a>
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

                        <form method="post" class="form-validate-jquery">
                            <textarea name="enter-message" required="" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>
                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6 text-right">

                                    <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Back</button>
                                    <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Comment</button>

                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Tenant Details</h6>
            </div>

            <div class="modal-body panel-body login-form" id="password_form" >
                <?php if($user['profile_pic'] != '' && file_exists(USER_PROFILE_IMAGE . '/' . $user['profile_pic'])){ ?>
                <div class="text-center" style="padding: 5px;"><img class="img-circle" src="<?php echo USER_PROFILE_IMAGE . '/' . $user['profile_pic']; ?>" alt="" height="90px" width="90px" /></div>
                <?php } ?>
                <table class="table table-striped table-bordered newTickets ticket_details" data-alert="" data-all="189">
                    <tbody>
                        <tr>
                            <th>Tenant Name</th>
                            <td><?php echo $user['fname'] . ' ' . $user['lname']; ?></td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td><?php echo $user['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact No.</th>
                            <td><?php echo $user['contactno']; ?></td>
                        </tr>
                        <tr>
                            <th>Address </th>
                            <td><?php echo $user['address']; ?></td>
                        </tr>
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-teal legitRipple" data-dismiss="modal">Close</button>
            </div>          

        </div>
    </div>
</div>
<script>
    $(function () {
        $('.fancybox').fancybox();
    });
</script>
