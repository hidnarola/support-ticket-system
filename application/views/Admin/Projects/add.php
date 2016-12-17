<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/projects'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $page; ?></a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <?php $this->load->view('Admin/message_view'); ?>
        <div class="col-md-12">
            <?php
            $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);
            if (isset($data)) {
                $action = base_url() . "admin/projects/edit/" . base64_encode($data['id']);
            } else {
                $action = base_url() . "admin/projects/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="news_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading"></div>

                            <div class="panel-body">
                                <div class="center-block">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Title<font color="red">*</font></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" required="" name="title" placeholder="Enter Title" value="<?php echo (isset($data)) ? $data['title'] : set_value('title'); ?>">   
                                            <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Short Description<font color="red">*</font></label>
                                        <div class="col-lg-10">
                                            <div class="content-group">
                                                <textarea rows="2" cols="2" name="short_desc" class="form-control" required="required" placeholder="Short Description" aria-required="true" aria-invalid="true"><?php
                                                    if (isset($data)) {
                                                        echo trim($data['short_desc']);
                                                    } else {
                                                        echo set_value('short_desc');
                                                    }
                                                    ?></textarea>
                                                <?php echo '<label id="short_desc-error" class="validation-error-label" for="short_desc">' . form_error('short_desc') . '</label>'; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (isset($data)) { ?>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Image<font color="red">*</font></label>
                                            <div class="col-lg-10">
                                                <div class="uploader">
                                                    <input name="logo_image" type="file" class="file-styled" onchange="readURL(this);">
                                                </div>
                                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                <div class="col-lg-5">
                                                    <div id="imgpreview" style="margin-top: 10px;">
                                                        <?php
                                                        if (isset($data)) {
                                                            if (trim($data['logo_image']) != '') {
                                                                echo "<img src='" . base_url() . PROJECTS_IMAGES . '/' . $data['logo_image'] . "' height='73px' width='73px'>"; //                                               
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                if (isset($profile_validation)) {
                                                    echo '<label id="logo_image-error" class="validation-error-label" for="logo_image">' . $profile_validation . '</label>';
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Image<font color="red">*</font></label>
                                            <div class="col-lg-10">
                                                <div class="uploader">
                                                    <input name="logo_image" type="file" class="file-styled" onchange="readURL(this);" required="">
                                                </div>
                                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                 <?php
                                                if (isset($profile_validation)) {
                                                    echo '<label id="logo_image-error" class="validation-error-label" for="logo_image">' . $profile_validation . '</label>';
                                                }
                                                ?>
                                                <div class="col-lg-5">
                                                    <div id="imgpreview" style="margin-top: 10px;">
                                                        <!--
                                                        <?php
//                                                    if (isset($data)) {
//                                                        if (trim($data['logo_image']) != '') {
//                                                            echo "<img src='" . base_url() . PROJECTS_IMAGES . '/' . $data['logo_image'] . "' height='73px' width='73px'>"; //                                               
//                                                        }
//                                                    }
                                                        ?>
                                                        -->  
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    <?php } ?>

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
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var html = '<img src="' + e.target.result + '" height="73px" width="73px" alternate="Image" />';
                $('#imgpreview').html(html);
//            $('#imgpreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
