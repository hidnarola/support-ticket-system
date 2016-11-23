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
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold">Tickets</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('staff'); ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('staff/tickets'); ?>"><i class="icon-home2 position-left"></i> Tickets</a></li>
            <li class="active">View Ticket</li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- Vertical form -->
            <!--        <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead><tr><th colspan="2"><center><h6>Ticket Details</h6></center></th></tr></thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td><?php echo $ticket->title ?></td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td><?php echo $ticket->dept_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ticket Type</th>
                                            <td><?php echo $ticket->type_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ticket Priority</th>
                                            <td><?php echo $ticket->priority_name ?></td>
                                        </tr>                                
                                        <tr>
                                            <th>Ticket Status</th>
                                            <td><?php echo $ticket->status_name ?></td>
                                        </tr>                                
                                        <tr>
                                            <th>Ticket Category</th>
                                            <td><?php echo $ticket->category_name ?></td>
                                        </tr>                          
                                        <tr>
                                            <th>Added On</th>
                                            <td><?php echo date('d-M-Y', strtotime($ticket->created)) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->


            <div class="panel-group ticket-view-panel" id="accordion1" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default ticket_details">
                    <div class="panel-heading" role="tab" id="heading1">
                        <h4 class="panel-title">

                            Ticket Details
                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="pull-right">
                                <i class="solsoCollapseIcon fa fa-chevron-up"></i>	
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body ticket-view">
                                <table class="table table-striped table-bordered newTickets ticket_details" data-alert="" data-all="189">
                                    <tbody>
                                        <tr class="alpha-teal">
                                            <th>Assign To</th>
                                            <td><?php echo $ticket->staff_fname . ' ' . $ticket->staff_lname; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tenant</th>
                                            <td><?php echo $ticket->fname . ' ' . $ticket->lname; ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Title</th>
                                            <td><?php echo $ticket->title ?></td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td><?php echo $ticket->dept_name ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Ticket Type</th>
                                            <td><?php echo $ticket->type_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ticket Priority</th>
                                            <td><?php echo $ticket->priority_name ?></td>
                                        </tr>                                
                                        <tr class="alpha-teal">
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
                                    //pr($val);
                                    if ($val['sent_from'] != $this->session->userdata('staffed_logged_in')['id']) {
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
                                                <?php if ($val['sent_from'] != $val['user_id'] && $val['sent_from'] != $val['staff_id']) { ?>
                                                    <div class="media-heading">
                                                        <a href="#" class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></a>
                                                    </div>
                                                <?php } ?>
                                                <div class="media-content"><?php echo $val['message']; ?></div>
                                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                            </div>
                                        </li>
                                    <?php } else {
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

                        <form method="post" class="form-validate-jquery">
                            <textarea name="enter-message" required="" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea>
                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6 text-right">

                                    <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Back</button>
                                    <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /vertical form -->
            </div>
        </div>
    </div>
</div>	

<style>
    .ticket_details > .panel-heading {
        background-color: #333;
        border-color: #ddd;
        color: #fff;
    }
    .alpha-teal {
        background-color: #e0f2f1 !important;
    }
</style>