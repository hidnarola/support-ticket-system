<?php
$action = $this->uri->segment(1);
$suffixUrl = '';
if ($this->input->get('filter'))
    $suffixUrl = "?filter=" . $this->input->get('filter');
?>
<!--<script type="text/javascript" src="assets/admin/js/plugins/notifications/bootbox.min.js"></script>-->
<style>.series_no{font-size: 18px!important;line-height: 1!important;padding: 0 0 5px!important;}</style>
<div class="content-wrap">
    <div class="container clearfix ticket-listing">
        <div class="row clearfix">
            <div class="col-sm-9">
                <?php
                if ($this->session->flashdata('success_msg')) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success_msg'); ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($this->session->flashdata('error_msg')) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error_msg'); ?>
                    </div>
                    <?php
                }
                ?>

                <div class="row">
                    <div class="col-sm-3">
                        <?php
                        $current = $this->uri->segment(3);
                        $current = $this->input->get('filter');
                        ?>
                        <!-- <label class="control-label">Filter by Status</label> -->
                        <form method="get" id="category_search" action="tickets">
                        <select class="select filter form-control" id="filter" name='filter' onchange="document.getElementById('category_search').submit();">
                        <option <?php echo ($current == '') ? 'selected' : ''; ?> value="">Select Status</option>
                        <?php foreach ($statuses as $status) { ?>
                            <option <?php echo ($current == $status['id'] ) ? 'selected' : ''; ?> value="<?php echo $status['id'] ?>"><?php echo $status['name'] ?></option>
                        <?php } ?>
                    </select>
                            <!-- <select class="select filter form-control" id="filter" name='filter' onchange="document.getElementById('category_search').submit();">
                                <option <?php echo ($current == '') ? 'selected' : ''; ?> value="">All</option>
                                <option <?php echo ($current == '3') ? 'selected' : ''; ?> value="3">Open</option>
                                <option <?php echo ($current == '5') ? 'selected' : ''; ?> value="5">Pending</option>
                                <option <?php echo ($current == '2') ? 'selected' : ''; ?> value="2">In Progress</option>
                                <option <?php echo ($current == '4') ? 'selected' : ''; ?> value="4">Paused</option>
                                <option <?php echo ($current == '1') ? 'selected' : ''; ?> value="1">Closed</option>
                            </select> -->
                        </form>
                    </div>
                    <div class="col-sm-9">

                        <a class="button button-rounded button-reveal button-small pull-right" onclick="window.location = 'tickets/add'"><i class="icon-plus-sign"></i><span>Add Ticket</span></a>
                    </div>
                </div>

                <?php
                if ($tickets) {
                    foreach ($tickets as $key => $record) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row left-section">

                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <div class="ticket-img">
                                        <?php if($record['image']!=''){ ?>
                                            <a class="fancybox" href="<?php echo TICKET_IMAGE.'/'.$record['image'] ?>" data-fancybox-group="gallery"><img src="<?php echo TICKET_MEDIUM_IMAGE.'/'.$record['image']; ?>" alt="" /></a>
                                            
                                        <?php }else{ ?>
                                            <img src="assets/admin/images/ticket_section.png"/>
                                        <?php }?>
                                        
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <ul class="top-section">
                                            <li><a><i class="icon-clock" aria-hidden="true"></i>Update: <span><?php echo date('Y-m-d', strtotime($record['created'])); ?></span></a></li>
                                            <?php if ($record['staff_fname'] != '') { ?>
                                                <li><a><i class="icon-user" aria-hidden="true"></i>Assign To: <span><?php echo $record['staff_fname'] . ' ' . $record['staff_lname']; ?></span></a></li>
                                            <?php } ?>
        <!--<li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i><span>2</span></a></li>-->
                                            <?php if ($record['is_read'] == 0) { ?>
                                                <!--<li><a><span class="label label-warning">Unread</span></a></li>-->
                                            <?php } else { ?>
                                                <!--<li><a><span class="label label-success">Read</span></span></a></li>-->
                                            <?php } ?>
                                            <li class="view"><a href="<?php echo base_url() . 'tickets/view/' . base64_encode($record['id']) ?>"><i class="icon-eye-open"></i></a></li>
                                            <!--<li class="edit"><a href="<?php echo base_url() . 'tickets/reply/' . base64_encode($record['id']) ?>"><i class="icon-envelope2"></i></a></li>-->


                                                                                                    <!--<li><a href="http://clientapp.narola.online/HD/spotashoot/admin/users/edit/251" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a></li>-->
                                                                                                    <!--<li class="edit"><a href="#" class="button button-rounded button-reveal button-mini button-teal edit"><i class="icon-pencil"></i><span>edit</span></a></li>-->

                                        </ul>
                                        <p class="series_no"><?php echo $record['series_no']; ?></p>
                                        <p><a href="<?php echo base_url() . 'tickets/view/' . base64_encode($record['id']) ?>"><?php echo $record['title']; ?></a></p>
                                        <ul class="bottom-section">
                                            <li><a class="resolved"><?php echo $record['dept_name']; ?></a></li>
                                            <li><a><span>Priority: </span><?php echo $record['priority_name']; ?></a></li>
                                            <li><a><span>Type: </span><?php echo $record['type_name']; ?></a></li>
                                            <li><a><span>Status: </span><?php echo $record['status_name']; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="row">  
                        <div class='col-sm-12'>
                            <?php echo $links; ?>
                        </div>
                    </div>
                <?php } else {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="style-msg infomsg">
                                <div class="sb-msg"><i class="icon-info-sign"></i><strong>No tickets are available!!!</strong></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>


            </div>
            <div class="line visible-xs-block"></div>
            <?php $this->load->view('frontend/User/rightsidebar'); ?>

        </div>

    </div>
</div>

<div class="modal fade bs-example-modal-sm1" id="confirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Dialogue</h4>
                </div>
                <div class="modal-body">
                    <p class="nobottommargin"> Do you really want to delete this ticket?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="assets/admin/css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script>
    jQuery(document).ready(function ($) {
         $('.fancybox').fancybox();
        // $('#datatable1').DataTable();
    });
</script>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000);

    var base_url = '<?php echo base_url(); ?>';
    $(document).on('click', '.delete', function () {
        var id = $(this).attr('id').replace('delete_', '');
        var url = base_url + 'tickets/delete';
        $('#delete').on('click', function (e) {
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
                    }
                }
            });
        });
    });
    function load_news(val) {
        if (val == '') {
            window.location = "tickets";
        } else {
            window.location = "tickets/index?" + val;
        }
    }
</script>