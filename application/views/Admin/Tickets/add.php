<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/tickets'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i> Tickets</a></li>
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

            if (isset($ticket)) {
                $action = base_url() . "admin/tickets/edit/" . base64_encode($ticket->id);
            } else {
                $action = base_url() . "admin/tickets/add";
            }
            ?>
            <form class="form-validate-jquery" method="post" id="user_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">

                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h5 class="panel-title"><?php echo (isset($ticket)) ? 'Edit Ticket' : 'Add Ticket' ?></h5>-->
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-xs-12">
                                            <label>Tenant</label>                                  
                                            <select class="select" name="user_id" required="" id="user_id">
                                                <option selected="" value="">Select Tenant</option> 
                                                <?php

                                                foreach ($tenants as $row) {
                                                    if (isset($ticket) && $ticket->user_id == $row['id']) {
                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['fname'] .' '. $row['lname']. "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['id'] . "'>" . $row['fname']  .' '. $row['lname'] ."</option>"; //                                                
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="user_id-error" class="validation-error-label" for="user_id">' . form_error('user_id') . '</label>'; ?>
                                        </div>

                                        <div class="form-group col-xs-12">
                                            <label>Title</label>
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

                                        
                                        <div class="form-group col-xs-12">
                                            <label>Ticket Type</label>                                                                      
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
                                        <div class="form-group col-xs-12">
                                            <label>Ticket Priority</label>

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
                                    <div class="col-md-6">
                                    <div class="form-group col-xs-12">
                                            <label>Department</label>                                  
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
<!--                                        <div class="form-group col-xs-12">
                                            <label>Ticket Status</label>

                                            <select class="select" name="status_id" required="" id="status_id">
                                                <option selected="" value="">Select Ticket Status</option> 
                                                <?php
//                                                foreach ($tickets_statuses as $row) {
//                                                    if ($ticket->status_id == $row['id']) {
//                                                        echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
//                                                    } else {
//                                                        echo "<option value='" . $row['id'] . "' >" . $row['name'] . "</option>"; //                                                
//                                                    }
//                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="status_id-error" class="validation-error-label" for="status_id">' . form_error('status_id') . '</label>'; ?>

                                        </div>-->


                                        <div class="form-group col-xs-12">
                                            <label>Description</label>

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
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Cancel</button>
                                        <button type="submit" class="btn bg-teal">Save<i class="icon-arrow-right14 position-right"></i></button>
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