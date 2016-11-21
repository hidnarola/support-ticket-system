<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
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
    <div class="form-group">
        <label class="col-lg-2 control-label text-semibold">Upload:</label>
        <div class="col-lg-10">
            <input type="file" class="file-input-ajax" multiple="multiple">
        </div>
    </div>

    <div class="panel">
    <div class="panel-heading"></div>     
    <div class="panel-body">
        
    </div>     
    </div>
</div>
<script type="text/javascript" src="assets/admin/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="assets/admin/js/core/app.js"></script>
<!-- <script type="text/javascript" src="assets/admin/js/pages/uploader_bootstrap.js"></script> -->
<script type="text/javascript">
$(function() {
    var base_url = "<?php echo base_url(); ?>";
    var controller = '/media';
    var upload_url = base_url + '/admin' +controller + '/file_upload/gallery';
    $(".file-input-ajax").fileinput({
        uploadUrl: upload_url, // server upload action
        uploadAsync: true,
        maxFileCount: 5,
        initialPreview: [],
        fileActionSettings: {
            removeIcon: '<i class="icon-bin"></i>',
            removeClass: 'btn btn-link btn-xs btn-icon',
            uploadIcon: '<i class="icon-upload"></i>',
            uploadClass: 'btn btn-link btn-xs btn-icon',
            indicatorNew: '<i class="icon-file-plus text-slate"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
        }
    }).on('filebatchpreupload', function(event, data, id, index) {
        }).on('filebatchuploadsuccess', function(event, data) {
            console.log(data);
            // window.location.reload();
    });
});
</script>