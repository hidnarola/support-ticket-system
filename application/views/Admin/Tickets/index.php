<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
        <script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<?php
$segment = $this->uri->segment(1);
?>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class;?> position-left"></i> <span class="text-semibold"><?php echo $title;?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
        </ul>
    </div>
</div>

<div class="content">
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <!--        <h5 class="panel-title">Tickets List</h5>-->
            <div class="col-md-2">
    <?php $current = $this->uri->segment(4); ?>
                    <!-- <label class="control-label">Filter by Status</label> -->
                    <select class="select filter" onchange="load_news(this.value);">
                        <option <?php echo ($current == '') ? 'selected' : ''; ?> value="">All</option>
                        <option <?php echo ($current == '3') ? 'selected' : ''; ?> value="3">Open</option>
                        <option <?php echo ($current == '5') ? 'selected' : ''; ?> value="5">Pending</option>
                        <option <?php echo ($current == '2') ? 'selected' : ''; ?> value="2">In Progress</option>
                        <option <?php echo ($current == '4') ? 'selected' : ''; ?> value="4">Paused</option>
                        <option <?php echo ($current == '1') ? 'selected' : ''; ?> value="1">Closed</option>
                    </select></div>
                    <div class="col-md-10">
            <div class="pull-right">
                <!-- <ul class="icons-list">                -->
                    <!--<li><a data-action="collapse"></a></li>-->
                    
                     <a onclick="window.location = 'admin/tickets/add'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Ticket</a>
                    <!--<button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/tickets/add'"><i class="icon-plus-circle2 position-left"></i>Add New Ticket</button>-->
                <!-- </ul> -->
            </div></div>
        </div>
        <style>/* #ticket_table .dataTables_length {margin: 5px 0 20px 20px;} */</style>
        <div class="panel-body">
            <div class="row">
                <!--<div class="table-responsive ticket_table">-->
                    <table class="table datatable-basic" id="ticket_table">
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
                                <th style="width:12%;text-align: center;">Actions</th>
                                <!--<th>Actions</th>-->
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
                                    <!--<td>ABC</td>-->
                                    <?php if ($record['is_read'] == 0) { ?>
                                        <td class="text-center"><span class="label label-warning">Unread</span></td>
                                    <?php } else { ?>
                                        <td  class="text-center"><span class="label label-success">Read</span></td>
                                    <?php } ?>
                                    <td>
                                        <ul class="icons-list">
                                            <li class="text-teal-600">
                                                <a href="<?php echo base_url() . 'admin/tickets/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" title='Edit Ticket' class="edit"><i class="icon-pencil7"></i></a>
                                            </li>
                                            <li class="text-purple-700">
                                                <a href="<?php echo base_url() . 'admin/tickets/view/' . base64_encode($record['id']) . '/' . $segment ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i></a>
                                            </li>
                                            <li class="text-grey">
                                                <a href="<?php echo base_url() . 'admin/tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i></a>
                                            </li>
                                            <li class="text-danger-600">
                                                <a id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Delete Ticket' class="delete"><i class="icon-trash"></i></a>
                                            </li>
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
<!--                                    <td class="text-center">
                                        <ul class="icons-list">
                                            
                                        </ul>
                                    </td>-->
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- /table header styling -->

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
    <!-- /success modal -->
    <script type="text/javascript">
        $(function() {
        $('#ticket_table').DataTable();
    });
        
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
    <script type="text/javascript">
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
        var type = '<?php echo $this->uri->segment(2); ?>';
        $(document).on('click', '.delete', function () {
            var id = $(this).attr('id').replace('delete_', '');
            var url = base_url + 'tickets/delete';
            jconfirm("Do you really want to delete this record?", function (r) {
                if (r) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: false,
                        dataType: 'JSON',
                        data: {id: id, type: type},
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

        function load_news(val) {
            if (val == '') {
                window.location = "admin/tickets";
            } else {
                window.location = "admin/tickets/index/" + val;
            }
        }
    </script>