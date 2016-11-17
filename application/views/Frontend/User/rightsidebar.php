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

<!--    <div class="fancy-title topmargin title-border">
        <h4>About Me</h4>
    </div>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum laboriosam, dignissimos veniam obcaecati. Quasi eaque, odio assumenda porro explicabo laborum!</p>

    <div class="fancy-title topmargin title-border">
        <h4>Social Profiles</h4>
    </div>

    <a href="#" class="social-icon si-facebook si-small si-rounded si-light" title="Facebook">
        <i class="icon-facebook"></i>
        <i class="icon-facebook"></i>
    </a>

    <a href="#" class="social-icon si-gplus si-small si-rounded si-light" title="Google+">
        <i class="icon-gplus"></i>
        <i class="icon-gplus"></i>
    </a>

    <a href="#" class="social-icon si-dribbble si-small si-rounded si-light" title="Dribbble">
        <i class="icon-dribbble"></i>
        <i class="icon-dribbble"></i>
    </a>

    <a href="#" class="social-icon si-flickr si-small si-rounded si-light" title="Flickr">
        <i class="icon-flickr"></i>
        <i class="icon-flickr"></i>
    </a>

    <a href="#" class="social-icon si-linkedin si-small si-rounded si-light" title="LinkedIn">
        <i class="icon-linkedin"></i>
        <i class="icon-linkedin"></i>
    </a>

    <a href="#" class="social-icon si-twitter si-small si-rounded si-light" title="Twitter">
        <i class="icon-twitter"></i>
        <i class="icon-twitter"></i>
    </a>-->

</div>
<?php $this->load->view('frontend/rightsidebar'); ?>