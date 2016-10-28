<?php
$segment = $this->uri->segment(3);
if ($segment == 'tenants')
    $seg = 'tenant';
else
    $seg = 'staff';
?>
<!-- Table header styling -->
<script type="text/javascript" src="assets/admin/js/plugins/notifications/pnotify.min.js"></script>	
<script type="text/javascript" src="assets/admin/js/pages/components_notifications_pnotify.js"></script>
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo $user_type; ?> List</h5>

        <div class="heading-elements">
            <ul class="icons-list">
                <?php if ($segment == 'tenants') { ?>
                    <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/users/add/tenant'"><i class="icon-user-plus position-left"></i>Add New Tenant</button>
                <?php } else { ?>
                    <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/users/add/staff'"><i class="icon-user-plus position-left"></i>Add New Staff</button> 
                <?php } ?>
                <!--<li><a data-action="collapse"></a></li>-->
            </ul>
        </div>

    </div>
    <div class="panel-body">

        <div class="table-responsive user_table">
            <table class="table table-bordered table-hover table-striped  datatable-basic" id="datatable-basic">
                <thead>
                    <tr class="bg-teal">
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <?php
                        $user = '';
                        foreach ($users as $key => $record) {
                            $user = $record['role_id'];
                        }
                        if ($user == 2) {
                            ?>
                            <th>Department</th>
                        <?php } else { ?>

                            <th>Address</th>
                        <?php } ?>
                        <th>Verified</th>
                        <th>Action</th>
                        <th>Quick Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $key => $record) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $record['fname']; ?></td>
                            <td><?php echo $record['lname']; ?></td>
                            <td><?php echo $record['email']; ?></td>
                            <?php if ($record['role_id'] == 2) { ?>
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
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="text-teal-600">
                                        <a href="<?php echo base_url() . 'admin/users/edit/' . $seg . '/' . base64_encode($record['uid']) ?>" id="edit_<?php echo base64_encode($record['uid']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                    </li>
                                    <li class="text-danger-600">
                                        <a id="delete_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" class="delete"><i class="icon-trash"></i></a>
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
                                            <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" class="chang_pwdd" id="changepwd_<?php echo base64_encode($record['uid']); ?>" data-record="<?php echo base64_encode($record['uid']); ?>" ><i class="icon-file-pdf"></i> Change Password</a></li>
    <!--                                            <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                            <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>-->
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
                        <label class="lblpassword" style="display: none" id='labelpaas'></label>
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
                <div class="pass-set">This User is not verified Yet!</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-teal legitRipple" id="save_pasword">Save changes <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /success modal -->
<script>
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
                            $('a.delete[data-record="' + data.id + '"]').closest('tr').remove();
                        } else if (data.status == 0) {
//                            $("div.div_alert_error").addClass('alert-danger');
                        }
                    }
                });
            }
        });
    });
    
    /* open modal click on quick action and get user's password */ 
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
</script>