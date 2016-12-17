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
    <?php $this->load->view('Admin/message_view'); ?>
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
                                        <li>
                                            <button data-id="<?php echo $subadmin['id']; ?>" id="get_notifications" class="label bg-success heading-text">Manage Email Notifications</button>    
                                        </li>
                                    </ul>
                                </td>
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
<!-- Success modal -->
<div id="notifications_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Manage Email Notifications</h6>
            </div>
        <form method="post" id="notifications_frm" action="admin/sub_admin/set_notifications">
            <div class="modal-body panel-body login-form" >
                <input type="hidden" name="subadmin_id" id="subadmin_id" value="">
                <?php foreach ($email_notifications as $noti) { ?>
                <div class="col-md-4">
                   <div class="checkbox">
                        <label>
                            <input type="checkbox" value="<?php echo $noti['id']; ?>" name="email_notifications[]">
                            <?php echo $noti['name']; ?>
                        </label>
                    </div>
                </div>
               <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-teal legitRipple">Submit</button>
                <button type="button" class="btn bg-teal legitRipple" data-dismiss="modal">Close</button>
            </div>          
            </form>

        </div>
    </div>
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

        $("#get_notifications").click(function(){
            var id = $(this).attr('data-id');
            var base_url = "<?php echo base_url(); ?>";
            var controller = "admin/sub_admin";
            $("form#notifications_frm").find("#subadmin_id").val(id);
            $("form#notifications_frm").find('input[type="checkbox"]').prop('checked',false);
            $.ajax({
                url: base_url + controller + '/get_subadmin_email_notifications',
                type: 'POST',
                data: {subadmin_id: id},
                dataType: 'JSON',
                success: function(response) {
                    for (var i = 0; i < response.length; i++) {
                        var notification_id = response[i];
                        $("form#notifications_frm").find('input[type="checkbox"]').each(function(){
                            if($(this).val() == notification_id){
                                $(this).prop('checked', true);
                            }
                        });
                    }
                    $("#notifications_modal").modal();

                }, error: function(error) {
                    console.log('here');
                }
            });
        });

</script>
