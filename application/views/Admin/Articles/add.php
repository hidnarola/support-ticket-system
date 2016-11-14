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

            if (isset($data)) {
                $action = base_url() . "admin/articles/edit/" . base64_encode($data['id']);
            } else {
                $action = base_url() . "admin/articles/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="articles_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h5 class="panel-title"><?php echo (isset($data)) ? 'Edit News/Announcement' : 'Add News/Announcement' ?></h5>-->
                            </div>

                            <div class="panel-body">
                                <div class="center-block">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Title</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" required="" name="title" placeholder="Enter Title" value="<?php echo (isset($data)) ? $data['title'] : ''; ?>">   
                                             <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Category</label>
                                        <div class="col-lg-10">
                                            
                                             <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
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
                                                            if (isset($data)) {
                                                                echo trim($data['description']);
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