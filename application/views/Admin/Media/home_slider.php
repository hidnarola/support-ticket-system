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

    <?php $this->load->view('Admin/message_view'); ?>
    <div class="panel panel-flat">
        <div class="panel-heading"></div>     
        <div class="panel-body">
            <div class="form-group">
                <label class="col-lg-2 control-label text-semibold text-center">Upload:</label>
                <div class="col-lg-10">
                    <input type="file" class="file-input-ajax" multiple="multiple" accept="image/*" >
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading"></div>     
        <div class="panel-body">
            <div class="col-md-12">
                <?php //pr($images); ?>
                <?php foreach ($images as $image) { ?>
                    <div class="col-md-3 home_image text-center">
                        <div class="row ">
                            <a class="fancybox" href="<?php echo HOME_IMAGE . '/' . $image['image']; ?>" data-fancybox-group="gallery"><img src="<?php echo HOME_MEDIUM_IMAGE . '/' . $image['image']; ?>" alt="" /></a>
                        </div><div class="row">
                            <a class="text-danger-600 delete" onClick="return confirm('Are you sure you want to delete?')" href="Admin/Media/delete/<?php echo base64_encode($image['id']); ?>" data-record=""><i class="icon-trash"></i></a>
                        </div>

                    </div>
                <?php } ?>
            </div>     
        </div>     
    </div>
</div>
<script type="text/javascript" src="assets/admin/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
                            $(function () {
                                $('.fancybox').fancybox();
                                var base_url = "<?php echo base_url(); ?>";
                                var controller = '/Media';
                                var upload_url = base_url + '/Admin' + controller + '/file_upload/home';
                                $(".file-input-ajax").fileinput({
                                    uploadUrl: upload_url, // server upload action
                                    uploadAsync: true,
                                    maxFileCount: 5,
                                    allowedFileExtensions: ['jpg', 'jpeg', 'png','gif'],
                                    initialPreview: [],
                                    fileActionSettings: {
                                        // removeIcon: '<i class="icon-bin"></i>',
                                        // removeClass: 'btn btn-link btn-xs btn-icon',
                                        uploadIcon: '<i class="icon-upload"></i>',
                                        uploadClass: 'btn btn-link btn-xs btn-icon',
                                        indicatorNew: '<i class="icon-file-plus text-slate"></i>',
                                        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                                        indicatorError: '<i class="icon-cross2 text-danger"></i>',
                                        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
                                    }
                                }).on('fileuploaded', function (event, data) {
                                    window.location.reload(true);
                                });
                            });
</script>