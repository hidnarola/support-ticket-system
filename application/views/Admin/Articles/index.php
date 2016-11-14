<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<?php
$segment = $this->uri->segment(1);
?>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
                <div class="pull-right">
                    <a onclick="window.location = 'admin/articles/add'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Article</a>
                </div>
            </div>
        </div>
        <style>/* #ticket_table .dataTables_length {margin: 5px 0 20px 20px;} */</style>
        <div class="panel-body">
            <div class="row">
                <!--<div class="table-responsive ticket_table">-->
                <table class="table datatable-basic">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Visible</th>
                            <th>Created At</th>
                            <th style="width:12%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($articles as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $record['title']; ?></td>
                                <td><?php echo $record['cat_name']; ?></td>                              
                                <?php if ($record['is_visible'] == 0) { ?>
                                    <td><span class="label label-success">Yes</span></td>
                                <?php } else { ?>
                                    <td><span class="label label-warning">No</span></td>
                                <?php } ?>
                                <td><?php echo date('Y-m-d', strtotime($record['a_created'])); ?></td>
                                <td>
                                    <ul class="icons-list">
                                        <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/articles/edit/' . base64_encode($record['aid']) ?>" id="edit_<?php echo base64_encode($record['aid']); ?>" title='Edit Article' class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                        <li class="text-purple-700">
                                            <a href="<?php echo base_url() . 'admin/articles/view/' . base64_encode($record['aid']); ?>" id="view_<?php echo base64_encode($record['aid']); ?>" data-record="<?php echo base64_encode($record['aid']); ?>" title='View Article' class="view"><i class="icon-eye"></i></a>
                                        </li>

                                        <li class="text-danger-600">
                                            <a id="delete_<?php echo base64_encode($record['aid']); ?>" data-record="<?php echo base64_encode($record['aid']); ?>" title='Delete Article' class="delete"><i class="icon-trash"></i></a>
                                        </li>
                                    </ul>
                                </td>
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

<script type="text/javascript">
    $(function () {
        $('.datatable-basic').DataTable();
    });
    
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
            var url = base_url + 'articles/delete';
            jconfirm("Do you really want to delete this record?", function (r) {
                if (r) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        async: false,
                        dataType: 'JSON',
                        data: {id: id, type: type},
                        success: function (data) {
                            if (data.status == 1) {
                                window.location.reload();
                            } else if (data.status == 0) {
                            }
                        }
                    });
                }
            });
        });
</script> 