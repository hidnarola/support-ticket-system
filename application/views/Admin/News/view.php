
<div class="row">
    <div class="col-md-12">
        
                
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title"><?php echo ($data['is_news']==0) ? 'Announcement' : 'News'; ?>
                            </h5>
                        </div>
                
                        <div class="panel-body">
                            <div class="center-block" style="max-width:650px;margin: 0 auto;">
                                
                                <?php if($data['image'] != ''){ 
                                    $image = NEWS_IMAGE.'/'.$data['image'];
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