<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">

                <div class="fancy-title title-dotted-border title-center">
                    <h3>Tickets Details</h3>
                </div>
                
                
<!--                <div class="pricing-desc">
							<div class="pricing-title">
								<h3>How many Themes can you Download today?</h3>
							</div>
							<div class="pricing-features">
								<ul class="clearfix">
                                                                    <li><i class="icon-desktop"></i>&nbsp;&nbsp;  Ticket Title: <span>&nbsp;&nbsp; <?php echo $ticket->title ?></span>  </li>
									<li><i class="icon-eye-open"></i>&nbsp;&nbsp;  Assign To </li>
									<li><i class="icon-beaker"></i>&nbsp;&nbsp;  Tenant</li>
									<li><i class="icon-magic"></i>&nbsp;&nbsp;  Department</li>
									<li><i class="icon-font"></i>&nbsp;&nbsp;  Ticket Type</li>
									<li><i class="icon-stack3"></i>&nbsp;&nbsp;  Ticket Priority</li>
									<li><i class="icon-file2"></i>&nbsp;&nbsp;  Ticket Status</li>
									<li><i class="icon-support"></i>&nbsp;&nbsp;  Added On</li>
									<li><i class="icon-support"></i>&nbsp;&nbsp;  Description</li>
								</ul>
							</div>
						</div>-->


<!--                <div class="row">
                    <div class="col-sm-3">
                        <span>Ticket Title </span>
                    </div>
                    <div class="col-sm-9">
                        <?php echo $ticket->title ?>
                    </div>
                    <div class="col-sm-3">
                        Assign To
                    </div>
                    <div class="col-sm-9">
                        <?php if ($ticket->staff_fname == '' && $ticket->staff_lname == '') { ?>
                            <span class="label label-success">Free</span>
                            <?php
                        } else {
                            echo $ticket->staff_fname . ' ' . $ticket->staff_lname;
                        }
                        ?>
                    </div>
                </div>-->


                <table class="table newTickets" data-alert="" data-all="189">
                    <tbody>
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
                        <tr>
                            <th>Ticket Category</th>
                            <td><?php echo $ticket->category_name ?></td>
                        </tr>                          
                        <tr class="">
                            <th>Added On</th>
                            <td><?php echo date('d-M-Y', strtotime($ticket->created)) ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td style="width: 70%;"><?php echo $ticket->description ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-right">
                    <a href="tickets/reply/<?php echo base64_encode($ticket->id) ?>" class="button button-rounded button-reveal button-small pull-right blue-button"><i class="icon-envelope2"></i><span>Send Message</span></a>
                    <button type="button" class="button button-3d button-small button-rounded button-white button-light pull-right" onclick="window.history.back()">Back</button>
                    <!--<button type="button" class="button button-3d button-small button-rounded button-white button-light pull-right" onclick="window.history.back()"></button>-->
                </div>
                <!-- /vertical form -->
            </div>
            <div class="line visible-xs-block"></div>

            <?php $this->load->view('frontend/User/rightsidebar'); ?>
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