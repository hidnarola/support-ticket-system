<!--<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>-->
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/loaders/progressbar.min.js"></script>

<?php $segment = $this->uri->segment(1); ?>
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
        <div class="panel-heading tic-listing">
            <div class="col-md-12"> 
                <div class="pull-right">
                    <a onclick="window.location = 'admin/properties/landing_banner/add'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Banner</a>
                </div>
            </div>
        </div>
       
        <div class="panel-body">
            <div class="row">
                <!--<div class="table-responsive ticket_table">-->
                <table class="table datatable-basic" id="ticket_table">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Image</th>
                            <th style="width:15%;">Reference No.</th>
                            <th style="width:30%;">Property Title</th>
                            <th style="width:5%;">Status</th>
                            <th style="width:5%;">Position</th>
                            <th style="width:2%;">Created</th>
                            <th style="width:5%;text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($landing_banner_list as $key => $record) { ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <?php
                                        $img = explode(",",$record['image']);
                                    ?>
                                    <img src="<?php echo PROPERTY_BANNER.'/'.$img[0]; ?>" class="img-sm">
                                </td>
                                <td><?php echo $record['reference_number']; ?></td>
                                <td><?php echo substr($record['prop_title'],0,40); ?></td>
                                <td>
                                    <?php 
                                        if($record['status']=='Active'){
                                            echo "<span class='label label-success'>ACTIVE</span>";
                                        }else{
                                            echo "<span class='label label-danger'>INACTIVE</span>";
                                        }
                                    ?>
                                </td>
                                <td style="display:inline-flex">
                                    <input type="text" class="form-control txt_position" id="txt_position_<?php echo $record['id']; ?>" name="txt_position_<?php echo $record['id']; ?>" value="<?php echo $record['position']; ?>" style="text-align: center">
                                    <a href="javascript:void(0)" onclick="update_position(<?php echo $record['id']; ?>)">
                                        <span class="icon-reset position_loader" id="position_reset-<?php echo $record['id']; ?>" onclick="position_edit('<?php echo $record['id']; ?>')"></span>
                                    </a>
                                    <img style="display:none" class="position_loader" id="position_loader-<?php echo $record['id']; ?>" src="assets/frontend/images/preloader@2x.gif" alt="loading..">
                                </td>
                                <td><?php echo date('Y-m-d', strtotime($record['created'])); ?></td>
                                <td>
                                    <ul class="icons-list">
                                        <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/properties/landing_banner/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" title='Edit Property' class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                        <li class="text-purple-700">
                                            <a href="<?php echo base_url() . 'admin/properties/landing_banner/view/' . base64_encode($record['id']); ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Property' class="view"><i class="icon-eye"></i></a>
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
<!-- /table header styling -->
<style>
    .position_loader{ width: 15px; height: 15px; margin: 10px !important; }
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
    $(function () {
        $('.datatable-basic').dataTable({
            scrollCollapse: true,
            autoWidth: false,
            processing: true,
            language: {
                search: '<span>Filter:</span> _INPUT_',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        });
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            width: 'auto'
        });

        $(".txt_position").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {

                e.preventDefault();
            }
        });
    });
</script>
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>admin/';
    
    function update_position(id=''){
        $('#position_reset-'+id).css('display','none');
        $('#position_loader-'+id).css('display','block');
        $.ajax({
            url: base_url + "Properties/update_banner_position",
            type: "POST",
            data: {id: id,position: $('#txt_position_'+id).val()},
            success: function (response) {
                $('#position_reset-'+id).css('display','block');
                $('#position_loader-'+id).css('display','none');
            }
        });
    }

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
    
    var type = '<?php echo $this->uri->segment(2); ?>';
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'tickets/delete';
        jconfirm("Do you really want to delete this record?", function (r) {
            if (r) {
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
                            window.location.reload();
                        } else if (data.status == 0) {
                        }
                    }
                });
            }
        });
    });
</script>
