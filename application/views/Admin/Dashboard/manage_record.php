<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <!--<li><a href="<?php echo site_url('admin'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> <?php echo $page; ?></a></li>-->
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-6">
            <form method="POST" class="form-horizontal form-validate manage_record" id="manage_record" name="manage_record">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php echo 'Manage ' . $record_type; ?></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" required="required">
                                <input type="hidden" name="record_id" id="record_id">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn bg-teal"><?php echo 'Save ' . $record_type; ?> <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><?php echo $record_type . ' List'; ?></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatable-basic">
                            <thead>
                                <tr class="bg-teal">
                                    <th>#</th>
                                    <th><?php echo $record_type . ' Name'; ?></th>
                                    <th>Action</th>
                                </tr>
                               <!--  <tr class="bg-teal">
                                   <th>Name</th>
                               </tr> -->
                            </thead>
                            <tbody>
                                <?php
                                foreach ($records as $key => $record) {
                                    ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $record['name']; ?></td>
                                        <td>
                                            <ul class="icons-list">
                                                <li class="text-teal-600">
                                                    <a id="edit_<?php echo base64_encode($record['id']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                                </li>
                                                <li class="text-danger-600">
                                                    <?php $url = urlencode("admin/delete/" . $this->uri->segment(3) . "/" . base64_encode($record['id'])); ?>
                                                    <a data-record="<?php echo base64_encode($record['id']); ?>" id="delete_<?php echo base64_encode($record['id']); ?>" class="delete"><i class="icon-trash"></i></a>
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
</div>
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>admin/';
    var type = '<?php echo $this->uri->segment(3); ?>';
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id').replace('edit_', '');
        var url = base_url + 'get_detail';
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            dataType: 'JSON',
            data: {id: id, type: type},
            success: function (data) {
                if (data.status == 1) {
                    var record = data.record[0];
                    //console.clear();
                    $('#name').val(record.name);
                    $('#record_id').val(record.id);
                }
            }
        });
    });
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'delete';
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
    });
</script>