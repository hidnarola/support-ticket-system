<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-indigo-300">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard">
                            <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                            <!--<div class="media-left"><a href="#" class="btn border-success text-success btn-flat btn-icon btn-rounded btn-sm"><i class="icon-checkmark3"></i></a></div>-->
                            <div class="icon-object border-white text-white"><i class="icon-collaboration"></i></div>
                        </div>
                        <h3 class="no-margin"><?php echo $total_departments; ?></h3>
                        <?php echo ($total_departments == 1) ? 'Department' : 'Departments'; ?>
                        <!--<div class="text-muted text-size-small">489 avg</div>-->
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->
            </div>
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-pink-400">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard">
                            <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                            <div class="icon-object border-white text-white"><i class="icon-users"></i></div>
                        </div>
                        <h3 class="no-margin"><?php echo $total_tenants; ?></h3>
                        <?php echo ($total_tenants == 1) ? 'Tenant' : 'Tenants'; ?>
                        <!--<div class="text-muted text-size-small">489 avg</div>-->
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->
<<<<<<< HEAD
            </div>
            <!-- /members online -->
            
            
=======

            </div>
            <!-- /members online -->


>>>>>>> a03c0263f1cea7ea5448fb8c31a2c0f91d9e4ce4
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-slate-400">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard">
                            <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                            <div class="icon-object border-white text-white"><i class="icon-people"></i></div>
                        </div>
                        <h3 class="no-margin"><?php echo $total_staffs; ?></h3>
                        Staff
                        <!--<div class="text-muted text-size-small">489 avg</div>-->
                    </div>
                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->
            </div>
            <?php if ($total_tickets != 0) { ?>
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-warning-400">
                    <div class="panel-body">
                        <div class="heading-elements icon-dasboard">
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
            </div>
            <?php } ?>
            
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
    <div class="col-md-6">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                            <th>Staff</th>
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
                                    <td><span class="label label-warning">Unread</span></td>
                                <?php } else { ?>
                                    <td><span class="label label-success">Read</span></td>
                                <?php } ?>
                                    <td class="text-center">
                                    <ul class="icons-list">

                                        <li class="text-purple-700">
                                            <a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i> </a>
                                        </li>
                                        <li class="text-grey">
                                            <a href="<?php echo base_url() . 'admin/tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i> </a>
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
                                                <!--                                               <li class="divider"></li>
                                                                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" class="chang_pwdd" id="changepwd_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" ><i class="icon-file-pdf"></i>Change priority</a></li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>

                            <?php
                            if($record['is_read'] == 0 ){ ?>
                            <td><span class="label label-warning">Unread</span></td>
                            <?php } else{  ?>
                            <td><span class="label label-success">Read</span></td>
                            <?php } ?>
                            <td>
                                <ul class="icons-list">
                                    
                                    <li class="text-white">
                                        <a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view label bg-slate"><i class="icon-eye"></i> View</a>
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
                                            <!--                                               <li class="divider"></li>
                                            <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" class="chang_pwdd" id="changepwd_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" ><i class="icon-file-pdf"></i>Change priority</a></li>-->
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
<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <form id="change_action" class="form-validate" method="post" action="admin/tickets/changeAction">
                <input type="hidden" id="hidden_value" name="hidden_value" value=""/>
                <input type="hidden" id="select_type" name="select_type" value=""/>
                <input type="hidden" id="hidden_id" name="hidden_id" value=""/>
                <div id='ret'></div>
                <div class="modal-body panel-body login-form" id="password_form" >
                    <div class="form-group" id="dept_id" style="display:none">
                        <select class="select" id="dept_val" name="dept_id" required="">
                            <option value="">Select Department</option>
                            <?php
                            foreach ($departments as $row) {
                            echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="status_id" style="display:none">
                        <select class="select" id="status_val" name="status_id" required="">
                            <option value="">Select Status</option>
                            <?php
                            foreach ($statuses as $row) {
                            echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="priority_id" style="display:none">
                        <select class="select" id="priority_val" name="priority_id" required="">
                            <option value="">Select Priority</option>
                            <?php
                            foreach ($priorities as $row) {
                            echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-teal legitRipple" id="save_action">Save changes <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /success modal -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">

$(function () {
    var dt = new Date();
var current_month = dt.getMonth();
var current_year = dt.getFullYear();
    $('#container').highcharts({
        title: {
            text: 'Clients and Tickets this month',
            x: -20 //center
        },
       
       xAxis: {
                type: 'datetime',
                tickInterval: 24 * 3600 * 1000,
                title: {
                    text: null
                }
            },
        yAxis: {
            title: {
                text: 'Number'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Clients',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(current_year, current_month, 01 , 0, 0, 0, 0),
            data: [
                0.8446, 0.8445, 0.8444, 0.8451,    0.8418, 0.8264,    0.8258, 0.8232,    0.8233, 0.8258,
                0.8283, 0.8278, 0.8256, 0.8292,    0.8239, 0.8239,    0.8245, 0.8265,    0.8261, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172,    0.8172, 0.8172,    0.8172, 0.8172,    0.8172, 0.8172
            ]
        },
        {
            name: 'Tickets',
            pointInterval: 24 * 3600 * 1000,
            pointStart: Date.UTC(current_year, current_month, 01 , 0, 0, 0, 0),
            data: [
                0.8446, 0.8445, 0.8444, 0.8451,    0.8418, 0.8264,    0.8258, 0.8232,    0.8233, 0.8258,
                0.8283, 0.8278, 0.8256, 0.8292,    0.8239, 0.8239,    0.8245, 0.8265,    0.8261, 0.8269,
                0.8273, 0.8244, 0.8244, 0.8172,    0.8172, 0.8172,    0.8172, 0.8172,    0.8172, 0.8172
            ]
        }
        ]
        
    });
});

var base_url = '<?php echo base_url(); ?>admin/';
$(document).on('click', 'a.chang_pwdd', function () {
    var modal_title = $(this).attr('data-modal-title');
    var action = $(this).attr('data-act');
    var url = base_url + 'tickets/changeAction';
    var id = $(this).attr('id').replace('changedept_', '');
    $('#hidden_id').val(id);
    if (action == 'dept') {
        $('#dept_id').show();
        $('#priority_id').hide();
        $('#status_id').hide();
        //                var id = $(this).attr('id').replace('changedept_', '');
        var action_type = 'dept_id';
        $('.validation-error-label').hide();
        var card = document.getElementById("dept_val");
        var select_data = card.selectedIndex;
    } else if (action == 'status') {
        $('#dept_id').hide();
        $('#priority_id').hide();
        $('#status_id').show();
        var card = document.getElementById("status_val");
        var select_data = card.selectedIndex;
        //                var id = $(this).attr('id').replace('changestatus_', '');
        var action_type = 'status_id';
        $('.validation-error-label').hide();
    } else if (action == 'priority') {
        $('#priority_id').show();
        $('#status_id').hide();
        $('#dept_id').hide();
        var card = document.getElementById("priority_val");
        var select_data = card.selectedIndex;
        //                var id = $(this).attr('id').replace('changepriority_', '');
        var action_type = 'priority_id';
        $('.validation-error-label').hide();
    } else {
        $('#dept_id').hide();
        $('#priority_id').hide();
        $('#status_id').hide();
    }
    $('.modal-title').html(modal_title);
    var select = card.selectedIndex;
    var hidden_val = select;
    $('#hidden_value').val(hidden_val);
    $('#select_type').val(action_type);
});
$(function () {
    $("#change_action").submit(function (event) {
    var url = $(this).attr('action');
    $.ajax({
        url: url,
        data: {form: $('#change_action').serialize()},
        type: $(this).attr('method')
    }).done(function (data) {
    if (data = 'success') {
        $('#modal_theme_success').modal('hide');
        $('#change_action')[0].reset();
        $('#ticket_table').dataTable();
        //                       $("#dept_val option[value='']").attr('selected', true)
        $('#dept_val').val('');
        $('#status_val').val('');
        $('#priority_val').val('');
        window.location.reload();
    } else {
    }
    });
    event.preventDefault();
    });
});
</script>
