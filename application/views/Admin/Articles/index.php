<script type="text/javascript" src="assets/admin/js/pages/datatables_basic.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<?php
$segment = $this->uri->segment(1);
?>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></span></h4>
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
<?php $this->load->view('admin/message_view');?>
    <!-- Table header styling -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <form method="get">
                        <input type="text" name="search_text" value="<?php echo ($search_text != '') ? $search_text : ''; ?>" class="form-control" placeholder="Search">
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-size-base"></i>
                        </div>
                    </form>
                </div>

                <div class="col-md-9">
                    <div class="pull-right">
                        <a onclick="window.location = 'admin/articles/add'" class="btn btn-success btn-labeled"><b><i class="icon-plus-circle2"></i></b> Add New Article</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <?php
        foreach ($articles as $key => $record) {
            ?>

            <div class="col-md-12">
                <div class="panel panel-body articles">
                    <div class="media">
                        <div class="media-left">
                            <a title="Article"><i class="icon-magazine text-success-400 icon-2x no-edge-top mt-5"></i></a>
                        </div>

                        <div class="media-body">
                            <?php
                            if ($record['image'] != '') {
                                $image = ARTICLE_MEDIUM_IMAGE . '/' . $record['image'];
                                ?>

                                <div class="col-md-2">
                                    <img src="<?php echo $image; ?>">
                                </div>
                            <?php } ?>

                            <div class="col-md-9">
                                <h5 class="media-heading text-semibold"><a href="admin/articles/view/<?php echo base64_encode($record['id']); ?>" class="text-default"><?php echo $record['title']; ?></a></h5>
                                <h6 class="media-heading" style="display:inline; font-weight: 500;">Category: </h6><span><?php echo $record['cat_name']; ?></span>
                                <div>
                                    <h6 class="media-heading" style="display:inline; font-weight: 500;">Is visible: </h6>
                                    <?php if ($record['is_visible'] == 0) { ?>

                                        <div class="checkbox visible_chk">
                                            <!--<label>-->
                                                <!--<div class="checker border-success-600 text-success-800"><span class="checked"><input class="control-success" disabled="" checked="checked" type="checkbox"></span></div>-->
                                                Yes
                                            <!--</label>-->
                                        </div>

                                    <?php } else { ?>
                                        <div class="checkbox visible_chk">
                                            <!--<label>-->
                                                <!--<div class="checker border-warning-600 text-warning-800"><i class="icon-cancel-square" style="margin-top: -4px;"></i></div>-->
                                                NO
                                            <!--</label>-->
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="description"><?php echo html_excerpt($record['description']); ?></div>
                                <div class="expiers">
                                    <i class="icon-calendar"></i> <?php echo date('d F, Y', strtotime($record['created'])); ?><br>                                            
                                    <!--<h6 class="media-heading" style="display:inline; font-weight: 500;">Expires On: </h6><span><?php echo $record['cat_name']; ?></span>-->
                                </div>
                            </div>
                        </div>

                    </div>

                    <a class="pull-right text-danger-600 delete" id="delete_<?php echo base64_encode($record['id']); ?>" data-record="<?php echo base64_encode($record['id']); ?>"><i class="icon-trash"></i></a>
                    <a class="pull-right text-teal-600 edit" href="<?php echo base_url() . 'admin/articles/edit/' . base64_encode($record['id']) ?>" id="edit_<?php echo base64_encode($record['id']); ?>"><i class="icon-pencil7"></i></a>
                </div>

            </div>

            <?php
        }
        ?>
    </div>
    <!--</div>-->
</div>
</div>
</div>

<style>
    .visible_chk {display: inline;}
    .checkbox .checker{top: 0;}
    .expiers{margin-top: 7px;}
    .checker .icon-cancel-square{font-size: 17px;}
</style>
<script type="text/javascript">
    $(function () {
        $('.datatable-basic').DataTable();
    });

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
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'articles/delete';
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
                        }
                    }
                });
            }
        });
    });
</script> 