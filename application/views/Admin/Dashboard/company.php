<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="<?php echo $icon_class;?> position-left"></i> <span class="text-semibold"><?php echo $title;?></span></h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="row profile_page">
<?php $this->load->view('Admin/message_view');?>
        <div class="col-md-12">

            <!-- Basic layout-->
            <form class="profile_frm" method="post">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                        <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>Company Name:</label>
                            <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name" value="<?php echo $company['company_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" name="company_address" class="form-control" placeholder="Enter Address" value="<?php echo $company['company_address']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Zipcode:</label>
                            <input type="text" name="company_zipcode" class="form-control" placeholder="Enter Zipcode" value="<?php echo $company['company_zipcode']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Contact Person:</label>
                            <input type="text" name="company_contact_person" class="form-control" placeholder="Enter Contact Person" value="<?php echo $company['company_contact_person']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Contact No:</label>
                            <input type="text" name="company_contact_no" class="form-control" placeholder="Enter Contact No" value="<?php echo $company['company_contact_no']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Company Email:</label>
                            <input type="email" name="company_email" class="form-control" placeholder="Enter Email" value="<?php echo $company['company_email']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Website:</label>
                            <input type="text" name="company_website" class="form-control" placeholder="Enter website url" value="<?php echo $company['company_website']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Description:</label>
                            <textarea name="company_description" class="form-control"><?php echo $company['company_description']; ?></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary legitRipple">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /basic layout -->

        </div>
    </div>
</div>
