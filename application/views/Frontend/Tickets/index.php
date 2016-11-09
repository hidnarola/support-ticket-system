<!--<script type="text/javascript" src="assets/admin/js/plugins/notifications/bootbox.min.js"></script>-->
<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">
                <div class="row">
                    <a class="button button-rounded button-reveal button-small pull-right" onclick="window.location = 'tickets/add'"><i class="icon-plus-sign"></i><span>Add Ticket</span></a>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>State</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($tickets as $key => $record) {
                                    ?>
                                    <tr>
                                        <td><?php echo $record['title']; ?></td>
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
                                            <!--<button class='btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete"><span class="fa fa-times"></span> delete</button>-->
                                            <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-sm1" id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" class="delete" title='Delete Ticket'><i class="icon-trash2"></i></a>
                                            <a href="<?php echo base_url() . 'tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye-open" style="font-size: 16px;"></i></a>
                                            <a href="<?php echo base_url() . 'tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" title='Reply Ticket' class="reply"><i class="icon-envelope2"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="line visible-xs-block"></div>

            <?php $this->load->view('frontend/User/rightsidebar'); ?>


        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm1" id="confirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Dialogue</h4>
                </div>
                <div class="modal-body">
                    <p class="nobottommargin"> Do you really want to delete this ticket?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#datatable1').DataTable();


//        $('.delete').on('click', function (e) {
//            $('#confirm')
//                    .modal({backdrop: 'static', keyboard: false})
//                    .one('click', '#delete', function (e) {
//                        //delete function
//                        alert('here');
//                    });
//        });
    });
</script>
<script type="text/javascript">
//    var jconfirm = function (message, callback) {
//        var options = {
//            message: message
//        };
//        options.buttons = {
//            cancel: {
//                label: "No",
//                className: "btn-default",
//                callback: function (result) {
//                    callback(false);
//                }
//            },
//            main: {
//                label: "Yes",
//                className: "btn-primary",
//                callback: function (result) {
//                    callback(true);
//                }
//            }
//        };
//        bootbox.dialog(options);
//    };
    var base_url = '<?php echo base_url(); ?>';
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'tickets/delete';
        $('#delete').on('click', function (e) {
            alert('xvcx');
//            $.ajax({
//                type: 'POST',
//                url: url,
//                async: false,
//                dataType: 'JSON',
//                data: {id: id, type: type},
//                success: function (data) {
//                    if (data.status == 1) {
//                        window.location.reload();
//                    } else if (data.status == 0) {
//                    }
//                }
//            });

        });
    });
</script>