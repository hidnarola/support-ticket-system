<!--<link href="assets/admin/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/js/pages/form_select2.js"></script>




<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/editor_ckeditor.js"></script>
<!-- <script src="assets/admin/js/bootstrap/bootstrap-switch.js" type="text/javascript"></script> -->



<!--<script type="text/javascript" src="assets/admin/js/pages/form_tags_input.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/forms/tags/tagsinput.min.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/forms/tags/typeahead.bundle.js"></script>-->
<link href="assets/admin/css/components.css" rel="stylesheet" type="text/css">


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"> -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-gear"></i> <span class="text-semibold"><?php echo $heading; ?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/email_templates'); ?>"><i class="icon-newspaper2 position-left"></i> Email Templates</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <div class="row">
        <?php
        $this->load->view('Admin/message_view');
        echo validation_errors();
        ?>
        <div class="col-md-12">
            <form class="form-horizontal form-validate-jquery" action="" id="template_settings" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                       <div class="form-group template_div">
                            <label class="col-md-3">Template Name<font color="red">*</font>:</label>
                            <div class="col-md-6">
                              <input type="text" name="template_name" class="form-control" placeholder="Enter Template Name" value="<?php echo isset($template) ? $template['template_name'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group template_div">
                            <label class="col-md-3">Email Subject<font color="red">*</font>:</label>
                            <div class="col-md-6">
                              <input type="text" name="email_subject" class="form-control" placeholder="Enter Email Subject" value="<?php echo isset($template) ? $template['email_subject'] : ''; ?>">
                            </div>
                        </div>

                        <div class="form-group template_div">
                            <label class="col-md-3">Sender Name<font color="red">*</font>:</label>
                            <div class="col-md-6">
                              <input type="text" name="sender_name" class="form-control" placeholder="Enter Sender Name" value="<?php echo isset($template) ? $template['sender_name'] : 'Manazel Specialists'; ?>">
                            </div>
                        </div>

                        <div class="form-group template_div">
                            <label class="col-md-3">Sender Email<font color="red">*</font>:</label>
                            <div class="col-md-6">
                              <input type="text" name="sender_email" class="form-control" placeholder="Enter Sender Email" value="<?php echo isset($template) ? $template['sender_email'] : $smtp['smtp_email']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">
                                Email Description<font color="red">*</font>
                            </label>

                            <div class="content-group col-md-9">
                                <textarea name="email_description" required="" id="editor-full" rows="4" cols="4"><?php
                                    if (isset($template)) {
                                        echo trim($template['email_description']);
                                    } else {
                                        echo '';
                                    }
                                    ?>  
                                </textarea>
                                <?php echo '<label id="content-error" class="validation-error-label" for="content">' . form_error('content') . '</label>'; ?>
                            </div>
                       </div>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php //$this->load->view('Templates/admin_footer');  ?>
</div>
<script type="text/javascript">
    $('.select2').select2({
        tags: true,
        tokenSeparators: [",", " "],
        createTag: function (tag) {
            return {
                id: tag.term,
                text: tag.term,
                isNew: true
            };
        }
    }).on("select2:select", function (e) {
        if (e.params.data.isNew) {
            $('#console').append('<code>New tag: {"' + e.params.data.id + '":"' + e.params.data.text + '"}</code><br>');
            $(this).find('[value="' + e.params.data.id + '"]').replaceWith('<option selected value="' + e.params.data.id + '">' + e.params.data.text + '</option>');
        }
    });



//    $("#email_tags").autocomplete({
//        minLength: 1,
//        source:
//                function (req, add) {
//                    $.ajax({
//                        url: "<?php echo base_url() . 'admin/Newsletters/get_emails'; ?>",
//                        dataType: 'json',
//                        type: 'POST',
//                        data: req,
//                        success:
//                                function (data) {
//                                    if (data.response === "true") {
//                                        add(data.message);
//                                    }
//                                }
//                    });
//                }
//    });

    // setTimeout(function(){
//    $('.tags-input').tagsinput({
//        maxTags: 5,
//        trimValue: true,
//    });
    // }, 300);
    jQuery(document).ready(function ($) {


        $('.tags-input').on('beforeItemAdd', function (event) {
            var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,5}|[0-9]{1,3})(\]?)$/;
            if (pattern.test(event.item) == false) {
                event.cancel = true;
            }
        });

        // $(".switch-radio2").bootstrapSwitch();
        // $('#newsletter_content').froalaEditor({
        //     toolbarInline: false,
        //     height: 300
        // });
        /* CKEDITOR.replace('newsletter_content', {
         height: '400px'
         });
         $('select').select2({
         liveSearch : true,
         size: 5
         });*/
    });

    $(document).on('click', '.is_auto', function () {
        data_type = $(this).data('type');
        data_id = $(this).data('id');
        if ($(this).parent().attr('class') == 'checked') {
            $(this).parent().removeClass('checked');
            $(this).prop('checked', false);
            $('#duration_box').hide(500);
            $('#latest_box').hide(500);
        }
        else {
            $(this).parent().addClass('checked');
            $(this).prop('checked', true);
            $('#duration_box').show(500);
            $('#latest_box').show(500);
        }
    });

    $('document').ready(function () {
        $("#newsletter_settings").validate({
        });
    });
</script>