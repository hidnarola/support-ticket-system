<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <!--<li><a href="<?php echo site_url('admin'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> <?php echo $page; ?></a></li>-->
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row">
        <?php $this->load->view('Admin/message_view'); ?>

        <div class="col-md-6">
            <form method="POST" action="admin/social_media" class="form-horizontal  form-validate-jquery manage_record" enctype="multipart/form-data"  id="manage_record" name="manage_record">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"><?php echo 'Manage ' . $record_type; ?></h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Image<font color="red">*</font></label>
                            <div class="col-sm-9">

                                <input type="file" class="form-control" name="social_image" id="social_image" onchange="ValidateSingleInput(this);readURL(this);">

                                <input type="hidden" name="record_id" id="record_id">
                                <div id="imgpreview" style="margin-top: 10px;">
                                            
                                        </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Url<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="url" id="url" required="required">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" name="save" class="btn bg-teal"><?php echo 'Save ' . $record_type; ?> <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><?php echo $record_type . ' List'; ?></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <!--<table id="example" class="table table-bordered table-hover" cellspacing="0" width="100%">-->
                    <table class="table datatable-basic">
                        <thead>
                            <tr class="bg-teal">
                                <th>#</th>
                                <th><?php echo $record_type . ' Image'; ?></th>
                                <th><?php echo $record_type . ' Url'; ?></th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($records as $key => $record) {
                                ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><img style="width:30px;" src="<?php echo SOCIAL_IMAGE . '/' . $record['image']; ?>"></td>
                                    <td><?php echo $record['url']; ?></td>
                                    <td>
                                        <ul class="icons-list">
                                            <li class="text-teal-600">
                                                <a id="edit_<?php echo base64_encode($record['id']); ?>" class="edit"><i class="icon-pencil7"></i></a>
                                            </li>
                                            <li class="text-danger-600">
                                                <?php $url = urlencode("admin/delete/" . $this->uri->segment(3) . "/" . base64_encode($record['id'])); ?>
                                                <a data-record="<?php echo base64_encode($record['id']); ?>" id="delete_<?php echo base64_encode($record['id']); ?>" class="delete"><i class="icon-trash"></i></a>
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
    </div>
</div>
<div id="validation_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-teal-400">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title"></h6>
                </div>
                <div class="modal-body panel-body validation_alert">
                    <label></label>
                </div>
           </div>
        </div>
    </div>

<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript">
 var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                $(".validation_alert label").text("Sorry, invalid file, allowed extensions are: " + _validFileExtensions.join(", "));
                $("#validation_modal").modal();
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
    var base_url = '<?php echo base_url(); ?>admin/';
    var type = 'social_media';
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id').replace('edit_', '');
        var url = base_url + 'social_media/get_detail';
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            dataType: 'JSON',
            data: {id: id, type: type},
            success: function (data) {
                if (data.status == 1) {
                    var record = data.record[0];
                    //console.clear();
                    var img_url = "<?php echo base_url().SOCIAL_IMAGE.'/'; ?>"+record.image;
                    // console.log("img_url",img_url);
                    readURL(img_url);
                    // $('#image').val();
                    $('#record_id').val(record.id);
                    $('#url').val(record.url);
                }
            }
        });
    });
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'delete';
        $.ajax({
            type: 'POST',
            url: url,
            async: false,
            dataType: 'JSON',
            data: {id: id, type: type},
            success: function (data) {
                if (data.status == 1) {
                    $("div.div_alert_error").addClass('alert-success');
                    $('a.delete[data-record="' + data.id + '"]').closest('tr').remove();
                } else if (data.status == 0) {
                    $("div.div_alert_error").addClass('alert-danger');
                }
                $("p.alert_error_msg").text(data.msg);
                $("div.div_alert_error").show();
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

    function readURL(input) {

        if (input.files && input.files[0]) {
            var arr = [ 'image/png', 'image/jpeg', 'image/gif' ];
            if($.inArray( input.files[0].type , arr )!=-1){
                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = '<img src="' + e.target.result + '" height="30px" width="30px" alternate="Image" />';
                    $('#imgpreview').html(html);
             };
                reader.readAsDataURL(input.files[0]);
            }
        }else{
            if(typeof input=='string'){
                var html = '<img src="' + input + '" height="30px" width="30px" alternate="Image" />';
                $('#imgpreview').html(html);
            }
        }
    }


</script>