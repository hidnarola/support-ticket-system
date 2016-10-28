<div class="row">
    <div class="col-md-12">
        <?php
        $segment = $this->uri->segment(4);
        $edit_segment = $this->uri->segment(3);

        if (isset($ticket)) {
            $action = base_url() . "admin/tickets/edit/" . base64_encode($ticket->id);
        } else {
            $action = base_url() . "admin/tickets/add";
        }
        ?>
        <form class="form-horizontal form-validate" method="post" id="user_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title"><?php echo (isset($ticket)) ? 'Edit Ticket' : 'Add Ticket' ?></h5>
                        </div>

                        <div class="panel-body">
                            <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Title:</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="title" class="form-control" placeholder="Title" required="required" value="<?php
                                        if (isset($ticket)) {
                                            echo trim($ticket->title);
                                        } else {
                                            if ($this->input->post('title')) {
                                                echo $this->input->post('title');
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>">
                                               <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Department:</label>
                                    <div class="col-lg-9">                                  
                                        <select class="select" name="dept_id" required="" id="dept_id">
                                            <option selected="" value="">Select Department</option> 
                                            <?php
                                            foreach ($departments as $row) {
                                                if ($ticket->dept_id == $row['id']) {
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo '<label id="dept_id-error" class="validation-error-label" for="dept_id">' . form_error('dept_id') . '</label>'; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ticket Type</label>
                                    <div class="col-lg-9">                                  
                                        <select class="select" name="ticket_type_id" required="" id="ticket_type_id">
                                            <option selected="" value="">Select Ticket Type</option> 
                                            <?php
                                            foreach ($tickets_types as $row) {
                                                if ($ticket->ticket_type_id == $row['id']) {
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo '<label id="ticket_type_id-error" class="validation-error-label" for="ticket_type_id">' . form_error('ticket_type_id') . '</label>'; ?>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ticket Priority</label>
                                    <div class="col-lg-9">                                  
                                        <select class="select" name="priority_id" required="" id="priority_id">
                                            <option selected="" value="">Select Ticket Priority</option> 
                                            <?php
                                            foreach ($tickets_priorities as $row) {
                                                if ($ticket->priority_id == $row['id']) {
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo '<label id="priority_id-error" class="validation-error-label" for="priority_id">' . form_error('priority_id') . '</label>'; ?>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ticket Status</label>
                                    <div class="col-lg-9">                                  
                                        <select class="select" name="status_id" required="" id="status_id">
                                            <option selected="" value="">Select Ticket Status</option> 
                                            <?php
                                            foreach ($tickets_statuses as $row) {
                                                if ($ticket->status_id == $row['id']) {
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                        <?php echo '<label id="status_id-error" class="validation-error-label" for="status_id">' . form_error('status_id') . '</label>'; ?>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ticket Category</label>
                                    <div class="col-lg-9">                                  
                                        <select class="select" name="category_id" required="" id="category_id">
                                            <option selected="" value="">Select Ticket Category</option> 
                                            <?php
                                            foreach ($tickets_categories as $row) {
                                                if ($ticket->category_id == $row['id']) {
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
                                    <label class="col-lg-3 control-label">Description</label>
                                    <div class="col-lg-9">
                                        <textarea rows="5" cols="5" name="description" class="form-control" required="required" placeholder="Description Here" aria-required="true" aria-invalid="true"><?php
                                            if (isset($ticket)) {
                                                echo trim($ticket->description);
                                            } else {
                                                if ($this->input->post('description')) {
                                                    echo $this->input->post('description');
                                                } else {
                                                    echo '';
                                                }
                                            }
                                            ?></textarea>
                                        <?php echo '<label id="description-error" class="validation-error-label" for="description">' . form_error('description') . '</label>'; ?>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                    <button type="submit" class="btn bg-teal">Save Ticket  <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

</script>
