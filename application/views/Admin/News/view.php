<div class="row">
    <div class="col-md-12">
        <?php
        $segment = $this->uri->segment(4);
        $edit_segment = $this->uri->segment(3);
 ?>
                
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title"><?php echo (isset($data)) ? 'Edit News/Announcement' : 'Add News/Announcement' ?></h5>
                        </div>

                        <div class="panel-body">
                            <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                
                               
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Title</label>
                                    <div class="col-lg-9">
                                        <label class="control-label"><?php echo $data['title']; ?>"</label>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <textarea rows="5" cols="5" name="description" class="form-control" required="required" placeholder="Description Here" aria-required="true" aria-invalid="true"><?php
                                            if (isset($data)) {
                                                echo trim($data['description']);
                                            } else {
                                                echo '';
                                            }
                                            ?></textarea>
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
        
    </div>
</div>