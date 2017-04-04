<!--<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>-->
<script type="text/javascript" src="assets/admin/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/uploader_bootstrap.js"></script>
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
    <div class="panel panel-flat">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <form method="post" id="bulk_upload_form" enctype="multipart/form-data" action="admin/properties/property/bulk_add"> 
                <div style="background-color:#ddd;border:2px dashed #ccc;padding-bottom:4%">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-4">
                            <h4><i><b>From Here you can add new properties</b></i></h4>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-1 text-center">
                            <div class="panel border-right-lg border-right-primary invoice-grid timeline-content">
                                <div class="panel-body" style="padding:43px">
                                    <h5><i>From here you can add single property</i></h5>
                                    <a href='admin/properties/property/add' class="btn btn-primary btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Property</a>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1" style="text-align: center"><span style="font-size: 1.6em;padding: 50px 0px;display: inline-block;"><i>OR</i></span></div>
                        <div class="col-md-5">
                            <div class="panel border-left-lg border-left-primary invoice-grid timeline-content">
                                <div class="panel-body">
                                    <h5 class="text-center"><i>From here you can do bulk upload</i></h5>
                                    <input type="file" class="file-styled-primary" name="upload_csv" id="upload_csv"> 
                                    <code><a href="./uploads/csv/bulk_demo.csv" style="text-align: left">Click Here</a> , to get a CSV format.</code>
                                    <button type="submit" class="btn btn-primary pull-right" style="margin-top:10px;border-radius: 2px">Upload<i class="icon-arrow-up13 position-right"></i></button>                                    
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 col-md-offset-1 text-center">
                            <h5><i>From here you can add single property</i></h5>
                            <a href='admin/properties/property/add' class="btn btn-primary btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Property</a>    
                        </div>
                        <div class="col-md-1"><span style="font-size: 1.6em;margin-left:18%"><i>OR</i></span></div>
                        <div class="col-md-4">
                            <h5><i>From here you can do bulk upload</i></h5>
                             <input type="file" class="file-styled-primary" name="upload_csv" id="upload_csv">
                            <span class="help-block"><code>You can upload here .CSV file.</code></span>
                        </div>
                        <div class="col-md-1">
                            <h5 style="color:#ddd">dfd</h5>
                            <button type="submit" class="btn btn-primary">Upload<i class="icon-arrow-up13 position-right"></i></button>
                        </div> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <!-- <div class="panel-heading tic-listing">
            <div class="col-md-12"> 
                <div class="pull-right">
                    <a href='admin/properties/property/add' class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Property</a>
                </div>
            </div>
        </div> -->
       
        <div class="panel-body">
            <div class="row">
                <!--<div class="table-responsive ticket_table">-->
                <table class="table datatable-basic" id="ticket_table">
                    <thead>
                        <tr class="bg-teal">
                            <th>#</th>
                            <th>Reference No.</th>
                            <th>Image</th>
                            <th style="width:30%;">Title</th>
                            <th style="width:15%;">Price (AED)</th>
                            <th style="width:18% !important;">Area (Sq. ft)</th>
                            <th style="width:10%;">BHK</th>
                            <th style="width:5%;">Featured</th>
                            <th style="width:5%;">Status</th>
                            <th style="width:2%;">Created</th>
                            <th style="width:5%;text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($property_list as $key => $record) { ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $record['reference_number']; ?></td>
                                <td>
                                    <?php
                                        $img = explode(",",$record['images']);
                                    ?>
                                    <img src="<?php echo PROPERTY_THUMB_IMAGE.'/'.$img[0]; ?>" class="img-sm">
                                </td>
                                <td><?php echo substr($record['title'],0,30); ?></td>
                                <td><?php echo number_format($record['price']); ?></td>
                                <td><?php echo number_format($record['area']); ?></td>
                                <td><?php echo "<b>Bed : </b>".$record['bedroom_no']."<br><b>Bath : </b>".$record['bathroom_no']; ?></td>
                                <td class="text-center">
                                    <?php 
                                        if($record['is_featured']=='1'){
                                            echo "<span class='label label-primary'>YES</span>";
                                        }else{
                                            echo "<span class='label label-default'> NO </span>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if($record['status']=='Active'){
                                            echo "<span class='label label-success'>ACTIVE</span>";
                                        }else{
                                            echo "<span class='label label-danger'>INACTIVE</span>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo date('Y-m-d', strtotime($record['created'])); ?></td>
                                <td>
                                    <ul class="icons-list">
                                        <li class="text-teal-600">
                                            <a href="<?php echo base_url() . 'admin/properties/property/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>" title='Edit Property' class="edit"><i class="icon-pencil7"></i></a>
                                        </li>
                                        <li class="text-purple-700">
                                            <a href="<?php echo base_url() . 'admin/properties/property/view/' . base64_encode($record['id']); ?>" id="view_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='View Property' class="view"><i class="icon-eye"></i></a>
                                        </li>
                                        <li class="text-danger-600">
                                            <a id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" title='Delete Property' class="delete"><i class="icon-trash"></i></a>
                                        </li>
                                        <!-- <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="dept" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>" data-dept="<?php echo $record['dept_id']; ?>"
                                                       data-modal-title="Change Department"><i class="icon-collaboration"></i>Change department</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="status" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>"  data-status="<?php echo $record['status_id']; ?>"
                                                       data-modal-title="Change Status"><i class="icon-stats-bars2"></i>Change status</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="priority" class="chang_pwdd" id="changedept_<?php echo base64_encode($record['id']); ?>" data-priority="<?php echo $record['priority_id']; ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                       data-modal-title="Change Priority"><i class="icon-list-numbered"></i>Change priority</a></li>
                                                <li><a data-dept="<?php echo $record['dept_id']; ?>" href="#" data-toggle="modal" data-target="#modal_theme_success" data-act="assign" class="chang_pwdd" id="assign_<?php echo base64_encode($record['id']); ?>" data-staff="<?php echo $record['staff_id']; ?>" data-record="<?php echo base64_encode($record['id']); ?>" 
                                                       data-modal-title="Assign Staff"><i class="icon-user"></i><?php echo ($record['staff_id'] != '') ? 'Change' : 'Assign'; ?> Staff</a></li>
                                            </ul>
                                        </li> -->
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

<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title"></h6>
            </div>
            <form id="change_action" class="form-validate" novalidate method="post" action="admin/tickets/changeAction">
                <input type="hidden" id="hidden_value" name="hidden_value" value=""/>
                <input type="hidden" id="select_type" name="select_type" value=""/>
                <input type="hidden" id="hidden_id" name="hidden_id" value=""/>
                <div id='ret'></div>
                <div class="modal-body panel-body login-form" id="password_form" >
                    <div class="form-group" id="dept_id" style="display:none">
                        <select class="select" id="dept_val" name="dept_id" required="">
                            <option value="">Select Department</option> 
                            <?php
                            foreach ($departments as $row) {
                                echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>   
                    <div class="form-group" id="status_id" style="display:none">
                        <select class="select" id="status_val" name="status_id" required="">
                            <option value="">Select Status</option> 
                            <?php
                            foreach ($statuses as $row) {
                                echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="priority_id" style="display:none">
                        <select class="select" id="priority_val" name="priority_id" required="">
                            <option value="">Select Priority</option> 
                            <?php
                            foreach ($priorities as $row) {
                                echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="staff_id" style="display:none">
                        <select class="select" id="staff_val" name="staff_id" required="">
                            <option value="">Select Staff</option> 
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-teal legitRipple" id="save_action">Save changes <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /success modal -->
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
    $(function () {
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
    });

    var base_url = '<?php echo base_url(); ?>admin/';
    $(document).on('click', 'a.chang_pwdd', function () {
        var modal_title = $(this).attr('data-modal-title');
        var action = $(this).attr('data-act');
        var url = base_url + 'tickets/changeAction';
        // var id = $(this).attr('id').replace('changedept_', '');
        var id = $(this).attr('data-record');
        $('#hidden_id').val(id);
        if (action == 'dept') {
            selected = $(this).attr('data-dept');
            $("#dept_val").val(selected);
            $("#dept_val").select2();
            $('#dept_id').show();
            $('#staff_id').hide();
            $('#priority_id').hide();
            $('#status_id').hide();
            //                var id = $(this).attr('id').replace('changedept_', '');
            var action_type = 'dept_id';
            $('.validation-error-label').hide();
            var card = document.getElementById("dept_val");
            var select_data = card.selectedIndex;
            var selected = '';
        } else if (action == 'status') {
            selected = $(this).attr('data-status');
            $("#status_val").val(selected);
            $("#status_val").select2();
            $('#dept_id').hide();
            $('#staff_id').hide();
            $('#priority_id').hide();
            $('#status_id').show();
            var card = document.getElementById("status_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changestatus_', '');
            var action_type = 'status_id';
            $('.validation-error-label').hide();
        } else if (action == 'priority') {
            selected = $(this).attr('data-priority');
            $("#priority_val").val(selected);
            $("#priority_val").select2();
            $('#priority_id').show();
            $('#staff_id').hide();
            $('#status_id').hide();
            $('#dept_id').hide();
            var card = document.getElementById("priority_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changepriority_', '');
            var action_type = 'priority_id';
            $('.validation-error-label').hide();

        } else if (action == 'assign') {
            selected = $(this).attr('data-staff');

            $("#staff_val").val(selected);
            $("#staff_val").select2();
            var dept = $(this).attr('data-dept');
            $.ajax({
                url: 'admin/dashboard/get_staff',
                data: {'dept': dept},
                type: 'post',
            }).done(function (data) {
                console.log(data);
                $("select#staff_val").html(data);
                $("select#staff_val").select2();
                $('#staff_id').show();
            });
            $('#priority_id').hide();
            $('#status_id').hide();
            $('#dept_id').hide();
            var card = document.getElementById("staff_val");
            var select_data = card.selectedIndex;
            //                var id = $(this).attr('id').replace('changepriority_', '');
            var action_type = 'staff_id';
            $('.validation-error-label').hide();
        } else {
            $('#dept_id').hide();
            $('#priority_id').hide();
            $('#status_id').hide();
            $('#staff_id').hide();
        }
        $('.modal-title').html(modal_title);
        var select = card.selectedIndex;
        console.log("select", select);
        var hidden_val = select;
        $('#hidden_value').val(hidden_val);
        $('#select_type').val(action_type);
    });
    $(function () {
        $("#change_action").submit(function (event) {
            // var card = document.getElementById("staff_val");
            // var select_data = card.selectedIndex;
            var url = $(this).attr('action');
            $('.loader').show();
            $.ajax({
                url: url,
                data: {form: $('#change_action').serialize()},
                type: $(this).attr('method')
            }).done(function (data) {
                if (data = 'success') {
                    $('#modal_theme_success').modal('hide');
                    $('#change_action')[0].reset();
                    $('#ticket_table').dataTable();
                    //$("#dept_val option[value='']").attr('selected', true)
                    $('#dept_val').val('');
                    $('#staff_val').val('');
                    $('#status_val').val('');
                    $('#priority_val').val('');

                    $('.loader').hide();


//                    window.location.reload();
                } else {
                }
            });
            event.preventDefault();
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
    var base_url = '<?php echo base_url(); ?>Admin/';
    var type = '<?php echo $this->uri->segment(2); ?>';
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'Properties/delete';
        jconfirm("Do you really want to delete this record?", function (r) {
            if (r) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id, type: 'property_listing'},
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
    function load_news(val) {
        if (val == '') {
            window.location = "admin/tickets";
        } else {
            window.location = "admin/tickets/index/" + val;
        }
    }
</script>
