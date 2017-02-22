<link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
<style> .fancy-title.title-dotted-border {
        background: url(assets/frontend/images/icons/dotted.png) repeat-x center;
    }
    .title-center {
        text-align: center;
    }
    .fancy-title {
        position: relative;
        margin-bottom: 30px;
    }
    .fancy-title h3 {
        position: relative;
        display: inline-block;
        background-color: #FFF;
        padding-right: 15px;
        margin-bottom: 20px;
    }
    .title-center h3 {
        padding: 0 15px;
    }
</style>
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
    <?php $this->load->view('Admin/message_view'); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-group ticket-view-panel" id="accordion1" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default ticket_details">
                    <div class="panel-heading " role="tab" id="heading1">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="true" aria-controls="collapse1" class="pull-right">
                                <i class="solsoCollapseIcon fa fa-chevron-up"></i>	
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body ticket-view">
                                <table class="table table-striped table-bordered newTickets" data-alert="" data-all="189">
                                    <tbody>
                                        <tr class="alpha-teal">
                                            <th>Reference No.</th>
                                            <td><?php echo $banner->reference_number; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td><?php echo $banner->prop_title ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Property Category Type</th>
                                            <td><?php echo $banner->type_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Property Contract</th>
                                            <td><?php echo $banner->category_name ?></td>
                                        </tr> 
                                        <tr class="alpha-teal">
                                            <th>Price</th>
                                            <td><?php echo $banner->price.' AED'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Area (in sq.ft)</th>
                                            <td><?php echo $banner->area.' Sq. ft' ?></td>
                                        </tr>  
                                        <tr class="alpha-teal">
                                            <th>BHK</th>
                                            <td><?php echo "<b>Bedrooms : </b>".$banner->bedroom_no." / <b>Bathrooms : </b>".$banner->bathroom_no ?></td>
                                        </tr>                               
                                        <tr>
                                            <th>Banner Status</th>
                                            <td>
                                                <?php 
                                                    if($banner->status=='Active'){
                                                        echo "<span class='label label-success'>Active</span>";
                                                    }else{
                                                        echo "<span class='label label-danger'> Inactive </span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>                               
                                        <tr  class="alpha-teal">
                                            <th>Banner Position</th>
                                            <td><?php echo $banner->position ?></td>
                                        </tr>
                                        <tr>
                                            <th>Added On</th>
                                            <td><?php echo date('d-M-Y', strtotime($banner->created)) ?></td>
                                        </tr>

                                        <?php if($banner->image!= ''){ ?>
                                            <tr class="alpha-teal">
                                                <th>Images</th>
                                                <td> 
                                                    <?php
                                                        $img_arr = explode(',',$banner->image);
                                                        foreach($img_arr as $k => $v){
                                                            if(file_exists(PROPERTY_BANNER.'/'.$v)){
                                                    ?>
                                                                <a class="fancybox" href="<?php echo PROPERTY_BANNER . '/' . $v; ?>" data-fancybox-group="gallery"><img src="<?php echo PROPERTY_BANNER . '/' . $v; ?>" alt="" height="60px" width="60px" /></a>
                                                    <?php 
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>					
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.fancybox').fancybox();
    });
</script>
