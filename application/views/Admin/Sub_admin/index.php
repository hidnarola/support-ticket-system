<!--<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>-->
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/loaders/progressbar.min.js"></script>

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
    <?php $this->load->view('admin/message_view'); ?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <a href="admin/sub_admin/add" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add Sub Admin</a>
        </div>
       
        <div class="panel-body">
            <div class="row">
                <!--<div class="table-responsive ticket_table">-->
                <table class="table datatable-basic" id="subadmin_table">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($subadmins as $subadmin) { ?>
                            <tr class="">
                                <td><?php echo $i ?></td>
                                <td><?php echo $subadmin['fname'].' '.$subadmin['lname']; ?></td>
                                <td><?php echo $subadmin['created']; ?></td>
                                <td>
                                 <ul class="icons-list">
                                <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/sub_admin/edit/' . base64_encode($subadmin['id']) ?>" id="edit_<?php echo base64_encode($subadmin['id']); ?>" title='Edit' class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                        <li class="text-danger-600">
                                            <a href="<?php echo base_url() . 'admin/sub_admin/delete/' . base64_encode($subadmin['id']) ?>" id="delete_<?php echo base64_encode($subadmin['id']); ?>" data-record="<?php echo base64_encode($subadmin['id']); ?>" title='Delete' class="delete"><i class="icon-trash"></i></a>
                                        </li>
                                        </ul></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>

                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<!-- /table header styling -->

<style>
    .loading-image {background: #fff none repeat scroll 0 0;border-radius: 5px;left: 50%;padding: 10px;position: absolute;top: 50%;z-index: 10;}
    .loader{display: none;background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;bottom: 0;left:0;overflow: auto;position: fixed;right: 0;text-align: center;top: 0;z-index: 9999;}
    .table > tbody > tr > td {padding: 12px 18px;}
    .dataTables_wrapper {margin-top: 20px;}
</style>
<div class="loader">
    <center>
        <img class="loading-image" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
    </center>
</div>

<script type="text/javascript">
   $('.datatable-basic').dataTable({
//            scrollX: true,
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
//            order: [[2, "asc"]],
        });
   $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
</script>
