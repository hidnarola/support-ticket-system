<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold">Beacons</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Beacons</li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('Admin/message_view'); ?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading user-listing">
            <div class="col-md-12">

                <div class="col-md-offset-4 col-md-8">
                    <ul class="icons-list pull-right">
                        <a onclick="window.location = 'admin/beacons/add'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add new Beacon</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!--<div class="user_table">-->
            <table class="table datatable-basic" id="datatable-basic-users">
                <thead>
                    <tr class="bg-teal">
                        <th>#</th>
                        <th>Beacon Title</th>
                        <th>UUID</th>
                        <th>Major</th>
                        <th>Minor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($beacons as $key => $record) {
                        ?>
                        <tr class="">
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $record['beacon_name']; ?></td>
                            <td><?php echo $record['uuid']; ?></td>
                            <td><?php echo $record['major']; ?></td>
                            <td><?php echo $record['minor']; ?></td>
                            <td class="">
                                <ul class="icons-list">
                                    <li class="text-teal-600">
                                        <a href="<?php echo base_url() . 'admin/beacons/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                    </li>
                                    <li class="text-danger-600">
                                        <a id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" class="delete"><i class="icon-trash"></i></a>
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

<script>
    $(function () {
        $('.datatable-basic').dataTable({
            // scrollX: true,
            //scrollCollapse: true,
            autoWidth: false,
            processing: true,
            //serverSide: true,
            language: {
                search: '<span>Search:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
//            order: [[2, "asc"]],
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
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
        var url = base_url + 'beacons/delete';
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
                        }
                    }
                });
            }
        });
    });
</script>