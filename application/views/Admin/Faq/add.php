<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $page; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/faq'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $title; ?></a></li>
            <li class="active"><?php echo $page; ?></li>
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

            if (isset($faq)) {
                $action = base_url() . "admin/faq/edit/" . base64_encode($faq[0]['id']);
            } else {
                $action = base_url() . "admin/faq/add";
            }
            ?>
            <form class="form-horizontal form-validate-jquery" method="post" id="faq_add" enctype="multipart/form-data" action="<?php echo $action ?>" >            
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <!--<h5 class="panel-title"><?php echo (isset($faq)) ? 'Edit FAQ' : 'Add FAQ' ?></h5>-->
                            </div>

                            <div class="panel-body">
                                <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Category</label>
                                        <div class="col-lg-9">

                                            <select class="select" name="category_id" required="" id="category_id">
                                                <option selected="" value="">Select Category</option> 
                                                <?php
                                                foreach ($categories as $row) {
                                                    $selected = '';
                                                    if (isset($faq) && $faq->category_id == $row['id']) {

                                                        $selected = 'selected';
                                                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</option>';
                                                    }else{
                                                        echo '<option value="' . $row['id'] . '" >' . $row['name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php echo '<label id="category_id-error" class="validation-error-label" for="category_id">' . form_error('category_id') . '</label>'; ?>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Question</label>
                                        <div class="col-lg-9">
                                            <textarea rows="5" cols="5" name="question" class="form-control" required="required" placeholder="Question Here" aria-required="true" aria-invalid="true"><?php
                                                if (isset($faq)) {
                                                    echo trim($faq[0]['question']);
                                                } else {
                                                    if ($this->input->post('question')) {
                                                        echo $this->input->post('question');
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                ?></textarea>

                                            <?php echo '<label id="question-error" class="validation-error-label" for="question">' . form_error('question') . '</label>'; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Answer</label>
                                        <div class="col-lg-9">
                                            <textarea rows="10" cols="10" name="answer" class="form-control" required="required" placeholder="Answer Here" aria-required="true" aria-invalid="true"><?php
                                                if (isset($faq)) {
                                                    echo trim($faq[0]['answer']);
                                                } else {
                                                    if ($this->input->post('answer')) {
                                                        echo $this->input->post('answer');
                                                    } else {
                                                        echo '';
                                                    }
                                                }
                                                ?></textarea>
                                            <?php echo '<label id="answer-error" class="validation-error-label" for="answer">' . form_error('answer') . '</label>'; ?>
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