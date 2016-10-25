<?php
$segment = $this->uri->segment(3);
?>
<!-- Table header styling -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Tickets List</h5>

        <div class="heading-elements">
            <ul class="icons-list">               
                <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/tickets/add'"><i class="icon-user-plus position-left"></i>Add New Ticket</button>
                <!--<li><a data-action="collapse"></a></li>-->
            </ul>
        </div>

    </div>
    <div class="panel-body">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped datatable-basic">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Title</th>
                            <th>Tenant</th>
                            <th>Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                            <th>Quick Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tickets as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $record['title']; ?></td>
                                <td><?php echo $record['fname'] . ' ' . $record['lname']; ?></td>
                                <td><?php echo $record['type_name']; ?></td>
                                <td><?php echo $record['priority_name']; ?></td>
                                <td><?php echo $record['status_name']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($record['created'])); ?></td>
                                <td>
                                    <ul class="icons-list">
                                        <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/tickets/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                        <li class="text-danger-600">
                                            <a id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" class="delete"><i class="icon-trash"></i></a>
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
                                                       data-href="admin/tickets/changeAction" data-modal-title="Change Department"><i class="icon-collaboration"></i>Change department</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="status" class="chang_pwdd" id="changestatus_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>"
                                                       data-href="admin/tickets/changeAction" data-modal-title="Change Status"><i class="icon-stats-bars2"></i>Change status</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="priority" class="chang_pwdd" id="changepriority_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                       data-href="admin/tickets/changeAction" data-modal-title="Change Priority"><i class="icon-list-numbered"></i>Change priority</a></li>
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
<!-- /table header styling -->

<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <form id="change_department" class="form-validate" method="post">
                <div id='ret'></div>
                <div class="modal-body panel-body login-form" id="password_form" >
                    <div class="form-group" id="dept_id" style="display:none">
                        <select class="select"  name="dept_id" required="">
                            <option selected="" value="">Select Department</option> 
                            <?php
                            foreach ($departments as $row) {
                                echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>   
                    <div class="form-group" id="status_id" style="display:none">
                        <select class="select"  name="status_id" required="">
                            <option selected="" value="">Select Status</option> 
                            <?php
                            foreach ($statuses as $row) {
                                echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="priority_id" style="display:none">
                        <select class="select"  name="priority_id" required="">
                            <option selected="" value="">Select Priority</option> 
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
        $(document).on('click', 'a.chang_pwdd', function () {
            var modal_title = $(this).attr('data-modal-title');
            var action = $(this).attr('data-act');
            if (action == 'dept') {
                $('#dept_id').show();
                $('#priority_id').hide();
                $('#status_id').hide();
                var url = $(this).attr('data-href');
                var id = $(this).attr('id').replace('changedept_', '');
                var action_type = 'dept';
                $('.validation-error-label').hide();
//                $("#save_action").live('click', function(){
//                    $.ajax({
//                        type: 'POST',
//                        url: url,
//                        async: false,
//                        dataType: 'JSON',
//                        data: {id: id, action_type: action_type},
//                        success: function (data) {
//                            console.log(data);
//
//                        }
//                    });
//                });


            } else if (action == 'status') {
                $('#dept_id').hide();
                $('#priority_id').hide();
                $('#status_id').show();
                var url = $(this).attr('data-href');
                var id = $(this).attr('id').replace('changestatus_', '');
                var action_type = 'status';
                $('.validation-error-label').hide();
//                $("#save_action").live('click', function(){
//                    $.ajax({
//                        type: 'POST',
//                        url: url,
//                        async: false,
//                        dataType: 'JSON',
//                        data: {id: id, action_type: action_type},
//                        success: function (data) {
//                            console.log(data);
//
//                        }
//                    });
//                });
            } else if (action == 'priority') {
                $('#priority_id').show();
                $('#status_id').hide();
                $('#dept_id').hide();
                var url = $(this).attr('data-href');
                var id = $(this).attr('id').replace('changepriority_', '');
                var action_type = 'priority';
                $('.validation-error-label').hide();
//                $("#save_action").live('click', function(){
//                    $.ajax({
//                        type: 'POST',
//                        url: url,
//                        async: false,
//                        dataType: 'JSON',
//                        data: {id: id, action_type: action_type},
//                        success: function (data) {
//                            console.log(data);
//
//                        }
//                    });
//                });

            } else {
                $('#dept_id').hide();
                $('#priority_id').hide();
                $('#status_id').hide();
            }

            $('.modal-title').html(modal_title);
//            $("#change_department").submit(function (event) {
//               
//                $.ajax({
//                    type: 'POST',
//                    url: url,
//                    async: false,
//                    dataType: 'JSON',
//                    data: {id: id, action_type: action_type},
//                    success: function (data) {
//                        console.log(data);
//
//                    }
//                });
////            }
//                event.preventDefault();
//            });

            $("#save_action").click(function() {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id, action_type: action_type},
                    success: function (data) {
                        console.log(data);

                    }
                });
            });
        });
        
        
        
        $(function () {
            $("#change_transaction").submit(function (event) {
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: {form: $('#change_transaction').serialize()},
                    type: $(this).attr('method')
                }).done(function (data) {
                    if (data = 'success') {
                        $('#modal_theme_success').modal('hide');
                        $('#password_field').val('');
                        $('#labelpaas').hide();
                    } else {

                    }
                });
                event.preventDefault();
            });
        });</script>

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
            var url = base_url + 'delete';
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
                                $("div.div_alert_error").addClass('alert-success');
                                $('a.delete[data-record="' + data.id + '"]').closest('tr').remove();
                            } else if (data.status == 0) {
                                $("div.div_alert_error").addClass('alert-danger');
                            }
                            $("p.alert_error_msg").text(data.msg);
                            $("div.div_alert_error").show();
                        }
                    });
                }
            });
        });
    </script>