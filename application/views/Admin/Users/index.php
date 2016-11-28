<!--<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>-->
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<div class="page-header page-header-default">
    <?php
    $segment = $this->uri->segment(2);
    if ($segment == 'tenants')
        $seg = 'tenant';
    else
        $seg = 'staff';
    ?>
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo ($seg == 'tenant') ? 'Tenants' : 'Staff'; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo ($seg == 'tenant') ? 'Tenants' : 'Staff'; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('admin/message_view'); ?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading user-listing">
            <div class="col-md-12" style="padding-left: 0">
                <!-- <div class="heading-elements"> -->
                <?php if ($seg == 'staff') { ?>
                    <div class="col-md-3" style="padding-left: 0">
                        <form method="get">
                            <div class="form-group">
                                <label class="col-lg-2 control-label" style="padding-left: 0">Department</label>
                                <?php $get_dept = $this->input->get('department'); ?>
                                <div class="col-lg-10">
                                    <select name="department" class="form-control select" onchange="this.form.submit()">
                                        <option <?php echo ($get_dept == 'all') ? 'selected' : ''; ?> value="all">All</option>
                                        <?php foreach ($departments as $dept) { ?>
                                            <option <?php echo ($get_dept == $dept['name']) ? 'selected' : ''; ?> value="<?php echo $dept['name']; ?>"><?php echo $dept['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="row" style="margin-bottom: 10px;">
                        <?php } else { ?>
                            <div class="col-md-offset-4 col-md-8">
                            <?php } ?>
                            <ul class="icons-list pull-right">
                                <?php if ($seg == 'tenant') { ?>
                                    <a onclick="window.location = 'admin/users/add/tenant'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add new Tenant</a>
                                <?php } else { ?>
                                    <a onclick="window.location = 'admin/users/add/staff'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add new Staff</a>
                                <?php } ?>                               
                            </ul>
                            <?php if ($seg == 'staff') { ?>
                            </div>
                            <div class="row pull-right">
                                <p style="color: red;">*Highlighted rows represents Head Staff</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="clear: both;">
                <div class="user_table">
                    <table class="table datatable-basic" id="datatable-basic-users">
                        <thead>
                            <tr class="bg-teal">
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <?php
                                if ($seg == 'staff') { ?>
                                    <th>Department</th>
                                <?php } else { ?>
                                    <th>Address</th>
                                <?php } ?>
                                <th>Verified</th>
                                <?php if ($seg == 'tenant') { ?>
                                    <th>Status</th>
                                <?php } ?>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $key => $record) {
                                $is_head = '';
                                if ($seg == 'staff') {
                                    if ($record['is_head'] == 1) {
                                        $is_head = 'staff_head';
                                    }
                                }
                                ?>
                                <tr class="<?php echo $is_head; ?>">
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $record['fname']; ?></td>
                                    <td><?php echo $record['lname']; ?></td>
                                    <td><?php echo $record['email']; ?></td>
                                    <?php if ($seg == 'staff') { ?>
                                        <td><?php echo $record['name']; ?></td> 
                                    <?php } else { ?>
                                        <td><?php echo $record['address']; ?></td>
                                    <?php } ?>
                                    <td><?php if ($record['is_verified'] == 0) { ?>
                                            <span class="label label-danger">Not Verified</span>
                                        <?php } else { ?>
                                            <span class="label label-success">Verified</span> 
                                        <?php }
                                        ?></td>

                                    <?php if ($seg == 'tenant') { ?>
                                        <td><?php if ($record['status'] == 0) { ?>
                                                <span class="label bg-orange-600">Unapproved</span>
                                            <?php } else { ?>
                                                <span class="label bg-green-600">Approved</span> 
                                            <?php }
                                            ?></td>
                                    <?php } ?>

                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="text-teal-600">
                                                <a href="<?php echo base_url() . 'admin/users/edit/' . $seg . '/' . base64_encode($record['uid']) ?>" id="edit_<?php echo base64_encode($record['uid']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                            </li>
                                            <li class="text-danger-600">
                                                <a id="delete_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" class="delete"><i class="icon-trash"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" class="chang_pwdd" id="changepwd_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" ><i class="icon-pencil3"></i> Change Password</a></li>
                                                    <?php if ($seg == 'tenant') { ?>  
                                                        <li><a class="chang_status" data-status="<?php echo $record['status']; ?>" id="changestatus_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" ><i class="icon-pencil3"></i> Change Status</a></li>

                                                        <?php
                                                        if ($record['contract'] != '') {
                                                            ?>
                                                            <li><a target="_blank" class="view_contract" href="<?php echo USER_CONTRACT . '/' . $record['contract']; ?>" data-record="<?php echo base64_encode($record['uid']); ?>" ><i class="icon-eye"></i> View Contract</a></li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php if ($seg == 'staff') { ?>
                                                        <li><a class="assign_head" data-dept="<?php echo $record['dept_id']; ?>" data-action="<?php echo ($is_head) ? 'unassign' : 'assign'; ?>" id="assign_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" ><i class="icon-user"></i> <?php echo ($is_head) ? 'Unassign as Head Staff' : 'Assign as Head Staff'; ?></a></li>
                                                    <?php } ?>
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
</div>
<!-- /table header styling -->

<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Change Password</h6>
            </div>
            <form id="change_transaction"  method="post" action="admin/users/changePasswordAdmin">
                <div id='ret'></div>
                <div class="modal-body panel-body login-form" id="password_form">
                    <div class="form-group has-feedback">
                        <!--<label>User's Password: </label>-->
                        <button type="button" id='show_pwd_btn' class="btn btn-primary legitRipple">Show Password</button>
                        <!--<div class="user_password" id='user_password' style="display: none">-->
                        <label class="lblpassword" style="display: none;margin-left: 10px;" id='labelpaas'></label>
                        <!--</div>-->
                    </div>
                    <div class="form-group has-feedback">
                        <input value="" id="user_id" name='user_id' type="hidden">
                        <label>Password: </label>
                        <input class="form-control" name="password" required="required" id="password_field" type="password">
                        <div class="form-control-feedback">
                            <i class="icon-lock text-muted"></i>
                        </div>
                    </div>               
                    <div class="form-group login-options">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="checkbox-inline">
                                    <!--<input type="checkbox" class="styled" id="show_password" name="remember_me" value="1">-->
                                    <input type="checkbox" id="show_password" class="styled" onchange="document.getElementById('password_field').type = this.checked ? 'text' : 'password'">
                                    Show Password
                                </label>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="pass-set user_verified">This User is not verified Yet!</div>
                <div class="modal-footer">
                    <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-teal legitRipple" id="save_pasword">Save changes <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .user_verified{display: none;font-size: 18px;margin-left: 16px;margin-top: 10px;}
    .user_table .dataTables_length > label > span:first-child {margin: 7px 15px 8px 0;}
    .dataTables_length {margin: 12px 0 12px 20px;}
    .datatable-scroll {overflow-x: hidden;}
</style>
<!-- /success modal -->
<script>
$(function () {
        $('.datatable-basic').dataTable({
            scrollX: true,
            scrollCollapse: true,
            autoWidth: false,
            processing: true,
            //serverSide: true,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            order: [[2, "asc"]],
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
    });
    /* change password form (modal) submit */
    $(function () {
        $("#change_transaction").submit(function (event) {
            var url = $(this).attr('action');
            var pwd = $('#password_field').val();
            var id = $('#user_id').val();
            $.ajax({
                url: url,
                data: {pwd: pwd, id: id},
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

    /* delete record function */
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'users/delete';
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
                            //                            $("div.div_alert_error").addClass('alert-success');
                            //                            $('a.delete[data-record="' + data.id + '"]').closest('tr').remove();
                        } else if (data.status == 0) {
                            //                            $("div.div_alert_error").addClass('alert-danger');
                        }
                    }
                });
            }
        });
    });

    /* open modal click on quick action and get user's password */
    $(document).on('click', 'a.assign_head', function () {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-record');
        var dept = $(this).attr('data-dept');
        var url = base_url + 'users/assign_head';
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            dataType: 'JSON',
            data: {id: id, action: action, dept: dept},
            success: function (data) {
                window.location.reload();
            }
        });
    });
    $(document).on('click', 'a.chang_pwdd', function () {
        var id = $(this).attr('id').replace('changepwd_', '');
        $('#user_id').val(id);
        var url = base_url + 'users/getPassword';
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            dataType: 'JSON',
            data: {id: id},
            success: function (data) {
                console.log(data);
                if (data != 'error') {
                    $('#password_form').show();
                    $('#save_pasword').show();
                    $('#labelpaas').html(data);
                    $('.pass-set').hide();
                    //                    $('#user_id').val(id);
                } else {
                    $('#password_form').hide();
                    $('.pass-set').show();
                    $('#save_pasword').hide();
                }
                $('#show_pwd_btn').on('click', function () {
                    $('#labelpaas').show();
                });
            }
        });
    });

    $(document).on('click', '.chang_status', function () {
        var id = $(this).attr('id').replace('changestatus_', '');
        var status = $(this).attr('data-status');
        var jconmessage = '';
        if (status == 1) {
            jconmessage = "Do you really want to Unapprove this user?";
        } else {
            jconmessage = "Do you really want to Approve this user?";
        }
        var url = base_url + 'users/changeUserStatus';
        jconfirm(jconmessage, function (r) {
            if (r) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id, status: status},
                    success: function (data) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>