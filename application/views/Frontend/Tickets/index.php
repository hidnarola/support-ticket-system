<!--<script type="text/javascript" src="assets/admin/js/plugins/notifications/bootbox.min.js"></script>-->
<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">
                <?php
                if ($this->session->flashdata('success_msg')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success_msg'); ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($this->session->flashdata('error_msg')) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                    <?php
                }
                ?>


                <div class="row">
                    <div class="col-sm-3">
                        <?php $current = $this->uri->segment(3); ?>
                        <!-- <label class="control-label">Filter by Status</label> -->
                        <select class="select filter form-control" onchange="load_news(this.value);">
                            <option <?php echo ($current == '') ? 'selected' : ''; ?> value="">All</option>
                            <option <?php echo ($current == '3') ? 'selected' : ''; ?> value="3">Open</option>
                            <option <?php echo ($current == '5') ? 'selected' : ''; ?> value="5">Pending</option>
                            <option <?php echo ($current == '2') ? 'selected' : ''; ?> value="2">In Progress</option>
                            <option <?php echo ($current == '4') ? 'selected' : ''; ?> value="4">Paused</option>
                            <option <?php echo ($current == '1') ? 'selected' : ''; ?> value="1">Closed</option>
                        </select>
                    </div>
                    <div class="col-sm-9">

                        <a class="button button-rounded button-reveal button-small pull-right" onclick="window.location = 'tickets/add'"><i class="icon-plus-sign"></i><span>Add Ticket</span></a>
                    </div>
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
                                            <?php if ($record['status_name'] == 'close') { ?>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-sm1" id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" class="delete" title='Delete Ticket'><i class="icon-trash2"></i></a>
                                            <?php } ?>
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
    });
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000);

    var base_url = '<?php echo base_url(); ?>';
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'tickets/delete';
        $('#delete').on('click', function (e) {
            $.ajax({
                type: 'POST',
                url: url,
                async: false,
                dataType: 'JSON',
                data: {id: id},
                success: function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    } else if (data.status == 0) {
                    }
                }
            });
        });
    });
    function load_news(val) {
        if (val == '') {
            window.location = "tickets";
        } else {
            window.location = "tickets/index/" + val;
        }
    }
</script>