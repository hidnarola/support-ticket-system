<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<div class="page-header page-header-default">
    
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold">Staff Members</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('staff'); ?>"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li class="active">Staff Members</li>
        </ul>
    </div>
</div>

<div class="content">

    <?php //$this->load->view('Admin/message_view'); ?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
       
            <div class="panel-body" style="clear: both;">

                <div class="user_table">
                    <table class="table datatable-basic" id="datatable-basic-users">
                        <thead>
                            <tr class="bg-teal">
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                
                                <th>Verified</th>
                                
                                <th>Action</th>

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
                                    
                                        
                                   
                                    <td><?php if ($record['is_verified'] == 0) { ?>
                                            <span class="label label-danger">Not Verified</span>
                                        <?php } else { ?>
                                            <span class="label label-success">Verified</span> 
                                        <?php }
                                        ?></td>
                                    
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="text-teal-600">
                                                <a href="<?php echo base_url() . 'staff/members/view/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" class="edit"><i class="icon-eye"></i></a>
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
    </style>
    <!-- /success modal -->
    <script>

        $(function () {
            $('#datatable-basic-users').DataTable();
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
       /* $(document).on('click', '.delete', function () {
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
        });*/

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

        

        /*$(document).on('click', '.chang_dept', function () {
         var id = $(this).attr('data-record');
         var url = base_url + 'users/change_dept';
         $.ajax({
         type: 'POST',
         url: url,
         async: false,
         dataType: 'JSON',
         data: {id: id},
         success: function (data) {
         window.location.reload();
         }
         });
         });*/
    </script>