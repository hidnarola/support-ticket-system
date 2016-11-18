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
<style>
    .alert-dismissable .close, .alert-dismissible .close {right: -10px;}
</style>
<script type="text/javascript">
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 6000);
</script>