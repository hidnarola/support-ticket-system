<div class="panel panel-flat">
    <div class="panel-heading">
        <!-- <h5 class="panel-title"> -->
        <div class="row">
            <div class="col-md-3 form-group has-feedback">
                <form method="post" action="admin/faq">
                    <input type="text" name="search_text" value="<?php echo ($search_text!='') ? $search_text : ''; ?>" class="form-control" placeholder="Search">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-size-base"></i>
                    </div>
                </form>
            </div>
            <div class="col-md-9">           
                <button type="button" class="btn bg-pink-400 pull-right" onclick="window.location = 'admin/news/add'"><i class="icon-plus-circle2 position-left"></i>Add New</button>
            </div>
        </div>
        <!-- </h5> -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Questions list -->
        
                            
            <?php foreach ($data as $news) { ?>
        <div class="col-md-12">
                <div class="panel panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a title="<?php echo ($news['is_news']==1) ? 'News' : 'Announcement'; ?>"><i class="<?php echo ($news['is_news']==1) ? 'icon-newspaper2' : 'icon-megaphone'; ?> text-success-400 icon-2x no-edge-top mt-5"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="media-heading text-semibold"><a href="#" class="text-default"><?php echo $news['title']; ?></a></h6>
                                        <?php echo $news['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php } ?>
        
        <!-- /questions list -->
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