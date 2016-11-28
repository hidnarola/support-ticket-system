<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-newspaper2"></i> <span class="text-semibold">Newsletters</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Newsletters</li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    echo validation_errors();
}
?>
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading text-right">
            <a href="<?php echo site_url('admin/newsletters/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-newspaper2"></i></b> Add newsletter</a>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Created Date</th>
                    <th>Is auto</th>
                    <th>Action</th>
                    <th>Send Newsletter</th>
                    <th>Test Newsletter</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
             foreach ($newsletters as $newsletter) { ?>
                <tr>
                    <td><?php echo $i; ?></th>
                    <td><?php echo $newsletter['title']; ?></td>
                    <td><?php echo date('F j, Y',strtotime($newsletter['created_date'])); ?></td>
                    <td><?php 
                            $status = '';
                        if($newsletter['is_auto'] != '' && $newsletter['is_auto'] != 0 && $newsletter['is_auto'] != null){
                            $status = '<span class="label bg-success">Is Auto</span>';
                        } else {
                            $status = '<span class="label bg-grey">Is not Auto</span>';
                        }
                        echo $status;

                    ?></td>
                    <td>
                        <a href="admin/newsletters/edit/<?php echo $newsletter['id']; ?>" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a>
                       <a href="admin/newsletters/settings/<?php echo $newsletter['id']; ?>" class="btn border-brown text-brown-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-gear"></i></a>
                        <a href="admin/newsletters/delete/<?php echo $newsletter['id']; ?>" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded btn-sm" onclick="return confirm_alert(this);"><i class="icon-cross2"></i></a>
                    
                    </td>
                    <td>
                        <?php 
                         
                        if($newsletter['setting_id'] != null && $newsletter['content'] != ''){ ?>
                           <a href="admin/newsletters/send/original/<?php echo $newsletter['id']; ?>" class="btn border-success text-success-600 btn-flat btn-icon btn-sm" target="_blank" onclick="return confirm_alert_for_send_newsletter(this);">Send</a>
                        <?php } else { ?>
                            <span class="label bg-brown">No content</span>
                        <?php }
                        ?>
                    </td>
                    <td>Test Newsletter</td>
                </tr>
            <?php } ?>
                
            </tbody>
        </table>
    </div>
    
</div>
<script>
    $(document).on('click','.styled', function () {
        data_type = $(this).data('type');
        data_id = $(this).data('id');
        if($(this).parent().attr('class') == 'checked') {
            $(this).parent().removeClass('checked');
            $(this).prop('checked', false);
            value = 0;
        }
        else {
            $(this).parent().addClass('checked');
            $(this).prop('checked', true);
            value = 1;
        }

        $.ajax({
            url: "<?php site_url() ?>admin/newsletters/change_data_status",
            data: { id : data_id, value : value},
            type : "POST",
            success: function(result){
                swal("Success!", "Record successfully updated!", "success");
            }
        });
    });

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
    
    function confirm_alert(e) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this newsletter!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Yes, delete it!"
        },
        function (isConfirm) {
            if (isConfirm) {
                window.location.href = $(e).attr('href');
                return true;
            }
            else {
                return false;
            }
        });
        return false;
    }

    function confirm_alert_for_send_newsletter(e) {
        swal({
            title: "Are you sure you want to send newsletter?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF7043",
            confirmButtonText: "Yes, send it!"
        },
        function (isConfirm) {
            if (isConfirm) {
                window.open($(e).attr('href'), '_blank');
                return true;
            }
            else {
                return false;
            }
        });
        return false;
    }
</script>