<div class="panel">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">

							<!-- Basic layout-->
							<form class="profile_frm" action="#">
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
											<label>First Name:</label>
											<input type="text" class="form-control" placeholder="Enter First Name" value="<?php echo $profile['fname']; ?>">
										</div>
										<div class="form-group">
											<label>Last Name:</label>
											<input type="text" class="form-control" placeholder="Enter Last Name" value="<?php echo $profile['lname']; ?>">
										</div>

										<div class="form-group">
											<label>Email:</label>
											<input type="email" class="form-control" placeholder="Enter Email" value="<?php echo $profile['email']; ?>">
										</div>

										<div class="form-group">
											<label>Contact No:</label>
											<input type="text" class="form-control" placeholder="Enter Contact Number" value="<?php echo $profile['contactno']; ?>">
										</div>

										
										<div class="form-group">
											<label class="display-block">Your avatar:</label>
											<div class="uploader">
											<input type="file" class="file-styled">
											</div>
											<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
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
</div>