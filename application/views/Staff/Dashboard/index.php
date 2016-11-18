<?php
$segment = $this->uri->segment(1);
?>
<div class="content">

    <!-- Main charts -->
    <div class="row dashboard_layout">

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
    

    <div class="panel">
    <div class="panel-heading">
        
    </div>
    <div class="panel-body">
        <div class="row">
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
                        <th>state</th>
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
                            <?php if ($record['is_read'] == 2 || $record['is_read'] == 3) { ?>
                                <td><span class="label label-success">Read</span></td>
                            <?php } else { ?>
                                <td><span class="label label-warning">Unread</span></td>
                            <?php } ?>
                            <td class="text-center">
                                <ul class="icons-list">

                                    <li class="text-purple-700">
                                        <a href="<?php echo base_url() . 'staff/tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye"></i> </a>
                                    </li>
                                    <li class="text-grey">
                                        <a href="<?php echo base_url() . 'staff/tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Reply' class="view"><i class="icon-reply"></i> </a>
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
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <form id="change_action" class="form-validate" method="post" action="staff/tickets/changeAction">
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
<script type="text/javascript">
$(function() {
        $('.datatable-basic').dataTable();
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
            $('#staff_id').hide();
            $('#priority_id').hide();
            $('#status_id').hide();
            //                var id = $(this).attr('id').replace('changedept_', '');
            var action_type = 'dept_id';
            $('.validation-error-label').hide();
            var card = document.getElementById("dept_val");
            var select_data = card.selectedIndex;
        } else if (action == 'status') {
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
            var dept = $(this).attr('data-dept');
             $.ajax({
                url: 'staff/dashboard/get_staff',
                data: {'dept':dept},
                type: 'post',
            }).done(function (data) {
                console.log(data);
                $("select#staff_val").html(data);
            });
            $('#staff_id').show();
            $('#priority_id').hide();
            $('#status_id').hide();
            $('#dept_id').hide();
            var card = document.getElementById("staff_val");
            var select_data = card.selectedIndex;
            //var id = $(this).attr('id').replace('changepriority_', '');
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
                    //$("#dept_val option[value='']").attr('selected', true)
                    $('#dept_val').val('');
                    $('#staff_val').val('');
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