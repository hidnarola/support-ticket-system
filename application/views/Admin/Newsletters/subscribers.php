<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-newspaper2"></i> <span class="text-semibold">Newsletter Subscribers</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Newsletter Subscribers</li>
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
            <a href="<?php echo site_url('admin/subscribers/add'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-newspaper2"></i></b> Add Subscriber</a>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr class="bg-teal">
                    <th>Sr No.</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($subscribers as $subscriber) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></th>
                        <td><?php echo $subscriber['email']; ?></td>
                        <td><?php echo date('F j, Y', strtotime($subscriber['created'])); ?></td>
                        <td>
                            <!-- <a href="admin/newsletters/edit/<?php echo $subscriber['id']; ?>" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a>
                                                   <a href="admin/newsletters/settings/<?php echo $subscriber['id']; ?>" class="btn border-brown text-brown-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-gear"></i></a> -->
                            <a href="admin/subscribers/delete/<?php echo $subscriber['id']; ?>" class="btn border-danger text-danger-600 btn-flat btn-icon btn-rounded btn-sm" onclick="return confirm_alert(this);"><i class="icon-cross2"></i></a>

                        </td>
                        <!-- <td>
                        <?php
                        /*
                          if($newsletter['setting_id'] != null && $newsletter['content'] != ''){ ?>
                          <a href="admin/newsletters/send/original/<?php echo $newsletter['id']; ?>" class="btn border-success text-success-600 btn-flat btn-icon btn-sm" target="_blank" onclick="return confirm_alert_for_send_newsletter(this);">Send</a>
                          <?php } else { ?>
                          <span class="label bg-brown">No content</span>
                          <?php } */
                        ?>
                        </td>
                        <td>Test Newsletter</td> -->
                    </tr>
                    <?php $i++;
                }
                ?>
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
            text: "You will not be able to recover this subscriber!",
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