<div class="page-header page-header-default">
    
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold">View Member</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('staff'); ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('staff/members'); ?>"><i class="icon-home2 position-left"></i> Members</a></li>
            <li class="active">View Member</li>
        </ul>
    </div>
</div>
<div class="row">



    <div class="col-md-10 col-md-offset-1">
        


        <div class="panel-group ticket-view-panel" id="accordion1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default ticket_details">
                <div class="panel-heading" role="tab" id="heading1">
                    <h4 class="panel-title">

                        Member Details
                        <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="pull-right">
                            <i class="solsoCollapseIcon fa fa-chevron-up"></i>	
                        </a>
                    </h4>
                </div>

                <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                    <div class="panel-body ticket-view">
                     <?php //pr($member); ?>
                        <table class="table table-striped table-bordered newTickets ticket_details" data-alert="" data-all="189">
                            <tbody>

                                <tr class="alpha-teal">
                                    <th>Name</th>
                                    <td><?php echo $member->fname . ' ' . $member->lname; ?></td>
                                </tr>
                                 <tr class="alpha-teal">
                                    <th>Email</th>
                                    <td><?php echo $member->email; ?></td>
                                </tr>
                                <tr class="alpha-teal">
                                    <th>Address</th>
                                    <td><?php echo $member->address; ?></td>
                                </tr>
                                <tr class="alpha-teal">
                                    <th>Contact No.</th>
                                    <td><?php echo $member->contactno; ?></td>
                                </tr>
                                <tr class="alpha-teal">
                                    <th>Joined on</th>
                                    <td><?php echo date('F j, Y', strtotime($member->modified)); ?></td>
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