<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/editor_ckeditor.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/news'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $page; ?></a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">

    <div class="row">
        <?php $this->load->view('admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);

            if (isset($data)) {
                $action = base_url() . "admin/news/edit/" . base64_encode($data['id']);
            } else {
                $action = base_url() . "admin/news/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="news_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h5 class="panel-title"><?php echo (isset($data)) ? 'Edit News/Announcement' : 'Add News/Announcement' ?></h5>-->
                            </div>

                            <div class="panel-body">
                                <div class="center-block">

                                    <div class="form-group">
                                        <label class="display-block control-label text-semibold col-lg-2">Please select</label>

                                        <?php
                                        $news_checked = 'checked';
                                        $announcement_checked = '';

                                        if (isset($data)) {
                                            if ($data['is_news'] == 1) {
                                                $news_checked = 'checked';
                                                $announcement_checked = '';
                                            } else {
                                                $news_checked = '';
                                                $announcement_checked = 'checked';
                                            }
                                        }
                                        ?>

                                        <label class="radio-inline">
                                            <input type="radio" value="1" name="is_news" class="styled" <?php echo $news_checked; ?>>
                                            News
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" value="0" name="is_news" class="styled" <?php echo $announcement_checked; ?>>
                                            Announcement
                                        </label>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Title<font color="red">*</font></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" required="" name="title" placeholder="Enter Title" value="<?php
                                            echo (isset($data)) ? $data['title'] : set_value('description');
                                            ;
                                            ?>">   
                                                   <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Description<font color="red">*</font></label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                </div>

                                                <div class="panel-body">
                                                    <div class="content-group">
                                                        <textarea name="description" required="" id="editor-full" rows="4" cols="4"><?php
                                                            if (isset($data)) {
                                                                echo trim($data['description']);
                                                            } else {
                                                                echo set_value('description');
                                                            }
                                                            ?>	
                                                        </textarea>
                                                        <?php echo '<label id="description-error" class="validation-error-label" for="description">' . form_error('description') . '</label>'; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Image</label>
                                        <div class="col-lg-10">
                                            <div class="uploader">
                                                <input name="userfile" type="file" class="file-styled" onchange="ValidateSingleInput(this);">
                                            </div>
                                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>

                                            <?php
                                            if (isset($profile_validation)) {
                                                echo '<label id="userfile-error" class="validation-error-label" for="userfile">' . $profile_validation . '</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn bg-teal">Save <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </form>
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
    </script>

