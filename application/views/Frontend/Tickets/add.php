
<!-- Select-Boxes CSS -->
<!--<link rel="stylesheet" href="assets/frontend/css/components/select-boxes.css" type="text/css" />-->
<!-- Select-Boxes Plugin -->
<!--<script type="text/javascript" src="assets/frontend/js/components/select-boxes.js"></script>-->

<div class="content-wrap">
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-sm-9">
                <?php
                if ($this->session->flashdata('success_msg')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success_msg'); ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($this->session->flashdata('error_msg')) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                    <?php
                }
                ?>
                <form id="ticket-add-form" name="register-form" class="nobottommargin" action="tickets/add" method="post">
                    <div class="col_full" style="margin-bottom: 0">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" required="required" class="form-control required" />
                        <?php echo '<label id="title-error" class="validation-error-label" for="title">' . form_error('title') . '</label>'; ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col_full">
                                <label for="Department">Department:</label>
                                <select class="form-control" name="dept_id" required="" id="dept_id">
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
                        <div class="col-sm-6">
                            <div class="col_full">
                                <label>Ticket Type:</label>                                                                      
                                <select class="form-control" name="ticket_type_id" required="" id="ticket_type_id">
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
                    </div>                   
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col_full">
                                <label>Ticket Priority:</label>

                                <select class="form-control" name="priority_id" required="" id="priority_id">
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
                        <div class="col-sm-6">
                            <div class="col_full">
                                <label>Ticket Category:</label>

                                <select class="form-control" name="category_id" required="" id="category_id">
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
                    </div>

                    <div class="col_full">
                        <label>Description</label>
                        <!--border-color: #E42C3E;-->
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

                    <div class="col_full nobottommargin">
                        <!--<a href="tickets/add" class="button button-3d button-small button-rounded pull-right" style="background-color: #003473">Save</a>-->
                        <button type="submit" class="button button-3d button-small button-rounded pull-right blue-button" id="ticket-submit" name="save" value="register">Save</button>
                        <button type="button" class="button button-3d button-small button-rounded button-white button-light pull-right" onclick="window.history.back()">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="line visible-xs-block"></div>

            <?php $this->load->view('frontend/User/rightsidebar'); ?>

        </div>
    </div>
</div>
<script type="text/javascript" src="assets/frontend/js/plugins/jquery.validation.js"></script>
<script type="text/javascript">
                            $(document).ready(function () {
                                $('#datatable1').DataTable();

                            });



//                            var element = $('#category_id').val();
                            $("#ticket-add-form").validate({
                                rules: {
                                    category_id: "required",
                                    dept_id: "required",
                                    status_id: "required",
                                    priority_id: "required",
                                },
//                                errorPlacement: function (error, element) {
//                                    error.insertAfter(element.parent());
//                                    console.log(element);
//
//                                    if (element.attr("name") == "category_id") {
//                                        element.removeClass('error');
//                                        element.parent().find("button").addClass('dropdown-id-dropdown-toggle');
//                                    }
//                                },
//                                success: function (label, element) {
//                                    if (element.attr("name") == "category_id") {
//                                        element.removeClass('error');
//                                        element.parent().find("button").removeClass('dropdown-id-dropdown-toggle');
//
//                                    }
//
//                                },
                                submitHandler: function (form) { // for demo
                                    form.submit();
                                }

                            });
</script>