<!DOCTYPE html>
<html lang="en">
<!-- Headerlinks -->
<?php include('includes/headerlinks.php') ?>
<body>
	<!-- Main navbar -->
	<?php include('includes/header.php') ?>
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include('includes/sidebar.php') ?>
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4>Edit Profile</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?= base_url('vendor/dashboard')?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Edit Profile</span>
						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
				<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Edit Profile</h6>
							</div>
							<?php 
							if (isset($editVendorData) && count($editVendorData) != 0) {
								$vendorname = $editVendorData[0]->vendor_name;
								$email = $editVendorData[0]->vendor_email;
								$Address = $editVendorData[0]->vendor_address;
								$vendorCity = $editVendorData[0]->city_id;
								$GetState = $this->VendorModel->getCityState($vendorCity);
								$state = $GetState[0]->state_id;
								$pin = $editVendorData[0]->pin_code;
								$vendorContact = $editVendorData[0]->vendor_contact;
							}
							?>
							<div class="card-body">
								<?php
								if ($this->session->flashdata('errMsg')) { ?>
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?= $this->session->flashdata('errMsg') ?>
									</div>
									<?php
								}elseif ($this->session->flashdata('successMsg')) { ?>
									<div class="alert alert-success alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?= $this->session->flashdata('successMsg') ?>
									</div>
								<?php  }
								?>
								<form id="vendorSubmit" action="" method="post">
									<fieldset class="mb-3">
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Name:</label>
											<div class="col-lg-8">
												<input type="text" name="vendor_name" class="form-control" placeholder="Enter Name" value="<?= @$vendorname ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Email:</label>
											<div class="col-lg-8">
												<input type="text" name="vendor_email" class="form-control" placeholder="Enter Email ID" value="<?= @$email ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Address:</label>
											<div class="col-lg-8">
												<textarea rows="3" cols="3" name="vendor_address" class="form-control" placeholder="Enter Address"><?= @$Address ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Pin Code:</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" name="pin_code" placeholder="Enter Pin Code" maxlength="6" value="<?= @$pin ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Select State:</label>
											<div class="col-lg-8">
												<select class="form-control form-control-uniform states" name="state" data-fouc required>
													<option value="">Select State</option>
													<?php
													foreach ($states as $r) { ?>
														<option value="<?= $r->state_id ?>" <?= $r->state_id == $state ? 'selected' : '' ?>><?= $r->state_name ?></option>
													<?php  }
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Select City:</label>
											<div class="col-lg-8">
												<select class="form-control form-control-uniform city_field"  name="city_id" data-fouc required>
													<option value="<?= @$vendorCity ?>"><?= @$vendorCity != '' ? @getCityName($vendorCity) : 'Select City' ?></option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Contact No:</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" name="vendor_contact" placeholder="Enter Mobile No." value="<?= @$vendorContact ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Current Password:</label>
											<div class="col-lg-8">
												<input type="password" name="password" class="form-control" placeholder="Leave Empty if you don't want to change">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Password:</label>
											<div class="col-lg-8">
												<input type="password" name="npassword" class="form-control" placeholder="Enter Password">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-2">Confirm Password:</label>
											<div class="col-lg-8">
												<input type="password" name="cpassword" class="form-control" placeholder="Re Enter Password">
											</div>
										</div>
										<div class="d-flex justify-content-end align-items-center">
											<button type="submit" class="btn btn-primary ml-3">Submit <i class="icon-paperplane ml-2"></i></button>
										</div>
									</fieldset>
								</form>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- /content area -->

<!-- Footer -->
<?php include('includes/footer.php') ?>
<!-- /footer -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->
<?php include('includes/footerlinks.php') ?>
<script type="text/javascript">
	$(document).ready(function(){

		$('input,textarea').on('change',function(){
			if ($(this).val() != null || $(this).value != "") {
				$(this).css('border-color','#ddd');
			}
		});
		$('.states').on('change',function(){
			var stateID = $('.states').val();
			$('.city_field').html('<option value="">Select City</option>');
			var formData = new FormData();
			formData.set('state_id',stateID);
			$.ajax({
				url: '<?= base_url('vendor/citylist') ?>',
				type: 'post',
				processData: false,
				contentType: false,
				data: formData,
				success: function(a){
					a = JSON.parse(a);
					$.each(a,function(ind,value){
						var opt = $('<option/>');
						opt.val(value['city_id']);
						opt.text(value['city_name']);
						$('.city_field').append(opt);
					})
				}
			})
		});
		$('#vendorSubmit').on('submit',function(e){
			if (validate() != 0) {
				e.preventDefault();
				return false;
			}
		})
	});
	function validate()
	{
		var inps = $('input:not([type=password]),select,textarea');
		var count = 0;
		$.each(inps,function(ind,inp){
			if (inp.value == null || inp.value == "") {
				$(this).css('border-color','red');
				count++;
			}else{
				$(this).css('border-color','#ddd');
			}
		});
		return count;  
	}
</script>
</body>
</html>
