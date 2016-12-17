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
<?php $this->load->view('Admin/message_view');?>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <!-- <h5 class="panel-title"> -->
            <div class="row">
                <div class="col-md-2 form-group has-feedback">
                    <form method="get">
                        <input type="text" name="search_text" value="<?php echo ($search_text != '') ? $search_text : ''; ?>" class="form-control" placeholder="Search">
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-size-base" style="margin-right: 10px;"></i>
                        </div>
                    </form>
                </div>
                <div class="col-md-10">
                    <div class="col-md-3">
                    <?php $current = $this->uri->segment(4); ?>
                    <select class="select filter" onchange="load_news(this.value);">
                        <option <?php echo ($current == '') ? 'selected' : ''; ?> value="">Both</option>
                        <option <?php echo ($current == '1') ? 'selected' : ''; ?> value="1">News</option>
                        <option <?php echo ($current == '0') ? 'selected' : ''; ?> value="0">Announcements</option>
                    </select>
                    </div>
                    <div class="col-md-9"> 
                    <a onclick="window.location = 'admin/news/add'" class="btn btn-success btn-labeled pull-right news_ann"><b><i class="icon-plus-circle2"></i></b> Add New</a></div>
                </div>
            </div>
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
                                <a title="<?php echo ($news['is_news'] == 1) ? 'News' : 'Announcement'; ?>"><i class="<?php echo ($news['is_news'] == 1) ? 'icon-newspaper2' : 'icon-megaphone'; ?> text-success-400 icon-2x no-edge-top mt-5"></i></a>
                            </div>

                            <div class="media-body">
                                <?php if($news['image'] != ''){ 
                                    $image = NEWS_MEDIUM_IMAGE.'/'.$news['image'];
                                    if($news['is_news'] == 0){
                                        $image = ANNOUNCEMENT_MEDIUM_IMAGE.'/'.$news['image'];
                                    } ?>

                                    <div class="col-md-2">
                                        <img style="width:100%" src="<?php echo $image; ?>"/>
                                    </div>
                                <?php } ?>

                                <div class="col-md-9">
                                    <h5 class="media-heading text-semibold"><a href="admin/news/view/<?php echo $news['is_news'] . '/' . base64_encode($news['id']); ?>" class="text-default"><?php echo $news['title']; ?></a></h5>
                                    <div class="description"><?php echo html_excerpt($news['description']); ?></div>
                                </div>                              
                            </div>

                            <a class="pull-right text-danger-600 delete" id="delete_<?php echo base64_encode($news['id']); ?>" data-record="<?php echo base64_encode($news['id']); ?>"><i class="icon-trash"></i></a>
                            <a class="pull-right text-teal-600 edit" href="<?php echo base_url() . 'admin/news/edit/' . base64_encode($news['id']) ?>" id="edit_<?php echo base64_encode($news['id']); ?>"><i class="icon-pencil7"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
    //var type = '<?php echo $this->uri->segment(2); ?>';

    /* delete record function */
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'news/delete';
        jconfirm("Do you really want to delete this record?", function (r) {
            if (r) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    async: false,
                    dataType: 'JSON',
                    data: {id: id},
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

    function load_news(val) {
        if (val == '') {
            window.location = "admin/news";
        } else {
            window.location = "admin/news/index/" + val;
        }
    }
</script>