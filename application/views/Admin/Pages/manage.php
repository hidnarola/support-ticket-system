<style>
    label.error {
        color: #D8000C;
    }
</style>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/editor_ckeditor.js"></script>
<!--<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="assets/admin/ckeditor/ckeditor.js"></script>-->
<!-- <script type="text/javascript" src="assets/admin/js/core/app.js"></script> -->
<!-- <script type="text/javascript" src="assets/admin/js/pages/editor_ckeditor.js"></script> -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold"><?php echo $title; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/pages'); ?>"><i class="icon-magazine position-left"></i> Pages</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <?php $this->load->view('admin/message_view'); ?>
        <div class="col-md-12">
            <div class="col-md-12">
                <!-- Basic layout-->
                <form action="" method="post" id="page_info" class="form-validate-jquery" enctype="multipart/form-data">
                    <div class="panel panel-flat">
                        <div class="panel-body">

                            <div class="form-group">
                                <label>Navigation Name<font color="red">*</font></label>
                                <input type="text" name="navigation_name" required="required" id="navigation_name" class="form-control" value="<?php echo isset($page_data['navigation_name']) ? $page_data['navigation_name'] : set_value('navigation_name'); ?>">
                                <?php echo '<label id="navigation_name-error" class="validation-error-label" for="navigation_name">' . form_error('navigation_name') . '</label>'; ?>
                            </div>
                            <div class="form-group">
                                <label>Page Title<font color="red">*</font></label>
                                <input type="text" name="title" id="title" required="required" class="form-control" value="<?php echo isset($page_data['title']) ? $page_data['title'] : set_value('title'); ?>">
                                <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                            </div>
                            <div class="form-group">
                                <label>Description<font color="red">*</font></label>
                                <textarea name="description" id="editor-full" required="required" rows="4" cols="4">
                                    <?php echo isset($page_data['description']) ? $page_data['description'] : set_value('description'); ?>
                                </textarea>
                                <?php echo '<label id="description-error" class="validation-error-label" for="description">' . form_error('description') . '</label>'; ?>
                            </div>
                            <div class="row">
                                <?php
                                if (isset($page_data['banner_image'])) {
                                    ?>
                                    <div class="col-md-3">
                                        <img heigth="100" width="170" src="<?php echo base_url(PAGE_MEDIUM_IMAGE . '/' . $page_data['banner_image']) ?>" alt="">
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Banner Image:</label>
                                        <!-- <div class="uploader"> -->
                                            <input type="file" name="banner_image" id="banner_image" onchange="ValidateSingleInput(this);">
                                            <!-- <span class="filename" style="">No file selected</span> -->
                                            <!-- <span class="action btn bg-pink-400" style="">Choose File</span> -->
                                        <!-- </div> -->
                                        <span class="help-block">Accepted formats: png, jpg, jpeg. Max file size 700Kb</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Banner Url:</label>
                                <input type="text" name="ext_url" id="ext_url" class="form-control" value="<?php echo isset($page_data['ext_url']) ? $page_data['ext_url'] : set_value('ext_url'); ?>">

                            </div>

                            <div class="text-right">
                                <button class="btn btn-primary" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /basic layout -->
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
    <script type="text/javascript">

        $('document').ready(function () {
//            CKEDITOR.replace('description', {
//                height: '400px'
//            });
            $("#page_info").validate({
                rules: {
                    navigation_name: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    banner_image: {
                        // required: true,
                        extension: "jpg|png|jpeg",
                        maxFileSize: {
                            "unit": "KB",
                            "size": 700
                        }
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "banner_image") {
                        error.insertAfter($(".uploader"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                },
            });
        });

        function get_states() {
            country_id = $('#country_id').val();
            $.ajax({
                url: 'admin/users/get_states',
                type: 'POST',
                data: {country_id: country_id},
                success: function (response) {
                    data = JSON.parse(response);
                    if (data != '') {
                        str = '<option value="">State</option>';
                        $.each(data, function (i, item) {
                            str += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        $('#state_id').val('');
                        $('#city_id').val('');
                        $('#state_id').html(str);
                        // $('#state_id').select2('refresh');
                    }
                }
            });
        }

        function get_cities() {
            state_id = $('#state_id').val();
            $.ajax({
                url: 'admin/users/get_cities',
                type: 'POST',
                data: {state_id: state_id},
                success: function (response) {
                    data = JSON.parse(response);
                    if (data != '') {
                        str = '<option value="">City</option>';
                        $.each(data, function (i, item) {
                            str += '<option value="' + item.id + '">' + item.name + '</option>';
                        });
                        $('#city_id').val('');
                        $('#city_id').html(str);
                        // $('#city_id').select2('refresh');
                    }
                }
            });
        }
         var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    console.log('heree');
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

       /* document.getElementById('banner_image').onchange = function () {
            var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '')
            $('.filename').html(filename);
        };*/
    </script>
