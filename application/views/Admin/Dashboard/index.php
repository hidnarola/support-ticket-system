<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
        <script type="text/javascript" src="assets/admin/js/pages/components_loaders.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ul>
    </div>
</div>

<div class="content">

    <!-- Main charts -->
    <div class="row dashboard_layout">
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-indigo-300">
                <div class="panel-body">
                    <div class="heading-elements icon-dasboard">
                        <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                        <!--<div class="media-left"><a href="#" class="btn border-success text-success btn-flat btn-icon btn-rounded btn-sm"><i class="icon-checkmark3"></i></a></div>-->
                        <div class="icon-object border-white text-white dash-icon"><i class="icon-collaboration"></i></div>
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
                        <div class="icon-object border-white text-white dash-icon"><i class="icon-users"></i></div>
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

        </div>
        <!-- /members online -->

        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-slate-400">
                <div class="panel-body">
                    <div class="heading-elements icon-dasboard">
                        <!--<span class="heading-text badge bg-teal-800">+53,6%</span>-->
                        <div class="icon-object border-white text-white dash-icon"><i class="icon-people"></i></div>
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
                            <div class="icon-object border-white text-white dash-icon"><i class=" icon-ticket"></i></div>
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
    <div class="row">
        <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            <div class="panel container-fluid">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-ticket position-left text-danger"></i> <?php echo $total_tickets_this_month; ?></h5>
                            <span class="text-muted text-size-small">Total Tickets this month</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin"><i class="icon-users position-left text-primary"></i> <?php echo $total_clients_this_month; ?></h5>
                            <span class="text-muted text-size-small">Total Clients this month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php 
    $permissions = array();

        if($this->session->userdata('module_ids')){
            $permissions = explode(',', $this->session->userdata('module_ids'));
        }
if(in_array('3', $permissions) || empty($permissions)){ ?>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Latest Tickets</h6>
                <span style="padding:5px; color: red;">*Highlighted rows represents unread tickets</span>
            <div class="heading-elements">

                <a href="admin/tickets" class="label bg-success heading-text">View All Tickets</a></div>
                
        </div>
        <div class="panel-body">
            <div class="row">
            <table class="table table-bordered table-hover table-striped datatable-basic">
                <thead>
                    <tr class="bg-teal">
                        <th>#</th>
                        <th>Ticket ID</th>
                        <th>Assigned To</th>
                        <th>Title</th>
                        <th>Tenant</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <!-- <th>State</th> -->
                        <th style="width:10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                            foreach ($tickets as $key => $record) {
                                $is_read = 'is_read';
                                
                                    if ($record['is_read'] == 1 || $record['is_read'] == 3) {
                                        $is_read = '';
                                    }
                                
                                ?>
                                <tr class="<?php echo $is_read; ?>">
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $record['series_no']; ?></td>
                            <?php if ($record['staff_id'] != '') { ?>
                                <td><?php echo $record['staff_fname'] . ' ' . $record['staff_lname']; ?></td>
                            <?php } else { ?>
                                <td class="text-center"><span class="label label-success">Free</span></td>
                            <?php } ?>
                                <td><a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']) ?>"><?php echo $record['title']; ?></a></td>
                            <td><?php echo $record['fname'] . ' ' . $record['lname']; ?></td>
                            <td><?php echo $record['dept_name']; ?></td>
                            <td><?php echo $record['type_name']; ?></td>
                            <td><?php echo $record['priority_name']; ?></td>
                            <td><?php echo $record['status_name']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($record['created'])); ?></td>
                            <?php /* if ($record['is_read'] == 1 || $record['is_read'] == 3) { ?>
                                <td><span class="label label-success">Read</span></td>
                            <?php } else { ?>
                                <td><span class="label label-warning">Unread</span></td>
                            <?php } */ ?>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/tickets/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" title='Edit Ticket' class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                    <li class="text-purple-700">
                                        <a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i> </a>
                                    </li>
                                   <li class="text-danger-600">
                                            <a id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Delete Ticket' class="delete"><i class="icon-trash"></i></a>
                                        </li>
<!--                                    <li class="text-grey">
                                        <a href="<?php echo base_url() . 'admin/tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i> </a>
                                    </li>-->
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="dept" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" data-dept="<?php echo $record['dept_id']; ?>"
                                                           data-modal-title="Change Department"><i class="icon-collaboration"></i>Change department</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="status" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>"  data-status="<?php echo $record['status_id']; ?>"
                                                           data-modal-title="Change Status"><i class="icon-stats-bars2"></i>Change status</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="priority" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-priority="<?php echo $record['priority_id']; ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                           data-modal-title="Change Priority"><i class="icon-list-numbered"></i>Change priority</a></li>
                                                    <li><a data-dept="<?php echo $record['dept_id']; ?>" href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="assign" class="chang_pwdd" id="assign_<?php echo base64_encode($record['id']); ?>" data-staff="<?php echo $record['staff_id']; ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                   data-modal-title="Assign Staff"><i class="icon-user"></i><?php echo ($record['staff_id'] != '') ? 'Change' : 'Assign'; ?> Staff</a></li>
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

        <?php } ?>
    <!-- /main charts -->
</div>


<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <form id="change_action" class="form-validate" method="post" novalidate action="admin/tickets/changeAction">
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
                    <div class="form-group" id="staff_id" style="display:none">
                        <select class="select" id="staff_val" name="staff_id" required="">
                        <option value="">Select Staff</option>
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
<style>
    .loading-image {
        background: #fff none repeat scroll 0 0;
        border-radius: 5px;
        left: 50%;
        padding: 10px;
        position: absolute;
        top: 50%;
        z-index: 10;
    }
    .loader{
        display: none;
        background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
        bottom: 0;
        left:0;
        overflow: auto;
        position: fixed;
        right: 0;
        text-align: center;
        top: 0;
        z-index: 9999;

    }
</style>
<div class="loader">
    <center>
        <img class="loading-image" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
    </center>
</div>
<!-- /success modal -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
// $('.datatable-basic').dataTable();

    $(function () {
        var dt = new Date();
        var current_month = dt.getMonth();
        var current_year = dt.getFullYear();


        $('#container').highcharts({
            title: {
                text: 'Clients and Tickets this month',
                x: -20 //center
            },
            credits: {
                enabled: false
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
                    pointStart: Date.UTC(current_year, current_month, 01, 0, 0, 0, 0),
                    data: <?php echo json_encode($clients_chart); ?>,

                },
                {
                    name: 'Tickets',
                    pointInterval: 24 * 3600 * 1000,
                    pointStart: Date.UTC(current_year, current_month, 01, 0, 0, 0, 0),
                    data: <?php echo json_encode($tickets_chart); ?>,
                    color:'#F44336'
                }
            ]

        });
    });

    var base_url = '<?php echo base_url(); ?>admin/';
    $(document).on('click', 'a.chang_pwdd', function () {
        var modal_title = $(this).attr('data-modal-title');
        var action = $(this).attr('data-act');
        var url = base_url + 'tickets/changeAction';
        // var id = $(this).attr('id').replace('changedept_', '');
        var id = $(this).attr('data-record');
        $('#hidden_id').val(id);
        if (action == 'dept') {
            selected  = $(this).attr('data-dept');
            $("#dept_val").val(selected);
            $("#dept_val").select2();
            $('#dept_id').show();
            $('#staff_id').hide();
            $('#priority_id').hide();
            $('#status_id').hide();
            //                var id = $(this).attr('id').replace('changedept_', '');
            var action_type = 'dept_id';
            $('.validation-error-label').hide();
            var card = document.getElementById("dept_val");
            var select_data = card.selectedIndex;
            var selected = '';
        } else if (action == 'status') {
            selected  = $(this).attr('data-status');
            $("#status_val").val(selected);
            $("#status_val").select2();
            $('#dept_id').hide();
            $('#staff_id').hide();
            $('#priority_id').hide();
            $('#status_id').show();
            var card = document.getElementById("status_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changestatus_', '');
            var action_type = 'status_id';
            $('.validation-error-label').hide();
        } else if (action == 'priority') {
            selected  = $(this).attr('data-priority');
            $("#priority_val").val(selected);
            $("#priority_val").select2();
            $('#priority_id').show();
            $('#staff_id').hide();
            $('#status_id').hide();
            $('#dept_id').hide();
            var card = document.getElementById("priority_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changepriority_', '');
            var action_type = 'priority_id';
            $('.validation-error-label').hide();
        }else if (action == 'assign') {
            selected  = $(this).attr('data-staff');
            $("#staff_val").val(selected);
            $("#staff_val").select2();
            var dept = $(this).attr('data-dept');
             $.ajax({
                url: 'admin/dashboard/get_staff',
                data: {'dept':dept},
                type: 'post',
            }).done(function (data) {
                console.log(data);
                $("select#staff_val").html(data);
                    $("select#staff_val").select2();
                $('#staff_id').show();
            });
            $('#priority_id').hide();
            $('#status_id').hide();
            $('#dept_id').hide();
            var card = document.getElementById("staff_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changepriority_', '');
            var action_type = 'staff_id';
            $('.validation-error-label').hide();
        } else {
            $('#dept_id').hide();
            $('#priority_id').hide();
            $('#status_id').hide();
            $('#staff_id').hide();
        }
        $('.modal-title').html(modal_title);
        var select = card.selectedIndex;
        console.log("select", select);

        var hidden_val = select;
        $('#hidden_value').val(hidden_val);
        $('#select_type').val(action_type);
    });
    $(function () {
        $("#change_action").submit(function (event) {
            // var card = document.getElementById("staff_val");
            // var select_data = card.selectedIndex;
            var url = $(this).attr('action');
             $('.loader').show();
            $.ajax({
                url: url,
                data: {form: $('#change_action').serialize()},
                type: $(this).attr('method')
            }).done(function (data) {
                if (data = 'success') {
                    $('#modal_theme_success').modal('hide');
                    $('#change_action')[0].reset();
                    $('#ticket_table').dataTable();
                    //$("#dept_val option[value='']").attr('selected', true)
                    $('#dept_val').val('');
                    $('#staff_val').val('');
                    $('#status_val').val('');
                    $('#priority_val').val('');
                    $('.loader').hide();
//                   window.location.reload();
                } else {
                }
            });
            event.preventDefault();
        });
    });
    var jconfirm = function (message, callback) {
        var options = {
            message: message
        };
        options.buttons = {
            cancel: {
                label: "No",
                className: "btn-default",
                callback: function (result) {
                    callback(false);
                }
            },
            main: {
                label: "Yes",
                className: "btn-primary",
                callback: function (result) {
                    callback(true);
                }
            }
        };
        bootbox.dialog(options);
    };
    var base_url = '<?php echo base_url(); ?>admin/';
    $(document).on('click', '.delete', function () {
        console.log('here');
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'tickets/delete';
        jconfirm("Do you really want to delete this record?", function (r) {
            if (r) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id, type: 'tickets'},
                    success: function (data) {
                        console.log("data", data);
                        console.log(data.status);
                        console.log(data.msg);
                        console.log(data.id);
                        if (data.status == 1) {
                            window.location.reload();
                        } else if (data.status == 0) {
                        }
                    }
                });
            }
        });
    });
</script>
