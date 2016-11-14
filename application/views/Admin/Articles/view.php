<div class="row">

    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="<?php echo $icon_class; ?> position-left"></i> <span class="text-semibold"><?php echo $title; ?></h4>
            </div>
        </div>
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
                <li><a href="<?php echo site_url('admin/articles'); ?>"><i class="<?php echo $icon_class; ?> position-left"></i><?php echo $page; ?></a></li>
                <li class="active"><?php echo $title; ?></li>
            </ul>
        </div>
    </div>

    <div class="content">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Article
                            </h5>
                        </div>

                        <div class="panel-body">
                            <div class="center-block" style="max-width:650px;margin: 0 auto;">

                                <?php
                                if ($data['image'] != '') {
                                    $image = ARTICLE_IMAGE . '/' . $data['image'];
                                    ?>
                                    <div class="row entry-image"><img src="<?php echo $image ?>"></div>
                                <?php }
                                ?>

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
</div>

<style>
    .entry-image {
        display: block;
        position: relative;
        width: 100%;
        height: auto;
    }
    .entry-image img {
        width: 100%;
    }
</style>