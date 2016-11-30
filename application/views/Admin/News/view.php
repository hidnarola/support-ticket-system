<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo ($data['is_news']==0) ? 'Announcement' : 'News'; ?></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?php echo site_url('admin/news'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $title; ?></a></li>
            <li class="active"><?php echo $page; ?></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">                
                        <div class="panel-body">
                        <div class="pull-right"><h6><?php echo date('F j, Y', strtotime($data['modified'])); ?></h6></div>
                            <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                <?php if($data['image'] != ''){ 
                                    $image = NEWS_MEDIUM_IMAGE.'/'.$data['image'];
                                    if($data['is_news'] == 0){
                                        $image = ANNOUNCEMENT_MEDIUM_IMAGE.'/'.$data['image'];
                                    }
 
                                    ?>
                                    <div class="row"><img src="<?php echo $image ?>"></div>

                                <?php } ?>
                                <div class="row">
                                    <h1><?php echo $data['title']; ?></h1>
                                </div>
                                <div class="row">
                                    <?php echo trim($data['description']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>