<script type="text/javascript" src="assets/admin/js/plugins/pickers/anytime.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/pickers/pickadate/picker.date.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/pickers/pickadate/picker.time.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/picker_date.js"></script>
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
            <li><a href="<?php echo site_url('admin/articles'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $page; ?></a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <?php
            $segment = $this->uri->segment(4);
            $edit_segment = $this->uri->segment(3);

            if (isset($article)) {
                $action = base_url() . "admin/articles/edit/" . base64_encode($article->id);
            } else {
                $action = base_url() . "admin/articles/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="articles_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">

                            </div>

                            <div class="panel-body">
                                <div class="center-block">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Title</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" required="" name="title" placeholder="Enter Title" value="<?php echo (isset($article)) ? $article->title : ''; ?>">   
                                            <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Category</label>
                                        <div class="col-lg-10">
                                            <select class="select" name="category_id" required="" id="category_id">
                                                <option selected="" value="">Select Ticket Category</option> 
                                                <?php
                                                foreach ($tickets_categories as $row) {
                                                    if ($article->category_id == $row['id']) {
                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="category_id-error" class="validation-error-label" for="category_id">' . form_error('category_id') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Make it visible</label>
                                        <div class="col-lg-10">
                                            <input class="styled" type="checkbox" name="is_visible" id="is_visible" value="yes" <?php
                                            if (isset($article)) {
                                                if ($article->is_visible == 0) {
                                                    echo 'checked=checked';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?>>
                                                   <?php // echo '<label id="is_visible-error" class="validation-error-label" for="is_visible">' . form_error('is_visible') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Set expiry date</label>
                                        <div class="col-lg-10">
                                            <div class="ckbox ckbox-danger">
                                                <input class="styled" type="checkbox" name="add_expiry_date" id="add_expiry_date" value="yes" <?php
                                                if (isset($article)) {
                                                    if ($article->expiry_date != '') {
                                                        echo 'checked = checked';
                                                    }
                                                }
                                                ?>>
                                            </div>
                                        
                                    <br>
                                    <?php
                                    if (isset($article)) {
                                        if ($article->expiry_date != '') {
                                             $expiry_date = date('d F, Y', strtotime($article->expiry_date));
                                            ?>
                                            <div id="expiry_date_id" class="input-group mb10">

                                                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                                <input type="text" name="expiry_date" id="expiry_date" class="form-control pickadate" placeholder="Try me&hellip;" value="<?php echo $expiry_date; ?>">
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>

                                        <div id="expiry_date_id" class="input-group mb10" style="display:none">

                                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                            <input type="text" name="expiry_date" id="expiry_date" class="form-control pickadate" placeholder="Try me&hellip;">
                                        </div>
                                        
                                    <?php } ?>
                                    </div>
                                    </div>
                                   
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                            </div>

                                            <div class="panel-body">

                                                <div class="content-group">
                                                    <textarea name="description" required="" id="editor-full" rows="4" cols="4"><?php
                                                        if (isset($article)) {
                                                            echo trim($article->description);
                                                        } else {
                                                            echo '';
                                                        }
                                                        ?>	
                                                    </textarea>
                                                    <?php echo '<label id="description-error" class="validation-error-label" for="description">' . form_error('description') . '</label>'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 user_profile_pic">
                                    <label class="col-lg-2 control-label">Article Image:</label>  
                                    <div class="col-lg-10">
                                        <input type="file" name="image" class="file-styled" onchange="readURL(this)">
                                        <!--<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>-->                               
                                        <div class="clearfix"></div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-5">
                                            <div id="imgpreview" style="margin-top: 10px;">
                                                <?php
                                                if (isset($article)) {
                                                    if (trim($article->image) != '')
                                                        echo "<img src='" . base_url() . ARTICLE_IMAGE . '/' . $article->image . "' height='73px' width='73px'>"; //                                               
                                                }
                                                ?>
                                        </div>
                                    </div>
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
</div>
<script>
    $("[name=add_expiry_date]").click(function () {
        if ($("#add_expiry_date").is(':checked'))
        {
            // Show date...
            $('#expiry_date_id').show();
        }
        else {
            // Hide date...
            $('#expiry_date_id').hide();
        }
    });
    // Expiry date picker...
    $('#expiry_date').pickadate({
        dateFormat: 'yy-mm-dd',
        minDate: '+7d',
//         startDate: Today(),
//            endDate: moment(),
//            maxDate: '12/31/2016'
    });
</script>
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
