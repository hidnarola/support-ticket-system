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
                                            <a href="#" class="" title='Delete Ticket'><i class="icon-trash2"></i></a>
                                            <a href="<?php echo base_url() . 'tickets/view/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="view"><i class="icon-eye-open"></i></a>
                                            <a href="<?php echo base_url() . 'tickets/reply/' . base64_encode($record['id']) ?>" id="view_<?php echo base64_encode($record['id']); ?>" title='View Ticket' class="reply"><i class="icon-reply"></i></a>
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
<script>
    $(document).ready(function () {
        $('#datatable1').DataTable();
    });
</script>