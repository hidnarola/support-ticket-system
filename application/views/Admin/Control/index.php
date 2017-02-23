<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="assets/admin/js/core/libraries/jquery_ui/touch.min.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/jqueryui_interactions.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold">Pages</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Pages</li>
        </ul>
    </div>
</div>
<div class="content">
    <?php
    $this->load->view('Admin/message_view');
    echo validation_errors();
    ?>
    <div class="panel panel-flat">
        <div class="panel-body" style="clear: both;">
            <table class="table datatable-basic">
                <thead>
                    <tr class="bg-teal">
                        <th>Sr No.</th>
                        <th>Navigation Name</th>
                        <th>Title</th>
                        <th>Parent Page</th>
                        <th>Display In Header</th>
                        <th>Display In Footer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pages as $key => $page) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $page['navigation_name']; ?></td>
                            <td><?php echo $page['title']; ?></td>
                            <td><?php echo date('F j, Y', strtotime($page['created'])); ?></td>
                            <td>
                                <?php if ($page['show_in_header'] == 0) { ?>
                                    <input type="checkbox" class="check_btn" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_header">

                                <?php } else { ?>
                                    <input type="checkbox" class="check_btn" checked="checked" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_header">
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($page['show_in_footer'] == 0) { ?>


                                    <input type="checkbox" class="check_btn" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_footer">


                                <?php } else { ?>
                                    <input type="checkbox" class="check_btn" checked="checked" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_footer">
                                <?php } ?>
                            </td>   
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php //$this->load->view('Templates/admin_footer'); ?>
</div>
<style>
    .datatable-scroll {overflow-x: hidden;}
</style>
<script>

    $(document).on('click', '.check_btn', function () {
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
            url: "<?php site_url() ?>Admin/Header_footer_control/change_data_status",
            data: {type: data_type, id: data_id, value: value},
            type: "POST",
            success: function (result) {
                swal("Success!", "Your changes was successfully arranged!", "success");
                //common_ajax_call();
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
            order: [[2, "asc"]],
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });
    });
    function common_ajax_call() {
        $.ajax({
            url: "<?php site_url() ?>admin/header_footer_control/get_header_footer",
            type: "POST",
            data: {type: 'header'},
            success: function (result) {
                data = JSON.parse(result);
                str = '';
                if (data != '') {
                    $.each(data, function (i, item) {
                        str += '<li class="ui-sortable-handle" id="' + item.id + '">' + item.navigation_name + '</li>';
                    });
                    $('#header_save').show();
                } else {
                    str += 'No header links found...';
                    $('#header_save').hide();
                }
                $('#header_sortable').html(str);
                $("#header_sortable").sortable();
            }
        });

        $.ajax({
            url: "<?php site_url() ?>admin/header_footer_control/get_header_footer",
            type: "POST",
            data: {type: 'footer'},
            success: function (result1) {
                data1 = JSON.parse(result1);
                str1 = '';
                if (data1 != '') {
                    $.each(data1, function (i1, item1) {
                        str1 += '<li class="ui-sortable-handle" id="' + item1.id + '">' + item1.navigation_name + '</li>';
                    });
                    $('#footer_save').show();
                } else {
                    str1 += 'No footer links found...';
                    $('#footer_save').hide();
                }
                $('#footer_soratable').html(str1);
                $("#footer_soratable").sortable();
            }
        });
    }

    function save_header_footer_arrangment(type) {
        if (type == 'header') {
            data = $('#header_sortable').sortable('toArray');
        } else {
            data = $('#footer_soratable').sortable('toArray');
        }
        $.ajax({
            url: "<?php site_url() ?>admin/header_footer_control/save_arrangement",
            type: "POST",
            data: {type: type, data: data},
            success: function (result1) {
                if (type == 'header')
                    swal("Success!", "Your header links was successfully arranged!", "success");
                else
                    swal("Success!", "Your footer links was successfully arranged!", "success");
            }
        });
    }
</script>