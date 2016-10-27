<div class="col-md-12 profile_page">
		
		<!-- Basic layout-->
		<form class="profile_frm" method="post">
			<div class="panel panel-flat">
				<div class="panel-heading">
				<h5 class="panel-title">Personal Details</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                	</ul>
                	</div>
				<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

				<div class="panel-body">
					<div class="form-group">
						<label>First Name:</label>
						<input type="text" name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo $profile['fname']; ?>">
					</div>
					<div class="form-group">
						<label>Last Name:</label>
						<input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo $profile['lname']; ?>">
					</div>

					<div class="form-group">
						<label>Email:</label>
						<input type="email" name="email" disabled="disabled" class="form-control" placeholder="Enter Email" value="<?php echo $profile['email']; ?>">
					</div>

					<div class="form-group">
						<label>Contact No:</label>
						<input type="text" name="contactno" class="form-control" placeholder="Enter Contact Number" value="<?php echo $profile['contactno']; ?>">
					</div>

					<div class="form-group">
						<label>Address:</label>
						<textarea name="address" class="form-control"><?php echo $profile['address']; ?></textarea>
					</div>

					
					<div class="form-group">
						<label class="display-block">Your avatar:</label>
						<div class="uploader">
						<input type="file" name="profile_pic" class="file-styled">
						</div>
						<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
					</div>


					<div class="text-right">
						<button type="submit" class="btn btn-primary legitRipple">Save Profile<i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</div>
			</div>
		</form>
		<!-- /basic layout -->

	</div>
	<div class="col-md-12">
		<div class="panel panel-flat">
				<div class="panel-heading">
				<h5 class="panel-title">Change Password</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                	</ul>
                	</div>
				<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
				<form class="change_pwd_frm" method="post" action="staff/dashboard/change_password">
				<div class="panel-body">
					<div class="form-group">
						<label>Old Password:</label>
						<input type="password" name="old_password" class="form-control"  placeholder="Enter Old Password" value="">
					</div>
					<div class="form-group">
						<label>New Password:</label>
						<input type="password" name="new_password" class="form-control" placeholder="Enter New Password" value="">
					</div>
					<div class="form-group">
						<label>Retype New Password:</label>
						<input type="password" name="cnfrm_password" class="form-control" placeholder="Re-enter New Password" value="">
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary legitRipple">Save Password <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</div>
				</form>
			</div>
	</div>

	<div class="col-md-12">
		<div class="panel panel-flat">
				<div class="panel-heading">
				<h5 class="panel-title">Department Details</h5>
					<div class="heading-elements">
						<ul class="icons-list">
	                		<li><a data-action="collapse"></a></li>
	                	</ul>
                	</div>
				<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label col-md-2">Department Name:</label>
						<label  class="control-label col-md-2"><?php echo $profile['dept_name']; ?></label>
					</div>
				</div>
			</div>
	</div>

	