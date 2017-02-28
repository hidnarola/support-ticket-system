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
                            <?php echo $property->title; ?>
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
                                            <th style="width:20%">Reference No.</th>
                                            <td><?php echo $property->reference_number; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Contact Details</th>
                                            <td><a href="#" data-toggle="modal" data-target="#modal_theme_success"><?php echo $property->contact_name; ?></a></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Title</th>
                                            <td><?php echo $property->title ?></td>
                                        </tr>
                                        <tr>
                                            <th style="vertical-align:top !important">Description</th>
                                            <td style="text-align:justify"><?php echo $property->short_description ?></td>
                                        </tr>
                                        <tr class="alpha-teal">
                                            <th>Property Category Type</th>
                                            <td><?php echo $property->type_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Property Contract</th>
                                            <td><?php echo $property->category_name ?></td>
                                        </tr> 
                                        <tr class="alpha-teal">
                                            <th>Price</th>
                                            <td><?php echo number_format($property->price).' AED'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Area (in sq.ft)</th>
                                            <td><?php echo number_format($property->area).' Sq. ft' ?></td>
                                        </tr>  
                                        <tr class="alpha-teal">
                                            <th>BHK</th>
                                            <td><?php echo "<b>Bedrooms : </b>".$property->bedroom_no." / <b>Bathrooms : </b>".$property->bathroom_no ?></td>
                                        </tr>                               
                                        <tr>
                                            <th>Property Status</th>
                                            <td>
                                                <?php 
                                                    if($property->status=='Active'){
                                                        echo "<span class='label label-success'>Active</span>";
                                                    }else{
                                                        echo "<span class='label label-danger'> Inactive </span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr> 
                                        <tr class="alpha-teal">
                                            <th>Featured</th>
                                            <td>
                                                <?php 
                                                    if($property->is_featured=='1'){
                                                        echo "<span class='label label-primary'>YES</span>";
                                                    }else{
                                                        echo "<span class='label label-default'> NO </span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>                                

                                        <tr>
                                            <th>Added On</th>
                                            <td><?php echo date('d-M-Y', strtotime($property->created)) ?></td>
                                        </tr>

                                        <?php if($property->images!= ''){ ?>
                                            <tr class="alpha-teal">
                                                <th>Images</th>
                                                <td> 
                                                    <?php
                                                        $img_arr = explode(',',$property->images);
                                                        foreach($img_arr as $k => $v){
                                                            if(file_exists(PROPERTY_IMAGE.'/'.$v)){
                                                    ?>
                                                                <a class="fancybox" href="<?php echo PROPERTY_IMAGE . '/' . $v; ?>" data-fancybox-group="gallery"><img src="<?php echo PROPERTY_THUMB_IMAGE . '/' . $v; ?>" alt="" height="60px" width="60px" /></a>
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


                        <!-- <div class="fancy-title title-dotted-border title-center">
                            <h3>Comments </h3>
                        </div>

                        <ul class="media-list chat-list content-group">
                            <?php foreach ($ticket_coversation as $key => $value) { ?>
                                <li class="media date-step content-divider">
                                    <span><?php echo $key; ?></span>
                                </li>
                                <?php
                                foreach ($value as $val) {
                                    if ($val['sent_from'] != $this->session->userdata('admin_logged_in')['id']) {
                                        ?>
                                        <li class="media">
                                            <div class="media-left">
                                                <?php
                                                if ($val['profile_pic'] != '') {
                                                    $filename = getimagesize(base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic']);
                                                    if ($filename > 0) {
                                                        ?>
                                                        <a href="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>">
                                                            <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>" class="img-circle" alt="">
                                                        </a>
                                                        <?php } else { ?>
                                                            <a href="assets/admin/images/placeholder.jpg">
                                                                <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                            </a>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <a href="assets/admin/images/placeholder.jpg">
                                                            <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                        </a>
                                                    <?php } ?>

                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <label class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></label>
                                                    <span><strong><br><?php
                                                            if ($val['role_id'] == 1) {
                                                                echo 'Tenant';
                                                            } elseif ($val['role_id'] == 2) {
                                                                echo 'staff';
                                                            } elseif ($val['role_id'] == 3) {
                                                                echo 'Admin';
                                                            }elseif ($val['role_id'] == 4) {
                                                                echo 'Sub Admin';
                                                            }
                                                            ?></strong></span>
                                                            </div>
                                                            <div class="media-content"><?php echo $val['message']; ?></div>
                                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                                    
                                                </div>
                                                
                                            
                                        </li>
                                    <?php } else {
                                        ?>

                                        <li class="media reversed">
                                            <div class="media-body">
                                                <div class="media-heading">
                                                      <label class="text-semibold"><?php echo $val['fname'] . ' ' . $val['lname']; ?></label>
                                                    <span><strong><br><?php
                                                            if ($val['role_id'] == 1) {
                                                                echo 'Tenant';
                                                            } elseif ($val['role_id'] == 2) {
                                                                echo 'staff';
                                                            } elseif ($val['role_id'] == 3) {
                                                                echo 'Admin';
                                                            }elseif ($val['role_id'] == 4) {
                                                                echo 'Sub Admin';
                                                            }
                                                            ?></strong></span>
                                                </div>
                                                <div class="media-content"><?php echo $val['message']; ?></div>
                                                <span class="media-annotation display-block mt-10"><?php echo $date = date('g:i a', strtotime($val['created_date'])); ?></span>
                                            </div>

                                            <div class="media-right">
                                                <?php
                                                if ($val['profile_pic'] != '') {
                                                    $filename = getimagesize(base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic']);
                                                    if ($filename > 0) {
                                                        ?>
                                                        <a href="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>">
                                                            <img src="<?php echo base_url() . USER_PROFILE_IMAGE . '/' . $val['profile_pic'] ?>" class="img-circle" alt="">
                                                        </a>
                                                        <?php } else { ?>
                                                            <a href="assets/admin/images/placeholder.jpg">
                                                                <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                            </a>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <a href="assets/admin/images/placeholder.jpg">
                                                            <img src="assets/admin/images/placeholder.jpg" class="img-circle" alt="">
                                                        </a>
                                                    <?php } ?>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </ul> -->

                        <form method="post" class="form-validate-jquery">
                            <!-- <textarea name="enter-message" required="" class="form-control content-group" rows="3" cols="1" placeholder="Enter your message..."></textarea> -->
                            <div class="row">
                                <div class="col-xs-6"></div>
                                <div class="col-xs-6 text-right">

                                    <button type="button" class="btn border-slate btn-flat cancel-btn" onclick="window.history.back()">Back</button>
                                    <!-- <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Comment</button> -->

                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Success modal -->
<div id="modal_theme_success" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal-400">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Contact Details</h6>
            </div>

            <div class="modal-body panel-body login-form" id="password_form" >
                <table class="table table-striped table-bordered newTickets ticket_details" data-alert="" data-all="189">
                    <tbody>
                        <tr>
                            <th>Contact Name</th>
                            <td><?php echo $property->contact_name; ?></td>
                        </tr>
                        <tr>
                            <th>Email ID</th>
                            <td><?php echo $property->contact_email; ?></td>
                        </tr>
                        <tr>
                            <th>Contact No.</th>
                            <td><?php echo $property->contact_no; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-teal legitRipple" data-dismiss="modal">Close</button>
            </div>          

        </div>
    </div>
</div>
<script>
    $(function () {
        $('.fancybox').fancybox();
    });
</script>
