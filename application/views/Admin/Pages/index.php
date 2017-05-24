<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold">Pages</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Pages</li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('Admin/message_view'); ?>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="pull-right">
                <a href="<?php echo site_url('admin/pages/manage'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add new page</a>
            </div>
        </div>
        <div class="panel-body" style="clear: both;">
            <div class="row">
                <table class="table datatable-basic">
                    <thead>
                        <tr class="bg-teal">
                            <th>Sr No.</th>
                            <th>Navigation Name</th>
                            <th>Title</th>
                            <th>Modified Date</th>
                            <th>Status</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pages as $key => $page) {
                            if($page['is_static'] == 0) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $page['navigation_name']; ?></td>
                                <td><?php echo $page['title']; ?></td>
                                <td><?php echo date('F j, Y', strtotime($page['created'])); ?></td>
                                <td><?php
                                    $status = '<span class="label bg-success">Active</span>';
                                    if ($page['active'] == '0') {
                                        $status = '<span class="label bg-grey">InActive</span>';
                                    }
                                    if ($page['active'] == '2') {
                                        $status = '<span class="label bg-danger">Deleted</span>';
                                    } echo $status
                                    ?></td>
                                <td>
                                    <?php if ($page['active'] == '1') { ?>

                                        <a href="admin/pages/manage/<?php echo $page['id']; ?>" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a>
                                    <?php } else {
                                        ?>
                                        <a href="admin/pages/activate/<?php echo $page['id']; ?>" class="btn border-success text-success-600 btn-flat btn-icon btn-rounded"><i class="icon-checkmark"></i></a>
                                        <?php } ?>
                                </td>
                            </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.datatable-basic').dataTable({
            scrollX:        true,
            scrollCollapse: true,
            autoWidth : false,  
            processing: true,
            //serverSide: true,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            order: [[2, "asc"]],
            
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
    });
</script>