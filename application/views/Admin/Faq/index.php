<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">FAQ'S List</h5>

        <div class="heading-elements">
            <ul class="icons-list">               
                <button type="button" class="btn bg-pink-400" onclick="window.location = 'admin/faq/add'"><i class="icon-plus-circle2 position-left"></i>Add FAQ</button>
                <!--<li><a data-action="collapse"></a></li>-->
            </ul>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Questions list -->
            <div class="panel-group panel-group-control panel-group-control-right">
                <?php foreach ($faq as $value) { ?>

                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" href="<?php echo "#question" . $value['id'] ?>">
                                    <i class="icon-help position-left text-slate"></i> <?php echo $value['question']; ?>
                                </a>
                                <a class="pull-right text-danger-600 delete" id="delete_<?php echo base64_encode($value['id']); ?>" data-record="<?php echo base64_encode($value['id']); ?>"><i class="icon-trash"></i></a>
                                <a class="pull-right text-teal-600 edit" href="<?php echo base_url() . 'admin/faq/edit/' . base64_encode($value['id']) ?>" id="edit_<?php echo base64_encode($value['id']); ?>"><i class="icon-pencil7"></i></a>
                            </h6>
                        </div>

                        <div id="<?php echo "question" . $value['id'] ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php echo $value['answer']; ?>
                            </div>

                            <div class="panel-footer panel-footer-transparent">
                                <div class="heading-elements">
                                    <span class="text-muted heading-text">Latest update: <?php echo date('M d, Y', strtotime($value['created'])); ?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- /questions list -->
        </div>
    </div>
</div>
<!-- /questions area -->
<script type="text/javascript">
    var jconfirm = function (message, callback) {
        var options = {
            message: message
        };
        options.buttons = {
            cancel: {
                label: "No",
                className: "btn-default",
                callback: function (result) {
                    callback(false);
                }
            },
            main: {
                label: "Yes",
                className: "btn-primary",
                callback: function (result) {
                    callback(true);
                }
            }
        };
        bootbox.dialog(options);
    };
    var base_url = '<?php echo base_url(); ?>admin/';
    var type = '<?php echo $this->uri->segment(2); ?>';

    /* delete record function */
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'faq/delete';
        jconfirm("Do you really want to delete this record?", function (r) {
            if (r) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id, type: type},
                    success: function (data) {
                        if (data.status == 1) {
                            window.location.reload();
                        } else if (data.status == 0) {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>