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
            <li><a href="<?php echo site_url('admin/newsletters'); ?>"><i class="icon-newspaper2 position-left"></i> Newsletters</a></li>
            <li class="active"><?php echo $heading; ?></li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    echo validation_errors();
}
?>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-validate" action="" id="newsletter_settings" method="POST">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <?php /*
                          <fieldset>
                          <legend class="text-semibold">
                          <i class="icon-gear position-left"></i>
                          OTHER SETTINGS
                          </legend>
                          <div class="form-group">
                          <label class="col-lg-2 control-label">
                          Is auto:
                          </label>
                          <?php
                          $check_checked = '';
                          $duration_box = 'display:none;';
                          if(isset($newsletter_settings['is_auto'])){
                          if($newsletter_settings['is_auto'] == 1){
                          $check_checked = 'checked';
                          $duration_box = 'display:block;';
                          }
                          }
                          ?>
                          <div class="col-lg-4">
                          <div class="">
                          <input type="checkbox" value="1" data-id="''" class="is_auto" name="is_auto" <?php echo $check_checked ?>>
                          </div>
                          </div>
                          </div>
                          <?php
                          $_2_days = $_4_days = $_7_days = $_30_days = '';
                          if(isset($newsletter_settings['is_auto'])){
                          if($newsletter_settings['duration'] == '2'){
                          $_2_days = 'checked';
                          } elseif ($newsletter_settings['duration'] == '4'){
                          $_4_days = 'checked';
                          } elseif ($newsletter_settings['duration'] == '7'){
                          $_7_days = 'checked';
                          } else {
                          $_30_days = 'checked';
                          }

                          if($_2_days == '' && $_4_days == '' && $_7_days == ''){
                          $_30_days = 'checked';
                          }
                          }
                          ?>
                          <div class="form-group" id="duration_box" style="<?php echo $duration_box; ?>">
                          <label class="col-lg-2 control-label">
                          Duration:
                          </label>
                          <div class="col-lg-8">
                          <label for="">
                          <strong>
                          2 days:
                          </strong>
                          </label>
                          <input type="radio" name="duration" data-radio-all-off="true" class="switch-radio2" value="2" <?php echo $_2_days ?>>

                          <label for="">
                          <strong>
                          4 days:
                          </strong>
                          </label>
                          <input type="radio" name="duration" data-radio-all-off="true" class="switch-radio2" value="4" <?php echo $_4_days ?>>
                          <label for="">
                          <strong>
                          7 days:
                          </strong>
                          </label>
                          <input type="radio" name="duration" data-radio-all-off="true" class="switch-radio2" value="7" <?php echo $_7_days ?>>
                          <label for="">
                          <strong>
                          30 days:
                          </strong>
                          </label>
                          <input type="radio" name="duration" data-radio-all-off="true" class="switch-radio2" value="30" <?php echo $_30_days ?>>
                          </div>
                          </div>

                          </fieldset>
                         */ ?>
                        <fieldset>
                            <legend class="text-semibold">
                                <i class="icon-wrench position-left"></i>
                                TESTING SETTINGS
                            </legend>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">
                                    Email ids:
                                </label>
                                
                                <div class="col-lg-10">
                                    <!--<input type="text" id="email_tags"  value="<?php if (isset($testing_emails[0]['email_ids'])) echo $testing_emails[0]['email_ids']; ?>" class="tags-input form-control" name="testing_emails" autocomplete="off">-->
                                    <select multiple="true" name="testing_emails[]" id="tagSelector" class="form-control select2">
                                        <?php
//                                        foreach ($subscribers as $value) {
//                                            
//                                            echo "<option value='" . $value['id'] . "' >" . $value['email'] . "</option>";
//                                        }
                                        $arr = array();
                                        if (isset($emails)) {
                                            foreach ($emails as $value) {
                                                $arr[] = $value;
                                            }
                                        }
                                         foreach ($subscribers as $key => $val) {
                                            $selected = '';
                                            if (isset($emails)) {
                                                if (in_array($val['email'], $arr)) {
                                                    $selected = "selected";
                                                }
                                            }
                                             echo "<option value='" . $val['email'] . "' $selected>" . $val['email'] . "</option>";
                                         }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-semibold">
                                <i class="icon-newspaper2 position-left"></i>
                                CONTENT OF NEWSLETTER
                            </legend>

                            <div class="content-group">
                                <textarea name="newsletter_content" required="" id="editor-full" rows="4" cols="4"><?php
                                    if (isset($newsletter_settings)) {
                                        echo trim($newsletter_settings['content']);
                                    } else {
                                        echo '';
                                    }
                                    ?>  
                                </textarea>
                                <?php echo '<label id="content-error" class="validation-error-label" for="content">' . form_error('content') . '</label>'; ?>
                            </div>
                        </fieldset>
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php //$this->load->view('Templates/admin_footer'); ?>
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
    $('.select').select2({
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
</script>