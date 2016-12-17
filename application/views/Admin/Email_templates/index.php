<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-newspaper2"></i> <span class="text-semibold">Email Templates</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Email templates</li>
        </ul>
    </div>
</div>

<div class="content">
    <?php
    $this->load->view('Admin/message_view');
    echo validation_errors();
    ?>
    <div class="panel panel-flat">
        <div class="panel-heading text-right">
            <a href="<?php echo site_url('admin/email_templates/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add Email Template</a>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="bg-teal">
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Email Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $i=1;
             foreach ($templates as $template) { ?>
                <tr>
                    <td><?php echo $i; ?></th>
                    <td><?php echo $template['template_name']; ?></td>
                    <td><?php echo $template['email_subject']; ?></td>
                  
                    <td>
                        <a href="admin/email_templates/edit/<?php echo $template['id']; ?>" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a>
                    </td>
                    
                    <!-- <td>Test Newsletter</td> -->
                </tr>
            <?php 
            $i++;
                        } ?>
                
            </tbody>
        </table>
    </div>

</div>
<script>
    $(document).on('click', '.styled', function () {
        data_type = $(this).data('type');
        data_id = $(this).data('id');
        if ($(this).parent().attr('class') == 'checked') {
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
            data: {id: data_id, value: value},
            type: "POST",
            success: function (result) {
                swal("Success!", "Record successfully updated!", "success");
            }
        });
    });

    $(function () {
        $('.datatable-basic').dataTable({
            scrollX: true,
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