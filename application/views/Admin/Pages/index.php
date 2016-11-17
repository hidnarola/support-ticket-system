<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-magazine"></i> <span class="text-semibold">Pages</span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/home'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
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
        <div class="panel-heading text-right">
            <a href="<?php echo site_url('admin/pages/manage'); ?>" class="btn btn-success btn-labeled"><b><i class="icon-magazine"></i></b> Add new page</a>
        </div>
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Modified Date</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $srno = 1;
                foreach ($pages as $page) { ?>
                    <tr>
                        <td><?php echo $srno; ?></td>
                        <td><?php echo $page['title']; ?></td>
                        <td><?php echo date('F j, Y', strtotime($page['created'])); ?></td>
                        <td><?php $status = '<span class="label bg-success">Active</span>';
                    if ($page['active'] == '0') {
                        $status = '<span class="label bg-grey">InActive</span>';
                    }
                    if ($page['active'] == '2') {
                        $status = '<span class="label bg-danger">Deleted</span>';
                    } echo $status ?></td>
                        <td>
                            <?php if ($page['active'] == '1') { ?>
                        
                            <a href="admin/pages/manage/<?php echo $page['id']; ?>" class="btn border-primary text-primary-600 btn-flat btn-icon btn-rounded btn-sm"><i class="icon-pencil3"></i></a>
                            <?php 
                        }else { ?>
                        <a href="admin/pages/activate/<?php echo $page['id']; ?>" class="btn border-success text-success-600 btn-flat btn-icon btn-rounded"><i class="icon-checkmark"></i></a>
                    <?php } ?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    