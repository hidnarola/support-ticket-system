<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="assets/admin/js/core/libraries/jquery_ui/touch.min.js"></script>
<script type="text/javascript" src="assets/admin/js/pages/jqueryui_interactions.js"></script>
<script type="text/javascript" src="assets/admin/js/plugins/notifications/sweet_alert.min.js"></script>
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold">Pages</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Pages</li>
        </ul>
    </div>
</div>
<?php
if ($this->session->flashdata('success')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('success') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('success', false);
} else if ($this->session->flashdata('error')) {
    ?>
    <div class="content pt0">
        <div class="alert alert-danger">
            <a class="close" data-dismiss="alert">×</a>
            <strong><?= $this->session->flashdata('error') ?></strong>
        </div>
    </div>
    <?php
    $this->session->set_flashdata('error', false);
} else {
    echo validation_errors();
}
?>
<div class="content">
    <div class="panel panel-flat">
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Navigation Name</th>
                    <th>Title</th>
                    <th>Parent Page</th>
                    <th>Display In Header</th>
                    <th>Display In Footer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srno = 1;
                foreach ($pages as $page) {
                    ?>
                    <tr>
                        <td><?php echo $srno; ?></td>
                        <td><?php echo $page['navigation_name']; ?></td>
                        <td><?php echo $page['title']; ?></td>
                        <td><?php echo date('F j, Y', strtotime($page['created'])); ?></td>
                        <td>
                        <?php if ($page['show_in_header'] == 0) { ?>
                            <div class="checkbox"><label><input type="checkbox" class="styled" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_header">
                            </label></div>
                    <?php }else { ?>
                        <div class="checkbox"><label><input type="checkbox" class="styled" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_header"></label></div>
                    <?php } ?>
                    </td>
                    <td>
                        <?php if ($page['show_in_footer'] == 0) { ?>
                            <div class="checkbox">
                                <label>
                                   <input type="checkbox" class="styled" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_footer">
                                </label>
                            </div>
                    <?php }else { ?>
                        <div class="checkbox"><label><input type="checkbox" class="styled" value="1" data-id="<?php echo $page['id']; ?>" data-type="show_in_footer"></label></div>
                    <?php } ?>
                    </td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title text-semibold">Arrange header links</h6>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <ul class="selectable-demo-list" id="header_sortable">
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <button class="btn btn-primary" onclick="save_header_footer_arrangment('header')" id="header_save">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title text-semibold">Arrange footer links</h6>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <ul class="selectable-demo-list" id="footer_soratable">
                        </ul>
                    </div>
                    <hr>
                    <div>
                        <button class="btn btn-primary" onclick="save_header_footer_arrangment('footer')" id="footer_save">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
    <?php //$this->load->view('Templates/admin_footer'); ?>
</div>
<script>

$(document).on('click','.styled', function () {
    data_type = $(this).data('type');
    data_id = $(this).data('id');
    if($(this).parent().attr('class') == 'checked') {
        $(this).parent().removeClass('checked');
        $(this).prop('checked', false);
        value = 0;
    }
    else {
        $(this).parent().addClass('checked');
        $(this).prop('checked', true);
        value = 1;
    }

    $.ajax({
        url: "<?php site_url() ?>admin/header_footer_control/change_data_status",
        data: {type : data_type, id : data_id, value : value},
        type : "POST",
        success: function(result){
            swal("Success!", "Your changes was successfully arranged!", "success");
            common_ajax_call();
        }
    });
});

$(function () {
    $('.datatable-basic').dataTable();

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    common_ajax_call();
});

function common_ajax_call(){
    $.ajax({
        url: "<?php site_url() ?>admin/header_footer_control/get_header_footer",
        type : "POST",
        data : {type : 'header'},
        success: function(result){
            data = JSON.parse(result);
            str = '';
            if(data != ''){
                $.each(data, function(i, item) {
                    str += '<li class="ui-sortable-handle" id="' + item.id + '">' + item.navigation_name + '</li>';
                });
                $('#header_save').show();
            } else {
                str += 'No header links found...';
                $('#header_save').hide();
            }
            $('#header_sortable').html(str);
            $("#header_sortable").sortable();
        }
    });

    $.ajax({
        url: "<?php site_url() ?>admin/header_footer_control/get_header_footer",
        type : "POST",
        data : {type : 'footer'},
        success: function(result1){
            data1 = JSON.parse(result1);
            str1 = '';
            if(data1 != ''){
                $.each(data1, function(i1, item1) {
                    str1 += '<li class="ui-sortable-handle" id="' + item1.id + '">' + item1.navigation_name + '</li>';
                });
                $('#footer_save').show();
            } else {
                str1 += 'No footer links found...';
                $('#footer_save').hide();
            }
            $('#footer_soratable').html(str1);
            $("#footer_soratable").sortable();
        }
    });
}

function save_header_footer_arrangment(type){
    if(type == 'header'){
        data = $('#header_sortable').sortable('toArray');
    } else {
        data = $('#footer_soratable').sortable('toArray');
    }
    $.ajax({
        url: "<?php site_url() ?>admin/header_footer_control/save_arrangement",
        type : "POST",
        data : {type : type, data : data},
        success: function(result1){
            if(type == 'header')
                swal("Success!", "Your header links was successfully arranged!", "success");
            else
                swal("Success!", "Your footer links was successfully arranged!", "success");
        }
    });
}
</script>