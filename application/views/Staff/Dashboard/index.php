<?php
$segment = $this->uri->segment(1);
?>
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <?php // if($total_tickets != 0) { ?>
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-warning-400">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard" style="margin-top: 0px;">
                            <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                            <div class="icon-object border-white text-white"><i class=" icon-ticket"></i></div>
                        </div>
                        <h3 class="no-margin"><?php echo $total_tickets; ?></h3>

                        <?php echo ($total_tickets == 1) ? 'Ticket' : 'Tickets'; ?>
                        <!--<div class="text-muted text-size-small">489 avg</div>-->
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->
            </div>
            <?php // } ?>
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-slate-400">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard" style="margin-top: 0px;">
                            <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                            <div class="icon-object border-white text-white"><i class=" icon-reply"></i></div>

                        </div>
                        <h3 class="no-margin"><?php echo $total_replies; ?></h3>
                        Replies
                        <!--<div class="text-muted text-size-small">489 avg</div>-->
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->
            </div> 
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="row">


            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped datatable-basic">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Assign To</th>
                            <th>Title</th>
                            <th>Tenant</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>State</th>
                            <th>Actions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tickets as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <?php if ($record['staff_fname'] != '' && $record['staff_lname'] != '') { ?>
                                    <td><?php echo $record['staff_fname'] . ' ' . $record['staff_lname']; ?></td>
                                <?php } else { ?>
                                    <td class="text-center"><span class="label label-success">Free</span></td>
                                <?php } ?>
                                <td><?php echo $record['title']; ?></td>
                                <td><?php echo $record['fname'] . ' ' . $record['lname']; ?></td>
                                <td><?php echo $record['dept_name']; ?></td>
                                <td><?php echo $record['type_name']; ?></td>
                                <td><?php echo $record['priority_name']; ?></td>
                                <td><?php echo $record['status_name']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($record['created'])); ?></td>
                                <?php if ($record['is_read'] == 0) { ?>
                                    <td class="text-center"><span class="label label-warning">Unread</span></td>
                                <?php } else { ?>
                                    <td  class="text-center"><span class="label label-success">Read</span></td>
                                <?php } ?>
                                <td class="text-center">
                                    <ul class="icons-list">                                            
                                        <li class="text-purple-700">
                                            <?php if ($segment == 'admin') { ?>
                                                <a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']); ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i></a>
                                            <?php } elseif ($segment == 'staff') { ?>
                                                <a href="<?php echo base_url() . 'staff/tickets/view/' . base64_encode($record['id']); ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i></a>
                                            <?php } ?>
                                        </li>
                                        <li class="text-grey">
                                            <?php if ($segment == 'admin') { ?>
                                                <a href="<?php echo base_url() . 'admin/tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i></a>
                                            <?php } elseif ($segment == 'staff') { ?>
                                                <a href="<?php echo base_url() . 'tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i></a>
                                            <?php } ?>
                                        </li>                                            
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="dept" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                       data-modal-title="Change Department"><i class="icon-collaboration"></i>Change department</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="status" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>"
                                                       data-modal-title="Change Status"><i class="icon-stats-bars2"></i>Change status</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="priority" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                       data-modal-title="Change Priority"><i class="icon-list-numbered"></i>Change priority</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>