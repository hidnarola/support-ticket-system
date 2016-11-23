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
            </div>					
        </div>
        <div class="text-right">
            <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Back</button>
        </div>
        <!-- /vertical form -->
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