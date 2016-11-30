<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php $this->load->view('admin/message_view'); ?>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <!--<h5 class="panel-title">FAQ'S List-->
                <div class="row">
                    <div class="col-md-3 form-group has-feedback">
                        <form method="get" action="admin/faq">
                            <input type="text" name="keyword" value="<?php echo ($keyword != '') ? $keyword : ''; ?>" class="form-control" placeholder="Search FAQ">
                            <div class="form-control-feedback">
                                <i class="icon-search4 text-size-base" style="margin-right: 10px;"></i>
                            </div>
                        </form>
                    </div>
                     <div class="pull-right col-md-2">           
                        <a onclick="window.location = 'admin/faq/add'" class="btn btn-success btn-labeled pull-right"><b><i class="icon-plus-circle2"></i></b> Add FAQ</a>
                    </div>
                    
                </div>
            <!--</h5>-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Questions list -->
            <?php 
            //pr($faq);   
            foreach ($faq as $key => $value) { ?>

                <div class="text-size-large text-uppercase text-semibold text-muted mb-10"><?php echo $key; ?></div>
                    <div class="panel-group panel-group-control panel-group-control-right">
                <?php foreach ($value as $val) { ?>

                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="collapsed faq_collapsed" data-toggle="collapse" href="<?php echo "#question" . $val['fid'] ?>">
                                        <i class="icon-help position-left text-slate"></i> <?php echo $val['question']; ?>
                                    </a>
                                    <span class="faq-listing"><a class=" text-danger-600 delete" id="delete_<?php echo base64_encode($val['fid']); ?>" data-record="<?php echo base64_encode($val['fid']); ?>"><i class="icon-trash"></i></a>
                                        <a class="text-teal-600 edit" href="<?php echo base_url() . 'admin/faq/edit/' . base64_encode($val['fid']) ?>" id="edit_<?php echo base64_encode($val['fid']); ?>"><i class="icon-pencil7"></i></a></span>
                                </h6>
                            </div>

                            <div id="<?php echo "question" . $val['fid'] ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $val['answer']; ?>
                                </div>

                                <div class="panel-footer panel-footer-transparent">
                                    <div class="heading-elements">
                                        <span class="text-muted heading-text">Latest update: <?php echo date('F j, Y', strtotime($val['modified'])); ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <!-- /questions list -->
        </div>
    </div>
    <div class="row pull-right">  
        <div class='col-sm-12'>
            <?php echo $links; ?>
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