<?php
$page = $this->uri->segment(1);
$page_sec = $this->uri->segment(2);
?>
<div class="col-sm-3 clearfix">

    <div class="list-group">
        <a  href="profile" class="list-group-item clearfix <?php echo ($page == 'profile' && $page_sec == '') ? 'active' : ''; ?>">Profile <i class="icon-user pull-right"></i></a>
        <a  href="profile/changepassword" class="list-group-item clearfix <?php echo ($page_sec == 'changepassword') ? 'active' : ''; ?>">Change Password <i class="icon-edit pull-right"></i></a>
        <?php if ($user['status'] != 0 && $this->session->userdata('user_logged_in')) { ?>
            <a href="tickets" class="list-group-item clearfix <?php echo ($page == 'tickets') ? 'active' : ''; ?>">My Tickets <i class="icon-ticket pull-right"></i></a>
        <?php } ?>
        <a href="login/logout" class="list-group-item clearfix">Logout <i class="icon-line2-logout pull-right"></i></a>
    </div>
</div>
<?php $this->load->view('Frontend/rightsidebar'); ?>